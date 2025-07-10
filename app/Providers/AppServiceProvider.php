<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ActivityEventService;
use App\Services\impl\ActivityEventServiceImpl;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
