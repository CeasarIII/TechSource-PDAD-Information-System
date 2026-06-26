<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TermsController extends Controller
{
    public function show()
    {
        return view('terms.show');
    }

    public function accept(Request $request)
    {
        $user = Auth::user();
        $user->terms_accepted = true;
        $user->terms_accepted_at = now();
        $user->save();

        return redirect()->intended('/pwd/dashboard');
    }
}
