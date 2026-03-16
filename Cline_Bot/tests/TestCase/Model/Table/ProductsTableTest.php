<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductsTable;
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
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Products',
        'app.Categories',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Products') ? [] : ['className' => ProductsTable::class];
        $this->Products = $this->getTableLocator()->get('Products', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Products);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\ProductsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $validator = $this->Products->getValidator('default');

        // Test valid data
        $data = [
            'name' => 'Test Product',
            'description' => 'Test Description',
            'price' => 19.99,
            'category_id' => '550e8400-e29b-41d4-a716-446655440000',
            'sku' => 'TEST-001'
        ];

        $errors = $validator->validate($data);
        $this->assertEmpty($errors, 'Valid data should pass validation');

        // Test invalid SKU format
        $data['sku'] = 'invalid-sku!';
        $errors = $validator->validate($data);
        $this->assertNotEmpty($errors, 'Invalid SKU should fail validation');
        $this->assertArrayHasKey('sku', $errors, 'SKU validation error should be present');

        // Test missing SKU
        unset($data['sku']);
        $errors = $validator->validate($data);
        $this->assertNotEmpty($errors, 'Missing SKU should fail validation');
        $this->assertArrayHasKey('sku', $errors, 'SKU validation error should be present');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\ProductsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test SKU uniqueness validation
     *
     * @return void
     */
    public function testSkuUniqueness(): void
    {
        // Create a product with a specific SKU
        $product1 = $this->Products->newEntity([
            'name' => 'Product 1',
            'description' => 'Description 1',
            'price' => 10.00,
            'category_id' => '550e8400-e29b-41d4-a716-446655440000',
            'sku' => 'UNIQUE-001'
        ]);

        $this->Products->save($product1);

        // Try to create another product with the same SKU
        $product2 = $this->Products->newEntity([
            'name' => 'Product 2',
            'description' => 'Description 2',
            'price' => 20.00,
            'category_id' => '550e8400-e29b-41d4-a716-446655440000',
            'sku' => 'UNIQUE-001'
        ]);

        $result = $this->Products->save($product2);
        $this->assertFalse($result, 'Duplicate SKU should not be saved');
        $this->assertNotEmpty($product2->getErrors(), 'Validation errors should be present');
        $this->assertArrayHasKey('sku', $product2->getErrors(), 'SKU validation error should be present');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\ProductsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
