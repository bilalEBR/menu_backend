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
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        // Define API rate limiting (standard Laravel)
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        // Define routes: this closure registers all route files
        $this->routes(function () {
            // ** CRITICAL FIX LINE: Loads routes/api.php under the /api prefix **
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Standard Web Routes
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
