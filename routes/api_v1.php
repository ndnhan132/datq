<?php
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\CartController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\LocationController;


Route::get('products/filter', [ProductController::class, 'filter']);
Route::get('products/flashsale', [ProductController::class, 'flashSale']);
Route::get('products/hotdeal', [ProductController::class, 'hotDeal']);
Route::get('products/by-category', [ProductController::class, 'productsByCategory']);
Route::get('product/similar', [ProductController::class, 'similar']);
Route::get('product/sanphammuacung', [ProductController::class, 'sanPhamMuaCung']);
Route::get('product/{productSlug}', [ProductController::class, 'productBySlug']);
Route::get('location/GetAllProvinces', [LocationController::class, 'GetAllProvinces']);
Route::get('location/GetDistrictsByProvinceId/{provinceId}', [LocationController::class, 'GetDistrictsByProvinceId']);
Route::get('location/GetWardsByDistrictId/{districtId}', [LocationController::class, 'GetWardsByDistrictId']);
Route::get('location/searchLocation', [LocationController::class, 'searchLocation']);



Route::get('category/getHomeCategoryProduct', [CategoryController::class, 'getHomeCategoryProduct']);

Route::get('search', [ProductController::class, 'search']);
Route::get('search/suggestSearch', [ProductController::class, 'suggestSearch']);


Route::apiResource('products', ProductController::class);
Route::apiResource('categories', CategoryController::class);
Route::middleware(['web'])->group(function () {
    Route::get('cart/products', [CartController::class, 'getCartProducts']);
    Route::put('order/userConfirm', [OrderController::class, 'userConfirm']);
    Route::put('order/cancel', [OrderController::class, 'cancel']);

    Route::apiResource('cart', CartController::class);
    Route::apiResource('order', OrderController::class);
});


