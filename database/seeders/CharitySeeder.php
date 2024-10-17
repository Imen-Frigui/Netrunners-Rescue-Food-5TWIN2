<?php

namespace Database\Seeders;

use App\Models\Charity;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CharitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Seed 10 charities
        foreach (range(1, 10) as $index) {
            Charity::create([
                'charity_name' => $faker->company,
                'address' => $faker->address,

                // Store contact_info as a string (e.g., "phone: xxx, email: xxx")
     // Store contact_info as an associative array (will be handled as JSON)
     'contact_info' => [
        'phone' => $faker->phoneNumber,
        'email' => $faker->companyEmail,
    ],
                'charity_type' => $faker->randomElement(['food_bank', 'shelter', 'soup_kitchen']),
                'beneficiaries_count' => $faker->numberBetween(50, 1000),

                // Store preferred_food_types as a comma-separated string
                'preferred_food_types' => implode(',', $faker->randomElements([
                    'Grains', 'Canned Goods', 'Vegetables', 'Dairy', 'Fruits', 'Meat'
                ], 3)),

                // Store request_history as a comma-separated string (e.g., "item1: x, item2: y")
                'request_history' => implode(', ', [
                    $faker->word . ': ' . $faker->numberBetween(50, 200),
                    $faker->word . ': ' . $faker->numberBetween(50, 200)
                ]),

                // Store inventory_status as a comma-separated string (e.g., "item1: x, item2: y")
                'inventory_status' => implode(', ', [
                    $faker->word . ': ' . $faker->numberBetween(50, 200),
                    $faker->word . ': ' . $faker->numberBetween(50, 200)
                ]),

                'last_received_donation' => $faker->dateTimeBetween('-1 year', 'now'),
                'donation_frequency' => $faker->numberBetween(1, 10),

                // Store assigned_drivers_volunteers as a comma-separated string
                'assigned_drivers_volunteers' => implode(',', $faker->randomElements([
                    'Driver 1', 'Driver 2', 'Volunteer A', 'Volunteer B'
                ], 2)),

                // Store current_requests as a comma-separated string (e.g., "item: quantity")
                'current_requests' => $faker->word . ': ' . $faker->numberBetween(10, 50),

                'charity_rating' => $faker->randomFloat(2, 1, 5), // Rating between 1.00 and 5.00
                'charity_approval_status' => $faker->randomElement(['approved', 'pending', 'rejected']),
            ]);
        }
    }
}
