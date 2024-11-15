@php
$cats = [
    [
        'name' => 'Rau, củ, nấm, trái cây',
        'image' => 'https://cdn.tgdd.vn/bachhoaxanh/menuheader/-202401091450502576.png'
    ],
    [
        'name' => 'Thịt heo',
        'image' => 'https://cdn.tgdd.vn/bachhoaxanh/menuheader/-202401091450387273.png'
    ],
    [
        'name' => 'Gạo các loại',
        'image' => 'https://cdnv2.tgdd.vn/bhx-static/bhx/menuheader/icon-cate-gao-1_202409162319347446.png'
    ],
    [
        'name' => 'Rau lá',
        'image' => 'https://cdn.tgdd.vn/Products/Images/8820/bhx/rau-la-cac-loai-202210311314254141.png'
    ],
    [
        'name' => 'Trái cây',
        'image' => 'https://cdn.tgdd.vn/Products/Images/8788/bhx/trai-cay-cac-loai-202210311314516525.png'
    ],
    [
        'name' => 'Củ, quả',
        'image' => 'https://cdn.tgdd.vn/Products/Images/8785/bhx/rau-cu-cac-loai-202209301506432108.png'
    ],
    [
        'name' => 'Mì ăn liền',
        'image' => 'https://cdnv2.tgdd.vn/bhx-static/bhx/Category/Images/2565/image-522_202410101609480522.png'
    ],
    [
        'name' => 'Cá, hải sản, khô',
        'image' => 'https://cdn.tgdd.vn/Products/Images/8782/bhx/ca-hai-san-202209301439213205.png'
    ],
    [
        'name' => 'Thịt gà, vịt, chim',
        'image' => 'https://cdn.tgdd.vn/Products/Images/8790/bhx/thit-ga-thit-vit-202212051413239059.png'
    ],
    [
        'name' => 'Trứng gà, vịt, cút',
        'image' => 'https://cdn.tgdd.vn/Products/Images/8783/bhx/trung-ga-vit-cut-202212051414238645.png'
    ],
    [
        'name' => 'Snack, rong biển',
        'image' => 'https://cdnv2.tgdd.vn/bhx-static/bhx/Category/Images/3364/274029_202410110841279313.png'
    ]
];



@endphp

<div class="min-h-[114px] rounded-4px bg-white px-6px pb-4px pt-[8px] top-cate">
    <div class="flex flex-wrap">
        <div class="w-[calc(100%/12)]"><a href="/dang-nhap"
                class="flex cursor-pointer flex-col items-center justify-start px-4px hover:bg-[#F0FFF3]">
                <div class="relative inline-block mx-auto mb-2px" style="width: 60px; height: 60px;"><img
                        alt="Mua lại đơn cũ" fetchpriority="high" width="0" height="0" decoding="async" data-nimg="1"
                        class="opacity-100"
                        src="https://cdn.tgdd.vn/bachhoaxanh/www/Content/images/icon-history.v202301091407.png"
                        style="color: transparent; width: 100%; height: auto;"></div>
                <div class="mb-[8px] line-clamp-2 text-center text-13 font-bold leading-[16px] text-[#007E42]">Mua lại
                    đơn cũ</div>
            </a></div>


        @foreach($cats as $value)

        <div class="w-[calc(100%/12)]">
            <a class="cate_name flex flex-col items-center justify-start" href="#">
                <div class="relative inline-block mx-auto image-container" >
                    <img
                        alt="Thịt heo" fetchpriority="high" width="0" height="0" decoding="async" data-nimg="1"
                        class="category-image"
                        src="{{ $value['image'] }}" />
                </div>
                <div class="flex items-center name-container">
                    <div class="line-clamp-2 text-center text-13 leading-[16px] category-name">
                        {{ $value['name'] }}
                    </div>
                </div>
            </a>
        </div>

        


        @endforeach



    </div>
</div>
 