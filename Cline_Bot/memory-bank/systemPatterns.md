# System Patterns: Cline_Bot

## Architectural Style

The application follows standard CakePHP MVC patterns.

### Main Layers
- **Controllers** handle request flow, form submission handling, redirects, and flash messaging
- **Table classes** define associations, validation, and integrity rules
- **Entities** represent row-level data objects
- **Templates** render server-side views
- **Migrations** evolve the database schema over time

This is a conventional server-rendered CakePHP application, not a front-end-heavy SPA architecture.

## Core Functional Patterns

### 1. Authentication Pattern
Authentication is handled through CakePHP Authentication.

Observed user actions include:
- register
- login
- logout
- dashboard

Controllers retrieve the authenticated identity when needed, and some actions are explicitly allowed for unauthenticated access.

### 2. CRUD Pattern
Products and Categories both follow a standard CakePHP CRUD pattern:
- `index`
- `view`
- `add`
- `edit`
- `delete`

This creates a consistent structure across resource areas.

### 3. Validation Pattern
Validation is implemented in Table classes using CakePHP's `Validator`.

Confirmed example:
- `src/Model/Table/ProductsTable.php`

The current pattern is:
- define field rules in `validationDefault()`
- define relational/integrity rules in `buildRules()`
- use ORM save operations as the validation gate

This means server-side validation is the primary confirmed validation layer.

### 4. Relationship Pattern
Products and Categories use ORM associations rather than raw manual joins.

Confirmed pattern:
- `Products belongsTo Categories`
- `Categories hasMany Products`

This supports:
- dropdown-based category selection in forms
- related data loading via `contain()`
- referential integrity rules via `existsIn()`

### 5. Schema Evolution Pattern
The schema has evolved incrementally through migrations instead of big rewrites.

Examples of this pattern:
- adding Categories separately
- introducing `category_id` into Products
- migrating Products toward UUID identifiers
- adding SKU through a dedicated migration

This shows a task-by-task migration style rather than a single upfront schema design.

## UI and View Patterns

### Layout Pattern
Different sections of the app use section-specific layouts and styles rather than only the default CakePHP scaffold output.

Examples seen in the repo include custom styling for:
- auth pages
- products pages
- categories pages

### Form Pattern
Forms are server-rendered and follow CakePHP form helper conventions.

Typical pattern:
- create or fetch entity
- patch request data into entity
- save entity
- show flash success/error message
- re-render form on failure

### Feedback Pattern
User feedback is primarily handled through:
- validation errors from CakePHP
- flash success/error messages
- redirect-after-success flow

## Data Modeling Patterns

### Users
- created early with integer primary keys
- support authentication flow

### Categories
- modeled as a first-class table
- use UUID validation in the Table class
- support product organization

### Products
- evolved from simpler CRUD data to category-linked products
- now include required unique SKU handling
- rely on validation rules for data consistency

## Important Accuracy Rules

To keep this file trustworthy:
- do not assume patterns that are not visible in the codebase
- do not describe client-side validation unless it is actually implemented
- do not describe soft delete unless it is explicitly present
- do not generalize all tables as UUID-based if only some of them are

## Recommended Pattern for Future Tasks

Future tasks should continue the current style:
- follow CakePHP MVC conventions
- keep schema changes incremental through migrations
- preserve the existing UI direction
- keep logic in the appropriate controller/table/template layers
- update the memory-bank after major changes

## Purpose of This File

This file should capture the recurring implementation patterns of the codebase so future tasks can reuse them instead of reinventing structure each time.
