<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class AlterProductsIdToUuid extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/5/en/migrations.html#the-change-method
     *
     * @return void
     */
    public function up(): void
    {
        // Create a temporary table with UUID id and nullable category
        $this->execute('
            CREATE TABLE products_temp (
                id CHAR(36) NOT NULL,
                name VARCHAR(255) NOT NULL,
                category VARCHAR(100) NULL,
                category_id CHAR(36) NULL,
                price DECIMAL(10,2) NOT NULL,
                stock INT NOT NULL DEFAULT 0,
                size VARCHAR(20) NULL,
                color VARCHAR(50) NULL,
                created DATETIME NULL,
                modified DATETIME NULL,
                PRIMARY KEY (id),
                INDEX category_id (category_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ');

        // Copy data from old table to new table with UUID conversion
        $this->execute('
            INSERT INTO products_temp (id, name, category, category_id, price, stock, size, color, created, modified)
            SELECT UUID(), name, category, category_id, price, stock, size, color, created, modified
            FROM products
        ');

        // Drop old table and rename new table
        $this->execute('DROP TABLE products');
        $this->execute('RENAME TABLE products_temp TO products');

        // First fix the collation of the category_id column to match categories.id
        $this->execute('ALTER TABLE products MODIFY COLUMN category_id CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL;');

        // Add foreign key constraint
        $this->execute('ALTER TABLE products ADD CONSTRAINT products_ibfk_1 FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL ON UPDATE CASCADE');
    }

    public function down(): void
    {
        // This is a destructive migration, so down() is not implemented
        // In a real application, you would need to backup data before running this migration
        throw new \Exception('Cannot rollback this migration - it would result in data loss');
    }
}
