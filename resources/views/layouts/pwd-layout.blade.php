@props(['title' => 'PWD Dashboard', 'header' => 'Dashboard'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 font-sans antialiased">
<div class="min-h-screen flex">

    {{-- SIDEBAR --}}
    <aside class="w-72 bg-[#00477a] text-white min-h-screen flex flex-col fixed left-0 top-0 bottom-0">

        <div class="p-6 border-b border-white/10">
            <div class="flex items-center gap-3">
                <img src="{{ asset('Images/pdad_logo.jpg') }}" class="w-14 h-14 rounded-full bg-white p-1">
                <div>
                    <h1 class="font-black text-xl">PDAD Portal</h1>
                    <p class="text-xs text-blue-100">PWD Dashboard</p>
                </div>
            </div>

            <p class="mt-5 text-sm text-blue-100">
                {{ Auth::user()->name }}
            </p>
        </div>

        <nav class="flex-1 p-4 space-y-2">

            <a href="{{ route('pwd.dashboard') }}"
               class="block px-4 py-3 rounded-xl transition
               {{ request()->routeIs('pwd.dashboard') ? 'bg-white/20 font-black shadow-lg' : 'hover:bg-white/10' }}">
                Dashboard
            </a>

            <a href="{{ route('pwd.validate.show') }}"
               class="block px-4 py-3 rounded-xl transition
               {{ request()->routeIs('pwd.validate*') ? 'bg-white/20 font-black shadow-lg' : 'hover:bg-white/10' }}">
                PWD ID Validation
            </a>

            <a href="{{ route('pwd.profile.create') }}"
               class="block px-4 py-3 rounded-xl transition
               {{ request()->routeIs('pwd.profile*') ? 'bg-white/20 font-black shadow-lg' : 'hover:bg-white/10' }}">
                My Profile
            </a>

            <a href="{{ route('pwd.jobs') }}"
               class="block px-4 py-3 rounded-xl transition
               {{ request()->routeIs('pwd.jobs') || request()->routeIs('pwd.jobs.*') ? 'bg-white/20 font-black shadow-lg' : 'hover:bg-white/10' }}">
                Job Recommendations
            </a>

            <a href="{{ route('pwd.applications') }}"
               class="block px-4 py-3 rounded-xl transition
               {{ request()->routeIs('pwd.applications') ? 'bg-white/20 font-black shadow-lg' : 'hover:bg-white/10' }}">
                My Applications
            </a>

            <a href="{{ route('pwd.trainings') }}"
               class="block px-4 py-3 rounded-xl transition
               {{ request()->routeIs('pwd.trainings') || request()->routeIs('pwd.trainings.*') ? 'bg-white/20 font-black shadow-lg' : 'hover:bg-white/10' }}">
                Trainings
            </a>

            <a href="{{ route('pwd.resume') }}"
               class="block px-4 py-3 rounded-xl transition
               {{ request()->routeIs('pwd.resume') ? 'bg-white/20 font-black shadow-lg' : 'hover:bg-white/10' }}">
                Resume & Certificates
            </a>

        </nav>

        <div class="p-4 border-t border-white/10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full text-left px-4 py-3 rounded-xl bg-red-500/15 text-red-100 hover:bg-red-500/25 transition">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 ml-72 min-h-screen">

        <header class="bg-white border-b border-slate-200 px-8 py-5 flex items-center justify-between">
            <div>
                <h2 class="text-xl font-black text-[#003b6f]">{{ $header }}</h2>
                <p class="text-sm text-slate-500">PDAD Employment Matching System</p>
            </div>

            <div class="text-sm text-slate-600">
                {{ Auth::user()->name }}
            </div>
        </header>

        <div class="p-8">
            {{ $slot }}
        </div>

    </main>

</div>
</body>
</html>