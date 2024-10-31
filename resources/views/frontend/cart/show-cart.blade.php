@extends('frontend.layouts.app')

@section('title', 'Giỏ hàng')

@section('content')
    <div class="container">
        <div class=""  id="cart_detail_content" >
            @include('frontend.cart.show-cart-list')
        </div>
    </div>
@endsection
