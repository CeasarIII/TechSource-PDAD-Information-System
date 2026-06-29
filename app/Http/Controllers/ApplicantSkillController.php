<?php

namespace App\Http\Controllers;

use App\Models\ApplicantSkill;
use App\Services\ProfileCompletenessService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicantSkillController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'skill_name' => 'required|string|max:100',
            'proficiency_level' => 'nullable|in:Beginner,Intermediate,Advanced,Expert',
        ]);

        $profile = Auth::user()->pwdProfile;

        if (!$profile) {
            return back()->withErrors([
                'profile' => 'Complete your profile first.',
            ]);
        }

        ApplicantSkill::create([
            'pwd_profile_id' => $profile->id,
            'skill_name' => $validated['skill_name'],
            'proficiency_level' => $validated['proficiency_level'] ?? 'Intermediate',
        ]);

        $profile->update([
            'profile_completed' => app(ProfileCompletenessService::class)->compute($profile) >= 80,
        ]);

        return back()->with('success', 'Skill added.');
    }

    public function destroy(ApplicantSkill $skill)
    {
        if ($skill->profile->user_id !== Auth::id()) {
            abort(403);
        }

        $profile = $skill->profile;

        $skill->delete();

        $profile->update([
            'profile_completed' => app(ProfileCompletenessService::class)->compute($profile) >= 80,
        ]);

        return back()->with('success', 'Skill removed.');
    }
}
