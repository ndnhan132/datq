<?php
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\CartController;


Route::get('products/filter', [ProductController::class, 'filter']);
Route::get('products/flashsale', [ProductController::class, 'flashSale']);
Route::get('products/hotdeal', [ProductController::class, 'hotDeal']);
Route::get('products/by-category', [ProductController::class, 'productsByCategory']);
Route::get('product/similar', [ProductController::class, 'similar']);
Route::get('product/sanphammuacung', [ProductController::class, 'sanPhamMuaCung']);
Route::get('product/{productSlug}', [ProductController::class, 'productBySlug']);





Route::apiResource('products', ProductController::class);
Route::apiResource('categories', CategoryController::class);
Route::middleware(['web'])->group(function () {
    Route::get('cart/products', [CartController::class, 'getCartProducts']);
    Route::apiResource('cart', CartController::class);
});


