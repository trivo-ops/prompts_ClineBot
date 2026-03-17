# Technology Context: Cline_Bot

## Core Stack

- Framework: CakePHP 5
- Language: PHP 8.3+
- Database: MySQL 8
- Package Manager: Composer
- Development Environment: Docker and docker-compose
- Testing: PHPUnit
- Static Analysis / Quality Tools: PHP_CodeSniffer, PHPStan, Psalm

## Project Structure

### Main Application Areas
- `src/Controller/` - request handling and application actions
- `src/Model/` - table classes, entities, validation, and business rules
- `templates/` - CakePHP view templates
- `config/Migrations/` - database schema changes
- `webroot/css/` - page styling assets
- `webroot/js/` - public JavaScript assets

### Notable Controllers
- `UsersController.php` - register, login, logout, dashboard
- `ProductsController.php` - products CRUD
- `CategoriesController.php` - categories CRUD

## Database Notes

### Users
- Created in `20250101000000_CreateUsers.php`
- Uses the default integer primary key
- Includes `username`, `email`, `password`, `created`, `modified`

### Products
- Originally created with a text `category` field
- Later updated to support `category_id`
- Later migrated to UUID primary keys
- Includes `sku` as a required unique field

### Categories
- Created with UUID primary keys
- Includes `name` and optional `description`

## Validation and Rules

### Confirmed Validation Layer
Validation is confirmed in CakePHP Table classes, especially:

- `src/Model/Table/ProductsTable.php`

The Products validation currently covers:
- `name`
- `category_id`
- `price`
- `stock`
- `size`
- `color`
- `sku`

### Important Note
Server-side validation is confirmed. Client-side validation should not be assumed unless separate JavaScript validation is actually added later.

## Authentication

The project uses CakePHP Authentication for user login flow.

Confirmed user actions:
- register
- login
- logout
- dashboard

The dashboard retrieves the authenticated identity in `UsersController::dashboard()`.

## Frontend Notes

The project uses CakePHP templates with custom CSS rather than relying only on the default scaffold presentation.

Relevant stylesheets include:
- `webroot/css/auth.css`
- `webroot/css/products.css`
- `webroot/css/categories.css`

The current UI direction is:
- cleaner than the default CakePHP scaffold
- consistent across auth, products, and categories pages
- server-rendered rather than SPA-based

## Development Workflow

Common project support files include:
- `docker-compose.yml`
- `Dockerfile`
- `Makefile`
- `composer.json`
- `phpunit.xml.dist`
- `phpcs.xml`
- `phpstan.neon`
- `psalm.xml`

Schema changes are handled through CakePHP migrations in `config/Migrations/`.

## Accuracy Boundaries

To keep this memory-bank reliable:

- do not assume all tables use UUIDs
- do not assume soft delete exists unless explicitly implemented
- do not assume client-side validation exists unless code is present
- prefer describing what is confirmed in the repository over generic CakePHP best practices
