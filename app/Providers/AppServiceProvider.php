<?php

namespace App\Providers;

use App\Models\Facility;
use App\Models\Partner;
use App\Models\Room;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        // Share rooms and facilities globally for navigation
        View::composer('layouts.frontbase', function ($view) {
            // $view->with('rooms', Room::where('status', 'Active')->latest()->take(10)->get());
            // $view->with('facilities', Facility::where('status', 'Active')->latest()->take(10)->get());
        });
    }
}
