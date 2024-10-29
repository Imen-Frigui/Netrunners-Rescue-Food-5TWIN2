<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'charity_id',
        'report_type',
        'content',
        'report_date',
    ];

    protected $casts = [
        'report_date' => 'datetime', // Cast report_date to a Carbon instance
    ];
    public function charity()
    {
        return $this->belongsTo(Charity::class);
    }
}
