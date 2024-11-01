<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;


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
                'username'      => 'adminthanh'    ,
                'display_name'  => 'mr. thanh',
                'usr_email'         => 'support@shopkeys.co',
                'usr_password'      => bcrypt('T@#123456'),
                'role'          => [ $ad, $em, $sh ],
            ],
            [
                'username'      => 'adminhuan'    ,
                'display_name'  => 'mrs. huan',
                'usr_email'         => '',
                'usr_password'      => bcrypt('T@#123456'),
                'role'          => [ $ad, $em, $sh ],
            ],
            [
                'username'      => 'adminnhan'    ,
                'display_name'  => 'mr. nhan',
                'usr_email'         => 'ndnhan132@gmail.com',
                'usr_password'      => bcrypt('T@#123456'),
                'role'          => [ $ad, $em, $sh ],
            ],
        ];

        foreach($uArr as $u) {
            $user = new User();
            $user->username = $u['username'];
            $user->display_name = $u['display_name'];
            $user->usr_email = $u['usr_email'];
            $user->usr_password = $u['usr_password'];
            $user->save();
            $user->roles()->attach( $u['role'] );
        }
    }
}
