<?php
/**
 * Simple functional verification script for Products CRUD operations
 * This script can be run manually to verify the implementation works correctly
 */

require_once __DIR__ . '/../config/bootstrap.php';

use Cake\ORM\TableRegistry;

// Test the Products table
echo "=== Products CRUD Functional Verification ===\n\n";

try {
    // Get the Products table
    $products = TableRegistry::getTableLocator()->get('Products');
    echo "✓ Products table loaded successfully\n";

    // Test 1: Create a new product
    echo "\n1. Testing CREATE operation...\n";
    $newProduct = $products->newEntity([
        'name' => 'Functional Test Product',
        'category' => 'Test Category',
        'price' => 99.99,
        'stock' => 10,
        'size' => 'Test Size',
        'color' => 'Test Color'
    ]);

    if ($products->save($newProduct)) {
        echo "✓ Product created successfully with ID: " . $newProduct->id . "\n";
        $productId = $newProduct->id;

        // Test 2: Read the product
        echo "\n2. Testing READ operation...\n";
        $retrievedProduct = $products->get($productId);
        if ($retrievedProduct) {
            echo "✓ Product retrieved successfully\n";
            echo "  Name: " . $retrievedProduct->name . "\n";
            echo "  Category: " . $retrievedProduct->category . "\n";
            echo "  Price: $" . $retrievedProduct->price . "\n";
            echo "  Stock: " . $retrievedProduct->stock . "\n";
            echo "  Size: " . $retrievedProduct->size . "\n";
            echo "  Color: " . $retrievedProduct->color . "\n";

            // Test 3: Update the product
            echo "\n3. Testing UPDATE operation...\n";
            $retrievedProduct->name = 'Updated Test Product';
            $retrievedProduct->price = 149.99;

            if ($products->save($retrievedProduct)) {
                echo "✓ Product updated successfully\n";

                // Verify the update
                $updatedProduct = $products->get($productId);
                if ($updatedProduct->name === 'Updated Test Product' && $updatedProduct->price == 149.99) {
                    echo "✓ Product data verified after update\n";

                    // Test 4: Delete the product
                    echo "\n4. Testing DELETE operation...\n";
                    if ($products->delete($updatedProduct)) {
                        echo "✓ Product deleted successfully\n";

                        // Verify deletion
                        $deletedProduct = $products->find()->where(['id' => $productId])->first();
                        if (!$deletedProduct) {
                            echo "✓ Product deletion verified\n";
                            echo "\nAll CRUD operations completed successfully!\n";
                        } else {
                            echo "Product still exists after deletion\n";
                        }
                    } else {
                        echo "Failed to delete product\n";
                    }
                } else {
                    echo "Product data not updated correctly\n";
                }
            } else {
                echo "Failed to update product\n";
                print_r($retrievedProduct->getErrors());
            }
        } else {
            echo "Failed to retrieve product\n";
        }
    } else {
        echo "Failed to create product\n";
        print_r($newProduct->getErrors());
    }

} catch (Exception $e) {
    echo "Error during verification: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}

echo "\n=== Verification Complete ===\n";
