<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Donation;
use App\Models\Food;
use App\Models\Beneficiary;
use Faker\Factory as Faker;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        
        foreach (range(1, 10) as $index) {
            Donation::create([
                'food_id' => Food::inRandomOrder()->first()->id,
                'beneficiary_id' => Beneficiary::inRandomOrder()->first()->id, 
                'donor_type' => $faker->randomElement(['Restaurant', 'Individual', 'Charity']),
                'donation_date' => $faker->dateTimeBetween('-1 year', 'now'),
                'quantity' => $faker->numberBetween(1, 100),
                'status' => $faker->randomElement(['Pending', 'Approved', 'Completed', 'Canceled']),
                'remarks' => $faker->sentence,
            ]);
        }
    }
}
