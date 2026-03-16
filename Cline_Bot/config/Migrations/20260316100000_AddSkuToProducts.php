<?php
use Migrations\BaseMigration;

class AddSkuToProducts extends BaseMigration
{
    public function up()
    {
        // Step 1: Add SKU column as nullable first
        $table = $this->table('products');
        $table->addColumn('sku', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => true,
            'after' => 'name'
        ]);
        $table->update();

        // Step 2: Backfill existing products with generated SKUs
        // Use a subquery to generate sequential numbers for existing products
        $this->execute('
            UPDATE products p
            JOIN (
                SELECT id,
                       CONCAT("PROD-", LPAD(@row_number := @row_number + 1, 3, "0")) as new_sku
                FROM products, (SELECT @row_number := 0) r
                WHERE sku IS NULL
            ) as temp ON p.id = temp.id
            SET p.sku = temp.new_sku
        ');

        // Step 3: Make SKU column non-null
        $this->table('products')
             ->changeColumn('sku', 'string', [
                 'default' => null,
                 'limit' => 50,
                 'null' => false
             ])
             ->update();

        // Step 4: Add unique index on SKU
        $this->table('products')
             ->addIndex(['sku'], [
                 'unique' => true,
                 'name' => 'UNIQUE_SKU'
             ])
             ->update();
    }

    public function down()
    {
        // Drop the unique index first
        $this->table('products')
             ->removeIndex(['sku'])
             ->update();

        // Drop the SKU column
        $this->table('products')
             ->removeColumn('sku')
             ->update();
    }
}
