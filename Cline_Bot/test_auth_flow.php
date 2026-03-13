<?php
// Simple test script to verify authentication flow
require_once 'vendor/autoload.php';

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

class AuthFlowTest extends TestCase
{
    use IntegrationTestTrait;

    public function setUp(): void
    {
        parent::setUp();
        $this->enableCsrfToken();
    }

    public function testUserRegistration()
    {
        $this->post('/users/register', [
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password' => 'password123'
        ]);

        $this->assertResponseOk();
        $this->assertFlashMessage('The user has been saved.');
    }

    public function testUserLogin()
    {
        // First register a user
        $this->post('/users/register', [
            'username' => 'testuser2',
            'email' => 'test2@example.com',
            'password' => 'password123'
        ]);

        // Then try to login
        $this->post('/users/login', [
            'email' => 'test2@example.com',
            'password' => 'password123'
        ]);

        $this->assertResponseOk();
    }

    public function testProductCRUD()
    {
        // Register and login a user
        $this->post('/users/register', [
            'username' => 'testuser3',
            'email' => 'test3@example.com',
            'password' => 'password123'
        ]);

        $this->post('/users/login', [
            'email' => 'test3@example.com',
            'password' => 'password123'
        ]);

        // Test product creation
        $this->post('/products/add', [
            'name' => 'Test Product',
            'description' => 'Test Description',
            'price' => 10.50
        ]);

        $this->assertResponseOk();
        $this->assertFlashMessage('The product has been saved.');
    }
}

echo "Authentication flow test script created successfully!";
echo "\nTo run tests: cd Cline_Bot && vendor/bin/phpunit tests/TestCase/Controller/UsersControllerTest.php";
