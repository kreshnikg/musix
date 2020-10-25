<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::insert([[
            "full_name" => "Kreshnik Gashi", // 1
            "email" => "kreshnikg3@gmail.com",
            "password" => Hash::make('12345678'),
            "role_id" => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            "full_name" => "Menaxher Gashi", // 1
            "email" => "menaxher@gmail.com",
            "password" => Hash::make('12345678'),
            "role_id" => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],[
            "full_name" => "Konsumator Gashi", // 1
            "email" => "konsumator@gmail.com",
            "password" => Hash::make('12345678'),
            "role_id" => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]]);
    }
}
