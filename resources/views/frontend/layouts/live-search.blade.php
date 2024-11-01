<div class="p-0 m-0" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.08);">
 

    @foreach ($searchProducts as $product)
    <div class="w-100" >
        <a href="" class="d-flex flex-wrap search-result-item border-bottom">
            <div class=" search-item-thumb ">
                <img src="{{ $product->image_url }}" alt="" >
            </div>
            <div class=" search-item-info">
                <div class="search-item-price ">
                    {{ convertMoneyToStr(priceAfterDiscount($product->price, $product->discount)) }}<span class="vnd">đ</span>
                </div>
                <h2 class="text-truncate  search-item-title">{{ $product->name }}</h2>
            </div>

            

        </a>
    </div>
    @endforeach
    <div class="w-100" >
        <a href="" class="d-block pt-2 py-3">
            <div class="search-view-more fw-bold text-center">
                Xem thêm 55 sản phẩm
            </div>
        </a>
    </div>
</div>