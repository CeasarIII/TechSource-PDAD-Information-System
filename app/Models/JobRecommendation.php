<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobRecommendation extends Model
{
    protected $table = 'job_recommendations';

    protected $guarded = [];

    protected $casts = [
        'similarity_score' => 'float',
        'generated_at' => 'datetime',
    ];

    public function pwdProfile(): BelongsTo
    {
        return $this->belongsTo(PwdProfile::class, 'pwd_profile_id');
    }

    public function jobPost(): BelongsTo
    {
        return $this->belongsTo(JobPost::class, 'job_post_id');
    }
}
