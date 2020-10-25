<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    private $roles = [
        [
            "title" => "admin",
            "description" => "Admin"
        ],[
            "title" => "manager",
            "description" => "Menaxher"
        ],[
            "title" => "customer",
            "description" => "Konsumator"
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->roles as $role) {
            \App\Models\Role::create([
                "title" => $role["title"],
                "description" => $role["description"]
            ]);
        }
    }
}
