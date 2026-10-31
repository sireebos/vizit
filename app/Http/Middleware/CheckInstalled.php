<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\InstallController;

class CheckInstalled
{
    /**
     * Handle an incoming request.
     * Redirect to installer if app is not installed
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip if already on install routes
        if ($request->is('install*')) {
            return $next($request);
        }

        // Check if installed
        if (!InstallController::isInstalled()) {
            return redirect()->route('install.welcome');
        }

        return $next($request);
    }
}

