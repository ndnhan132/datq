@extends('frontend.layouts.app')

@section('title', 'Tan hong food')

@section('content')
<div class="bg-main homepage"
style="padding-left: calc( var(--leftbar-width) + 10px );flex: 1 1 0%;
">
    <main id="main-layout">
        <div class="ml-auto bg-main">
            @include('frontend.home.top-category');

        </div>
    
    </main>
       
    <footer>
        
    </footer>
    
</div>
@endsection
