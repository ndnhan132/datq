<?php




function priceAfterDiscount($price, $discount) {
    $discountedPrice = $price - ($price * $discount / 100);
    $roundedDownPrice = floor($discountedPrice / 1000) * 1000;
    return $roundedDownPrice;
}

function convertMoneyToStr($price) {
    return number_format($price, 0, ',', '.');
}

function calEstimatedAmount ( $cartProducts, $carts ) {
    $subTotal = 0;
    foreach ($cartProducts as $product) {
        $product->cartQuantity = $carts[$product->id]['quantity'];
        $subTotal += priceAfterDiscount( $product->price , $product->discount ) * $product->cartQuantity;
    }
    return $subTotal;
}