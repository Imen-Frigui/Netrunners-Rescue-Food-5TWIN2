<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'food_id',
        'beneficiary_id',
        'donor_type',
        'donation_date',
        'quantity',
        'status',
        'remarks',
    ];

    /**
     * Relationship with Food model
     * A donation is associated with a food item.
     */
    public function food()
    {
        return $this->belongsTo(Food::class);
    }


    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class);
    }

}
