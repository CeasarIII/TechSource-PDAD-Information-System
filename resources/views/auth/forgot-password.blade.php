<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - PDAD Employment Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="min-h-screen bg-slate-100 grid lg:grid-cols-2">

        <section
            class="hidden lg:flex relative overflow-hidden text-white flex-col justify-between p-14 bg-cover bg-center"
            style="
                background-image:
                linear-gradient(rgba(0, 45, 90, 0.58), rgba(0, 27, 60, 0.82)),
                url('{{ asset('images/Mandaluyong_Cityhall.jpg') }}');
            "
        >
            <div class="absolute inset-0 bg-gradient-to-br from-[#003b6f]/55 via-[#003b6f]/25 to-[#071a3d]/70"></div>

            <div class="relative z-10">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('images/pdad_logo.jpg') }}" alt="PDAD Logo" class="w-16 h-16 rounded-full bg-white object-contain p-1 shadow-lg">

                    <div>
                        <h1 class="text-3xl font-extrabold">PDAD Employment Portal</h1>
                        <p class="text-blue-100">PWD Employment Matching System</p>
                    </div>
                </div>

                <div class="mt-16">
                    <span class="inline-flex items-center px-4 py-2 rounded-full bg-white/15 border border-white/25 text-sm font-bold text-white">
                        🔐 Account Recovery
                    </span>

                    <h2 class="mt-8 text-6xl font-black leading-tight drop-shadow-xl">
                        Secure<br>
                        Password<br>
                        Recovery
                    </h2>

                    <p class="mt-8 max-w-xl text-lg leading-9 text-blue-50">
                        Reset your account access safely. A password reset link will be sent to your registered email address.
                    </p>
                </div>
            </div>

            <div class="relative z-10 text-sm text-blue-100">
                WCAG 2.1 AA Compliant · Section 508 Ready · Government-Grade Security
            </div>
        </section>

        <section class="flex items-center justify-center px-6 py-12 bg-slate-100">
            <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl border border-slate-200 p-8">
                <div class="mb-8">
                    <h2 class="text-3xl font-extrabold text-[#003b6f]">Forgot password?</h2>
                    <p class="text-slate-500 mt-2">
                        Enter your email and we will send you a password reset link.
                    </p>
                </div>

                @if (session('status'))
                    <div class="mb-5 rounded-xl bg-green-50 border border-green-200 text-green-700 px-4 py-3 text-sm">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-6">
                        <label for="email" class="block text-sm font-bold text-[#003b6f] mb-2">
                            Email Address
                        </label>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            placeholder="you@example.gov.ph"
                            class="w-full min-h-[48px] rounded-xl border-2 border-[#003b6f] bg-slate-100 px-4 focus:ring-4 focus:ring-blue-100 focus:outline-none"
                        >

                        @error('email')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full min-h-[52px] rounded-xl bg-[#003b6f] text-white font-extrabold hover:bg-[#002f59] transition shadow-lg">
                        Send reset link
                    </button>

                    <p class="text-center text-sm text-slate-500 mt-6">
                        Remember your password?
                        <a href="{{ route('login') }}" class="font-bold text-[#009688] hover:underline">
                            Back to login
                        </a>
                    </p>
                </form>
            </div>
        </section>

    </div>
</body>
</html>