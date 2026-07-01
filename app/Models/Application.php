<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    protected $table = 'applications';

    protected $guarded = [];

    protected $casts = [
        'applied_at' => 'datetime',
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
