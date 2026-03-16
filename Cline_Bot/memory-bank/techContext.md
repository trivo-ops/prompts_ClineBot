# Technology Context: Cline_Bot

## Technology Stack Overview

### Backend Technologies
- **Framework**: CakePHP 5.x (latest stable)
- **Language**: PHP 8.3+ with strict typing (`declare(strict_types=1)`)
- **Database**: MySQL 8.0 with InnoDB engine
- **Authentication**: CakePHP Authentication plugin
- **ORM**: CakePHP's built-in ORM with validation and relationships

### Frontend Technologies
- **Templates**: CakePHP view templates (PHP-based)
- **Styling**: Custom CSS with modern design principles
- **JavaScript**: Vanilla JavaScript for interactivity
- **Responsive Design**: Mobile-first CSS approach

### Development & Infrastructure
- **Containerization**: Docker with docker-compose for development
- **Package Management**: Composer for PHP dependencies
- **Build Tools**: Makefile for common development tasks
- **Code Quality**: PHP_CodeSniffer, PHPStan, Psalm for static analysis
- **Testing**: PHPUnit with CakePHP test framework

## Key Configuration Files

### Application Configuration
- `config/app.php` - Main application settings, debug mode, security salts
- `config/bootstrap.php` - Plugin loading and initial setup
- `config/routes.php` - URL routing configuration

### Database Configuration
- `config/Migrations/` - Database schema changes and data seeding
- `config/schema/` - SQL schema definitions
- `config/app_local.example.php` - Local development configuration template

### Development Tools
- `composer.json` - PHP dependencies and autoloading
- `phpcs.xml` - PHP_CodeSniffer coding standards
- `phpstan.neon` - PHPStan static analysis configuration
- `psalm.xml` - Psalm type checking configuration
- `phpunit.xml.dist` - PHPUnit testing configuration

## Development Environment Setup

### Docker Configuration
```yaml
# docker-compose.yml
services:
  app:
    build: .
    ports: ["8765:80"]
    volumes: [".:/var/www/html"]
  db:
    image: mysql:8.0
    environment:
      MYSQL_DATABASE: cline_bot
      MYSQL_USER: cline_bot
      MYSQL_PASSWORD: cline_bot
```

### Makefile Commands
```bash
make up          # Start Docker containers
make shell       # Access app container shell
make test        # Run test suite
make cs          # Run code style checks
make migrate     # Run database migrations
```

## Code Organization

### Source Structure
```
src/
├── Controller/     # HTTP request handlers
├── Model/         # Data models and business logic
│   ├── Entity/    # Data objects
│   └── Table/     # Database operations
├── View/          # Template rendering
└── Application.php # Application bootstrap
```

### Template Structure
```
templates/
├── Products/      # Product management views
├── Categories/    # Category management views
├── Users/         # Authentication views
└── layout/        # Layout templates
```

## Security Features

### Authentication
- Email/password authentication
- Session-based authentication
- Password hashing with bcrypt
- CSRF protection on forms

### Input Validation
- Server-side validation in model tables
- Client-side JavaScript validation
- SQL injection prevention through ORM
- XSS prevention through template escaping

### Database Security
- UUID primary keys (no predictable IDs)
- Soft deletes for data recovery
- Foreign key constraints for data integrity

## Performance Considerations

### Database Optimization
- Indexed foreign keys
- Efficient query patterns through ORM
- Pagination for large datasets
- Proper relationship loading

### Caching Strategy
- File-based caching for development
- Configurable cache backends
- Query result caching where appropriate

### Frontend Optimization
- Minified CSS and JavaScript
- Efficient CSS selectors
- Optimized image handling
- Responsive design for all devices

## Testing Strategy

### Unit Tests
- Model validation testing
- Component functionality testing
- Helper method testing

### Integration Tests
- Controller action testing
- Full workflow testing
- Database interaction testing

### Functional Tests
- User interface testing
- End-to-end workflow verification
- Cross-browser compatibility

## Deployment Considerations

### Environment Variables
- Database connection settings
- Application debug mode
- Security configuration
- Cache configuration

### Production Setup
- Debug mode disabled
- Error reporting configured
- Security headers enabled
- Performance optimizations applied

### Monitoring & Logging
- Application logging through CakePHP
- Error tracking and reporting
- Performance monitoring
- Security event logging
