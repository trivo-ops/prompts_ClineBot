## STATUS: DRAFT
<!-- Change to APPROVED when ready for planning -->

# Task Prompt: Categories CRUD Feature

## Task ID
`TASK-005`

## Context

### Existing Codebase
- Products table has `category` field (string, 100 chars) - currently used as text input
- ProductsController handles CRUD operations with text-based category field
- Products views use dropdowns for size/color but text input for category
- Auth and Products layouts established with consistent CSS styling
- Existing validation in ProductsTable for category field

### Technology Stack
- CakePHP 5.x
- PHP 8.3+
- MySQL 8.0
- Docker
- Bootstrap-like CSS (milligram, normalize, custom auth.css and products.css)

## Objective
Replace the text-based category field in Products with a proper Categories table and dropdown selection. Implement full Categories CRUD (list, view, create, edit, delete) and migrate existing category data without losing information.

## Constraints
- Must follow CakePHP 5 MVC conventions
- PHP 8.3+ with strict types
- PSR-12 code style
- All logic must be covered by unit tests
- No raw SQL (use CakePHP ORM)
- Maintain backward compatibility during migration
- UI must match existing auth/products design patterns
- Minimal changes to unrelated code
- No extra features beyond basic Categories CRUD and Products integration

## Expected Output

### Files to Create
- `config/Migrations/YYYYMMDDHHMMSS_CreateCategories.php` — Create Categories table
- `config/Migrations/YYYYMMDDHHMMSS_UpdateProductsCategory.php` — Update Products table
- `config/Migrations/YYYYMMDDHHMMSS_MigrateCategoryData.php` — Data migration
- `src/Model/Table/CategoriesTable.php` — Categories model with validation
- `src/Model/Entity/Category.php` — Category entity
- `src/Controller/CategoriesController.php` — Categories CRUD controller
- `templates/Categories/index.php` — List categories page
- `templates/Categories/view.php` — View category page
- `templates/Categories/add.php` — Add category page
- `templates/Categories/edit.php` — Edit category page
- `tests/TestCase/Model/Table/CategoriesTableTest.php` — Categories model tests
- `tests/TestCase/Controller/CategoriesControllerTest.php` — Categories controller tests

### Files to Modify
- `src/Model/Table/ProductsTable.php` — Update validation and add belongsTo relationship
- `src/Controller/ProductsController.php` — Update add/edit actions for category dropdown
- `templates/Products/add.php` — Replace category text input with dropdown
- `templates/Products/edit.php` — Replace category text input with dropdown
- `templates/Products/index.php` — Display category name instead of ID
- `templates/Products/view.php` — Display category name instead of ID

## Acceptance Criteria
- [ ] Categories table created with id, name, description, created, modified fields
- [ ] Products table updated to use category_id (integer, foreign key) instead of category (string)
- [ ] Existing category data migrated to Categories table without loss
- [ ] Categories CRUD operations work correctly (list, view, create, edit, delete)
- [ ] Products forms show category dropdown populated from Categories table
- [ ] Products display category names instead of IDs
- [ ] Validation prevents duplicate category names
- [ ] Foreign key constraints maintained between Products and Categories
- [ ] All unit tests pass
- [ ] Code style check passes (`phpcs`)
- [ ] UI matches existing auth/products design patterns
- [ ] No regressions in existing tests

## Out of Scope
- Authentication/authorization for Categories
- API endpoints for Categories
- Category hierarchy/nesting
- Bulk operations on Categories
- Advanced category management features
