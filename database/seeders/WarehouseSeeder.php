<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Warehouse;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $rolesArr = [
            ['name' => 'Bắc Giang'    , 'location' => 'Bắc Giang'],
            ['name' => 'Bắc Ninh'    , 'location' => 'Tp Bắc Ninh'],
        ];

        foreach($rolesArr as $rul) {
            Warehouse::create([
                'name' => $rul['name'],
                'location' => $rul['location'],
            ]);
        }
    }
}
