<?php

namespace App\Providers;

use App\Contracts\AuthenticationRepositoryInterface;
use App\Http\Controllers\AuthenticationController;
use App\Models\User;
use App\Services\AuthenticationService;
use Illuminate\Support\ServiceProvider;

class AuthenticationProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->when(AuthenticationController::class)
                  ->needs(AuthenticationRepositoryInterface::class)
                  ->give(fn () => new AuthenticationService(new User()));
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
