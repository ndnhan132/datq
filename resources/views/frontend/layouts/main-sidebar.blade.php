@php
$cats = [
'Thịt, cá, trứng, hải sản',
'Rau, củ, nấm, trái cây',
'Dầu ăn, nước chấm, gia vị',
'Mì, miến, cháo, phở',
'Kem, thực phẩm đông mát',
'Gạo, bột, đồ khô',
'Bia, nước giải khát',
'Sữa các loại',
'Bánh kẹo các loại',
'Chăm sóc cá nhân',
'Sản phẩm cho mẹ và bé',
'Vệ sinh nhà cửa',
'Đồ dùng gia đình',
];

@endphp

<!-- mian sidebar menu -->

<div class="menu-desktop bg-white fixed sidebar "
    style="scrollbar-gutter: stable;">

    <div class="relative">

        <div class="flex items-center sidebar__itemwrap menu-discount">
            <span class="flex items-center item_discount menutext">
                <i class="icon__discount scale-125"></i>
                <span style="margin-left: 6px;">Khuyến mãi sốc</span>
            </span>
        </div>
        
        @foreach($cats as $c)
        <div class="relative cate_parent absolute_ sidebar__itemwrap">
            <div class="flex after:rotate-[225deg] itembox">
                <a href="#" class="flex flex-col itemlink">
                    <span class="flex items-center cate-name">{{ $c }}</span>
                </a>
            </div>
        </div>
        @endforeach

        <div>
            <a class="flex items-center sidebar__itemwrap menu-storesys" href="/he-thong-sieu-thi" >
                <span class="flex items-center menutext" >
                    <div class="relative inline-block mr-1" style="width: 20px; height: 20px;">
                        <img alt="" loading="lazy" width="0" height="0" class="" src="{{ asset('/public/img/menu_store.svg') }}" >
                    </div> Xem 1.736 cửa hàng
                </span>
            </a>
        </div>

    </div>

</div>

<!-- mian sidebar menu -->