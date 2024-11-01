<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rolesArr = [
            ['name' => 'Quản lý'    , 'alias' => 'admin'],
            ['name' => 'Nhân Viên'  , 'alias' => 'employee'],
            ['name' => 'Shipper'    , 'alias' => 'shipper'],
        ];

        foreach($rolesArr as $rul) {
            Role::create([
                'name' => $rul['name'],
                'alias' => $rul['alias'],
                'slug' => Str::slug($rul['name']),
            ]);
        }
    }
}
