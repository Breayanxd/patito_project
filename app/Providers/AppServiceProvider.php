<?php

namespace App\Providers;

use App\Listeners\UpdateLastLogin;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

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
        Event::listen(
            UpdateLastLogin::class,
        );
        
        Vite::prefetch(concurrency: 3);
    }
}
