<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use Faker\Factory as Faker;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Seed 10 restaurants
        foreach (range(1, 10) as $index) {
            Restaurant::create([
                'name' => $faker->company,              // Random company name
                'address' => $faker->address,           // Random address
                'phone' => $faker->phoneNumber,         // Random phone number
                'email' => $faker->unique()->safeEmail, // Unique random email
            ]);
        }
    }
}
