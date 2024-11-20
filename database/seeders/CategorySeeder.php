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

        $chineseSnackCategories = [
            "Đồ Ăn Vặt Trung Quốc",
            "Đồ Ngọt & Bánh Kẹo",
            "Đồ Ăn Nhanh",
            "Đồ Uống Đóng Hộp",
            "Đồ Nướng & Khô",
            "Mì & Bún Ăn Liền",
            "Hạt & Ngũ Cốc",
            "Đồ Chua & Dưa Muối",
            "Hải Sản Sấy Khô",
            "Snack Rong Biển",
            "Kẹo Dẻo & Kẹo Đắng",
            "Trà Sữa & Đồ Uống Đặc Biệt",
            "Đồ Chay Trung Quốc",
            "Trái Cây Sấy",
            "Gia Vị & Nước Chấm Trung Quốc"
        ];
        foreach($chineseSnackCategories as $sub) {
            Category::create([
                'name' => $sub,
                'slug' => Str::slug($sub),
                'parent_id' => 1,
            ]);
        }
    }
}
