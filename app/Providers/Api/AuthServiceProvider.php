<?php

namespace App\Providers\Api;

use App\Contracts\Auth\AuthContract;
use App\Models\User;
use App\Observers\UserObserver;
use App\Services\Auth\AuthService;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AuthContract::class, AuthService::class);
    }

    public function boot(): void
    {
        User::observe(UserObserver::class);
    }
}
