<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductsTable Test Case
 */
class ProductsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProductsTable
     */
    protected $Products;

    /**
     * Fixtures
     *
     * @var array
     */
    protected array $fixtures = [
        'app.Products',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Products') ? [] : ['className' => ProductsTable::class];
        $this->Products = TableRegistry::getTableLocator()->get('Products', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Products);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        // Test valid data
        $data = [
            'name' => 'Test Product',
            'category' => 'Electronics',
            'price' => 99.99,
            'stock' => 10,
            'size' => 'Large',
            'color' => 'Blue'
        ];

        $product = $this->Products->newEntity($data);
        $this->assertNotFalse($product);
        $this->assertEmpty($product->getErrors());

        // Test invalid data - missing required fields
        $data = [
            'category' => 'Electronics',
            'price' => 99.99,
            'stock' => 10
        ];

        $product = $this->Products->newEntity($data);
        $this->assertNotFalse($product);
        $this->assertNotEmpty($product->getErrors());
        $this->assertArrayHasKey('name', $product->getErrors());

        // Test invalid data - negative price
        $data = [
            'name' => 'Test Product',
            'category' => 'Electronics',
            'price' => -10.00,
            'stock' => 10
        ];

        $product = $this->Products->newEntity($data);
        $this->assertNotFalse($product);
        $this->assertNotEmpty($product->getErrors());
        $this->assertArrayHasKey('price', $product->getErrors());

        // Test invalid data - negative stock
        $data = [
            'name' => 'Test Product',
            'category' => 'Electronics',
            'price' => 99.99,
            'stock' => -5
        ];

        $product = $this->Products->newEntity($data);
        $this->assertNotFalse($product);
        $this->assertNotEmpty($product->getErrors());
        $this->assertArrayHasKey('stock', $product->getErrors());
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        // Test unique name constraint
        $data1 = [
            'name' => 'Unique Product',
            'category' => 'Electronics',
            'price' => 99.99,
            'stock' => 10
        ];

        $product1 = $this->Products->newEntity($data1);
        $saved1 = $this->Products->save($product1);
        $this->assertNotFalse($saved1);

        // Try to save another product with the same name
        $data2 = [
            'name' => 'Unique Product',
            'category' => 'Clothing',
            'price' => 49.99,
            'stock' => 5
        ];

        $product2 = $this->Products->newEntity($data2);
        $saved2 = $this->Products->save($product2);
        $this->assertFalse($saved2);
        $this->assertNotEmpty($product2->getErrors());
        $this->assertArrayHasKey('name', $product2->getErrors());
    }
}
