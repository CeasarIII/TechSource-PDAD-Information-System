<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PDAD Employment Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="min-h-screen bg-slate-100 grid lg:grid-cols-2">

        {{-- LEFT PANEL --}}
        <section
            class="hidden lg:flex relative overflow-hidden text-white flex-col justify-between p-14 bg-cover bg-center"
            style="
                background-image:
                linear-gradient(rgba(0, 45, 90, 0.55), rgba(0, 27, 60, 0.78)),
                url('{{ asset('images/Mandaluyong_Cityhall.jpg') }}');
            "
        >
            <div class="absolute inset-0 bg-gradient-to-br from-[#003b6f]/55 via-[#003b6f]/25 to-[#071a3d]/70"></div>
            <div class="absolute inset-0 backdrop-blur-[0.2px]"></div>

            <div class="absolute -top-28 -left-28 w-[420px] h-[420px] rounded-full bg-white/10 blur-2xl"></div>
            <div class="absolute bottom-[-120px] right-[-80px] w-[500px] h-[500px] rounded-full bg-[#009688]/20 blur-2xl"></div>

            <div class="relative z-10">
                <div class="flex items-center gap-4">
                    <img
                        src="{{ asset('images/pdad_logo.jpg') }}"
                        alt="PDAD Logo"
                        class="w-16 h-16 rounded-full bg-white object-contain p-1 shadow-lg"
                    >

                    <div>
                        <h1 class="text-3xl font-extrabold">
                            PDAD Employment Portal
                        </h1>

                        <p class="text-blue-100">
                            PWD Employment Matching System
                        </p>
                    </div>
                </div>

                <div class="mt-16">
                    <span class="inline-flex items-center px-4 py-2 rounded-full bg-white/15 border border-white/25 text-sm font-bold text-white shadow-lg backdrop-blur">
                        🏛️ Mandaluyong City Workforce Portal
                    </span>

                    <h2 class="mt-8 text-6xl font-black leading-tight drop-shadow-xl">
                        Predictive<br>
                        Ability-Based<br>
                        Employment
                    </h2>

                    <p class="mt-8 max-w-xl text-lg leading-9 text-blue-50 drop-shadow">
                        A government-grade portal connecting persons with disabilities to meaningful careers through
                        AI-powered ability matching, credential verification, accessibility-first design, and inclusive
                        employment opportunities.
                    </p>
                </div>
            </div>

            <div class="relative z-10">
                <div class="grid grid-cols-3 gap-5">
                    <div class="bg-white/15 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-xl">
                        <div class="text-4xl font-extrabold text-[#00d0b7]">
                            2,847
                        </div>
                        <div class="text-blue-50 mt-2">
                            Active Applicants
                        </div>
                    </div>

                    <div class="bg-white/15 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-xl">
                        <div class="text-4xl font-extrabold text-[#00d0b7]">
                            94%
                        </div>
                        <div class="text-blue-50 mt-2">
                            Match Accuracy
                        </div>
                    </div>

                    <div class="bg-white/15 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-xl">
                        <div class="text-4xl font-extrabold text-[#00d0b7]">
                            512
                        </div>
                        <div class="text-blue-50 mt-2">
                            Partner Employers
                        </div>
                    </div>
                </div>

                <div class="mt-10 text-sm text-blue-100 drop-shadow">
                    WCAG 2.1 AA Compliant · Section 508 Ready · Government-Grade Security
                </div>
            </div>
        </section>

        {{-- RIGHT PANEL --}}
        <section class="flex items-center justify-center px-6 py-12 bg-slate-100">
            <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl border border-slate-200 p-8">
                <div class="lg:hidden flex justify-center mb-8">
                    <img
                        src="{{ asset('images/pdad_logo.jpg') }}"
                        alt="PDAD Logo"
                        class="w-20 h-20 rounded-full object-contain bg-white"
                    >
                </div>

                <div class="mb-8">
                    <h2 class="text-3xl font-extrabold text-[#003b6f]">
                        Welcome back
                    </h2>

                    <p class="text-slate-500 mt-2">
                        Sign in to access your portal
                    </p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-[#003b6f] mb-3">
                            Select your role
                        </label>

                        <div class="grid grid-cols-3 gap-3">
                            <label class="cursor-pointer">
                                <input type="radio" name="role" value="pwd" class="peer sr-only" checked>

                                <div class="min-h-[76px] rounded-2xl border-2 border-slate-200 flex flex-col items-center justify-center text-sm text-slate-600 peer-checked:border-[#009688] peer-checked:bg-teal-50 peer-checked:text-[#009688] transition">
                                    <span class="text-xl">♿</span>
                                    <span>PWD</span>
                                </div>
                            </label>

                            <label class="cursor-pointer">
                                <input type="radio" name="role" value="employer" class="peer sr-only">

                                <div class="min-h-[76px] rounded-2xl border-2 border-slate-200 flex flex-col items-center justify-center text-sm text-slate-600 peer-checked:border-[#003b6f] peer-checked:bg-blue-50 peer-checked:text-[#003b6f] transition">
                                    <span class="text-xl">🏢</span>
                                    <span>Employer</span>
                                </div>
                            </label>

                            <label class="cursor-pointer">
                                <input type="radio" name="role" value="admin" class="peer sr-only">

                                <div class="min-h-[76px] rounded-2xl border-2 border-slate-200 flex flex-col items-center justify-center text-sm text-slate-600 peer-checked:border-orange-500 peer-checked:bg-orange-50 peer-checked:text-orange-600 transition">
                                    <span class="text-xl">🛡️</span>
                                    <span>Admin</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="mb-5">
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
                            autocomplete="username"
                            placeholder="you@example.gov.ph"
                            class="w-full min-h-[48px] rounded-xl border-2 border-[#003b6f] bg-slate-100 px-4 focus:ring-4 focus:ring-blue-100 focus:outline-none"
                        >

                        @error('email')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="password" class="block text-sm font-bold text-[#003b6f] mb-2">
                            Password
                        </label>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="••••••••"
                            class="w-full min-h-[48px] rounded-xl border-2 border-[#003b6f] bg-slate-100 px-4 focus:ring-4 focus:ring-blue-100 focus:outline-none"
                        >

                        @error('password')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center gap-2 text-sm text-slate-600">
                            <input
                                type="checkbox"
                                name="remember"
                                class="rounded border-slate-300 text-[#003b6f] focus:ring-[#003b6f]"
                            >
                            Remember me
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm font-semibold text-[#009688] hover:underline">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <button
                        type="submit"
                        class="w-full min-h-[52px] rounded-xl bg-[#003b6f] text-white font-extrabold hover:bg-[#002f59] transition shadow-lg"
                    >
                        Sign in
                    </button>

                    <p class="text-center text-sm text-slate-500 mt-6">
                        New to PDAD Employment Portal?

                        <a href="{{ route('register') }}" class="font-bold text-[#009688] hover:underline">
                            Create an account
                        </a>
                    </p>
                </form>
            </div>
        </section>

    </div>
</body>
</html>