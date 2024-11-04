<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description' ,
        'location',
        'event_date',
        'published_at',
        'enabled',
        'max_participants',
        'restaurant_id',
        'charity_id'
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'published_at' => 'datetime',
    ];

    public function restaurant() {
        return $this->belongsTo(Restaurant::class);
    }

    public function charity() {
        return $this->belongsTo(Charity::class);
    }


    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function scopeUpcoming($query) {
        return $query->where('event_date', '>', now());
    }
    
    public function scopeWithAvailableSpots($query) {
        return $query->whereColumn('max_participants', '>', 'volunteers_count');
    }
    

    public function getStatusAttribute()
    {
        if ($this->event_date->isFuture()) {
            return 'Upcoming';
        } elseif ($this->event_date->isToday()) {
            return 'Ongoing';
        } else {
            return 'Completed';
        }
    }

    public function sponsors()
    {
        return $this->belongsToMany(Sponsor::class, 'event_sponsors')->withPivot('sponsorship_level', 'sponsorship_amount');
    }

}
