## STATUS: APPROVED

# Implementation Plan: User Authentication System Implementation

## Task ID
`TASK-001`

## Summary
Implement a complete user authentication system for the CakePHP application including user registration, login, logout, and protected dashboard functionality with proper security measures and comprehensive testing.

---

## Files to Create

| File | Description |
|------|-------------|
| `src/Model/Table/UsersTable.php` | User table with validation rules for email and password |
| `src/Model/Entity/User.php` | User entity with password hashing and security field protection |
| `src/Controller/UsersController.php` | Authentication controller with login, register, logout, and dashboard actions |
| `templates/Users/login.php` | Login form template with CSRF protection and error handling |
| `templates/Users/register.php` | Registration form template with validation |
| `templates/Users/dashboard.php` | Protected dashboard template accessible only to authenticated users |
| `tests/TestCase/Controller/UsersControllerTest.php` | Controller integration tests for all authentication flows |
| `config/Migrations/20260311040530_CreateUsers.php` | Database migration for users table |

## Files to Modify

| File | Changes |
|------|---------|
| `src/Application.php` | Configure authentication middleware with session and form authenticators |
| `config/routes.php` | Add routes for login, register, logout, and dashboard |
| `src/Controller/AppController.php` | Add authentication component for controller access |

---

## Database Migrations

```sql
-- Table: users
CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email)
);
```

---

## Implementation Steps

- [x] **Step 1**: Install authentication dependencies
  - Run: `docker compose exec app composer require cakephp/authentication cakephp/authorization`
  - Run: `docker compose exec app composer require --dev cakephp/migrations`

- [x] **Step 2**: Create database migration
  - Run: `docker compose exec app bin/cake bake migration CreateUsers`
  - Add fields to migration (id, username, email, password, created, modified)
  - Run: `docker compose exec app bin/cake migrations migrate`

- [x] **Step 3**: Bake User Model
  - Run: `docker compose exec app bin/cake bake model User`
  - Add password hashing logic to User entity
  - Set accessible and hidden fields for security

- [x] **Step 4**: Configure Authentication
  - Add AuthenticationServiceProviderInterface to Application.php
  - Configure authentication middleware with session and form authenticators
  - Set up unauthenticated redirect to login page

- [x] **Step 5**: Create UsersController
  - Implement login action with authentication logic
  - Implement register action with user creation and validation
  - Implement logout action with session clearing
  - Implement dashboard action with authentication requirement

- [x] **Step 6**: Create Templates
  - Create login form template with email/password fields
  - Create registration form template with validation
  - Create dashboard template for authenticated users
  - Add CSRF protection to all forms

- [x] **Step 7**: Add Routes
  - Add authentication routes to config/routes.php
  - Configure resource routes for UsersController

- [x] **Step 8**: Write Tests
  - Create UsersControllerTest with integration tests
  - Test login page accessibility
  - Test register page accessibility
  - Test dashboard authentication requirement
  - Verify all tests pass

---

## Tests to Write

### UsersControllerTest
- `testLogin()` — GET /users/login returns 200 and contains 'Login'
- `testRegister()` — GET /users/register returns 200 and contains 'Register'
- `testDashboardRequiresAuthentication()` — GET /users/dashboard redirects to login for unauthenticated users

---

## Commands to Run

```bash
# Install dependencies
docker compose exec app composer require cakephp/authentication cakephp/authorization
docker compose exec app composer require --dev cakephp/migrations

# Create and run migration
docker compose exec app bin/cake bake migration CreateUsers
docker compose exec app bin/cake migrations migrate

# Create model and controller
docker compose exec app bin/cake bake model User
docker compose exec app bin/cake bake controller Users

# Run tests
docker compose exec app vendor/bin/phpunit tests/TestCase/Controller/UsersControllerTest.php

# Run all tests
docker compose exec app vendor/bin/phpunit

# Code style check
docker compose exec app vendor/bin/phpcs src/
```

---

## Definition of Done

- [x] Migration runs without errors and creates users table
- [x] User registration form accepts email and password with validation
- [x] Passwords are automatically hashed using DefaultPasswordHasher
- [x] Login form authenticates users with email/password
- [x] Dashboard is only accessible to authenticated users
- [x] Unauthenticated users are redirected to login page with proper redirect parameter
- [x] Logout functionality clears session and redirects to home page
- [x] All forms include CSRF protection
- [x] All unit tests pass (3/3 tests passing)
- [x] Code follows PSR-12 style guidelines
- [x] No regressions in existing test suite
- [x] Authentication middleware properly configured
- [x] Database connection working with MySQL
