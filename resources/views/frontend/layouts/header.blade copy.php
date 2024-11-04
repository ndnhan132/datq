<?php
    $cartLists = session()->get('carts', []) ?? [];
    $cartItemCount = count( $cartLists );
?>


<header class="container-fluid px-0 bg-warning_" style="">
    <div class="container header-wrap">

        <div class="w-100 align-items-center d-flex justify-content-between">
            
            <div class="logo-site col-sm-2_" style="height: 60px;">
                <a href="{{ route('home') }}"><img src="https://img0.pixhost.to/images/521/525528261_458698285_831498462425749_2370883238388886653_n.jpg" width="190px" height="60px" alt=""></a>
            </div>
            <div class="search-site col-sm-5">
                <div class="mb-3 position-relative">
                    <input type="email" class="form-control" id="live_search_input" data-action="{{ route('home.liveSearch') }}" >
                    <div id="live_search_result" class="position-absolute bg-white ">
                        
                    </div>
                </div>
            </div>
            <div class="col-sm-4_ header-wrap-action">
                <div class="header-action d-flex justify-content-end">
                    @for ($i = 0; $i < 1; $i++)
                    <div class="ms-3 position-relative header-action-item header-action-cart">
                        <a href="{{ route('cart.showCart') }}" title="Giỏ hàng" class="d-block header-action-link show_cart_hover">
                            <span class="box-icon">
                                <img src="{{ asset('img/shopping-cart-1.png') }}" alt="">
                                <span class="cart-holder">

                                    <span class="count" id="cart_count"> {{ $cartItemCount }}</span>
                                </span>
                            </span>
                            <span class="box-text">
                                <span class="c">Giỏ hàng</span>
                            </span>
                        </a>
                        <div class="card top-cart-content" id="header_cart_detail"></div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
    @include('frontend.layouts.navbar')
</header>
<script>
    $(document).ready(function() {
        $('#live_search_result').width($('#live_search_input').outerWidth());
    });

</script>

 