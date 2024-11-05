<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_sponsors')->withPivot('sponsorship_level', 'sponsorship_amount');
    }

}