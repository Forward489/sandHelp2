<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Donation;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $glenn = [];

        $glenn = array(
            "email" => "glennstevencg21@gmail.com",
            "password" => bcrypt('password'),
            "points" => mt_rand(0, 2000),
            "is_verified" => 1,
            'name' => 'Glenn Steven Santoso '
        );
        // for ($i = 1; $i < 21; $i++) {
        //     $glenn[] = [
        //         "email" => "glennstevencg21@gmail.com",
        //         "password" => bcrypt('password'),
        //         "points" => mt_rand(0, 2000),
        //         "is_verified" => 1,
        //         'name' => 'Glenn Steven Santoso '.$i
        //     ];
        // }

        // for ($i = 0; $i < 1; $i++) {
        //     User::create($glenn[$i]);
        // }
        // User::factory(20)->create();
        User::create($glenn);
        User::factory(5)->create();
        Donation::factory(5)->create();
        // User::factory(13)->create();


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
