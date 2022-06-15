<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $glenn = array(
            "email" => "glennstevencg21@gmail.com",
            "password" => bcrypt('password'),
            "points" => mt_rand(0, 1000),
            "is_verified" => 1,
            'name' => 'Glenn Steven Santoso'
        );
        User::create($glenn);
        User::factory(20)->create();


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
