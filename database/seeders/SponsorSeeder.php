<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sponsor;
use App\Models\Event;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsors = [
            ['name' => 'Tech Corp', 'email' => 'info@techcorp.com', 'phone' => '123-456-7890', 'company' => 'Tech Corp Inc.'],
            ['name' => 'Eco Green', 'email' => 'contact@ecogreen.com', 'phone' => '123-555-7890', 'company' => 'Eco Green Co.'],
            ['name' => 'Global Charity', 'email' => 'support@globalcharity.org', 'phone' => '321-654-9870', 'company' => 'Global Charity Foundation'],
            ['name' => 'Food For All', 'email' => 'info@foodforall.com', 'phone' => '456-789-1234', 'company' => 'Food For All Initiative'],
        ];

        foreach ($sponsors as $sponsor) {
            $createdSponsor = Sponsor::create($sponsor);

            $events = Event::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $createdSponsor->events()->attach($events);
        }
    }
}
