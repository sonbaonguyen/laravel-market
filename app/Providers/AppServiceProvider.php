<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Share product categories to all views
        View::share('categories', Category::all());

        if (auth()->check()) {
            // Share users to all views
            View::share('favorites', auth()->user()->favorites);
        }
    }
}
