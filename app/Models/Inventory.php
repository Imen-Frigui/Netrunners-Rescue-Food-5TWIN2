<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'food_id',
        'restaurant_id',
        'quantity_on_hand',
        'minimum_quantity',
        'last_updated',
        'storage_location',
    ];

    /**
     * Relationship with Food model.
     */
    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    /**
     * Relationship with Restaurant model.
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
