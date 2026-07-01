<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployerController extends Controller
{
    public function showRegistration()
    {
        return view('employer.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:200',
            'contact_person' => 'required|string|max:150',
            'company_email' => 'required|email|unique:users,email',
            'company_phone' => 'nullable|string|max:30',
            'company_address' => 'required|string|max:500',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['contact_person'],
            'email' => $validated['company_email'],
            'password' => Hash::make($validated['password']),
            'role' => 'employer',
            'account_status' => 'pending',
            'terms_accepted' => true,
            'terms_accepted_at' => now(),
        ]);

        Employer::create([
            'user_id' => $user->id,
            'company_name' => $validated['company_name'],
            'contact_person' => $validated['contact_person'],
            'company_email' => $validated['company_email'],
            'company_phone' => $validated['company_phone'] ?? null,
            'company_address' => $validated['company_address'],
            'verification_status' => 'pending',
        ]);

        return redirect()->route('login')
            ->with('success', 'Employer registration successful. Please wait for admin verification.');
    }

    public function dashboard()
    {
        $employer = auth()->user()->employer;

        return view('employer.dashboard', compact('employer'));
    }
}
