<?php
/**
 * Production Cache Clear Script
 * Upload this to your public folder, run it once, then DELETE it!
 * Access via: https://yourdomain.com/clear_cache.php
 */

// Change to the Laravel root directory
chdir(__DIR__);

// If this file is in public folder, go up one level
if (basename(__DIR__) === 'public') {
    chdir(dirname(__DIR__));
}

echo "<pre>";
echo "=== Laravel Production Cache Clear ===\n\n";

// Check if we're in the right directory
if (!file_exists('artisan')) {
    // Try going up one level if artisan not found
    chdir('..');
    if (!file_exists('artisan')) {
        die("Error: Could not find Laravel artisan file. Make sure this script is in the public folder.\n");
    }
}

echo "Working directory: " . getcwd() . "\n\n";

$commands = [
    'php artisan config:clear' => 'Clearing config cache...',
    'php artisan cache:clear' => 'Clearing application cache...',
    'php artisan route:clear' => 'Clearing route cache...',
    'php artisan view:clear' => 'Clearing view cache...',
    'php artisan event:clear' => 'Clearing event cache...',
];

foreach ($commands as $command => $message) {
    echo $message . "\n";
    $output = [];
    $returnCode = 0;
    exec($command . ' 2>&1', $output, $returnCode);
    echo implode("\n", $output) . "\n";
    echo ($returnCode === 0 ? "✓ Success" : "✗ Failed (code: $returnCode)") . "\n\n";
}

// Try to run composer dump-autoload
echo "Regenerating autoload files...\n";
$output = [];
exec('composer dump-autoload -o 2>&1', $output, $returnCode);
if ($returnCode !== 0) {
    // Try with full path common on cPanel
    exec('/usr/local/bin/composer dump-autoload -o 2>&1', $output, $returnCode);
}
echo implode("\n", $output) . "\n";
echo ($returnCode === 0 ? "✓ Success" : "⚠ May need to run manually via SSH") . "\n\n";

echo "=== Cache clearing complete! ===\n";
echo "\n⚠️  IMPORTANT: Delete this file immediately after use for security!\n";
echo "</pre>";
