<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Beneficiary;
use App\Models\User;
use Faker\Factory as Faker;

class BeneficiarySeeder extends Seeder
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
            Beneficiary::create([
                'name' => $faker->company,
                'contact_info' => $faker->phoneNumber,
                'address' => $faker->address,
                'description' => $faker->sentence,
                'type' => $faker->randomElement(['Individual', 'Organization', 'School', 'Hospital', 'Shelter', 'Community Center', 'Family']),
                'managed_by' => User::where('user_type', 'admin')->inRandomOrder()->first()->id, 
                'status' => $faker->randomElement(['Active', 'Inactive']),
                'needs' => $faker->sentence,
            ]);
        }
    }
}
