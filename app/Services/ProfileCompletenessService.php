<?php

namespace App\Services;

use App\Models\PwdProfile;

class ProfileCompletenessService
{
    public function compute(PwdProfile $profile): int
    {
        $score = 0;

        if (!empty($profile->registry_reference_id)) {
            $score += 30;
        }

        if (!empty($profile->contact_number)) {
            $score += 20;
        }

        if (!empty($profile->education)) {
            $score += 20;
        }

        if (!empty($profile->experience)) {
            $score += 15;
        }

        if ($profile->skills()->count() > 0) {
            $score += 15;
        }

        return min($score, 100);
    }
}
