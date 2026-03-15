# Implementation Plan: Categories CRUD Feature

## Phase 1: Database Schema Changes

### 1.1 Create Categories Table
**File:** `config/Migrations/YYYYMMDDHHMMSS_CreateCategories.php`
- Create table with fields: id (primary key), name (string, 100 chars, unique), description (text, nullable), created, modified
- Add unique index on name field
- Set appropriate character set and collation

### 1.2 Update Products Table
**File:** `config/Migrations/YYYYMMDDHHMMSS_UpdateProductsCategory.php`
- Add new field: `category_id` (integer, nullable, foreign key)
- Add foreign key constraint: `category_id` references `categories.id`
- Keep existing `category` field temporarily for migration

### 1.3 Data Migration
**File:** `config/Migrations/YYYYMMDDHHMMSS_MigrateCategoryData.php`
- Extract unique category values from existing Products table
- Create Categories records for each unique category
- Update Products table to set `category_id` based on category name matches
- Drop old `category` field after migration

## Phase 2: Model Layer Updates

### 2.1 Create Categories Model
**File:** `src/Model/Table/CategoriesTable.php`
- Define table name and validation rules
- Validation: name required, unique, max 100 chars; description optional, max 500 chars
- Set up timestamps behavior

**File:** `src/Model/Entity/Category.php`
- Define accessible fields: name, description
- Define hidden fields: id, created, modified

### 2.2 Update Products Model
**File:** `src/Model/Table/ProductsTable.php`
- Add belongsTo relationship: `belongsTo('Categories')`
- Update validation rules:
  - Remove validation for old `category` field
  - Add validation for `category_id`: required, numeric, exists in Categories
- Update displayField to show category name when joined

## Phase 3: Controller Layer

### 3.1 Create Categories Controller
**File:** `src/Controller/CategoriesController.php`
- Implement standard CRUD actions: index, view, add, edit, delete
- Add pagination for index action
- Implement proper error handling and flash messages
- Follow same patterns as existing ProductsController

### 3.2 Update Products Controller
**File:** `src/Controller/ProductsController.php`
- Modify `add()` and `edit()` actions to load category list for dropdown
- Update `index()` and `view()` actions to include category data in queries
- Ensure proper authorization checks

## Phase 4: View Layer

### 4.1 Create Categories Views
**Files:**
- `templates/Categories/index.php` - List categories with actions
- `templates/Categories/view.php` - Display single category details
- `templates/Categories/add.php` - Form for creating categories
- `templates/Categories/edit.php` - Form for editing categories

**Design Requirements:**
- Follow same CSS classes and layout as existing auth/products pages
- Use consistent form styling with other CRUD forms
- Include proper navigation links

### 4.2 Update Products Views
**Files:**
- `templates/Products/add.php` - Replace category text input with dropdown
- `templates/Products/edit.php` - Replace category text input with dropdown
- `templates/Products/index.php` - Display category name in table
- `templates/Products/view.php` - Display category name in detail view

**Changes:**
- Replace `echo $this->Form->control('category')` with category dropdown
- Update table columns to show category names instead of IDs
- Ensure proper error handling for category selection

## Phase 5: Testing

### 5.1 Model Tests
**File:** `tests/TestCase/Model/Table/CategoriesTableTest.php`
- Test category creation with valid data
- Test validation rules (name required, unique)
- Test relationship with Products
- Test timestamp behavior

### 5.2 Controller Tests
**File:** `tests/TestCase/Controller/CategoriesControllerTest.php`
- Test all CRUD actions
- Test pagination
- Test error handling
- Test authorization

### 5.3 Integration Tests
- Test data migration preserves existing categories
- Test Products can be created/edited with category selection
- Test category deletion with dependent products (should fail with constraint)

## Phase 6: Migration Execution

### 6.1 Migration Order
1. Run CreateCategories migration
2. Run UpdateProductsCategory migration
3. Run MigrateCategoryData migration
4. Verify data integrity
5. Test application functionality

### 6.2 Rollback Plan
- Each migration should be reversible
- Test rollback procedures
- Have backup of original data

## Risk Assessment

### High Risk
- **Data Loss**: Migration could lose existing category data
  - **Mitigation**: Backup database before migration, test migration on copy first
- **Foreign Key Constraints**: Existing data might violate new constraints
  - **Mitigation**: Careful data migration, handle edge cases

### Medium Risk
- **Application Downtime**: Migration requires application to be offline
  - **Mitigation**: Plan migration during maintenance window
- **UI Inconsistency**: New category pages might not match existing design
  - **Mitigation**: Follow existing CSS patterns, test visually

### Low Risk
- **Performance Impact**: Additional joins might slow queries
  - **Mitigation**: Add proper indexes, optimize queries

## Verification Steps

### 7.1 Database Verification
- Verify Categories table created with correct schema
- Verify foreign key constraints working
- Verify data migration completed successfully
- Verify no orphaned category references

### 7.2 Application Verification
- Test all Categories CRUD operations
- Test Products creation/editing with category selection
- Test Products display shows category names correctly
- Test validation prevents invalid data

### 7.3 User Experience Verification
- Verify category dropdown works in Products forms
- Verify category pages match existing design
- Verify navigation between Products and Categories works
- Verify error messages are clear and helpful

### 7.4 Performance Verification
- Test page load times with category data
- Verify database queries are optimized
- Test with realistic data volumes

## Success Criteria Checklist
- [ ] Categories table created with proper schema
- [ ] Products table updated with foreign key
- [ ] Data migration preserves all existing categories
- [ ] Categories CRUD operations work correctly
- [ ] Products forms use category dropdown
- [ ] Products display category names
- [ ] All validation rules work as expected
- [ ] UI matches existing design patterns
- [ ] All tests pass
- [ ] No regressions in existing functionality
- [ ] Performance meets requirements
