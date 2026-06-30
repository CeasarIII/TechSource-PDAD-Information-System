<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification - PDAD Employment Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="min-h-screen bg-slate-100 flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-lg bg-white rounded-3xl shadow-2xl border border-slate-200 p-8 text-center">
            <img src="{{ asset('images/pdad_logo.jpg') }}" alt="PDAD Logo" class="w-20 h-20 mx-auto rounded-full object-contain bg-white mb-6">

            <div class="w-20 h-20 mx-auto rounded-3xl bg-blue-50 flex items-center justify-center text-4xl mb-6">
                ✉️
            </div>

            <h1 class="text-3xl font-extrabold text-[#003b6f]">
                Verify your email
            </h1>

            <p class="text-slate-500 mt-4 leading-7">
                Thanks for registering with the PDAD Employment Portal. Before continuing, please verify your email address by clicking the link we sent to your inbox.
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="mt-6 rounded-xl bg-green-50 border border-green-200 text-green-700 px-4 py-3 text-sm">
                    A new verification link has been sent to your email address.
                </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}" class="mt-8">
                @csrf

                <button type="submit" class="w-full min-h-[52px] rounded-xl bg-[#003b6f] text-white font-extrabold hover:bg-[#002f59] transition shadow-lg">
                    Resend verification email
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf

                <button type="submit" class="w-full min-h-[52px] rounded-xl border border-slate-300 text-slate-600 font-bold hover:bg-slate-50 transition">
                    Log out
                </button>
            </form>
        </div>
    </div>
</body>
</html>