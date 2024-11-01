<!DOCTYPE html>
<html dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('/public/css/bootstrap.css') }}" rel="stylesheet" >
    <link rel="stylesheet" href="{{ asset('/public/css/style.css') }}?v{{ time() }}" rel="stylesheet" >
    <script src="{{ asset('/public/js/jquery-3.7.1.min.js') }}" type="text/javascript"></script>
</head>
<body>
    @include('frontend.layouts.header')


    <main class="container content position-relative" id="main_content">
        <div id="main_content_left" class="content-menu" style="">
            @include('frontend.layouts.main-sidebar')
        </div>
        <div id="w-100 mx-auto">
            <div id="main_content_right">
                @yield('content')
            </div>
        </div>
    </main>
    @include('frontend.layouts.footer')



    <script src="{{ asset('/public/js/bootstrap.js') }}" type="text/javascript"></script>
    
    
    <link rel="stylesheet" href="{{ asset('/public/css/fontawesome-all.min.css') }}" rel="stylesheet" >
    <!-- <link rel="stylesheet" href="{{ asset('/public/css/all.css') }}" rel="stylesheet" > -->

    
    <script src="{{ asset('/public/js/app.js') }}?v{{ time() }}" type="text/javascript"></script>

</body>
</html>
