<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Sponsor extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_sponsor')->withPivot('sponsorship_level', 'sponsorship_amount');
    }

}
