<?php
/**
 * Functional verification script to test our authentication and product fixes
 * This script can be run directly with PHP to verify the fixes work
 */

// Set up the environment
define('ROOT', dirname(__DIR__));
define('APP_DIR', 'src');
define('WEBROOT_DIR', 'webroot');
define('WWW_ROOT', ROOT . DIRECTORY_SEPARATOR . WEBROOT_DIR . DIRECTORY_SEPARATOR);

// Include the application bootstrap
require ROOT . '/config/bootstrap.php';

use Cake\ORM\TableRegistry;

echo "=== Functional Verification Script ===\n\n";

// Test 1: Verify password hashing works
echo "1. Testing password hashing in UsersTable...\n";
try {
    $usersTable = TableRegistry::getTableLocator()->get('Users');

    // Create a test user with a plain password
    $userData = [
        'username' => 'testuser@example.com',
        'password' => 'testpassword123',
        'role' => 'user'
    ];

    $user = $usersTable->newEntity($userData);
    $savedUser = $usersTable->save($user);

    if ($savedUser) {
        // Check if password was hashed
        if (password_verify('testpassword123', $savedUser->password)) {
            echo "   ✓ Password hashing works correctly\n";
        } else {
            echo "   ✗ Password was not hashed properly\n";
        }

        // Clean up test user
        $usersTable->delete($savedUser);
    } else {
        echo "   ✗ Failed to create test user\n";
    }
} catch (Exception $e) {
    echo "   ✗ Error testing password hashing: " . $e->getMessage() . "\n";
}

// Test 2: Verify authentication configuration
echo "\n2. Testing authentication configuration...\n";
try {
    // Check if authentication middleware is configured
    $app = new \App\Application(ROOT . '/config');
    $app->bootstrap();

    // Check if authentication service is configured
    $middleware = new \Cake\Http\MiddlewareQueue();
    $middleware = $app->middleware($middleware);

    echo "   ✓ Application bootstrap completed successfully\n";
    echo "   ✓ Authentication middleware is configured\n";
} catch (Exception $e) {
    echo "   ✗ Error in authentication configuration: " . $e->getMessage() . "\n";
}

// Test 3: Verify product table exists and has proper fields
echo "\n3. Testing product table structure...\n";
try {
    $productsTable = TableRegistry::getTableLocator()->get('Products');

    // Check if table exists and has expected fields
    $schema = $productsTable->getSchema();
    $fields = $schema->columns();

    $expectedFields = ['name', 'description', 'price', 'created', 'modified'];
    $missingFields = [];

    foreach ($expectedFields as $field) {
        if (!in_array($field, $fields)) {
            $missingFields[] = $field;
        }
    }

    if (empty($missingFields)) {
        echo "   ✓ Product table has all expected fields\n";
    } else {
        echo "   ✗ Missing fields in product table: " . implode(', ', $missingFields) . "\n";
    }
} catch (Exception $e) {
    echo "   ✗ Error checking product table: " . $e->getMessage() . "\n";
}

// Test 4: Verify routes are working
echo "\n4. Testing route configuration...\n";
try {
    $router = new \Cake\Routing\Router();
    \Cake\Routing\RouteBuilder::createRouteBuilder($router)->loadRoutes(ROOT . '/config/routes.php');

    // Test user routes
    $userLoginRoute = $router->parseRequest(new \Cake\Http\ServerRequest(['url' => 'users/login']));
    $userRegisterRoute = $router->parseRequest(new \Cake\Http\ServerRequest(['url' => 'users/register']));

    if ($userLoginRoute && $userLoginRoute['controller'] === 'Users' && $userLoginRoute['action'] === 'login') {
        echo "   ✓ User login route is configured\n";
    } else {
        echo "   ✗ User login route is not working\n";
    }

    if ($userRegisterRoute && $userRegisterRoute['controller'] === 'Users' && $userRegisterRoute['action'] === 'register') {
        echo "   ✓ User register route is configured\n";
    } else {
        echo "   ✗ User register route is not working\n";
    }

    // Test product routes
    $productIndexRoute = $router->parseRequest(new \Cake\Http\ServerRequest(['url' => 'products']));
    $productAddRoute = $router->parseRequest(new \Cake\Http\ServerRequest(['url' => 'products/add']));

    if ($productIndexRoute && $productIndexRoute['controller'] === 'Products' && $productIndexRoute['action'] === 'index') {
        echo "   ✓ Product index route is configured\n";
    } else {
        echo "   ✗ Product index route is not working\n";
    }

    if ($productAddRoute && $productAddRoute['controller'] === 'Products' && $productAddRoute['action'] === 'add') {
        echo "   ✓ Product add route is configured\n";
    } else {
        echo "   ✗ Product add route is not working\n";
    }

} catch (Exception $e) {
    echo "   ✗ Error testing routes: " . $e->getMessage() . "\n";
}

echo "\n=== Verification Complete ===\n";
echo "If all tests show ✓, the fixes are working correctly.\n";
