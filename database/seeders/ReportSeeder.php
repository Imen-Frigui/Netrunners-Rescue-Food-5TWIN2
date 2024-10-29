<?php


namespace Database\Seeders;

use App\Models\Report;
use App\Models\Charity;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Fetch existing charities to associate reports with
        $charities = Charity::all();

        // Check if there are charities available
        if ($charities->isEmpty()) {
            $this->command->info('No charities found. Please run the CharitySeeder first.');
            return;
        }

        // Seed 20 reports
        foreach (range(1, 20) as $index) {
            Report::create([
                'charity_id' => $charities->random()->id, // Randomly associate with a charity
                'report_type' => $faker->randomElement(['financial', 'performance', 'event summary','Volunteer Report']),
                'content' => $faker->paragraphs(rand(1, 3), true), // Generate 1 to 3 paragraphs of content
                'report_date' => $faker->dateTimeBetween('-1 year', 'now'), // Random date within the last year
            ]);
        }
    }
}
