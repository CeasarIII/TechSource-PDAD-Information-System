<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = [
        'training_name',
        'description',
        'provider',
        'location',
        'start_date',
        'end_date',
        'duration_hours',
        'mode',
        'is_free',
        'cost',
        'target_disability_types',
        'status',
    ];
}