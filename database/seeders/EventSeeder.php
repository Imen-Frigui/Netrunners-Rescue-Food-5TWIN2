<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        
        // $restaurants = Restaurant::pluck('id')->toArray();
        // $charities = Charity::pluck('id')->toArray();

        // Seed 10 events
        foreach (range(1, 10) as $index) {
            Event::create([
                'name' => $faker->sentence(3),
                'description' => $faker->paragraph,
                'location' => $faker->address,
                'event_date' => $faker->dateTimeBetween('now', '+1 year'),
                'max_participants' => $faker->numberBetween(5, 50),
                // 'restaurant_id' => $faker->randomElement($restaurants),
                // 'charity_id' => $faker->randomElement($charities),
            ]);
        }
    }
}
