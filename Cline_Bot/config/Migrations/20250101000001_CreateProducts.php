<?php
use Migrations\BaseMigration;

class CreateProducts extends BaseMigration
{
    public function change()
    {
        $table = $this->table('products');
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('category', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => false,
        ]);
        $table->addColumn('price', 'decimal', [
            'default' => null,
            'null' => false,
            'precision' => 10,
            'scale' => 2,
        ]);
        $table->addColumn('stock', 'integer', [
            'default' => 0,
            'null' => false,
        ]);
        $table->addColumn('size', 'string', [
            'default' => null,
            'limit' => 20,
            'null' => true,
        ]);
        $table->addColumn('color', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => true,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->create();
    }
}
