<?php

namespace Database\Seeders;

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
        if (!User::where('email', 'admin@material.com')->exists()) {
            User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@material.com',
                'password' => ('secret')
            ]);
        }

        $this->call(FoodSeeder::class);
        $this->call(RestaurantSeeder::class);
        $this->call(EventSeeder::class);
        $this->call(ReviewSeeder::class);

    }
}
