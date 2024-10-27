<div class="row content-cart-detail">
    <div class="p-3">
        <div class="cart-header text-center bg-white p-2 mb-3">
            <h4 class="m-0">Giỏ hàng của bạn</h4>
        </div>

        <div class="cart-detail-list bg-white p-2">
            
            @if($cartProducts)
            <form action="">
                <div class="cart-table">
                    @foreach($cartProducts as $product) 
                    <div class="d-flex cart-table-item cartitem{{ $product->id }}">
                        <div class="col-sm-2_ item-left">
                            <a href="" class="d-block p-2">
                                <img src="{{ $product->image_url }}" alt="" srcset="" class="" width="70">
                            </a>
                        </div>
                        <div class="col-sm-4+ item-right">
                            <div class="d-flex flex-sm-column align-self-center p-2">
                                <span>{{ $product->name }}</span>
                                <span>Đơn vị: {{ $product->unit_of_measurement }}</span>
                            </div>
                        </div>

                        <div class="col-sm-2_ item-price">
                            <div class="d-flex flex-sm-column align-self-center p-2">

                                <span class="old-price">{{ convertMoneyToStr( priceAfterDiscount( $product->price , $product->discount ) ) }} <span class="vnd">đ</span> 
                                <span class="old-price">{{ convertMoneyToStr( $product->price ) }} <span class="vnd">đ</span> </span>
                            </div>
                        </div>
                        <div class="col-sm-2_ item-right">
                            <div class="d-flex flex-sm-row align-self-center p-2">
                                <button class="qty_update" data-prd="{{ $product->id }}" data-action="minus">-</button>
                                <span class="px-2 qtycount{{ $product->id }}" >{{ $product->cartQuantity }}</span>
                                <button class="qty_update" data-prd="{{ $product->id }}" data-action="plus" >+</button>
                                
                            </div>
                        </div>
                        <div class="col-sm-2_ item-right">
                            <div class="d-flex flex-sm-row align-self-center p-2">
                                <button class="qty_update"  data-prd="{{ $product->id }}" data-action="remove" >
                                    <span>Xóa</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </form>
            @else
            <div>Giỏ hàng của bạn đang trống</div>
            @endif
        </div>
        <div >
            <label for="">Ghi chú đơn hàng</label>
            <textarea name="" id="" class="w-100 " ></textarea>
        </div>
    </div>
</div>

<div class="row"> 
    <div class="col-sm-5">
        <h3>Thông tin đơn hàng</h3>
    </div>
    <div class="col-sm-7">
        <div class="d-flex flex-column">
            <div class="d-flex justify-content-between">
                <span>Tạm tính giỏ hàng:</span>
                <span>{{ convertMoneyToStr( $subTotal ) }} <span class="vnd">đ</span></span>
            </div>
            <div class="d-flex justify-content-between">
                <span>Phí vận chuyển: </span>
                <span>0 <span class="vnd">đ</span></span>
            </div>
            <div class="d-flex justify-content-between border-bottom">
                <span>Thành tiền:</span>
                <span>{{ convertMoneyToStr( $subTotal ) }} <span class="vnd">đ</span></span>
            </div>
        </div>
    </div>
</div>


<div class="row"> 
    <div class="cart-policy">
        <small></small>
        <div>Bằng cách nhấn vào "Đặt hàng", bạn xác nhận rằng bạn đồng ý với các <a href=""> điều khoản và chính sách </a> của chúng tôi.
        </div>
    </div>
    <div class="btn-checkout">
        <button class="btn btn-danger w-100 btn_cart_order">Đặt hàng {{ convertMoneyToStr( $subTotal ) }} <span class="vnd">đ</span></button>
    </div>
</div>