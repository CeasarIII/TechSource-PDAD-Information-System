<?php

namespace App\Http\Controllers;

use App\Models\PwdProfile;
use App\Models\PwdRegistryReference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PwdProfileController extends Controller
{
    public function create()
    {
        $profile = Auth::user()->pwdProfile;

        if ($profile) {
            return redirect()->route('pwd.profile.edit', $profile->id);
        }

        $registryReferences = PwdRegistryReference::all();

        return view('pwd.profile.create', compact('registryReferences'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'registry_reference_id' => 'required|exists:pwd_registry_reference,id',
            'contact_number' => 'nullable|string|max:30',
            'education' => 'nullable|string|max:255',
            'experience' => 'nullable|string',
            'resume_path' => 'nullable|string|max:255',
            'portfolio_path' => 'nullable|string|max:255',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['profile_completed'] = $this->computeCompleteness($validated);

        PwdProfile::create($validated);

        return redirect('/pwd/dashboard')->with('success', 'Profile saved successfully.');
    }

    public function edit(PwdProfile $profile)
    {
        if ($profile->user_id !== Auth::id()) {
            abort(403);
        }

        $registryReferences = PwdRegistryReference::all();

        return view('pwd.profile.edit', compact('profile', 'registryReferences'));
    }

    public function update(Request $request, PwdProfile $profile)
    {
        if ($profile->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'registry_reference_id' => 'required|exists:pwd_registry_reference,id',
            'contact_number' => 'nullable|string|max:30',
            'education' => 'nullable|string|max:255',
            'experience' => 'nullable|string',
            'resume_path' => 'nullable|string|max:255',
            'portfolio_path' => 'nullable|string|max:255',
        ]);

        $validated['profile_completed'] = $this->computeCompleteness($validated);

        $profile->update($validated);

        return redirect('/pwd/dashboard')->with('success', 'Profile updated successfully.');
    }

    private function computeCompleteness(array $data): int
    {
        $requiredFields = [
            'registry_reference_id',
            'contact_number',
            'education',
            'experience',
        ];

        $filled = collect($requiredFields)
            ->filter(fn($field) => !empty($data[$field]))
            ->count();

        return $filled === count($requiredFields) ? 1 : 0;
    }
}
