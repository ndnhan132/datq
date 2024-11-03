<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\AccountController;

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;





Route::get('/dashboard', [AccountController::class, 'getDashboard'])->name('getDashboard');


Route::name('category.')->prefix('/danh-muc')->group(function(){
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::post('/store', [CategoryController::class, 'store'])->name('store');
    Route::post('/update', [CategoryController::class, 'update'])->name('update');
    Route::get('/load-category-table', [CategoryController::class, 'loadCategoryTable'])->name('loadCategoryTable');
    Route::post('/delete', [CategoryController::class, 'delete'])->name('delete');

});

Route::name('product.')->prefix('/san-pham')->group(function(){
    
    Route::get('/', [ProductController::class, 'index'])->name('index');




});