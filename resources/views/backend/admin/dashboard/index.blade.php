
@extends('backend.layouts.app')
@section('title', 'xxx')
@section('head')
@endsection
@section('content')

@endsection
@section('javascript')
  <!-- Page specific javascripts-->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

    <script type="text/javascript" src="{{asset('/public/web-admin/js/dashboard.js?s=') . time() }}"></script>
@endsection
