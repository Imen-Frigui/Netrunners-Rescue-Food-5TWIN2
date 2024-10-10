<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charity extends Model
{
    use HasFactory;

    protected $fillable = [
        'charity_name',
        'address',
        'contact_info',
        'charity_type',
        'beneficiaries_count',
        'preferred_food_types',
        'request_history',
        'inventory_status',
        'last_received_donation',
        'donation_frequency',
        'assigned_drivers_volunteers',
        'current_requests',
        'charity_rating',
        'charity_approval_status',
    ];

    protected $casts = [
        'contact_info' => 'array',  // Ensure contact_info is cast as an array
        'preferred_food_types' => 'array',
        'request_history' => 'array',
        'inventory_status' => 'array',
        'assigned_drivers_volunteers' => 'array',
        'current_requests' => 'array',
        'last_received_donation' => 'datetime',
    ];
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function events(){
        return $this->hasMany(Event::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }


    public function pickupRequests(){
        return $this->hasMany(PickupRequest::class);
    }

   
}
