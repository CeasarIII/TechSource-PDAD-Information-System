<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobPost extends Model
{
    protected $table = 'job_posts';

    protected $guarded = [];

    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }

    public function skills(): HasMany
    {
        return $this->hasMany(JobSkill::class, 'job_post_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'job_post_id');
    }

    public function recommendations()
    {
        return $this->hasMany(JobRecommendation::class, 'job_post_id');
    }
}
