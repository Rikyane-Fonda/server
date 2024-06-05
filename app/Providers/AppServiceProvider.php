<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Pointing;
use App\Observers\PointingObserver;

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
        Pointing::observe(PointingObserver::class);
    }
}
