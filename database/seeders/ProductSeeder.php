<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use Faker\Factory as Faker;
use Illuminate\Support\Str;

use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $pics = array(
            'https://img0.pixhost.to/images/521/525528174_456876615_824839953091600_373058502065527620_n.jpg',
            'https://img0.pixhost.to/images/521/525528177_457047077_824839913091604_6827878816774069451_n.jpg',
            'https://img0.pixhost.to/images/521/525528179_457059170_824839919758270_5898781625934178877_n.jpg',
            'https://img0.pixhost.to/images/521/525528180_457068761_824687836440145_5153308503659329236_n.jpg',
            'https://img0.pixhost.to/images/521/525528183_457108245_826108286298100_7371170443229932204_n.jpg',
            'https://img0.pixhost.to/images/521/525528185_457148590_824839943091601_1281692990382803537_n.jpg',
            'https://img0.pixhost.to/images/521/525528187_457182655_826108169631445_6418378971016449353_n.jpg',
            'https://img0.pixhost.to/images/521/525528191_457194974_824686073106988_1303631752550717492_n.jpg',
            'https://img0.pixhost.to/images/521/525528193_457202403_826108212964774_4518324890258408962_n.jpg',
            'https://img0.pixhost.to/images/521/525528196_457252339_826111246297804_1482584269579508541_n.jpg',
            'https://img0.pixhost.to/images/521/525528199_457255007_826109886297940_1643475204889526506_n.jpg',
            'https://img0.pixhost.to/images/521/525528200_457256609_826109976297931_16234402938316223_n.jpg',
            'https://img0.pixhost.to/images/521/525528201_457259507_826109889631273_1344423200547187778_n.jpg',

        );
        $unit_of_measurement = ['gói', 'thùng', 'chai', 'lon', ];
        $faker = Faker::create();

        foreach ($pics as $pic) {
            $randomKey = array_rand($unit_of_measurement);
            $tt = $faker->sentence($nbWords = 10, $variableNbWords = true);
            $product = Product::create([
                'name' => $tt,
                'slug' => Str::slug($tt), 
                'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'price' => rand(1 , 100) * 1000,
                'cost_price' => rand(1 , 100) * 500,
                'discount' => rand(0 , 7) * 5,
                'quantity' => rand(50, 500),
                'unit_of_measurement' => $unit_of_measurement[$randomKey],
            ]);
            $product->categories()->attach( rand( 1,2 ) );
        }
    }
}
