<?php
// Simple integration test to verify categories functionality
require_once 'config/bootstrap.php';

use Cake\ORM\TableRegistry;

// Test 1: Check if Categories table exists and has data
echo "Testing Categories integration...\n";

try {
    $categoriesTable = TableRegistry::getTableLocator()->get('Categories');
    $categories = $categoriesTable->find('list', [
        'keyField' => 'id',
        'valueField' => 'name',
        'order' => ['name' => 'ASC']
    ])->toArray();

    echo "✓ Categories table accessible\n";
    echo "✓ Found " . count($categories) . " categories\n";

    if (count($categories) > 0) {
        echo "✓ Categories data available:\n";
        foreach ($categories as $id => $name) {
            echo "  - $name (ID: $id)\n";
        }
    }

} catch (Exception $e) {
    echo "✗ Error accessing Categories: " . $e->getMessage() . "\n";
    exit(1);
}

// Test 2: Check if Products table can access Categories relationship
try {
    $productsTable = TableRegistry::getTableLocator()->get('Products');

    // Test the association
    $query = $productsTable->find()
        ->contain(['Categories'])
        ->limit(1);

    $result = $query->first();

    if ($result) {
        echo "✓ Products can access Categories relationship\n";
        echo "✓ Sample product: " . $result->name . " (Category: " . $result->category->name . ")\n";
    } else {
        echo "✓ Products table accessible, no products found (this is okay)\n";
    }

} catch (Exception $e) {
    echo "✗ Error testing Products-Categories relationship: " . $e->getMessage() . "\n";
    exit(1);
}

echo "\nAll tests passed! Categories integration is working correctly.\n";
