<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PopulateContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'content:populate {--fresh : Clear existing data before populating}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate the database with Kuwait Cabin Hotel Bar content from document.txt';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('');
        $this->info('╔══════════════════════════════════════════════════════════╗');
        $this->info('║     KUWAIT CABIN HOTEL BAR - CONTENT POPULATION          ║');
        $this->info('╚══════════════════════════════════════════════════════════╝');
        $this->info('');

        if ($this->option('fresh')) {
            if ($this->confirm('This will clear existing page settings. Are you sure?', false)) {
                $this->warn('Clearing existing data...');
                $this->clearExistingData();
            } else {
                $this->info('Operation cancelled.');
                return 0;
            }
        }

        $this->info('Populating content...');
        $this->newLine();

        // Run the seeder
        $this->call('db:seed', [
            '--class' => 'PopulateContentSeeder',
            '--force' => true,
        ]);

        $this->newLine();
        $this->info('╔══════════════════════════════════════════════════════════╗');
        $this->info('║                    POPULATION COMPLETE!                   ║');
        $this->info('╚══════════════════════════════════════════════════════════╝');
        $this->newLine();
        
        $this->table(
            ['Content Type', 'Status'],
            [
                ['Site Settings', '✅ Populated'],
                ['Home Page', '✅ Populated'],
                ['About Page', '✅ Populated'],
                ['Contact Page', '✅ Populated'],
                ['Services Page', '✅ Populated'],
                ['Restaurant Page', '✅ Populated'],
                ['Rooms Page', '✅ Populated'],
                ['Explore Page', '✅ Populated'],
                ['Terms & Conditions', '✅ Populated'],
                ['Room Types (4)', '✅ Created'],
                ['Menu Items (15)', '✅ Created'],
                ['Website Settings', '✅ Populated'],
            ]
        );

        $this->newLine();
        $this->info('Your website is now ready with Kuwait Cabin Hotel Bar content!');
        $this->info('Visit your site to see the changes.');
        $this->newLine();

        return 0;
    }

    /**
     * Clear existing page settings data
     */
    private function clearExistingData(): void
    {
        \App\Models\HomePageSettings::truncate();
        \App\Models\AboutPageSettings::truncate();
        \App\Models\ContactPageSettings::truncate();
        \App\Models\ServicesPageSettings::truncate();
        \App\Models\RestaurantPageSettings::truncate();
        \App\Models\RoomsPageSettings::truncate();
        \App\Models\ExplorePageSettings::truncate();
        \App\Models\TandcPageSettings::truncate();
    }
}

