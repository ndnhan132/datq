<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Models\Category;


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
        $chinaCategories;
        try {
            $chinaCategories = Category::with('products')->where('parent_id', '1')->get();
        }
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
        View::share('chinaCategories', $chinaCategories );
    }
}
