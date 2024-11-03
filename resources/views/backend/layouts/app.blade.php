<!DOCTYPE html>
<html dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <title>@yield('title')</title>

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/public/template/css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/public/web-admin/css/style.css' ) }}">
    <script src="{{asset('/public/template/js/jquery-3.3.1.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('/public/template/js/plugins/bootstrap-notify.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/public/template/js/plugins/sweetalert.min.js')}}"></script>
    
    @yield('head')
</head>
<body class="app sidebar-mini sidenav-toggled-">
    <header class="app-header">
        @include('backend.layouts.navbar')
    </header>
    
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        @include('backend.layouts.sidebar')
    </aside>
    
    <main class="app-content">
        @yield('content')
    </main>




<script src="{{asset('/public/template/js/popper.min.js')}}"></script>
<script src="{{asset('/public/template/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/public/template/js/main.js')}}"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="{{asset('/public/template/js/plugins/pace.min.js')}}"></script>


<script type="text/javascript" src="{{ asset('/public/web-admin/js/app.js') }}"></script>


@yield('javascript')



</body>
</html>