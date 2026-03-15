<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class SeedCategories extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/5/en/migrations.html#the-change-method
     *
     * @return void
     */
    public function change(): void
    {
        $data = [
            [
                'id' => '00000000-0000-0000-0000-000000000001',
                'name' => 'Electronics',
                'description' => 'Electronic devices and accessories',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '00000000-0000-0000-0000-000000000002',
                'name' => 'Clothing',
                'description' => 'Apparel and fashion items',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '00000000-0000-0000-0000-000000000003',
                'name' => 'Home & Garden',
                'description' => 'Home improvement and gardening supplies',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '00000000-0000-0000-0000-000000000004',
                'name' => 'Books',
                'description' => 'Books and educational materials',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('categories');
        $table->insert($data)->save();
    }
}
