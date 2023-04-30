<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Pagination\Paginator;
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
        // Tell paginator to use bootstrap instead of default (Tailwind)
        Paginator::useBootstrap();

        // Share product categories to all views
        View::share('categories', Category::all());


        // View::share('favorites', auth()->check() ? auth()->user()->favorites : null);

        // View::composer('/products/favorites', function (View $view) {
        //     $favorites = null;
        //     if (auth()->check()) {
        //         // Share users to all views
        //         // View::share('favorites', auth()->user()->favorites);
        //         $favorites = auth()->user()->favorites;
        //     }

        //     $view->with('favorites', $favorites);
        // });
    }
}
