<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Security Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains security-related configuration options for the
    | application to meet Envato security standards.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Rate Limiting
    |--------------------------------------------------------------------------
    */
    'rate_limits' => [
        'login' => [
            'max_attempts' => env('LOGIN_MAX_ATTEMPTS', 5),
            'decay_minutes' => env('LOGIN_DECAY_MINUTES', 15),
        ],
        'api' => [
            'max_attempts' => env('API_RATE_LIMIT', 60),
            'decay_minutes' => 1,
        ],
        'password_reset' => [
            'max_attempts' => env('PASSWORD_RESET_MAX_ATTEMPTS', 3),
            'decay_minutes' => env('PASSWORD_RESET_DECAY_MINUTES', 60),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Policy
    |--------------------------------------------------------------------------
    */
    'password' => [
        'min_length' => env('PASSWORD_MIN_LENGTH', 8),
        'require_uppercase' => env('PASSWORD_REQUIRE_UPPERCASE', true),
        'require_lowercase' => env('PASSWORD_REQUIRE_LOWERCASE', true),
        'require_numbers' => env('PASSWORD_REQUIRE_NUMBERS', true),
        'require_symbols' => env('PASSWORD_REQUIRE_SYMBOLS', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | File Upload Security
    |--------------------------------------------------------------------------
    */
    'uploads' => [
        'allowed_image_extensions' => ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'],
        'allowed_document_extensions' => ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'txt'],
        'max_file_size' => env('MAX_UPLOAD_SIZE', 10240), // KB
        'image_max_dimensions' => [
            'width' => env('IMAGE_MAX_WIDTH', 4096),
            'height' => env('IMAGE_MAX_HEIGHT', 4096),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Session Security
    |--------------------------------------------------------------------------
    */
    'session' => [
        'regenerate_on_login' => true,
        'invalidate_on_logout' => true,
        'single_session' => env('SINGLE_SESSION_MODE', false), // One session per user
    ],

    /*
    |--------------------------------------------------------------------------
    | Content Security Policy
    |--------------------------------------------------------------------------
    */
    'csp' => [
        'enabled' => env('CSP_ENABLED', true),
        'report_only' => env('CSP_REPORT_ONLY', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Logging Security Events
    |--------------------------------------------------------------------------
    */
    'logging' => [
        'log_failed_logins' => env('LOG_FAILED_LOGINS', true),
        'log_successful_logins' => env('LOG_SUCCESSFUL_LOGINS', true),
        'log_password_changes' => env('LOG_PASSWORD_CHANGES', true),
        'log_permission_changes' => env('LOG_PERMISSION_CHANGES', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Honeypot (Anti-Spam)
    |--------------------------------------------------------------------------
    */
    'honeypot' => [
        'enabled' => env('HONEYPOT_ENABLED', true),
        'field_name' => 'website_url_field',
    ],

];
