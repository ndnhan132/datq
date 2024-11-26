<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ad = Role::where('alias', 'admin')->first()->id;
        $em = Role::where('alias', 'employee')->first()->id;
        $sh = Role::where('alias', 'shipper')->first()->id;

        $uArr = [
            [
                'usr_phone'      => '0972704785'    ,
                'display_name'  => 'mr. thanh',
                'usr_email'         => 'support@shopkeys.co',
                'usr_password'      => bcrypt('T@#123456'),
                'role'          => [ $ad, $em, $sh ],
            ],
            [
                'usr_phone'      => '0838620123'    ,
                'display_name'  => 'mrs. huan',
                'usr_email'         => '',
                'usr_password'      => bcrypt('T@#123456'),
                'role'          => [ $ad, $em, $sh ],
            ],
            [
                'usr_phone'      => '0368054220'    ,
                'display_name'  => 'mr. nhan',
                'usr_email'         => 'ndnhan132@gmail.com',
                // 'usr_password'      => bcrypt('T@#123456'),
                'usr_password'      => Hash::make('N123456'),
                'role'          => [ $ad, $em, $sh ],
            ],
        ];

        foreach($uArr as $u) {
            $user = new User();
            $user->usr_phone = $u['usr_phone'];
            $user->display_name = $u['display_name'];
            $user->usr_email = $u['usr_email'];
            $user->usr_password = $u['usr_password'];
            $user->save();
            $user->roles()->attach( $u['role'] );
        }
    }
}
