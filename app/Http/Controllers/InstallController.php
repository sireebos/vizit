<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class InstallController extends Controller
{
    /**
     * Check if application is already installed
     */
    public static function isInstalled(): bool
    {
        return File::exists(storage_path('installed'));
    }

    /**
     * Step 1: Welcome & Requirements Check
     */
    public function welcome()
    {
        if (self::isInstalled()) {
            return redirect('/');
        }

        $requirements = $this->checkRequirements();
        $allPassed = collect($requirements)->every(fn($r) => $r['status']);

        return view('install.welcome', compact('requirements', 'allPassed'));
    }

    /**
     * Step 2: Database Configuration
     */
    public function database()
    {
        if (self::isInstalled()) {
            return redirect('/');
        }

        return view('install.database');
    }

    /**
     * Step 2: Process Database Configuration
     */
    public function databaseStore(Request $request)
    {
        $request->validate([
            'db_type' => 'required|in:sqlite,mysql',
            'db_host' => 'required_if:db_type,mysql',
            'db_port' => 'required_if:db_type,mysql',
            'db_database' => 'required_if:db_type,mysql',
            'db_username' => 'required_if:db_type,mysql',
            'db_password' => 'nullable',
        ]);

        try {
            if ($request->db_type === 'sqlite') {
                $this->configureSQLite();
            } else {
                $this->configureMySQL($request);
            }

            // Test connection
            DB::reconnect();
            DB::connection()->getPdo();

            return redirect()->route('install.migration');
        } catch (\Exception $e) {
            return back()->withErrors(['database' => 'Database connection failed: ' . $e->getMessage()]);
        }
    }

    /**
     * Step 3: Run Migrations
     */
    public function migration()
    {
        if (self::isInstalled()) {
            return redirect('/');
        }

        return view('install.migration');
    }

    /**
     * Step 3: Process Migrations
     */
    public function migrationRun()
    {
        try {
            // Run migrations
            Artisan::call('migrate', ['--force' => true]);
            
            // Create storage link
            if (!File::exists(public_path('storage'))) {
                Artisan::call('storage:link');
            }

            return redirect()->route('install.admin');
        } catch (\Exception $e) {
            return back()->withErrors(['migration' => 'Migration failed: ' . $e->getMessage()]);
        }
    }

    /**
     * Step 4: Create Admin User
     */
    public function admin()
    {
        if (self::isInstalled()) {
            return redirect('/');
        }

        return view('install.admin');
    }

    /**
     * Step 4: Process Admin Creation
     */
    public function adminStore(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|confirmed',
        ]);

        try {
            // Create admin user
            $admin = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => 'active',
                'employee_id' => 'ADMIN001',
                'hire_date' => now(),
            ]);

            // Assign admin role if spatie/laravel-permission is set up
            if (method_exists($admin, 'assignRole')) {
                // Check if Admin role exists, if not create it
                $roleClass = \Spatie\Permission\Models\Role::class;
                if (class_exists($roleClass)) {
                    $adminRole = $roleClass::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
                    $admin->assignRole($adminRole);
                }
            }

            return redirect()->route('install.site');
        } catch (\Exception $e) {
            return back()->withErrors(['admin' => 'Failed to create admin: ' . $e->getMessage()]);
        }
    }

    /**
     * Step 5: Site Configuration
     */
    public function site()
    {
        if (self::isInstalled()) {
            return redirect('/');
        }

        return view('install.site');
    }

    /**
     * Step 5: Process Site Configuration
     */
    public function siteStore(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'app_url' => 'required|url',
        ]);

        try {
            // Update .env with APP_URL
            $this->updateEnv([
                'APP_NAME' => '"' . $request->site_name . '"',
                'APP_URL' => $request->app_url,
                'APP_ENV' => 'production',
                'APP_DEBUG' => 'false',
            ]);

            // Create/update site settings
            \App\Models\SiteSettings::updateOrCreate(
                ['id' => 1],
                ['site_name' => $request->site_name]
            );

            return redirect()->route('install.finish');
        } catch (\Exception $e) {
            return back()->withErrors(['site' => 'Failed to save settings: ' . $e->getMessage()]);
        }
    }

    /**
     * Step 6: Finish Installation
     */
    public function finish()
    {
        if (self::isInstalled()) {
            return redirect('/');
        }

        return view('install.finish');
    }

    /**
     * Complete the installation
     */
    public function complete()
    {
        try {
            // Generate app key if not set
            if (empty(config('app.key')) || config('app.key') === 'base64:') {
                Artisan::call('key:generate', ['--force' => true]);
            }

            // Clear and cache
            Artisan::call('config:clear');
            Artisan::call('cache:clear');
            Artisan::call('view:clear');

            // Mark as installed
            File::put(storage_path('installed'), date('Y-m-d H:i:s'));

            return redirect('/')->with('status', 'Installation completed successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['complete' => 'Failed to complete: ' . $e->getMessage()]);
        }
    }

    /**
     * Check system requirements
     */
    protected function checkRequirements(): array
    {
        return [
            [
                'name' => 'PHP Version',
                'required' => '>= 8.2',
                'current' => PHP_VERSION,
                'status' => version_compare(PHP_VERSION, '8.2.0', '>='),
            ],
            [
                'name' => 'PDO Extension',
                'required' => 'Enabled',
                'current' => extension_loaded('pdo') ? 'Enabled' : 'Disabled',
                'status' => extension_loaded('pdo'),
            ],
            [
                'name' => 'PDO SQLite',
                'required' => 'Enabled',
                'current' => extension_loaded('pdo_sqlite') ? 'Enabled' : 'Disabled',
                'status' => extension_loaded('pdo_sqlite'),
            ],
            [
                'name' => 'PDO MySQL',
                'required' => 'Enabled',
                'current' => extension_loaded('pdo_mysql') ? 'Enabled' : 'Disabled',
                'status' => extension_loaded('pdo_mysql'),
            ],
            [
                'name' => 'OpenSSL Extension',
                'required' => 'Enabled',
                'current' => extension_loaded('openssl') ? 'Enabled' : 'Disabled',
                'status' => extension_loaded('openssl'),
            ],
            [
                'name' => 'Mbstring Extension',
                'required' => 'Enabled',
                'current' => extension_loaded('mbstring') ? 'Enabled' : 'Disabled',
                'status' => extension_loaded('mbstring'),
            ],
            [
                'name' => 'Tokenizer Extension',
                'required' => 'Enabled',
                'current' => extension_loaded('tokenizer') ? 'Enabled' : 'Disabled',
                'status' => extension_loaded('tokenizer'),
            ],
            [
                'name' => 'Ctype Extension',
                'required' => 'Enabled',
                'current' => extension_loaded('ctype') ? 'Enabled' : 'Disabled',
                'status' => extension_loaded('ctype'),
            ],
            [
                'name' => 'JSON Extension',
                'required' => 'Enabled',
                'current' => extension_loaded('json') ? 'Enabled' : 'Disabled',
                'status' => extension_loaded('json'),
            ],
            [
                'name' => 'Fileinfo Extension',
                'required' => 'Enabled',
                'current' => extension_loaded('fileinfo') ? 'Enabled' : 'Disabled',
                'status' => extension_loaded('fileinfo'),
            ],
            [
                'name' => 'Storage Directory',
                'required' => 'Writable',
                'current' => is_writable(storage_path()) ? 'Writable' : 'Not Writable',
                'status' => is_writable(storage_path()),
            ],
            [
                'name' => 'Bootstrap Cache',
                'required' => 'Writable',
                'current' => is_writable(base_path('bootstrap/cache')) ? 'Writable' : 'Not Writable',
                'status' => is_writable(base_path('bootstrap/cache')),
            ],
        ];
    }

    /**
     * Configure SQLite database
     */
    protected function configureSQLite()
    {
        $dbPath = database_path('database.sqlite');

        if (!File::exists($dbPath)) {
            File::put($dbPath, '');
        }

        $this->updateEnv([
            'DB_CONNECTION' => 'sqlite',
            'DB_DATABASE' => $dbPath,
            'DB_HOST' => '',
            'DB_PORT' => '',
            'DB_USERNAME' => '',
            'DB_PASSWORD' => '',
        ]);

        config(['database.default' => 'sqlite']);
        config(['database.connections.sqlite.database' => $dbPath]);
    }

    /**
     * Configure MySQL database
     */
    protected function configureMySQL(Request $request)
    {
        $this->updateEnv([
            'DB_CONNECTION' => 'mysql',
            'DB_HOST' => $request->db_host,
            'DB_PORT' => $request->db_port,
            'DB_DATABASE' => $request->db_database,
            'DB_USERNAME' => $request->db_username,
            'DB_PASSWORD' => $request->db_password ?? '',
        ]);

        config(['database.default' => 'mysql']);
        config(['database.connections.mysql.host' => $request->db_host]);
        config(['database.connections.mysql.port' => $request->db_port]);
        config(['database.connections.mysql.database' => $request->db_database]);
        config(['database.connections.mysql.username' => $request->db_username]);
        config(['database.connections.mysql.password' => $request->db_password ?? '']);
    }

    /**
     * Update .env file
     */
    protected function updateEnv(array $data)
    {
        $envPath = base_path('.env');

        if (!File::exists($envPath)) {
            File::copy(base_path('.env.example'), $envPath);
        }

        $envContent = File::get($envPath);

        foreach ($data as $key => $value) {
            $pattern = "/^{$key}=.*/m";
            $replacement = "{$key}={$value}";

            if (preg_match($pattern, $envContent)) {
                $envContent = preg_replace($pattern, $replacement, $envContent);
            } else {
                $envContent .= "\n{$replacement}";
            }
        }

        File::put($envPath, $envContent);
    }
}

