# Security Features

This document outlines the security features implemented in this application to meet Envato security standards.

## 1. CSRF Protection

- **Laravel's built-in CSRF protection** is enabled by default for all web routes
- All forms include `@csrf` directive automatically
- API routes use Sanctum token-based authentication
- SameSite cookie attribute set to "lax" for additional CSRF mitigation

## 2. Role-Based Access Control (RBAC)

- Powered by **Spatie Laravel Permission** package
- Admin routes protected by `auth` middleware
- Custom `CheckRole` and `CheckPermission` middleware for granular access control
- API routes protected by Sanctum authentication

### Available Middleware:
```php
'role' => \App\Http\Middleware\CheckRole::class,
'permission' => \App\Http\Middleware\CheckPermission::class,
```

## 3. Encrypted Password Storage

- Passwords are hashed using **bcrypt** algorithm (Laravel default)
- Password hashing is automatic via Eloquent model attribute casting
- Minimum password length: 8 characters
- Password confirmation required on registration/reset

## 4. Input Validation & XSS Protection

### Server-Side Validation
- All user inputs validated using Laravel's validation system
- Custom `SecureFormRequest` base class with common validation rules
- Maximum length limits on all text inputs

### XSS Protection
- **Blade templating** automatically escapes output using `{{ }}` syntax
- `SanitizeInput` middleware removes null bytes and trims whitespace
- `SecurityHelper` class provides sanitization utilities
- Content Security Policy (CSP) headers in production

### Security Headers Middleware
The `SecurityHeaders` middleware adds:
- `X-Frame-Options: SAMEORIGIN` - Prevents clickjacking
- `X-Content-Type-Options: nosniff` - Prevents MIME sniffing
- `X-XSS-Protection: 1; mode=block` - XSS filter for older browsers
- `Referrer-Policy: strict-origin-when-cross-origin` - Controls referrer info
- `Strict-Transport-Security` - Enforces HTTPS in production
- `Content-Security-Policy` - Controls resource loading in production

## 5. Secure Authentication & Session Handling

### Authentication Security
- **Rate limiting** on login attempts (5 attempts per 15 minutes)
- Account lockout after exceeded attempts
- Session regeneration on login (prevents session fixation)
- Session invalidation on logout
- Security event logging (failed/successful logins)

### Session Configuration (`config/session.php`)
- `encrypt: true` - Session data encrypted
- `http_only: true` - Cookies not accessible via JavaScript
- `secure: true` (production) - Cookies only sent over HTTPS
- `same_site: lax` - Prevents CSRF via cross-site requests
- `expire_on_close: true` - Sessions expire when browser closes

## 6. Additional Security Measures

### File Upload Security
- Allowed extensions whitelist
- Maximum file size limits
- MIME type validation
- Filename sanitization (prevents directory traversal)

### API Security
- Sanctum token authentication
- Rate limiting on API endpoints
- Security headers on all responses

### Logging & Monitoring
- Failed login attempts logged with IP address
- Successful logins logged
- Validation failures on protected routes logged
- Authentication failures logged

## Security Configuration

Security settings can be customized via `config/security.php`:

```php
return [
    'rate_limits' => [
        'login' => [
            'max_attempts' => 5,
            'decay_minutes' => 15,
        ],
    ],
    'password' => [
        'min_length' => 8,
    ],
    'uploads' => [
        'allowed_image_extensions' => ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'],
        'max_file_size' => 10240, // KB
    ],
];
```

## Environment Variables

Security-related environment variables:

```env
# Session Security
SESSION_DRIVER=database
SESSION_ENCRYPT=true
SESSION_SECURE_COOKIE=true  # Enable in production
SESSION_HTTP_ONLY=true

# Rate Limiting
LOGIN_MAX_ATTEMPTS=5
LOGIN_DECAY_MINUTES=15

# Logging
LOG_FAILED_LOGINS=true
LOG_SUCCESSFUL_LOGINS=true
```

## Security Helper Class

The `App\Helpers\SecurityHelper` class provides:

```php
// Sanitize string for safe output
SecurityHelper::sanitize($value);

// Sanitize HTML with allowed tags
SecurityHelper::sanitizeHtml($value, ['p', 'br', 'strong']);

// Generate secure random token
SecurityHelper::generateToken(32);

// Mask email for logging
SecurityHelper::maskEmail('user@example.com'); // us**@example.com

// Sanitize URL (removes javascript: etc.)
SecurityHelper::sanitizeUrl($url);

// Sanitize filename (prevents directory traversal)
SecurityHelper::sanitizeFilename($filename);

// Check allowed file extensions
SecurityHelper::isAllowedExtension($filename, ['jpg', 'png']);
```

## Reporting Security Issues

If you discover a security vulnerability, please email the developer directly. Do not create public issues for security vulnerabilities.
