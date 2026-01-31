<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Get the dashboard route based on user role_id
     * role_id = 1: Super Admin (can access all dashboards, default: accountant/finance)
     * role_id = 2: Content Manager (content-management dashboard only)
     * role_id = 3: Accountant (accountant dashboard only)
     */
    public static function getDashboardRoute($user)
    {
        if (!$user) {
            return '/dashboard';
        }

        // Check by role_id first (more reliable)
        switch ($user->role_id) {
            case 1: // Super Admin - Default to Accountant/Finance Dashboard
                return '/accountant/dashboard';
            case 2: // Content Manager
                return '/content-management/dashboard';
            case 3: // Accountant
                return '/accountant/dashboard';
            default:
                // Fallback to slug-based check for backward compatibility
                if ($user->role) {
                    $roleSlug = $user->role->slug;
                    switch ($roleSlug) {
                        case 'super-admin':
                            return '/accountant/dashboard'; // Super admin defaults to finance
                        case 'admin':
                            return '/content-management/dashboard';
                        case 'accountant':
                            return '/accountant/dashboard';
                        case 'front-office':
                            return '/front-office/dashboard';
                    }
                }
                return '/dashboard';
        }
    }

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
