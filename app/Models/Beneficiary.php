<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',            
        'contact_info',     
        'address',         
        'description',      
        'type',            
        'managed_by',      
        'status',          
        'needs',           
    ];

    /**
     * A beneficiary can have multiple donations.
     */
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    /**
     * A beneficiary is managed by one admin (user).
     */
    public function managedBy()
    {
        return $this->belongsTo(User::class, 'managed_by');
    }
}
