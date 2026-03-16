# Task Prompt: Add SKU Field to Products

## Task Overview
Add a Stock Keeping Unit (SKU) field to the existing Products system in the CakePHP 5 application. This enhancement will allow for unique product identification and inventory management while maintaining the existing Products CRUD functionality.

## Context
The application already has a complete Products CRUD system with proper validation, forms, and views. This task requires adding a SKU field to enhance product identification without disrupting the existing functionality.

## Requirements

### 1. Database Migration
Create a migration file that adds a `sku` field to the existing `products` table with the following specifications:
- `sku` (string, max 50 chars, required, unique)
- Format validation: uppercase letters, numbers, and hyphens only
- Pattern: `/^[A-Z0-9-]{3,50}$/`
- Handle existing products by generating default SKUs during migration

### 2. Model Layer Enhancement
Update the `ProductsTable` class to include SKU validation:
- Add SKU field to validation rules
- Make SKU required
- Enforce uniqueness across products
- Validate format pattern (uppercase, numbers, hyphens)
- Ensure length between 3 and 50 characters
- Maintain all existing validation rules

### 3. Entity Layer
Ensure the `Product` entity properly handles the SKU field:
- SKU should be accessible as a property
- Maintain existing entity structure and methods
- No changes needed to entity unless accessibility is an issue

### 4. View Templates Enhancement
Update all Products view templates to display SKU information:
- **index.php**: Add SKU column to product list table
- **view.php**: Display SKU in product details section
- **add.php**: Add SKU input field to form with validation
- **edit.php**: Add SKU input field to form with validation
- Maintain existing styling and layout patterns
- Ensure form validation errors display properly for SKU field

### 5. Controller Layer
No controller changes required - existing ProductsController should handle SKU automatically through CakePHP's ORM and form handling.

### 6. Data Migration Strategy
Implement a migration strategy that:
- Adds the SKU column to existing products table
- Generates default SKUs for existing products (e.g., "SKU-001", "SKU-002", etc.)
- Ensures all existing products have valid SKUs after migration
- Maintains data integrity throughout the process

## Technical Specifications

### Validation Rules
- **SKU**: Required, string, max 50 chars, unique across products
- **Format**: Must match pattern `/^[A-Z0-9-]{3,50}$/`
- **Length**: Must be between 3 and 50 characters
- **Uniqueness**: Must be unique across all products

### Data Migration Requirements
- Existing products must receive generated SKUs
- Generated SKUs should follow consistent pattern
- Migration should handle any edge cases gracefully
- No data loss during migration process

### User Interface Requirements
- SKU field should integrate seamlessly with existing forms
- Error messages should be clear and consistent with existing validation
- Display formatting should match existing product information layout
- Maintain responsive design and accessibility standards

## Implementation Guidelines

### Follow Existing Patterns
- Use the same coding style and conventions as existing Products implementation
- Follow established validation patterns in ProductsTable
- Maintain consistent form structure and styling
- Use existing layout and helper patterns
- Ensure error handling matches existing patterns

### Code Quality
- Include comprehensive PHPDoc documentation
- Use meaningful variable and method names
- Implement proper error handling
- Follow CakePHP best practices
- Ensure code is maintainable and extensible

### Testing Requirements
- Test migration with existing data
- Verify SKU validation rules work correctly
- Test form submission with valid and invalid SKUs
- Verify SKU display in all views
- Test uniqueness constraint enforcement

## Success Criteria

### Functional Requirements
- [ ] Database migration adds SKU column successfully
- [ ] Existing products receive generated SKUs during migration
- [ ] SKU validation prevents duplicate entries
- [ ] SKU format validation enforces proper pattern
- [ ] SKU appears in all product views (list, detail, add, edit)
- [ ] Form validation provides clear error messages
- [ ] Implementation maintains existing Products CRUD flow
- [ ] UI remains consistent with application design

### Technical Requirements
- [ ] Migration syntax is valid and executes without errors
- [ ] Model validation rules are comprehensive and working
- [ ] SKU field is properly integrated into forms
- [ ] Display templates show SKU information correctly
- [ ] Data migration handles existing products appropriately
- [ ] Uniqueness constraint is enforced at database level

### User Experience
- [ ] Forms are user-friendly and intuitive
- [ ] Error messages are clear and helpful
- [ ] SKU information is displayed consistently
- [ ] Navigation remains unchanged and functional
- [ ] Interface maintains responsive design

## Files to Create/Modify

### New Files
- `config/Migrations/20260316100000_AddSkuToProducts.php`

### Modified Files
- `src/Model/Table/ProductsTable.php` - Add SKU validation rules
- `templates/Products/index.php` - Add SKU column to table
- `templates/Products/view.php` - Display SKU in details
- `templates/Products/add.php` - Add SKU field to form
- `templates/Products/edit.php` - Add SKU field to form

## Testing Instructions

### Manual Testing
1. Run the migration: `php bin/cake.php migrations migrate`
2. Verify existing products have generated SKUs
3. Test SKU validation with invalid formats
4. Test SKU uniqueness validation
5. Verify SKU appears in all product views
6. Test form submission with valid and invalid SKUs

### Automated Testing
1. Run existing Products tests to ensure no regressions
2. Add specific tests for SKU validation if needed
3. Verify migration works correctly with test data

## Notes
- This implementation should be minimal and focused on SKU addition
- Maintain backward compatibility with existing data
- Follow established coding patterns and conventions
- Ensure data integrity during migration process
- Do not modify existing Products CRUD flow or functionality
- Focus on seamless integration with existing system
