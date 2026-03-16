<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ProductsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\ProductsController Test Case
 *
 * @uses \App\Controller\ProductsController
 */
class ProductsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    protected array $fixtures = [
        'app.Products',
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex(): void
    {
        $this->get('/products');
        $this->assertResponseOk();
        $this->assertResponseContains('Products');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView(): void
    {
        $this->get('/products/view/1');
        $this->assertResponseOk();
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd(): void
    {
        // Simulate authenticated user
        $this->session([
            'Auth' => [
                'id' => 1,
                'username' => 'testuser',
                'email' => 'test@example.com'
            ]
        ]);

        $this->get('/products/add');
        $this->assertResponseOk();
        $this->assertResponseContains('Add Product');
    }

    /**
     * Test add method with valid data
     *
     * @return void
     */
    public function testAddWithValidData(): void
    {
        // Simulate authenticated user
        $this->session([
            'Auth' => [
                'id' => 1,
                'username' => 'testuser',
                'email' => 'test@example.com'
            ]
        ]);

        $this->enableCsrfToken();
        $this->post('/products/add', [
            'name' => 'New Product',
            'category' => 'Electronics',
            'price' => 199.99,
            'stock' => 5,
            'size' => 'Medium',
            'color' => 'Red'
        ]);
        $this->assertResponseSuccess();
        $this->assertFlashMessage('The product has been saved.');
        $this->assertRedirect(['action' => 'index']);
    }

    /**
     * Test add method with invalid data
     *
     * @return void
     */
    public function testAddWithInvalidData(): void
    {
        // Simulate authenticated user
        $this->session([
            'Auth' => [
                'id' => 1,
                'username' => 'testuser',
                'email' => 'test@example.com'
            ]
        ]);

        $this->enableCsrfToken();
        $this->post('/products/add', [
            'name' => '',
            'category' => 'Electronics',
            'price' => -10.00,
            'stock' => -5
        ]);
        $this->assertResponseOk();
        $this->assertResponseContains('Add Product');
        // Check for validation errors in the response
        $this->assertResponseContains('name');
        $this->assertResponseContains('price');
        $this->assertResponseContains('stock');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit(): void
    {
        // Simulate authenticated user
        $this->session([
            'Auth' => [
                'id' => 1,
                'username' => 'testuser',
                'email' => 'test@example.com'
            ]
        ]);

        $this->get('/products/edit/1');
        $this->assertResponseOk();
        $this->assertResponseContains('Edit Product');
    }

    /**
     * Test edit method with valid data
     *
     * @return void
     */
    public function testEditWithValidData(): void
    {
        // Simulate authenticated user
        $this->session([
            'Auth' => [
                'id' => 1,
                'username' => 'testuser',
                'email' => 'test@example.com'
            ]
        ]);

        $this->enableCsrfToken();
        $this->post('/products/edit/1', [
            'name' => 'Updated Product',
            'category' => 'Updated Category',
            'price' => 299.99,
            'stock' => 15,
            'size' => 'Large',
            'color' => 'Green'
        ]);
        $this->assertResponseSuccess();
        $this->assertFlashMessage('The product has been updated.');
        $this->assertRedirect(['action' => 'index']);
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete(): void
    {
        $this->enableCsrfToken();
        $this->delete('/products/delete/1');
        $this->assertResponseSuccess();
    }

    /**
     * Test index method with category filter
     *
     * @return void
     * @uses \App\Controller\ProductsController::index()
     */
    public function testIndexWithCategoryFilter(): void
    {
        $this->get('/products?category_id=1');
        $this->assertResponseOk();
        $this->assertResponseContains('Products');
    }

    /**
     * Test add method with category
     *
     * @return void
     * @uses \App\Controller\ProductsController::add()
     */
    public function testAddWithCategory(): void
    {
        // Simulate authenticated user
        $this->session([
            'Auth' => [
                'id' => 1,
                'username' => 'testuser',
                'email' => 'test@example.com'
            ]
        ]);

        $this->get('/products/add');
        $this->assertResponseOk();
        $this->assertResponseContains('Add Product');

        $this->enableCsrfToken();
        $this->post('/products/add', [
            'name' => 'Test Product with Category',
            'category' => 'Electronics',
            'price' => 29.99,
            'stock' => 5,
            'size' => 'Medium',
            'color' => 'Red',
            'category_id' => 1
        ]);
        $this->assertResponseSuccess();
        $this->assertFlashMessage('The product has been saved.');
        $this->assertRedirect(['action' => 'index']);
    }

    /**
     * Test edit method with category
     *
     * @return void
     * @uses \App\Controller\ProductsController::edit()
     */
    public function testEditWithCategory(): void
    {
        // Simulate authenticated user
        $this->session([
            'Auth' => [
                'id' => 1,
                'username' => 'testuser',
                'email' => 'test@example.com'
            ]
        ]);

        $this->get('/products/edit/1');
        $this->assertResponseOk();
        $this->assertResponseContains('Edit Product');

        $this->enableCsrfToken();
        $this->post('/products/edit/1', [
            'name' => 'Updated Product',
            'category' => 'Updated Category',
            'price' => 39.99,
            'stock' => 15,
            'size' => 'Large',
            'color' => 'Green',
            'category_id' => 1
        ]);
        $this->assertResponseSuccess();
        $this->assertFlashMessage('The product has been updated.');
        $this->assertRedirect(['action' => 'index']);
    }
}
