@extends('frontend.layouts.app')

@section('title', 'Trang chủ')

@section('content')
    <div class="container">

    <!-- @include('frontend.home.carousel') -->
    <!-- @include('frontend.home.category-slide') -->
    @include('frontend.home.main-product')
    


        <h2>Welcome to My Application</h2>
        <p>This is the home page. Here you can find the latest updates and news.</p>


    </div>
@endsection
