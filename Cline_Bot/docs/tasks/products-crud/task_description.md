# Task: Implement Products CRUD System

## Overview
Implement a complete CRUD (Create, Read, Update, Delete) system for managing products in the CakePHP 5 application. This system will allow users to manage a catalog of products with basic information including name, category, price, stock, size, and color.

## Requirements

### Functional Requirements
- **Create**: Add new products with validation
- **Read**: View list of all products and individual product details
- **Update**: Edit existing product information
- **Delete**: Remove products from the system
- **Validation**: Ensure data integrity with proper validation rules
- **User Interface**: Create user-friendly forms and display pages

### Technical Requirements
- Follow CakePHP 5 MVC architecture patterns
- Use database migrations for schema management
- Implement proper model validation rules
- Create controller actions for all CRUD operations
- Design consistent view templates
- Include comprehensive error handling
- Add Flash messaging for user feedback
- Implement CSRF protection for forms

### Data Model Requirements
- **Product Fields**:
  - `id` (auto-increment primary key)
  - `name` (string, max 255 chars, required)
  - `category` (string, max 100 chars, required)
  - `price` (decimal, 10,2 precision, required, >= 0)
  - `stock` (integer, required, >= 0)
  - `size` (string, max 20 chars, optional)
  - `color` (string, max 50 chars, optional)
  - `created` (timestamp)
  - `modified` (timestamp)

### Security Requirements
- Input validation and sanitization
- CSRF token protection for all forms
- Proper error handling without exposing sensitive information
- Data validation at model level

## Success Criteria
- [ ] Database migration creates products table successfully
- [ ] All CRUD operations work correctly
- [ ] Form validation prevents invalid data entry
- [ ] User interface is consistent with existing application
- [ ] Flash messages provide clear user feedback
- [ ] Tests cover all major functionality
- [ ] Implementation follows CakePHP best practices

## Dependencies
- Existing CakePHP 5 application structure
- Database connection configured
- User authentication system (for future integration)

## Notes
- Use existing application styling and layout patterns
- Follow established naming conventions
- Consider future extensibility for additional product features
