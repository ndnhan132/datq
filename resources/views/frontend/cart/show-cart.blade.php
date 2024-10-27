@extends('frontend.layouts.app')

@section('title', 'Giỏ hàng')

@section('content')
    <div class="container">
        <div class="col-sm-6 mx-auto">
            <div class="w-100" id="cart_detail_content" >
                @include('frontend.cart.show-cart-list')
            </div>
        </div>
    </div>
@endsection
