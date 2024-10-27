<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use Illuminate\Support\Str;

use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Category::create([
            'name' => 'Đồ ăn Trung Quốc',
            'slug' => Str::slug('Đồ ăn Trung Quốc'),
            'parent_id' => 0,
        ]);

        $subCat = array(
            [ "name" => "Bánh kẹo Trung Quốc", "img" => "https://t0.pixhost.to/thumbs/521/525520336_449215967_790860256489570_9197507344493689214_n-jpg-_nc_cat-102-ccb-1-7-_nc_sid.jpg" ],
            [ "name" => "Hoa quả sấy khô Trung Quốc", "img" => "https://t0.pixhost.to/thumbs/521/525519506_462223601_851469183762010_3767766453107073892_n-jpg-_nc_cat-100-ccb-1-7-_nc_sid.jpg" ],
            [ "name" => "Đồ ăn vặt Trung Quốc", "img" => "https://t0.pixhost.to/thumbs/521/525518843_464109996_861749729400622_6761220115876243458_n-jpg-_nc_cat-107-ccb-1-7-_nc_sid.jpg" ],
            [ "name" => "Đồ uống Trung Quốc", "img" => "https://t0.pixhost.to/thumbs/521/525519160_463662969_859649926277269_5271070889603743850_n-jpg-_nc_cat-110-ccb-1-7-_nc_sid.jpg" ],
            [ "name" => "Mì - Miến -Cháo - Phở", "img" => "https://t0.pixhost.to/thumbs/521/525519363_463407255_859637226278539_5639381465798384414_n-jpg-_nc_cat-102-ccb-1-7-_nc_sid.jpg" ],
            [ "name" => "Thực Phẩm - Gia Vị", "img" => "https://t0.pixhost.to/thumbs/521/525520133_464243813_862424785999783_7446951595898714953_n-jpg-_nc_cat-105-ccb-1-7-_nc_sid.jpg" ],

        );
        foreach($subCat as $sub) {
            Category::create([
                'name' => $sub['name'],
                'slug' => Str::slug($sub['name']),
                'img' => $sub['img'],
                'parent_id' => 1,
            ]);
        }
    }
}
