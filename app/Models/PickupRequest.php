<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupRequest extends Model
{
    use HasFactory;
    protected $table = 'pickup_requests';


    protected $fillable = [
        'user_id',
        'restaurant_id',
        'pickup_time',
        'status',
        'pickup_address', 
        'food_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function restaurant()
    // {
    //     return $this->belongsTo(Restaurant::class);
    // }
}
