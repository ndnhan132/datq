<?php

use Faker\Factory as Faker;


function priceAfterDiscount($price, $discount) {
    $discountedPrice = $price - ($price * $discount / 100);
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
        $subTotal += priceAfterDiscount( $product->price , $product->discount ) * $product->cartQuantity;
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
        $discountTotal += ($product->price - priceAfterDiscount( $product->price , $product->discount ) ) * $product->cartQuantity;
    }
    return (int) $discountTotal;
}

function generateOrderId() {
    $randomChars = getRandomCharacters();

    return $randomChars . time();
}



function fakeName(){
    $faker = Faker::create();
    return $faker->name;
}
function fakePhone(){
    $faker = Faker::create();
    return $faker->phoneNumber;
}
function fakeAddress(){
    $faker = Faker::create();
    return $faker->address;
}
function fakeText(){
    $faker = Faker::create();
    return $faker->text;
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