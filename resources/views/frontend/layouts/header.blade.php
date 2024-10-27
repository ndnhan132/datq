<?php
    $cartLists = session()->get('carts', []) ?? [];
    $cartItemCount = count( $cartLists );
?>


<div class="w-100 header-wrap">

    <header class="container bg-warning_" style="">
        <div class="row align-items-center d-flex">
            
            <div class="logo-site col-sm-2 border" style="height: 60px;"></div>
            <div class="search-site col-sm-6">
                <form>
                    <div class="mb-3">
                      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                  </form>
            </div>
            <div class="col-sm-4 header-wrap-action">
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
    </header>
</div>