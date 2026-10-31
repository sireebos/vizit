<?php
/**
 * Kuwait Cabin Hotel Bar - Content Population Script
 * 
 * Upload this file to your server root (same folder as 'artisan' file)
 * Visit: https://yourdomain.com/populate.php
 * DELETE THIS FILE IMMEDIATELY AFTER USE!
 */

// Security check - comment out this line if you trust the environment
$allowedIPs = []; // Add your IP here like: ['123.456.789.0'] or leave empty to allow all

if (!empty($allowedIPs) && !in_array($_SERVER['REMOTE_ADDR'], $allowedIPs)) {
    die('Access denied. Your IP: ' . $_SERVER['REMOTE_ADDR']);
}

echo "<html><head><title>Kuwait Cabin Hotel Bar - Content Population</title>";
echo "<style>
    body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; background: #f5f5f5; }
    .box { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
    h1 { color: #333; border-bottom: 2px solid #c9a227; padding-bottom: 10px; }
    .success { color: #28a745; font-weight: bold; }
    .error { color: #dc3545; font-weight: bold; }
    .warning { color: #ffc107; background: #fff3cd; padding: 15px; border-radius: 5px; margin: 20px 0; }
    .info { color: #17a2b8; }
    pre { background: #1e1e1e; color: #9cdcfe; padding: 15px; border-radius: 5px; overflow-x: auto; }
    ul { line-height: 2; }
</style></head><body><div class='box'>";

echo "<h1>🏨 Kuwait Cabin Hotel Bar</h1>";
echo "<h2>Content Population Script</h2>";

try {
    // Bootstrap Laravel
    require __DIR__.'/vendor/autoload.php';
    $app = require_once __DIR__.'/bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();

    echo "<p class='info'>✅ Laravel bootstrapped successfully</p>";

    // Run the seeder
    echo "<p class='info'>⏳ Running content population...</p>";
    
    Artisan::call('db:seed', [
        '--class' => 'PopulateContentSeeder',
        '--force' => true
    ]);

    $output = Artisan::output();

    echo "<p class='success'>✅ CONTENT POPULATED SUCCESSFULLY!</p>";
    
    echo "<h3>Output:</h3>";
    echo "<pre>" . htmlspecialchars($output) . "</pre>";

    echo "<h3>✅ Content Added:</h3>";
    echo "<ul>
        <li>Site Settings (name, contact, social media)</li>
        <li>Home Page (hero, intro, features, rooms, testimonials)</li>
        <li>About Page (story, services, quotes)</li>
        <li>Contact Page (form, info)</li>
        <li>Services Page (6 service boxes, 4 offers)</li>
        <li>Restaurant Page (menu section)</li>
        <li>Rooms Page (4 room types: ₦55,000 - ₦250,000)</li>
        <li>Explore Page (Lagos attractions)</li>
        <li>Terms & Conditions (5 FAQ items)</li>
        <li>15 Restaurant Menu Items</li>
    </ul>";

    echo "<div class='warning'>
        <strong>⚠️ IMPORTANT SECURITY WARNING:</strong><br>
        DELETE THIS FILE (populate.php) FROM YOUR SERVER IMMEDIATELY!<br>
        Anyone can run this script if it remains on your server.
    </div>";

    echo "<p><strong>Next Steps:</strong></p>";
    echo "<ol>
        <li>Visit your website to verify the content</li>
        <li>Delete this populate.php file from your server</li>
        <li>Log into admin panel to customize content further</li>
    </ol>";

} catch (Exception $e) {
    echo "<p class='error'>❌ ERROR: " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
    
    echo "<h3>Troubleshooting:</h3>";
    echo "<ul>
        <li>Make sure this file is in the project root (same folder as 'artisan')</li>
        <li>Ensure database migrations have been run: <code>php artisan migrate</code></li>
        <li>Check that PopulateContentSeeder.php exists in database/seeders/</li>
        <li>Verify database connection in .env file</li>
    </ul>";
}

echo "</div></body></html>";

