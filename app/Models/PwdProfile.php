<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PwdProfile extends Model
{
    protected $table = 'pwd_profiles';

    protected $guarded = [];

    protected $casts = [
        'birthdate' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function skills(): HasMany
    {
        return $this->hasMany(ApplicantSkill::class);
    }

    public function registryReference(): BelongsTo
    {
        return $this->belongsTo(PwdRegistryReference::class, 'pwd_registry_id');
    }

    public function employmentPrediction()
    {
        return $this->hasOne(EmploymentPrediction::class, 'pwd_profile_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'pwd_profile_id');
    }

    public function jobRecommendations()
    {
        return $this->hasMany(JobRecommendation::class, 'pwd_profile_id');
    }
}
