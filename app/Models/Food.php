<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $fillable = [
        'food_name',
        'quantity',
        'unit',
        'expiration_date',
        'category',
        'status',
        'storage_conditions',
        'image',
        'donation_date',
    ];
     public function restaurants() {
        return $this->belongsToMany(Restaurant::class);
    }

    
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function pickupRequest() {
        return $this->belongsToMany(PickupRequest::class);
    }

 
}
