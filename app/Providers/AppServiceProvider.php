<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepository;
use App\Services\AuthService;
use App\Models\User;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->bind(UserRepository::class, function ($app) {
        //     return new UserRepository($app->make(User::class));
        // });

        // $this->app->bind(AuthService::class, function ($app){
        //     return new AuthService($app->make(UserRepository::class));
        // });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
