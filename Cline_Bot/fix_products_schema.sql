-- Fix Products Table Schema for Category Relationship
-- This SQL script adds the missing category_id column and foreign key constraint

-- First, add the category_id column to the products table
ALTER TABLE products
ADD COLUMN category_id CHAR(36) NULL COMMENT 'Foreign key to categories table';

-- Add the foreign key constraint
ALTER TABLE products
ADD CONSTRAINT fk_products_category_id
FOREIGN KEY (category_id)
REFERENCES categories(id)
ON DELETE SET NULL
ON UPDATE CASCADE;

-- Create an index on category_id for better performance
CREATE INDEX idx_products_category_id ON products(category_id);

-- Update existing products to have a default category (if categories exist)
-- This will set category_id to the first category found, or NULL if no categories exist
UPDATE products p
SET category_id = (
    SELECT id FROM categories LIMIT 1
)
WHERE category_id IS NULL;

-- Verify the changes
SELECT
    COLUMN_NAME,
    IS_NULLABLE,
    COLUMN_DEFAULT,
    COLUMN_TYPE,
    COLUMN_KEY
FROM information_schema.COLUMNS
WHERE TABLE_SCHEMA = 'cakephp'
AND TABLE_NAME = 'products'
AND COLUMN_NAME IN ('id', 'name', 'description', 'price', 'category_id')
ORDER BY ORDINAL_POSITION;

-- Show foreign key constraints
SELECT
    CONSTRAINT_NAME,
    COLUMN_NAME,
    REFERENCED_TABLE_NAME,
    REFERENCED_COLUMN_NAME
FROM information_schema.KEY_COLUMN_USAGE
WHERE TABLE_SCHEMA = 'cakephp'
AND TABLE_NAME = 'products'
AND REFERENCED_TABLE_NAME IS NOT NULL;
