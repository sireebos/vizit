<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
            'permission' => \App\Http\Middleware\CheckPermission::class,
            'installed' => \App\Http\Middleware\CheckInstalled::class,
            'security.headers' => \App\Http\Middleware\SecurityHeaders::class,
            'sanitize' => \App\Http\Middleware\SanitizeInput::class,
        ]);

        // Global middleware for all web routes
        $middleware->web(append: [
            \App\Http\Middleware\CheckInstalled::class,
            \App\Http\Middleware\SecurityHeaders::class,
            \App\Http\Middleware\SanitizeInput::class,
        ]);

        // API middleware
        $middleware->api(prepend: [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]);

        $middleware->api(append: [
            \App\Http\Middleware\SecurityHeaders::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Log security-related exceptions
        $exceptions->report(function (\Illuminate\Auth\AuthenticationException $e) {
            \Log::warning('Authentication failed', [
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'url' => request()->fullUrl(),
            ]);
        });

        $exceptions->report(function (\Illuminate\Validation\ValidationException $e) {
            // Only log validation failures for sensitive routes
            if (request()->is('admin/*') || request()->is('api/*')) {
                \Log::info('Validation failed on protected route', [
                    'ip' => request()->ip(),
                    'url' => request()->fullUrl(),
                    'errors' => $e->errors(),
                ]);
            }
        });
    })->create();
