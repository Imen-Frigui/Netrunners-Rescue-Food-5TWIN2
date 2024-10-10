<?php

namespace Database\Seeders;
use App\Models\Charity;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Restaurant;
use App\Models\User;

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
        

        // Seed 10 events
        foreach (range(1, 10) as $index) {
            Charity::create([
                'charity_name' => $faker->company,
                'address' => $faker->address,
                'contact_info' => json_encode([
                    'phone' => $faker->phoneNumber,
                    'email' => $faker->companyEmail
                ]),
                'charity_type' => $faker->randomElement(['food_bank', 'shelter', 'soup_kitchen']),
                'beneficiaries_count' => $faker->numberBetween(50, 1000),
                'preferred_food_types' => json_encode($faker->randomElements([
                    'Grains', 'Canned Goods', 'Vegetables', 'Dairy', 'Fruits', 'Meat'
                ], 3)),
                'request_history' => json_encode([
                    ['item' => $faker->word, 'quantity' => $faker->numberBetween(50, 200)],
                    ['item' => $faker->word, 'quantity' => $faker->numberBetween(50, 200)]
                ]),
                'inventory_status' => json_encode([
                    ['item' => $faker->word, 'quantity' => $faker->numberBetween(50, 200)],
                    ['item' => $faker->word, 'quantity' => $faker->numberBetween(50, 200)]
                ]),
                'last_received_donation' => $faker->dateTimeBetween('-1 year', 'now'),
                'donation_frequency' => $faker->numberBetween(1, 10),
                'assigned_drivers_volunteers' => json_encode($faker->randomElements([
                    'Driver 1', 'Driver 2', 'Volunteer A', 'Volunteer B'
                ], 2)),
                'current_requests' => json_encode([
                    ['item' => $faker->word, 'quantity' => $faker->numberBetween(10, 50)]
                ]),
                'charity_rating' => $faker->randomFloat(2, 1, 5), // Rating between 1.00 and 5.00
                'charity_approval_status' => $faker->randomElement(['approved', 'pending', 'rejected']),
          
                // 'donation_id' => $faker->randomElement($donations),
               
            ]);
        }
}
}
