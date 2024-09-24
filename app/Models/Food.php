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
        'restaurant_id',
        'charity_id',
        'pickup_request_id',
        'event_id',
        'review_id'
    ];


     // public function restaurant() {
    //     return $this->belongsTo(Restaurant::class);
    // }

    // public function charity() {
    //     return $this->belongsTo(Charity::class);
    // }

    // public function pickupRequest() {
    //     return $this->belongsTo(PickupRequest::class);
    // }

    // public function event() {
    //     return $this->belongsTo(Event::class);
    // }

    // public function reviews() {
    //     return $this->hasMany(Review::class);
    // }
}
