<?php

use Faker\Factory as Faker;


function priceAfterDiscount($product) {
    $discountedPrice = $product->price - ($product->price * $product->discount / 100);
    $roundedDownPrice = floor($discountedPrice / 1000) * 1000;
    return $roundedDownPrice;
}

function convertMoneyToStr($price) {
    return number_format($price, 0, ',', '.');
}

function calTotalAmountAfterDiscount ( $cartProducts, $carts ) {
    $subTotal = 0;
    foreach ($cartProducts as $product) {
        $product->cartQuantity = $carts[$product->id]['quantity'];
        $subTotal += priceAfterDiscount( $product ) * $product->cartQuantity;
    }
    return (int) $subTotal;
}

// tổng tiền của các sản phẩm trước khi áp dụng bất kỳ khoản giảm giá, thuế hay phí vận chuyển nào
function calSubtotal($cartProducts, $carts ) {
    $subTotal = 0;
    foreach ($cartProducts as $product) {
        $product->cartQuantity = $carts[$product->id]['quantity'];
        $subTotal += $product->price * $product->cartQuantity;
    }
    return (int) $subTotal;
}
// tổng soso tiền giảm đi bới khuyến mãi discount
function calDiscountTotal($cartProducts, $carts ) {
    $discountTotal = 0;
    foreach ($cartProducts as $product) {
        $product->cartQuantity = $carts[$product->id]['quantity'];
        $discountTotal += ($product->price - priceAfterDiscount( $product ) ) * $product->cartQuantity;
    }
    return (int) $discountTotal;
}

function generateOrderId() {
    $randomChars = getRandomCharacters();

    return $randomChars . time();
}

 
function getRandomCharacters($length = 3) {
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    $randomString = '';
    
    for ($i = 0; $i < $length; $i++) {
        $charLength = strlen($characters);
        $randomIndex = rand(0, $charLength - 1);
        $randomString .= $characters[$randomIndex];
    }

    return $randomString;
}

function processProducts($products) {
    foreach ($products as $product) {
        $product = processProduct($product);
    }
    return $products;
}

function processProduct($product) {
    $newCarts = session()->get('carts') ?? [];
    $product->name_vi = $product->name_vi . " - " .  $product->categories()->first()->name;
    $product->first_photo = $product->photos()->first()->path; 
    $product->link_detail_page = '/' . $product->categories()->first()->slug . "/" . $product->slug;

    // $product->link_category = "/" .  $product->categories()->first()->slug;
    $product->first_photo = $product->photos()->first()->path; 
    $product->new_price = priceAfterDiscount($product);
    $product->cart_quantity = $newCarts[$product->id]['quantity'] ?? 0;
    return $product;
}
