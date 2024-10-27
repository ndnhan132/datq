 

<div class="col col-sm-2 ">
    <div class="my-2 p-3 main-product-item">

            <div class="w-100 mb-2 position-relative product-thumbnail">
                    <a href="" class="d-block position-relative">
                        <img src="{{ $productImg }}" alt="" srcset="" class="w-100">
                        <span class="product-discount"> -{{ $productDiscount }}% </span>
                    </a>
            </div>

            <h3 class="mb-2 product-title"><a href="">{{ $productTitle }}</a></h3>
            <div class="w-100 mb-2 product-price">
                <span class="me-1 new-price">{{ priceAfterDiscount( $productPrice, $productDiscount ) }}<sup>đ</sup> </span>
                <span class="old-price">{{ $productPrice }}<sup>đ</sup> </span>
            </div>
            <div class="w-100">
                <div>
                    <button class="btn w-100 btn-addcart add_to_cart" data-url="{{ route('cart.addToCart', $productId ) }}">
                        <i class="fa-solid fa-bag-shopping"></i> Chọn mua
                    </button>
                </div>
            </div>
    </div>
</div>


