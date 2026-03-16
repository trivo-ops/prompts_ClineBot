<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class FixProductsSchemaForCategoryId extends BaseMigration
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
        // Make the old 'category' column nullable and add a default value
        // This allows new inserts to succeed while preserving existing data
        $table = $this->table('products');
        $table
            ->changeColumn('category', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->update();
    }
}
