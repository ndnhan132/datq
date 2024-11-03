@extends('backend.layouts.app')
@section('title', 'xxx')
@section('head')
@endsection
@section('content')

<div class="app-title">
    <div>
        <h1><i class="fa fa-edit"></i> Form Samples</h1>
        <p>Sample forms</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">

    </ul>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="tile">
            <h3 class="tile-title">Table Hover</h3>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $products as $product )
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->cost_price }}</td>
                        <td>{{ $product->discount }}</td>
                        <td>{{ $product->discount }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="clearix"></div>
</div>

@endsection
@section('javascript')
<script>
    jQuery(document).ready(function () {

    });
</script>
@endsection