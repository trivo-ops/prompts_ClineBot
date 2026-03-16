<?php
// Simple test script to verify categories functionality
require_once 'config/bootstrap.php';

use Cake\ORM\TableRegistry;

// Test Categories table
echo "Testing Categories functionality...\n";

try {
    $categoriesTable = TableRegistry::getTableLocator()->get('Categories');

    // Test creating a category
    $category = $categoriesTable->newEntity([
        'name' => 'Test Category',
        'description' => 'Test category for verification'
    ]);

    if ($categoriesTable->save($category)) {
        echo "✓ Category created successfully with ID: " . $category->id . "\n";

        // Test retrieving the category
        $retrieved = $categoriesTable->get($category->id);
        echo "✓ Category retrieved: " . $retrieved->name . "\n";

        // Clean up
        $categoriesTable->delete($category);
        echo "✓ Category deleted successfully\n";
    } else {
        echo "✗ Failed to create category\n";
        print_r($category->getErrors());
    }
} catch (Exception $e) {
    echo "✗ Error testing categories: " . $e->getMessage() . "\n";
}

// Test Products table with category_id
echo "\nTesting Products with categories...\n";

try {
    $productsTable = TableRegistry::getTableLocator()->get('Products');

    // Create a test category first
    $categoriesTable = TableRegistry::getTableLocator()->get('Categories');
    $category = $categoriesTable->newEntity([
        'name' => 'Test Category for Product',
        'description' => 'Test category'
    ]);
    $categoriesTable->save($category);

    // Test creating a product with category
    $product = $productsTable->newEntity([
        'name' => 'Test Product',
        'description' => 'Test product with category',
        'price' => 99.99,
        'category_id' => $category->id
    ]);

    if ($productsTable->save($product)) {
        echo "✓ Product created successfully with category ID: " . $product->category_id . "\n";

        // Test retrieving product with category association
        $productWithCategory = $productsTable->get($product->id, [
            'contain' => ['Categories']
        ]);

        echo "✓ Product retrieved with category: " . $productWithCategory->category->name . "\n";

        // Clean up
        $productsTable->delete($product);
        $categoriesTable->delete($category);
        echo "✓ Test data cleaned up\n";
    } else {
        echo "✗ Failed to create product with category\n";
        print_r($product->getErrors());
    }
} catch (Exception $e) {
    echo "✗ Error testing products with categories: " . $e->getMessage() . "\n";
}

echo "\nAll tests completed!\n";
