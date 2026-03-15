<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class AddCategoryIdToProducts extends BaseMigration
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
        $table = $this->table('products');
        $table
            ->addColumn('category_id', 'uuid', [
                'default' => null,
                'null' => true,
                'after' => 'category',
            ])
            ->addForeignKey('category_id', 'categories', 'id', [
                'update' => 'CASCADE',
                'delete' => 'SET_NULL'
            ])
            ->update();
    }
}
