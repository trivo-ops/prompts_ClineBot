# Dashboard Profile Enhancement

## Task Description
Enhance the user dashboard to display and allow editing of user profile information, including description and avatar image.

## Context
The current user dashboard only shows basic information (username, email, member since date). Users need the ability to personalize their profiles with additional information and visual elements to improve user experience and engagement.

## Requirements

### 1. Database Schema Updates
- Add `description` field (string, max 500 chars, nullable) to users table
- Add `avatar_path` field (string, max 255 chars, nullable) to users table
- Create migration file: `config/Migrations/20260317092300_AddProfileFieldsToUsers.php`

### 2. Backend Implementation
- Update `src/Model/Table/UsersTable.php` with validation rules:
  - Description: max 500 characters
  - Avatar path: must be valid URL format
- Update `src/Model/Entity/User.php` to make new fields accessible
- Add `edit()` action to `src/Controller/UsersController.php`:
  - Authorization check (users can only edit their own profiles)
  - Form processing with validation
  - Success/error flash messages
  - Proper redirects

### 3. Frontend Implementation
- Enhance `templates/Users/dashboard.php` to display:
  - Username, email, and member since date
  - User description (if present)
  - Avatar image with fallback to initials placeholder
  - "Edit Profile" link for authenticated users
- Create `templates/Users/edit.php` with:
  - Username, description, and avatar URL fields
  - Consistent styling with existing auth.css patterns
  - Proper error handling and validation feedback

### 4. Styling
- Add avatar-specific styles to `webroot/css/auth.css`:
  - Circular avatar images with consistent sizing
  - Proper spacing and layout for profile information
  - Responsive design considerations

## Success Criteria
- Users can view their complete profile information on the dashboard
- Users can edit their profile information through a dedicated edit form
- Profile changes are saved to the database and persist correctly
- Missing/null values are handled gracefully with appropriate placeholders
- UI maintains consistency with existing application design
- Proper authorization ensures users can only edit their own profiles
- All form inputs are properly validated

## Constraints
- New fields must be nullable to support gradual migration
- Avatar path must be a valid URL format (no file upload functionality)
- Must maintain backward compatibility with existing user data
- Must follow existing code patterns and styling conventions
- Must implement proper security measures (XSS prevention, authorization)

## Files to Modify/Create
- `config/Migrations/20260317092300_AddProfileFieldsToUsers.php` (NEW)
- `src/Model/Table/UsersTable.php` (MODIFY)
- `src/Model/Entity/User.php` (MODIFY)
- `src/Controller/UsersController.php` (MODIFY)
- `templates/Users/dashboard.php` (MODIFY)
- `templates/Users/edit.php` (NEW)
- `webroot/css/auth.css` (MODIFY)

## Testing Requirements
- Test profile display with and without avatar/description
- Test profile editing with valid and invalid data
- Test authorization (users can only edit their own profiles)
- Test graceful handling of missing/null values
- Verify consistent styling across different browsers
