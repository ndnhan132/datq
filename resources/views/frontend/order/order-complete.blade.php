@extends('frontend.layouts.app')

@section('title', 'Đặt hàng thành công')

@section('content')
    <div class="container">
        <div class="col-sm-6 mx-auto"  id="" >
            <div class="white-wrapbox  cart-header ">
                đặt hàng thành công
                mã đơn hang: {{ $orderId }}
            </div>
        </div>
    </div>
@endsection
