<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Driver extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'vehicle_type',
        'vehicle_plate_number',
        'license_number',
        'availability_status',
        'current_location',
        'max_delivery_capacity',
        'phone_number'
    ];

    protected $casts = [
        'current_location' => 'array',
        'is_available' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pickupRequests(): HasMany
    {
        return $this->hasMany(PickupRequest::class);
    }
}
