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
        'max_participants',
        'restaurant_id',
        'charity_id'
    ];

    protected $casts = [
        'event_date' => 'datetime',
    ];

    public function restaurant() {
        return $this->belongsTo(Restaurant::class);
    }

    public function charity() {
        return $this->belongsTo(Charity::class);
    }

    public function volunteers() {
        return $this->belongsToMany(User::class, 'event_volunteers')->withTimestamps();
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
    


}
