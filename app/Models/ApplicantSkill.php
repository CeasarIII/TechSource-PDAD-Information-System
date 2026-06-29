<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicantSkill extends Model
{
    protected $table = 'applicant_skills';

    protected $guarded = [];

    public function profile(): BelongsTo
    {
        return $this->belongsTo(PwdProfile::class, 'pwd_profile_id');
    }
}
