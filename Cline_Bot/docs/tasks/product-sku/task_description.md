# Task: Add SKU Field to Products

## Overview
Add a Stock Keeping Unit (SKU) field to the existing Products system in the CakePHP 5 application. This enhancement will allow for unique product identification and inventory management.

## Requirements

### Functional Requirements
- **Add SKU Field**: Add a `sku` field to the Products table with proper constraints
- **Display SKU**: Show SKU in product list, view, add, and edit interfaces
- **Validation**: Make SKU required and enforce uniqueness across products
- **Data Migration**: Handle existing products by generating default SKUs
- **User Interface**: Maintain consistent UI/UX patterns with existing application

### Technical Requirements
- **Database Migration**: Create migration to add SKU column with proper constraints
- **Model Validation**: Implement validation rules in ProductsTable
- **Entity Accessibility**: Ensure SKU is accessible in Product entity
- **Form Integration**: Add SKU field to add/edit forms with validation
- **Display Integration**: Show SKU in list and detail views
- **Data Integrity**: Ensure existing products get valid SKUs during migration

### Data Model Requirements
- **SKU Field**:
  - `sku` (string, max 50 chars, required, unique)
  - Format validation: uppercase letters, numbers, and hyphens only
  - Pattern: `/^[A-Z0-9-]{3,50}$/`

### Validation Requirements
- **Required**: SKU must be provided for all products
- **Unique**: SKU must be unique across all products
- **Format**: SKU must follow specified pattern (uppercase, numbers, hyphens)
- **Length**: SKU must be between 3 and 50 characters

### User Interface Requirements
- **List View**: Display SKU in product grid/list
- **Detail View**: Show SKU in product information section
- **Add Form**: Include SKU field with validation feedback
- **Edit Form**: Include SKU field with validation feedback
- **Consistency**: Maintain existing styling and layout patterns

## Success Criteria
- [ ] Database migration adds SKU column successfully
- [ ] Existing products receive generated SKUs during migration
- [ ] SKU validation prevents duplicate entries
- [ ] SKU format validation enforces proper pattern
- [ ] SKU appears in all product views (list, detail, add, edit)
- [ ] Form validation provides clear error messages
- [ ] Implementation maintains existing Products CRUD flow
- [ ] UI remains consistent with application design

## Dependencies
- Existing Products CRUD system
- CakePHP 5 application structure
- Database connection and migration system

## Scope
- **In Scope**:
  - Add SKU field to Products table
  - Implement validation rules
  - Update all product views to display SKU
  - Handle data migration for existing products
  - Maintain existing Products CRUD functionality
- **Out of Scope**:
  - Modify existing Products CRUD flow
  - Change application architecture
  - Add new product features beyond SKU
  - Modify authentication or authorization systems

## Notes
- Implementation should be minimal and focused on SKU addition
- Maintain backward compatibility with existing data
- Follow established coding patterns and conventions
- Ensure data integrity during migration process
