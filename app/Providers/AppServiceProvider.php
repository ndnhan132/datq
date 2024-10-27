<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;



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
        // $request = request();

        // dump($request->session()->all());

        // dump(session('carts', []) );
        // dump(session());
        // dump(Session::all());

        
        // $cartItemCount  = Session::get('carts', []);
        // dump( $cartItemCount );
        
        // $cartItemCount2  = session()->get('carts', []);
        // dump( $cartItemCount2 );
        // $cartItemCount  = 10;
        // dd(Session::get('carts', []));

        // View::share('cartItemCount', $cartItemCount );
    }
}
