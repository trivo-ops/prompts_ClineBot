# Task Prompt: Implement Products CRUD System

## Task Overview
Implement a complete CRUD (Create, Read, Update, Delete) system for managing products in the CakePHP 5 application. This system will allow users to manage a catalog of products with basic information including name, category, price, stock, size, and color.

## Context
The application already has a working user authentication system and follows established CakePHP 5 MVC patterns. The Products CRUD system should integrate seamlessly with the existing application structure, styling, and conventions.

## Requirements

### 1. Database Migration
Create a migration file that creates a `products` table with the following fields:
- `id` (auto-increment primary key)
- `name` (string, max 255 chars, required)
- `category` (string, max 100 chars, required)
- `price` (decimal, 10,2 precision, required)
- `stock` (integer, required)
- `size` (string, max 20 chars, optional)
- `color` (string, max 50 chars, optional)
- `created` (timestamp)
- `modified` (timestamp)

### 2. Model Layer
Create a `ProductsTable` class in `src/Model/Table/` that:
- Extends the base Table class
- Implements proper validation rules for all fields
- Enforces business rules (unique names, non-negative values)
- Uses appropriate field types and constraints

### 3. Controller Layer
Create a `ProductsController` class in `src/Controller/` that implements:
- `index()` - Display product list
- `view($id)` - Display single product details
- `add()` - Create new product with form validation
- `edit($id)` - Update existing product with form validation
- `delete($id)` - Delete product with confirmation
- Flash messaging for user feedback
- CSRF protection for all forms
- Proper error handling and redirects

### 4. View Templates
Create view templates in `templates/Products/`:
- `index.php` - Product list with action buttons (View, Edit, Delete)
- `view.php` - Single product details display
- `add.php` - Form for creating new products
- `edit.php` - Form for editing existing products
- All templates should follow existing application styling
- Use CakePHP FormHelper for forms
- Include proper error handling and display

### 5. Routes Configuration
Update `config/routes.php` to include RESTful routes for products:
- `/products` - Index (GET)
- `/products/view/{id}` - View (GET)
- `/products/add` - Add (GET/POST)
- `/products/edit/{id}` - Edit (GET/POST)
- `/products/delete/{id}` - Delete (POST)

### 6. Testing
Create comprehensive tests:
- Model tests for validation rules and business logic
- Controller tests for all CRUD actions
- Integration tests for HTTP requests and responses
- Tests should follow CakePHP testing conventions

## Technical Specifications

### Validation Rules
- **Name**: Required, string, max 255 chars, unique across products
- **Category**: Required, string, max 100 chars
- **Price**: Required, decimal, must be >= 0
- **Stock**: Required, integer, must be >= 0
- **Size**: Optional, string, max 20 chars
- **Color**: Optional, string, max 50 chars

### Security Requirements
- CSRF token protection for all forms
- Server-side validation in model layer
- Input sanitization and escaping
- Proper error handling without exposing sensitive information

### User Interface Requirements
- Consistent styling with existing application
- Bootstrap-compatible forms
- Clear action buttons and navigation
- Flash messages for user feedback
- Inline form validation errors
- Responsive design

## Implementation Guidelines

### Follow Existing Patterns
- Use the same coding style and conventions as existing controllers and models
- Follow the established directory structure
- Use the same validation patterns as the Users model
- Implement Flash messaging similar to the existing authentication system
- Use the same layout and styling patterns

### Code Quality
- Include comprehensive PHPDoc documentation
- Use meaningful variable and method names
- Implement proper error handling
- Follow CakePHP best practices
- Ensure code is maintainable and extensible

### Testing Requirements
- Unit tests for model validation
- Integration tests for controller actions
- HTTP request/response testing
- CSRF protection verification
- Error condition testing

## Success Criteria

### Functional Requirements
- [ ] Database migration creates products table successfully
- [ ] All CRUD operations work correctly
- [ ] Form validation prevents invalid data entry
- [ ] User interface is consistent with existing application
- [ ] Flash messages provide clear user feedback
- [ ] Tests cover all major functionality
- [ ] Implementation follows CakePHP best practices

### Technical Requirements
- [ ] Migration syntax is valid and executes without errors
- [ ] Model validation rules are comprehensive and working
- [ ] Controller actions handle all edge cases properly
- [ ] View templates are consistent and functional
- [ ] Routes are configured correctly and accessible
- [ ] Security measures are implemented and tested

### User Experience
- [ ] Forms are user-friendly and intuitive
- [ ] Error messages are clear and helpful
- [ ] Navigation is consistent and logical
- [ ] Flash messages provide appropriate feedback
- [ ] Interface is responsive and accessible

## Files to Create/Modify

### New Files
- `config/Migrations/20250311164000_CreateProducts.php`
- `src/Model/Table/ProductsTable.php`
- `src/Controller/ProductsController.php`
- `templates/Products/index.php`
- `templates/Products/view.php`
- `templates/Products/add.php`
- `templates/Products/edit.php`
- `tests/TestCase/Model/Table/ProductsTableTest.php`
- `tests/TestCase/Controller/ProductsControllerTest.php`

### Modified Files
- `config/routes.php`

## Testing Instructions

### Manual Testing
1. Run the migration: `php bin/cake.php migrations migrate`
2. Test all CRUD operations through the web interface
3. Verify form validation with invalid data
4. Test error handling and user feedback
5. Check that all routes are accessible and functional

### Automated Testing
1. Run the test suite: `vendor/bin/phpunit`
2. Verify all tests pass
3. Check code coverage if available

## Notes
- This implementation should be production-ready
- Consider future extensibility for additional product features
- Ensure the system is secure and follows best practices
- Maintain consistency with existing application patterns
- Document any assumptions or decisions made during implementation
