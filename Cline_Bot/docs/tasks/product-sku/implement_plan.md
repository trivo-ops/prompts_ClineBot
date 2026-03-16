# Implementation Plan: Add SKU Field to Products

## Overview
This plan outlines the step-by-step implementation of adding a SKU field to the existing Products system in the CakePHP 5 application. The implementation will be minimal and focused, maintaining all existing functionality while adding the new SKU capability.

## Implementation Steps

### Step 1: Create Database Migration
**File**: `config/Migrations/20260316100000_AddSkuToProducts.php`

**Actions**:
1. Create migration to add `sku` column to products table
2. Add NOT NULL constraint with default value
3. Add UNIQUE constraint for SKU
4. Implement data migration to generate SKUs for existing products
5. Add index for SKU field for performance

**Key Implementation Details**:
- Use `addColumn()` with proper constraints
- Generate SKUs using pattern "SKU-{ID}" for existing products
- Handle edge cases where products might already have SKU-like data
- Ensure migration is reversible

### Step 2: Update ProductsTable Model
**File**: `src/Model/Table/ProductsTable.php`

**Actions**:
1. Add SKU validation rules to `validationDefault()` method
2. Make SKU required
3. Add format validation using regex pattern
4. Add uniqueness validation
5. Ensure length constraints (3-50 characters)
6. Maintain all existing validation rules

**Validation Rules to Add**:
```php
->add('sku', [
    'required' => [
        'rule' => 'notBlank',
        'message' => 'SKU is required'
    ],
    'unique' => [
        'rule' => 'validateUnique',
        'provider' => 'table',
        'message' => 'This SKU is already in use'
    ],
    'format' => [
        'rule' => ['custom', '/^[A-Z0-9-]{3,50}$/'],
        'message' => 'SKU must contain only uppercase letters, numbers, and hyphens'
    ],
    'length' => [
        'rule' => ['minLength', 3],
        'message' => 'SKU must be at least 3 characters long'
    ]
])
```

### Step 3: Update Product List View
**File**: `templates/Products/index.php`

**Actions**:
1. Add SKU column header to table
2. Add SKU data column in table rows
3. Maintain existing table structure and styling
4. Ensure responsive design is preserved

**Implementation**:
- Add `<th>SKU</th>` in table header
- Add `<td><?= h($product->sku) ?></td>` in table body
- Maintain existing CSS classes and styling

### Step 4: Update Product Detail View
**File**: `templates/Products/view.php`

**Actions**:
1. Add SKU display in product information section
2. Maintain existing layout and styling
3. Ensure consistent formatting with other product fields

**Implementation**:
- Add SKU field display similar to existing fields
- Use consistent HTML structure and CSS classes

### Step 5: Update Product Add Form
**File**: `templates/Products/add.php`

**Actions**:
1. Add SKU input field to form
2. Include proper label and validation attributes
3. Ensure field integrates with existing form structure
4. Add appropriate CSS classes for styling

**Implementation**:
- Add `echo $this->Form->control('sku', ['required' => true]);`
- Ensure field appears in logical order with other form fields
- Maintain existing form styling and layout

### Step 6: Update Product Edit Form
**File**: `templates/Products/edit.php`

**Actions**:
1. Add SKU input field to form (same as add form)
2. Ensure field is populated with existing SKU value
3. Maintain form validation and styling consistency

**Implementation**:
- Add same SKU field as in add form
- CakePHP will automatically populate with existing value
- Maintain consistent form structure

## Implementation Order
1. **Migration First**: Create and run migration to ensure database structure is ready
2. **Model Validation**: Update ProductsTable to handle SKU validation
3. **Views**: Update all view templates to display and handle SKU
4. **Testing**: Verify all functionality works correctly

## Testing Strategy

### Unit Testing
- Test SKU validation rules in ProductsTable
- Test migration with existing data
- Test form submission with valid/invalid SKUs

### Integration Testing
- Test complete CRUD flow with SKU
- Verify SKU appears in all views
- Test uniqueness constraint enforcement

### Manual Testing
- Run migration and verify existing products have SKUs
- Test form validation with various SKU formats
- Verify SKU display in list and detail views
- Test editing products with SKU changes

## Risk Mitigation

### Data Migration Risks
- **Risk**: Existing products without SKU cause issues
- **Mitigation**: Migration generates default SKUs for all existing products

### Validation Risks
- **Risk**: Strict validation prevents legitimate SKUs
- **Mitigation**: Use flexible but secure validation pattern
- **Risk**: Uniqueness validation fails during migration
- **Mitigation**: Generate unique SKUs during migration process

### UI Consistency Risks
- **Risk**: SKU fields don't match existing form styling
- **Mitigation**: Use existing CakePHP FormHelper patterns
- **Risk**: Table layout breaks with new column
- **Mitigation**: Test responsive design thoroughly

## Success Criteria
- [ ] Migration runs successfully without errors
- [ ] All existing products have valid SKUs
- [ ] SKU validation prevents invalid entries
- [ ] SKU appears correctly in all views
- [ ] Form submission works with SKU field
- [ ] No regressions in existing Products functionality
- [ ] UI maintains consistent styling and layout

## Rollback Plan
If issues arise:
1. **Migration Rollback**: Use `php bin/cake.php migrations migrate down` to revert
2. **Code Rollback**: Revert view and model changes
3. **Data Rollback**: Migration includes down() method to remove SKU column

## Timeline
- **Step 1** (Migration): 15 minutes
- **Step 2** (Model): 10 minutes
- **Step 3-6** (Views): 20 minutes
- **Testing**: 15 minutes
- **Total**: ~1 hour

This implementation plan ensures a systematic, low-risk approach to adding SKU functionality while maintaining the integrity of the existing Products system.
