<?php
/**
 * Standalone script to fix the products table schema
 * This script can be run without the full CakePHP environment
 */

// Database configuration - adjust these values for your environment
$host = 'localhost';
$dbname = 'cakephp';
$username = 'root';
$password = ''; // Change this to your MySQL root password

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected to database successfully.\n\n";

    // SQL statements to fix the schema
    $sqlStatements = [
        "-- Add category_id column to products table",
        "ALTER TABLE products ADD COLUMN category_id CHAR(36) NULL COMMENT 'Foreign key to categories table';",

        "-- Add foreign key constraint",
        "ALTER TABLE products ADD CONSTRAINT fk_products_category_id FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL ON UPDATE CASCADE;",

        "-- Create index for better performance",
        "CREATE INDEX idx_products_category_id ON products(category_id);",

        "-- Update existing products to have a default category",
        "UPDATE products p SET category_id = (SELECT id FROM categories LIMIT 1) WHERE category_id IS NULL;"
    ];

    // Execute each statement
    foreach ($sqlStatements as $sql) {
        if (strpos($sql, '--') === 0) {
            echo $sql . "\n";
            continue;
        }

        echo "Executing: " . substr($sql, 0, 50) . "...\n";
        $pdo->exec($sql);
        echo "✓ Statement executed successfully.\n\n";
    }

    // Verify the changes
    echo "=== VERIFICATION ===\n";

    // Check columns
    $stmt = $pdo->query("
        SELECT COLUMN_NAME, IS_NULLABLE, COLUMN_TYPE, COLUMN_KEY
        FROM information_schema.COLUMNS
        WHERE TABLE_SCHEMA = '$dbname' AND TABLE_NAME = 'products'
        ORDER BY ORDINAL_POSITION
    ");

    echo "Products table columns:\n";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "  {$row['COLUMN_NAME']} ({$row['COLUMN_TYPE']}) - Nullable: {$row['IS_NULLABLE']}, Key: {$row['COLUMN_KEY']}\n";
    }

    // Check foreign key constraints
    $stmt = $pdo->query("
        SELECT CONSTRAINT_NAME, COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME
        FROM information_schema.KEY_COLUMN_USAGE
        WHERE TABLE_SCHEMA = '$dbname' AND TABLE_NAME = 'products' AND REFERENCED_TABLE_NAME IS NOT NULL
    ");

    echo "\nForeign key constraints:\n";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "  {$row['CONSTRAINT_NAME']}: {$row['COLUMN_NAME']} -> {$row['REFERENCED_TABLE_NAME']}.{$row['REFERENCED_COLUMN_NAME']}\n";
    }

    echo "\n✅ Schema fix completed successfully!\n";
    echo "The products table now has the category_id column and foreign key constraint.\n";

} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Please check your database connection settings and ensure the database exists.\n";
    exit(1);
}
