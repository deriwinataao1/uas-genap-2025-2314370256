<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

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
    public function boot()
    {
        View::composer('layouts.navbar', function ($view) {
            $user = Auth::user();
            $cartItems = [];

            if ($user) {
                $cartItems = Cart::with('product') // pastikan relasi product ada
                                ->where('user_id', $user->id)
                                ->get();
            }

            $view->with('cartItems', $cartItems);
        });
    }
}
