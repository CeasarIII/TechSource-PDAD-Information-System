<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobSkill extends Model
{
    protected $table = 'job_skills';

    protected $guarded = [];

    public function jobPost(): BelongsTo
    {
        return $this->belongsTo(JobPost::class, 'job_post_id');
    }
}
