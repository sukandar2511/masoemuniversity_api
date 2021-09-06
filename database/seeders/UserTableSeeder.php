<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id'        => '1',
            'email'     => 'sukandar2511@gmail.com',
            // 'nik'       => '25111996',
            // 'no_telepon'=> '082214014089',
            'password'  => Hash::make('admin'),
            'name'      => 'Sukandar',
            'id_role'   => 1,
            'level'     => 'admin'
        ]);
    }
}
