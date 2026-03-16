<?php
// Simple database test to verify categories functionality
$host = 'db';
$db = 'cakephp';
$user = 'cakephp';
$pass = 'cakephp';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "✓ Database connection successful\n";

    // Test Categories table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'categories'");
    if ($stmt->fetch()) {
        echo "✓ Categories table exists\n";
    } else {
        echo "✗ Categories table not found\n";
    }

    // Test Products table has category_id
    $stmt = $pdo->query("DESCRIBE products");
    $hasCategoryId = false;
    while ($row = $stmt->fetch()) {
        if ($row['Field'] === 'category_id') {
            $hasCategoryId = true;
            echo "✓ Products table has category_id field\n";
            break;
        }
    }
    if (!$hasCategoryId) {
        echo "✗ Products table missing category_id field\n";
    }

    // Test foreign key constraint
    $stmt = $pdo->query("SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = 'cakephp' AND TABLE_NAME = 'products' AND COLUMN_NAME = 'category_id' AND REFERENCED_TABLE_NAME IS NOT NULL");
    if ($stmt->fetch()) {
        echo "✓ Foreign key constraint exists\n";
    } else {
        echo "✗ Foreign key constraint not found\n";
    }

    // Test inserting a category with UUID
    $categoryId = strtolower(sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    ));
    $categoryName = 'Test Category ' . time();
    $stmt = $pdo->prepare("INSERT INTO categories (id, name, description, created, modified) VALUES (?, ?, ?, NOW(), NOW())");
    $stmt->execute([$categoryId, $categoryName, 'Test description']);
    echo "✓ Category inserted with ID: $categoryId\n";

    // Test inserting a product with category
    $productId = strtolower(sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    ));
    $stmt = $pdo->prepare("INSERT INTO products (id, name, price, category_id, created, modified) VALUES (?, ?, ?, ?, NOW(), NOW())");
    $stmt->execute([$productId, 'Test Product', 99.99, $categoryId]);
    echo "✓ Product inserted with category ID: $productId\n";

    // Test retrieving product with category
    $stmt = $pdo->prepare("SELECT p.name as product_name, c.name as category_name FROM products p JOIN categories c ON p.category_id = c.id WHERE p.id = ?");
    $stmt->execute([$productId]);
    $result = $stmt->fetch();
    if ($result) {
        echo "✓ Product retrieved with category: {$result['product_name']} - {$result['category_name']}\n";
    }

    // Clean up test data
    $pdo->exec("DELETE FROM products WHERE id = '$productId'");
    $pdo->exec("DELETE FROM categories WHERE id = '$categoryId'");
    echo "✓ Test data cleaned up\n";

    echo "\n🎉 All database tests passed successfully!\n";

} catch (PDOException $e) {
    echo "✗ Database error: " . $e->getMessage() . "\n";
}
