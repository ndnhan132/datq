<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\AccountController;


use Illuminate\Support\Facades\Session; 
use App\Models\History;






// Route::group([
//     'name' => 'account.', 
//     'prefix' => 'tai-khoan', 
//     // 'middleware' => 'auth'
//     'middleware' => 'web'
// ], 



Route::name('account.')->prefix('/tai-khoan')->middleware(['web'])->group(function(){
    Route::get('/', [AccountController::class, 'getLogin'])->name('getLogin');
    Route::post('/', [AccountController::class, 'postLogin'])->name('postLogin');
    Route::get('/dang-xuat', [AccountController::class, 'logout'])->name('logout');
    
});

Route::get('/123', function () {
    Session::put('test', 'testing');
});

Route::get('/124', function () {
    dd(Session::get('test'));
});


Route::get('/quan-ly/dashboard', [AccountController::class, 'getDashboard'])->name('getDashboard');
// Route::get('/quan-ly/dashboard', function () {
//     dump(session()->all());
//     Log::info('/quan-ly/dashboard', session()->all());

// })->name('getDashboard');


Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');

    return "Cache is cleared";
});






Route::get('/test', function() {
    // $sessionPath = session()->getPath();
    
    $sessionPath = config('session.SESSION_PATH');


    $session = session()->all();

    dump($session);

    // $h = new History();
    // $h->action = 'new History()';
    // $h->save();
    // dump($h);
});

 

Route::group(['middleware' => 'web'], function () {





Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/gio-hang', [CartController::class, 'showCart'])->name('cart.showCart');
Route::post('/cart/store-order', [OrderController::class, 'storeOrder'])->name('order.storeOrder');
Route::get('/dat-hang-thanh-cong/{order_id}', [OrderController::class, 'orderComplete'])->name('order.orderComplete');







Route::get('/cart/add-to-cart/{productId}', [CartController::class, 'addToCart'])->name('cart.addToCart');
Route::get('/cart/index', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clearCart');
Route::get('/cart/header-cart-reload', [CartController::class, 'headerCartReload'])->name('cart.headerCartReload');

Route::get('/cart/show-detail-cart-content', [CartController::class, 'showDetailCartContent'])->name('cart.showDetailCartContent');
Route::get('/cart/show-cart-order', [CartController::class, 'showCartOrder'])->name('cart.showCartOrder');

Route::post('/cart/update-cart', [CartController::class, 'updateCart'])->name('cart.updateCart');
Route::post('/product/live-search', [HomeController::class, 'liveSearch'])->name('home.liveSearch');
 



});