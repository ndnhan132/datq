<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\AccountController;

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\PhotoController;





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

    Route::get('/load-datatable', [ProductController::class, 'loadDataTable'])->name('loadDataTable');


    Route::get('/them-moi', [ProductController::class, 'create'])->name('create');
    Route::post('/them-moi', [ProductController::class, 'store'])->name('store');

    Route::get('/thay-doi/{product_id}', [ProductController::class, 'getUpdate'])->name('getUpdate');
    Route::post('/thay-doi', [ProductController::class, 'postUpdate'])->name('postUpdate');
    Route::post('/delete', [ProductController::class, 'delete'])->name('delete');




});


Route::name('photo.')->prefix('/hinh-anh')->group(function(){


    Route::post('/them-moi-tu-san-pham', [PhotoController::class, 'ajaxUploadFromProduct'])->name('ajaxUploadFromProduct');
    Route::get('/get-modal-photo', [PhotoController::class, 'loadProductModalPhoto'] )->name('loadProductModalPhoto');
});
