<ul class="list-item-cart">
    @foreach ($cartProducts as $cartItem)
    <li class="cart-item">
        <div class="d-flex">
            <div class="cart-item-img">
                <a href="" class="p-1">
                    <img src="{{ $cartItem->image_url }}" alt="" width="50" height="50">
                </a>
            </div>
            <div class="cart-item-detail">
                <div>{{ $cartItem->name }}</div>
                <div class="text-danger">{{ convertMoneyToStr(priceAfterDiscount( $cartItem->price , $cartItem->discount) ) }} đ x {{ $cartItem->cartQuantity }}</div>
            </div>
        </div>
        
    
    </li>
    @endforeach
</ul>
<div class="total-amount-after-discount">Tổng tiền tạm tính: <span>{{ convertMoneyToStr($totalAmountAfterDiscount) }} đ</span></div>
<div class="d-flex justify-content-between">
    <div>Có tổng số {{ $cartProducts->count() }} sản phẩm </div>
    <div><a href="{{ route('cart.showCart') }}" class="btn btn-sm btn-success" >Thanh toán ngay</a></div>
</div>