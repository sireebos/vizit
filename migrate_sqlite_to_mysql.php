<?php
/**
 * Script to migrate data from SQLite to MySQL
 */

// SQLite connection
$sqlitePath = __DIR__ . '/database/database.sqlite';
$sqlite = new PDO("sqlite:$sqlitePath");
$sqlite->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// MySQL connection
$mysql = new PDO('mysql:host=127.0.0.1;port=3306;dbname=hotel_vermon', 'root', '');
$mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$mysql->exec("SET FOREIGN_KEY_CHECKS=0");

// Get all tables from SQLite
$tables = $sqlite->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%' ORDER BY name");
$tableList = $tables->fetchAll(PDO::FETCH_COLUMN);

echo "Found " . count($tableList) . " tables in SQLite\n\n";

foreach ($tableList as $table) {
    try {
        // Get row count
        $count = $sqlite->query("SELECT COUNT(*) FROM `$table`")->fetchColumn();
        
        if ($count == 0) {
            echo "[$table] - 0 rows (skipped)\n";
            continue;
        }
        
        // Get all data from SQLite
        $data = $sqlite->query("SELECT * FROM `$table`")->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($data)) {
            echo "[$table] - No data\n";
            continue;
        }
        
        // Clear existing data in MySQL
        $mysql->exec("DELETE FROM `$table`");
        
        // Get columns
        $columns = array_keys($data[0]);
        $columnList = implode('`, `', $columns);
        $placeholders = implode(', ', array_fill(0, count($columns), '?'));
        
        // Prepare insert statement
        $sql = "INSERT INTO `$table` (`$columnList`) VALUES ($placeholders)";
        $stmt = $mysql->prepare($sql);
        
        $inserted = 0;
        foreach ($data as $row) {
            try {
                $stmt->execute(array_values($row));
                $inserted++;
            } catch (Exception $e) {
                echo "  Error inserting into $table: " . $e->getMessage() . "\n";
            }
        }
        
        echo "[$table] - $inserted/$count rows migrated\n";
        
    } catch (Exception $e) {
        echo "[$table] - Error: " . $e->getMessage() . "\n";
    }
}

$mysql->exec("SET FOREIGN_KEY_CHECKS=1");

echo "\n=== Migration complete! ===\n";
