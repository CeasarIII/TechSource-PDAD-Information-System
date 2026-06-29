<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmploymentPrediction extends Model
{
    protected $table = 'employment_predictions';

    protected $guarded = [];

    protected $casts = [
        'confidence' => 'float',
        'all_probabilities' => 'array',
        'generated_at' => 'datetime',
    ];

    public function profile(): BelongsTo
    {
        return $this->belongsTo(PwdProfile::class, 'pwd_profile_id');
    }
}
