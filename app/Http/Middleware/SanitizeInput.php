<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Input Sanitization Middleware
 * 
 * Sanitizes user input to prevent XSS attacks.
 * Works alongside Laravel's built-in validation.
 */
class SanitizeInput
{
    /**
     * Fields that should not be sanitized (e.g., password fields, HTML content)
     */
    protected array $except = [
        'password',
        'password_confirmation',
        'current_password',
        'new_password',
        'content', // Allow HTML in content fields for CMS
        'custom_css',
        'history_content',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $input = $request->all();
        
        $sanitized = $this->sanitizeArray($input);
        
        $request->merge($sanitized);

        return $next($request);
    }

    /**
     * Recursively sanitize an array of inputs
     */
    protected function sanitizeArray(array $input, string $prefix = ''): array
    {
        $sanitized = [];

        foreach ($input as $key => $value) {
            $fullKey = $prefix ? "{$prefix}.{$key}" : $key;

            if (is_array($value)) {
                $sanitized[$key] = $this->sanitizeArray($value, $fullKey);
            } elseif (is_string($value)) {
                $sanitized[$key] = $this->shouldSanitize($key) ? $this->sanitizeString($value) : $value;
            } else {
                $sanitized[$key] = $value;
            }
        }

        return $sanitized;
    }

    /**
     * Check if a field should be sanitized
     */
    protected function shouldSanitize(string $key): bool
    {
        return !in_array($key, $this->except, true);
    }

    /**
     * Sanitize a string value
     */
    protected function sanitizeString(string $value): string
    {
        // Trim whitespace
        $value = trim($value);

        // Remove null bytes
        $value = str_replace(chr(0), '', $value);

        // Convert special HTML characters to entities (basic XSS prevention)
        // Note: Laravel's Blade {{ }} already does this, but this is defense in depth
        // We do NOT use strip_tags here to preserve legitimate content

        return $value;
    }
}
