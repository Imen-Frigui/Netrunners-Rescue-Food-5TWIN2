<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Driver;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Driver::create([
            'user_id' => 1,  
            'vehicle_type' => 'car',
            'vehicle_plate_number' => 'ABC-123',
            'license_number' => 'XYZ123456',
            'availability_status' => 'available',
            'current_location' => json_encode(['lat' => 36.8065, 'lng' => 10.1815]),  
            'max_delivery_capacity' => 5,
            'phone_number' => '52327720',  
        ]);

        // Driver::create([
        //     'user_id' => 2, 
        //     'vehicle_type' => 'bike',
        //     'vehicle_plate_number' => 'DEF-456',
        //     'license_number' => 'ABC789123',
        //     'availability_status' => 'busy',
        //     'current_location' => json_encode(['lat' => 34.737, 'lng' => 10.208]),
        //     'max_delivery_capacity' => 3,
        //     'phone_number' => '987-654-3210',
        // ]);

        // Driver::create([
        //     'user_id' => 3,  
        //     'vehicle_type' => 'van',
        //     'vehicle_plate_number' => 'GHI-789',
        //     'license_number' => 'LMN456789',
        //     'availability_status' => 'offline',
        //     'current_location' => json_encode(['lat' => 35.676, 'lng' => 9.1816]),
        //     'max_delivery_capacity' => 10,
        //     'phone_number' => '555-123-4567',
        // ]);
        }
}
