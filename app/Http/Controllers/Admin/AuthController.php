<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Maximum login attempts before lockout
     */
    protected int $maxAttempts = 5;

    /**
     * Lockout duration in minutes
     */
    protected int $decayMinutes = 15;

    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.home-page.edit');
        }
        return view('admin.auth.login');
    }

    /**
     * Handle login attempt with rate limiting and security logging
     */
    public function login(Request $request)
    {
        // Check rate limiting
        $this->checkTooManyAttempts($request);

        // Validate credentials
        $credentials = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            // Clear rate limiter on successful login
            RateLimiter::clear($this->throttleKey($request));

            // Regenerate session for security
            $request->session()->regenerate();

            // Log successful login
            if (config('security.logging.log_successful_logins', true)) {
                Log::info('Successful admin login', [
                    'user_id' => Auth::id(),
                    'email' => $this->maskEmail($credentials['email']),
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);
            }

            return redirect()->intended(route('admin.home-page.edit'));
        }

        // Increment rate limiter on failed attempt
        RateLimiter::hit($this->throttleKey($request), $this->decayMinutes * 60);

        // Log failed login attempt
        if (config('security.logging.log_failed_logins', true)) {
            Log::warning('Failed admin login attempt', [
                'email' => $this->maskEmail($credentials['email']),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'attempts_remaining' => RateLimiter::remaining($this->throttleKey($request), $this->maxAttempts),
            ]);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Handle logout with session security
     */
    public function logout(Request $request)
    {
        $userId = Auth::id();

        Auth::logout();

        // Invalidate and regenerate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Log logout
        Log::info('Admin logout', [
            'user_id' => $userId,
            'ip' => $request->ip(),
        ]);

        return redirect()->route('admin.login');
    }

    /**
     * Check if too many login attempts
     */
    protected function checkTooManyAttempts(Request $request): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey($request), $this->maxAttempts)) {
            return;
        }

        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        Log::warning('Login rate limit exceeded', [
            'ip' => $request->ip(),
            'lockout_seconds' => $seconds,
        ]);

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ])->status(429);
    }

    /**
     * Get the rate limiting throttle key
     */
    protected function throttleKey(Request $request): string
    {
        return Str::transliterate(Str::lower($request->input('email')) . '|' . $request->ip());
    }

    /**
     * Mask email for logging (privacy)
     */
    protected function maskEmail(string $email): string
    {
        $parts = explode('@', $email);
        $name = $parts[0];
        $domain = $parts[1] ?? '';

        $maskedName = substr($name, 0, 2) . str_repeat('*', max(0, strlen($name) - 2));

        return $maskedName . '@' . $domain;
    }
}

