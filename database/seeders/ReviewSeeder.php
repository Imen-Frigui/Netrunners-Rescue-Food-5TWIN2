<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use Faker\Factory as Faker;

class ReviewSeeder extends Seeder
{
  
public function run(){$faker = Faker::create();

        // Seed 10 reviews
        foreach (range(1, 10) as $index) {
            Review::create([
                'user_id' => 1,                             // Always set userId to 1
                'comment' => $faker->sentence(10),       // Random comment
                'rating' => $faker->numberBetween(1, 5), // Random rating between 1 and 5
            ]);
        }
    }
}
