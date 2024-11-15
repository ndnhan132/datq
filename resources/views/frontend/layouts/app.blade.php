<!DOCTYPE html>
<html dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- <link rel="stylesheet" href="{{ asset('/public/css/bootstrap.css') }}" rel="stylesheet" > -->
    <script src="{{ asset('/public/js/jquery-3.7.1.min.js') }}" type="text/javascript"></script>
    
    <link rel="stylesheet" href="{{ asset('/public/css/bhx.css') }}?v{{ time() }}" rel="stylesheet" >
    
    
    <link rel="stylesheet" href="{{ asset('/public/css/styles.css') }}?v{{ time() }}" rel="stylesheet" >

</head>
<body>
    <div style="min-height: 100vh;" class="w100 block relative bg-main">

        @include('frontend.layouts.header')
        <div>
            <div class="relative mx-auto max-w-screen">
                @include('frontend.layouts.main-sidebar')
            </div>
        </div>
        <!-- ------------------------------------------------------------------------ -->

        <div class="mx-auto max-w-screen"
        style="
        transition-property: all;
        transition-timing-function: cubic-bezier(.4,0,.2,1);
        transition-duration: .4s;
        padding-top: 90px;
        ">

            @yield('content')
        </div>

        
    </div>


    <script src="{{ asset('/public/js/bootstrap.js') }}" type="text/javascript"></script>
    
    
    <link rel="stylesheet" href="{{ asset('/public/css/fontawesome-all.min.css') }}" rel="stylesheet" >
    <!-- <link rel="stylesheet" href="{{ asset('/public/css/all.css') }}" rel="stylesheet" > -->

    
    <script src="{{ asset('/public/js/app.js') }}?v{{ time() }}" type="text/javascript"></script>

</body>
</html>
