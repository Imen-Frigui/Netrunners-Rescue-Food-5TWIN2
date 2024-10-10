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

        // Example predefined real-world locations for 10 restaurants
        $locations = [
            ['name' => 'Chez Pierre', 'lat' => 48.8566, 'lng' => 2.3522, 'address' => '5 Avenue Anatole, Paris, France'],   // Paris, France
            ['name' => 'La Piazza', 'lat' => 41.9028, 'lng' => 12.4964, 'address' => 'Piazza del Colosseo, Rome, Italy'],   // Rome, Italy
            ['name' => 'Tokyo Sushi', 'lat' => 35.6762, 'lng' => 139.6503, 'address' => 'Chiyoda City, Tokyo, Japan'],      // Tokyo, Japan
            ['name' => 'Burger Queen', 'lat' => 51.5074, 'lng' => -0.1278, 'address' => 'Regent St, London, UK'],           // London, UK
            ['name' => 'Café del Sol', 'lat' => 40.4168, 'lng' => -3.7038, 'address' => 'Gran Vía, Madrid, Spain'],          // Madrid, Spain
            ['name' => 'La Casa Mexicana', 'lat' => 19.4326, 'lng' => -99.1332, 'address' => 'Zócalo, Mexico City, Mexico'], // Mexico City, Mexico
            ['name' => 'New York Deli', 'lat' => 40.7128, 'lng' => -74.0060, 'address' => 'Times Square, New York, USA'],    // New York, USA
            ['name' => 'Sydney Seafood', 'lat' => -33.8688, 'lng' => 151.2093, 'address' => 'Sydney Harbour, Sydney, Australia'], // Sydney, Australia
            ['name' => 'Rio Grill', 'lat' => -22.9068, 'lng' => -43.1729, 'address' => 'Copacabana, Rio de Janeiro, Brazil'], // Rio, Brazil
            ['name' => 'Cape Bistro', 'lat' => -33.9249, 'lng' => 18.4241, 'address' => 'V&A Waterfront, Cape Town, South Africa'], // Cape Town, South Africa
        ];

        foreach ($locations as $location) {
            Restaurant::create([
                'name' => $location['name'],
                'address' => $location['address'],
                'phone' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'latitude' => $location['lat'],
                'longitude' => $location['lng'],
            ]);
        }
    }
}
