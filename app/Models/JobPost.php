<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    protected $fillable = [
        'employer_id',
        'job_title',
        'job_description',
        'required_education',
        'employment_type',
        'location',
        'salary_min',
        'salary_max',
        'disability_friendly_notes',
        'application_deadline',
        'status',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}