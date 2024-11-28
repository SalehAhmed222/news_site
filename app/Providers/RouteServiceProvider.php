<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\Api;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';
    public const AdminHome = 'admin/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
            Route::middleware('web')
                ->group(base_path('routes/admin.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    //this is first way to Rate Limiter
    protected function configureRateLimiting(): void
    {


        //throttle for api routes
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(20)->by($request->user()?->id ?: $request->ip())->response(function () {
                return apiResponse(429, 'Try again after mintue');
            });;
        });

        // RateLimiter::for('getUser', function (Request $request) {
        //     return Limit::perMinute(2)->by($request->ip())->response(function () use ($request) {
        //         $retryAfter = RateLimiter::availableIn($request->ip());
        //         $remainingAttempts = RateLimiter::remaining($request->ip(), 1);
        //         RateLimiter::increment($request->ip());


        //         return response()->json([
        //             'status' => 429,
        //             'message' => 'Too many attempts. Please try again later.',
        //             'time_remaining' => $retryAfter, // الوقت المتبقي بالثواني
        //              // المحاولات المتبقية
        //         ], 429);
        //     });
        // });

        RateLimiter::for('contact', function (Request $request) {
            return Limit::perMinute(1)->by($request->ip())->response(function () {
                return apiResponse(429, 'Try again after mintue');
            });
        });

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(1)->by($request->ip())->response(function () {
                return apiResponse(429, 'Try again after mintue');
            });
        });

        RateLimiter::for('register', function (Request $request) {
            return Limit::perMinute(3)->by($request->ip())->response(function () {
                return apiResponse(429, 'Try again after mintue');
            });
        });
        RateLimiter::for('comment', function (Request $request) {
            return Limit::perMinute(2)->by($request->ip())->response(function () {
                return apiResponse(429, 'Try again after mintue');
            });
        });
        RateLimiter::for('verify', function (Request $request) {
            return Limit::perMinute(2)->by($request->ip())->response(function () {
                return apiResponse(429, 'Try again after mintue');
            });
        });



        //throttle for web routes
        RateLimiter::for('contact-web', function (Request $request) {
            return Limit::perMinute(2)->by($request->ip())->response(function () {
              abort(429);
            });
        });
    }
}
