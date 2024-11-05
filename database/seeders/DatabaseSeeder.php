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
                'password' => ('secret'),
                'user_type' => 'admin',
            ]);
        }

        $this->call(FoodSeeder::class);
        $this->call(RestaurantSeeder::class);
        $this->call(EventSeeder::class);
        $this->call(ReviewSeeder::class);
        $this->call(PickupRequestSeeder::class);
        $this->call(CharitySeeder::class);
        $this->call(ReportSeeder::class);
        $this->call(SponsorSeeder::class);
        $this->call(DriverSeeder::class);
        $this->call(BeneficiarySeeder::class);
        $this->call(DonationSeeder::class);

    }
}
