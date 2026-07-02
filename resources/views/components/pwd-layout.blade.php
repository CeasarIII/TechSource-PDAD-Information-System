<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'PWD Dashboard' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 min-h-screen font-sans antialiased">
    <div class="min-h-screen flex">
        <aside class="hidden lg:flex lg:w-72 bg-[#003b6f] text-white flex-col">
            <div class="p-6 border-b border-white/10">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('Images/pdad_logo.jpg') }}" class="w-12 h-12 rounded-full bg-white object-contain p-1">
                    <div>
                        <h1 class="font-extrabold text-lg leading-tight">PDAD Portal</h1>
                        <p class="text-xs text-blue-100">PWD Dashboard</p>
                    </div>
                </div>
                <p class="mt-4 text-sm text-blue-100">{{ Auth::user()->name }}</p>
            </div>

            <nav class="flex-1 p-4 space-y-2">
    <a href="/pwd/dashboard" class="block px-4 py-3 rounded-xl {{ request()->is('pwd/dashboard') ? 'bg-white/20 font-black' : 'hover:bg-white/10' }}">Dashboard</a>

    <a href="/pwd/validate" class="block px-4 py-3 rounded-xl {{ request()->is('pwd/validate') ? 'bg-white/20 font-black' : 'hover:bg-white/10' }}">PWD ID Validation</a>

    <a href="/pwd/profile/create" class="block px-4 py-3 rounded-xl {{ request()->is('pwd/profile*') ? 'bg-white/20 font-black' : 'hover:bg-white/10' }}">My Profile</a>

    <a href="/pwd/jobs" class="block px-4 py-3 rounded-xl {{ request()->is('pwd/jobs') ? 'bg-white/20 font-black' : 'hover:bg-white/10' }}">Job Recommendations</a>

    <a href="/pwd/applications" class="block px-4 py-3 rounded-xl {{ request()->is('pwd/applications') ? 'bg-white/20 font-black' : 'hover:bg-white/10' }}">My Applications</a>

    <a href="/pwd/trainings" class="block px-4 py-3 rounded-xl {{ request()->is('pwd/trainings') ? 'bg-white/20 font-black' : 'hover:bg-white/10' }}">Trainings</a>

    <a href="/pwd/resume" class="block px-4 py-3 rounded-xl {{ request()->is('pwd/resume') ? 'bg-white/20 font-black' : 'hover:bg-white/10' }}">Resume & Certificates</a>
</nav>

            <form method="POST" action="{{ route('logout') }}" class="p-4 border-t border-white/10">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-3 rounded-xl bg-red-500/15 text-red-100 hover:bg-red-500/25">
                    Logout
                </button>
            </form>
        </aside>

        <main class="flex-1 min-w-0">
            <header class="bg-white border-b border-slate-200 px-5 lg:px-8 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('Images/pdad_logo.jpg') }}" class="w-10 h-10 rounded-full object-contain lg:hidden">
                    <div>
                        <h2 class="font-extrabold text-[#003b6f] text-lg">{{ $header ?? 'PWD Dashboard' }}</h2>
                        <p class="text-xs text-slate-500 hidden sm:block">PDAD Employment Matching System</p>
                    </div>
                </div>

                <div class="text-sm text-slate-600">
                    {{ Auth::user()->name }}
                </div>
            </header>

            <section class="p-5 lg:p-8">
                {{ $slot }}
            </section>
        </main>
    </div>
</body>
</html>