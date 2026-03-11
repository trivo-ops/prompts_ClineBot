## STATUS: APPROVED

# Task Prompt: User Authentication System Implementation

## Task ID
`TASK-001`

## Context

### Existing Codebase
The CakePHP application is set up with:
- Docker environment with MySQL database
- CakePHP 5.x framework structure
- Existing PagesController and basic routing
- Composer dependencies including cakephp/authentication and cakephp/authorization
- Database migration system configured

### Technology Stack
- CakePHP 5.x
- PHP 8.4+
- MySQL 8.0
- Docker
- PHPUnit for testing
- Authentication plugin for CakePHP

## Objective
Implement a complete user authentication system that allows users to register, login, access protected areas, and logout securely. The system must follow CakePHP 5.x conventions and include proper security measures.

## Constraints
- Must use CakePHP 5.x authentication plugin
- PHP 8.4+ with strict types
- Passwords must be hashed using DefaultPasswordHasher
- All forms must include CSRF protection
- Database must use MySQL with utf8mb4 encoding
- All authentication logic must be covered by unit tests
- No raw SQL (use CakePHP ORM)
- PSR-12 code style compliance

## Expected Output

### Files to Create
- `src/Model/Table/UsersTable.php` — User table with validation rules
- `src/Model/Entity/User.php` — User entity with password hashing
- `src/Controller/UsersController.php` — Authentication controller
- `templates/Users/login.php` — Login form template
- `templates/Users/register.php` — Registration form template
- `templates/Users/dashboard.php` — Protected dashboard template
- `tests/TestCase/Controller/UsersControllerTest.php` — Controller tests

### Files to Modify
- `src/Application.php` — Configure authentication middleware
- `config/routes.php` — Add authentication routes
- `src/Controller/AppController.php` — Add authentication component

## Acceptance Criteria
- [ ] User registration form accepts email and password
- [ ] Passwords are automatically hashed before saving
- [ ] Login form authenticates users with email/password
- [ ] Dashboard is only accessible to authenticated users
- [ ] Unauthenticated users are redirected to login page
- [ ] Logout functionality clears session and redirects home
- [ ] All forms include CSRF protection
- [ ] All unit tests pass
- [ ] Code style check passes (`phpcs`)
- [ ] No regressions in existing tests

## Out of Scope
- Password reset functionality
- Email verification
- User roles and permissions
- API endpoints
- Social authentication
- Remember me functionality
