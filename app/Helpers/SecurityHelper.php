<?php

namespace App\Helpers;

use Illuminate\Support\Str;

/**
 * Security Helper
 * 
 * Provides security-related utility functions for the application.
 */
class SecurityHelper
{
    /**
     * Sanitize a string for safe output (XSS prevention)
     */
    public static function sanitize(?string $value): string
    {
        if ($value === null) {
            return '';
        }

        return htmlspecialchars($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    /**
     * Sanitize HTML content while allowing safe tags
     */
    public static function sanitizeHtml(?string $value, array $allowedTags = ['p', 'br', 'strong', 'em', 'ul', 'ol', 'li', 'a', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6']): string
    {
        if ($value === null) {
            return '';
        }

        // Build allowed tags string
        $tagsString = '<' . implode('><', $allowedTags) . '>';

        // Strip disallowed tags
        $value = strip_tags($value, $tagsString);

        // Remove dangerous attributes
        $value = preg_replace('/\s*on\w+\s*=\s*["\'][^"\']*["\']/i', '', $value);
        $value = preg_replace('/\s*javascript\s*:/i', '', $value);

        return $value;
    }

    /**
     * Generate a secure random token
     */
    public static function generateToken(int $length = 32): string
    {
        return bin2hex(random_bytes($length));
    }

    /**
     * Hash sensitive data for logging (e.g., partial email masking)
     */
    public static function maskEmail(?string $email): string
    {
        if ($email === null || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return '***';
        }

        $parts = explode('@', $email);
        $name = $parts[0];
        $domain = $parts[1] ?? '';

        $maskedName = substr($name, 0, 2) . str_repeat('*', max(0, strlen($name) - 2));

        return $maskedName . '@' . $domain;
    }

    /**
     * Validate and sanitize a URL
     */
    public static function sanitizeUrl(?string $url): ?string
    {
        if ($url === null || $url === '') {
            return null;
        }

        // Remove any potential JavaScript
        if (preg_match('/^javascript:/i', trim($url))) {
            return null;
        }

        // Validate URL format
        $sanitized = filter_var($url, FILTER_SANITIZE_URL);

        if (!$sanitized || !filter_var($sanitized, FILTER_VALIDATE_URL)) {
            // Allow relative URLs
            if (Str::startsWith($url, ['//', '/', '#', '.'])) {
                return $sanitized;
            }
            return null;
        }

        return $sanitized;
    }

    /**
     * Sanitize a filename to prevent directory traversal
     */
    public static function sanitizeFilename(?string $filename): string
    {
        if ($filename === null) {
            return '';
        }

        // Remove directory traversal characters
        $filename = str_replace(['../', '..\\', '/', '\\'], '', $filename);

        // Remove null bytes
        $filename = str_replace(chr(0), '', $filename);

        // Keep only safe characters
        $filename = preg_replace('/[^a-zA-Z0-9_\-\.]/', '_', $filename);

        return $filename;
    }

    /**
     * Check if a file extension is allowed
     */
    public static function isAllowedExtension(string $filename, array $allowedExtensions): bool
    {
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        return in_array($extension, array_map('strtolower', $allowedExtensions), true);
    }

    /**
     * Get allowed image extensions
     */
    public static function getAllowedImageExtensions(): array
    {
        return ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
    }

    /**
     * Get allowed document extensions
     */
    public static function getAllowedDocumentExtensions(): array
    {
        return ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'txt'];
    }

    /**
     * Validate CSRF token manually if needed
     */
    public static function validateCsrfToken(string $token): bool
    {
        return hash_equals(csrf_token(), $token);
    }

    /**
     * Generate a honeypot field name (for spam prevention)
     */
    public static function getHoneypotFieldName(): string
    {
        return 'website_url_' . substr(md5(config('app.key')), 0, 8);
    }

    /**
     * Check if honeypot field is filled (indicates spam)
     */
    public static function isHoneypotFilled(?string $value): bool
    {
        return $value !== null && $value !== '';
    }

    /**
     * Rate limit check helper
     */
    public static function getRateLimitKey(string $action, ?string $identifier = null): string
    {
        $identifier = $identifier ?? request()->ip();
        return "rate_limit:{$action}:{$identifier}";
    }
}
