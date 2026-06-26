<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureTermsAccepted
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && !Auth::user()->terms_accepted) {
            if (!$request->is('terms') && !$request->is('terms/accept') && !$request->is('logout')) {
                return redirect()->route('terms.show');
            }
        }

        return $next($request);
    }
}
