<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'pwd_profile_id',
        'job_post_id',
        'status',
        'applicant_message',
        'employer_notes',
        'applied_at',
        'status_updated_at',
    ];

    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }

    public function profile()
    {
        return $this->belongsTo(PwdProfile::class,'pwd_profile_id');
    }
}