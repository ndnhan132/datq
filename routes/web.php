<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CartController;


























Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/gio-hang', [CartController::class, 'showCart'])->name('cart.showCart');







Route::get('/cart/add-to-cart/{productId}', [CartController::class, 'addToCart'])->name('cart.addToCart');
Route::get('/cart/index', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clearCart');
Route::get('/cart/header-cart-reload', [CartController::class, 'headerCartReload'])->name('cart.headerCartReload');

Route::get('/cart/show-detail-cart-content', [CartController::class, 'showDetailCartContent'])->name('cart.showDetailCartContent');
Route::get('/cart/show-cart-order', [CartController::class, 'showCartOrder'])->name('cart.showCartOrder');

Route::post('/cart/update-cart', [CartController::class, 'updateCart'])->name('cart.updateCart');
 



