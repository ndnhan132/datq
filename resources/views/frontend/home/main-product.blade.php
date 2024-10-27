@foreach ($chinaCategories as $cat)
    <?php $products = $cat->products->take(12); ?>
<section class="bg-white product_main mb-4 home-box-section  ">
    <div class="w-100">
        <div class="d-flex justify-content-between align-items-center">
            <h2>{{ $cat->name }}</h2>
        </div>
        <div class="row">
            @foreach ($products as $prd)


                    @include('frontend.layouts.product-card', ['productTitle' => $prd->name, 'productImg' => $prd->image_url, 'productPrice' => $prd->price, 'productDiscount'=>$prd->discount , 'productId' => $prd->id, 'slug' => $prd->slug, 'description' => $prd->description])

            @endforeach
            
        </div>
        <div class="col-12 text-center my-3  product-more">
            <a href="" class="btn rounded-pill ">Xem thêm {{ $cat->products->count() }} sản phẩm <b>{{ $cat->name }}</b> <i class="fa-solid fa-chevron-right"></i></a>
        </div>
    </div>
</section>
    

@endforeach