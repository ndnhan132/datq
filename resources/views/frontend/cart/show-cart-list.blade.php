<div class="content-cart-detail">
    <div class="white-wrapbox  cart-header ">
        <div class="d-flex">
            <div class="text-center w-100 d-flex align-items-center justify-content-center ">
                <h2>Đơn hàng</h2>
            </div>
        </div>
    </div>

    @if(isset($cartProducts) && $cartProducts->count()>0 )
    <div class="white-wrapbox cart-detail-list">
        <div class="cart-table px-3">
            @foreach($cartProducts as $product) 
            <div class="d-flex cart-table-item cartitem{{ $product->id }}  position-relative">
                

                <button class="rounded-pill border-0- bg-danger text-white qty_update"  data-prd="{{ $product->id }}" data-action="remove" style="position: absolute;width: 25px; height: 25px;top: -0.15rem;left: -0.25rem;justify-content: center;align-items: center; border: 2px solid #fff;">
                    <i class="fa-solid fa-xmark"></i>
                </button>

                <div class="col-sm-2_ item-left">
                    <a href="" class="d-block p-2">
                        <img src="{{ $product->image_url }}" alt="" srcset="" class="" width="70">
                    </a>
                </div>
                <div class="d-flex  item-right">
                    <div class="d-flex flex-sm-column align-self-center p-2">
                        <span>{{ $product->name }}</span>
                        <span>Đơn vị: {{ $product->unit_of_measurement }}</span>
                    </div>
                </div>

                <div class="d-flex item-price">
                    <div class="d-flex flex-sm-column align-self-center p-2">

                        <span class="new-price">{{ convertMoneyToStr( priceAfterDiscount( $product->price , $product->discount ) ) }}<span class="vnd">đ</span>
                        </span>
                        <span class="old-price">{{ convertMoneyToStr( $product->price ) }}<span class="vnd">đ</span> </span>
                    </div>
                </div>
                <div class="d-flex  item-right">
                    <div class="d-flex flex-sm-row align-self-center px-2 py-0  bg-light rounded-pill" style="border: 2px solid #2199c4;">
                        <button class="btn btn-sm  text-danger fw-bold  qty_update" data-prd="{{ $product->id }}" data-action="minus">-</button>
                        <div class="text-center w-100 d-flex align-items-center justify-content-center text-danger fw-bold">
                            <span class="px-2 qtycount{{ $product->id }}" >{{ $product->cartQuantity }}</span>
                        </div>
                        <button class="btn btn-sm text-danger fw-bold qty_update" data-prd="{{ $product->id }}" data-action="plus" >+</button>
                        
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="white-wrapbox d-flex">
        <div class="col-sm-7 ms-auto row-total-amount">
            @include('frontend.cart.row-total-amount')
        </div>
    </div>
    <div class="white-wrapbox btn-checkout">
        <button class="btn btn-danger w-100 btn_cart_order my-2 fw-bold py-2">Đặt hàng {{ convertMoneyToStr( $totalAmountAfterDiscount ) }} <span class="vnd">đ</span></button>
        <script>
            jQuery(document).ready(function() {
                $('.btn_cart_order').on('click', function() {
                    if($('#cart_detail_content')){
                        $('#cart_detail_content').load("/cart/show-cart-order");
                    }
                } );
            });
        </script>
    </div>
    @else
    <div class="white-wrapbox">Giỏ hàng của bạn đang trống</div>
    @endif


</div>