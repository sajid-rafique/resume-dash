<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use App\Contracts\ApiResponseInterface;
use App\Services\ApiResponse;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ApiResponseInterface::class, ApiResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Passport::tokensExpireIn(now()->addSeconds(5));
        // Passport::refreshTokensExpireIn(now()->addSeconds(10));
        // Passport::personalAccessTokensExpireIn(now()->addSeconds(15));
        Passport::personalAccessTokensExpireIn(now()->addMinutes(30));
    }
}
