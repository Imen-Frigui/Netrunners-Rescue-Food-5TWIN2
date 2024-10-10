<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PickupRequest;

class PickupRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        PickupRequest::create([
            'request_time' => now(),
            'status' => 'pending',
            'pickup_time' => now()->addHours(2),
            'pickup_address' => "Ben Arous",
            'user_id'=> 1,
            'restaurant_id'=> 1,
            'food_id'=> 1

        ]);
        PickupRequest::create([
            'request_time' => now(),
            'status' => 'approved',
            'pickup_time' => now()->addHours(1),
            'pickup_address' => "Ariana",
            'user_id'=> 1,
            'food_id'=> 1
        ]);
     }
}
