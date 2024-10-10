<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Food;
use Faker\Factory as Faker;


class FoodSeeder extends Seeder
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
            Food::create([
                'food_name' => $faker->word,
                'quantity' => $faker->numberBetween(1, 100),
                'unit' => $faker->randomElement(['kg', 'liters', 'pieces']),
                'expiration_date' => $faker->dateTimeBetween('now', '+1 year'),
                'category' => $faker->randomElement(['fruit', 'vegetable', 'dairy', 'meat', 'grain', 'canned_food', 'beverage', 'baked_goods', 'seafood']),
                'status' => $faker->randomElement(['available', 'expired', 'donated']),
                'storage_conditions' => $faker->randomElement(['refrigerated', 'frozen', 'ambient', 'dry', 'humidity_controlled', 'vacuum_sealed', 'cool_dark_place']),
                'image' => $faker->imageUrl(400, 300, 'food', true), 
                'donation_date' => $faker->dateTimeBetween('-1 year', 'now'),

                // 'restaurant_id' => $faker->randomElement($restaurants),
                // 'charity_id' => $faker->randomElement($charities),
                // 'pickup_request_id' => $faker->randomElement($pickupRequests),
                // 'event_id' =>  $faker->randomElement($events),
                // 'review_id' =>  $faker->randomElement($reviews),
            ]);
        }
    }

}
