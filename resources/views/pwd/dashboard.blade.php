<x-pwd-layout title="PWD Dashboard" header="Dashboard">

@php
    $user = auth()->user();
    $profile = $profile ?? $user->pwdProfile;

    $applicationCount = 0;
    if ($profile && method_exists($profile, 'applications')) {
        $applicationCount = $profile->applications()->count();
    }

    $jobCount = 0;
    if (class_exists(\App\Models\JobPost::class)) {
        $jobCount = \App\Models\JobPost::whereIn('status', ['active', 'open'])->count();
    }

    $hasProfile = $profile ? true : false;
    $profileCompleted = $profile && $profile->profile_completed;

    $profileStatus = $profileCompleted ? 'Complete' : ($hasProfile ? 'In Progress' : 'Incomplete');
    $profilePercent = $profileCompleted ? 100 : ($hasProfile ? 60 : 35);

    $nextStepTitle = $profileCompleted ? 'Browse available jobs' : 'Complete your PWD profile';
    $nextStepDesc = $profileCompleted
        ? 'Your profile is ready. You can now check available job opportunities.'
        : 'Finish your profile first so the system can match you with suitable jobs.';

    $nextStepRoute = $profileCompleted ? route('pwd.jobs') : route('pwd.profile.create');
    $nextStepButton = $profileCompleted ? 'View Jobs' : 'Continue Profile';
@endphp

<div class="space-y-6">

    {{-- HERO / MAIN NEXT STEP --}}
    <section class="relative overflow-hidden rounded-[32px] bg-[#003b6f] p-8 lg:p-10 text-white shadow-xl">

        <div
            class="absolute inset-0 bg-cover bg-center opacity-25"
            style="background-image: url('{{ asset('Images/Mandaluyong_Cityhall.jpg') }}');">
        </div>

        <div class="absolute inset-0 bg-gradient-to-r from-[#003b6f]/95 via-[#005b96]/90 to-[#00a896]/80"></div>

        <div class="relative grid lg:grid-cols-3 gap-8 items-center">

            <div class="lg:col-span-2">
                <span class="inline-flex rounded-full bg-white/15 px-5 py-2 text-sm font-black">
                    Mandaluyong City Workforce Portal
                </span>

                <p class="mt-6 font-bold">
                    Good day, {{ $user->name }} 👋
                </p>

                <h1 class="mt-3 text-4xl lg:text-5xl font-black leading-tight">
                    Welcome to your PWD employment dashboard.
                </h1>

                <p class="mt-4 max-w-3xl text-white/90">
                    This dashboard shows your profile progress, job application status,
                    and the next action you need to complete.
                </p>
            </div>

            <div class="rounded-3xl bg-white/15 border border-white/20 p-6 backdrop-blur-md">
                <p class="text-sm font-bold text-white/80">Recommended Next Step</p>

                <h2 class="mt-3 text-2xl font-black">
                    {{ $nextStepTitle }}
                </h2>

                <p class="mt-3 text-sm text-white/80">
                    {{ $nextStepDesc }}
                </p>

                <a href="{{ $nextStepRoute }}"
                   class="inline-block mt-6 rounded-2xl bg-white px-6 py-3 font-black text-[#003b6f] hover:bg-slate-100 transition">
                    {{ $nextStepButton }}
                </a>
            </div>

        </div>
    </section>

    {{-- STATUS OVERVIEW --}}
    <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-5">

        <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-100">
            <p class="text-sm font-bold text-slate-500">Profile Status</p>

            <div class="mt-3 flex items-center justify-between">
                <h2 class="text-3xl font-black text-[#003b6f]">{{ $profileStatus }}</h2>
                <span class="text-3xl">👤</span>
            </div>

            <p class="mt-2 text-sm text-slate-400">
                {{ $profilePercent }}% completed
            </p>
        </div>

        <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-100">
            <p class="text-sm font-bold text-slate-500">Applications</p>

            <div class="mt-3 flex items-center justify-between">
                <h2 class="text-3xl font-black text-[#003b6f]">{{ $applicationCount }}</h2>
                <span class="text-3xl">📄</span>
            </div>

            <p class="mt-2 text-sm text-slate-400">
                Submitted applications
            </p>
        </div>

        <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-100">
            <p class="text-sm font-bold text-slate-500">Available Jobs</p>

            <div class="mt-3 flex items-center justify-between">
                <h2 class="text-3xl font-black text-[#003b6f]">{{ $jobCount }}</h2>
                <span class="text-3xl">💼</span>
            </div>

            <p class="mt-2 text-sm text-slate-400">
                Active job posts
            </p>
        </div>

        <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-100">
            <p class="text-sm font-bold text-slate-500">PWD Validation</p>

            <div class="mt-3 flex items-center justify-between">
                <h2 class="text-3xl font-black text-[#003b6f]">Pending</h2>
                <span class="text-3xl">🪪</span>
            </div>

            <p class="mt-2 text-sm text-slate-400">
                Registry verification
            </p>
        </div>

    </div>

    {{-- MAIN DASHBOARD CONTENT --}}
    <div class="grid xl:grid-cols-3 gap-6">

        {{-- LEFT --}}
        <div class="xl:col-span-2 space-y-6">

            {{-- PROFILE PROGRESS --}}
            <div class="rounded-3xl bg-white p-7 shadow-sm border border-slate-100">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h2 class="text-2xl font-black text-[#003b6f]">Profile Progress</h2>
                        <p class="mt-1 text-slate-500">
                            Your profile completion affects job matching accuracy.
                        </p>
                    </div>

                    <span class="rounded-full bg-orange-50 px-4 py-2 text-sm font-black text-orange-600">
                        {{ $profilePercent }}%
                    </span>
                </div>

                <div class="mt-6 h-3 rounded-full bg-slate-100 overflow-hidden">
                    <div
                        class="h-full rounded-full bg-gradient-to-r from-orange-400 via-yellow-400 to-emerald-500"
                        style="width: {{ $profilePercent }}%">
                    </div>
                </div>

                <div class="mt-6 rounded-2xl bg-slate-50 p-5">
                    <h3 class="font-black text-slate-800">
                        {{ $profileCompleted ? 'Profile is complete' : 'Profile needs more details' }}
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        {{ $profileCompleted
                            ? 'You can now focus on browsing jobs and tracking applications.'
                            : 'Complete your personal information, education, work experience, and resume details.' }}
                    </p>

                    <a href="{{ route('pwd.profile.create') }}"
                       class="inline-block mt-5 rounded-xl bg-[#003b6f] px-5 py-3 text-white font-black hover:bg-[#005b96] transition">
                        {{ $profileCompleted ? 'Review Profile' : 'Complete Profile' }}
                    </a>
                </div>
            </div>

            {{-- EMPLOYMENT SUMMARY --}}
            <div class="rounded-3xl bg-white p-7 shadow-sm border border-slate-100">
                <h2 class="text-2xl font-black text-[#003b6f]">Employment Summary</h2>
                <p class="mt-1 text-slate-500">
                    Summary of your current job search activity.
                </p>

                <div class="mt-6 grid md:grid-cols-2 gap-4">
                    <div class="rounded-2xl border border-slate-200 p-5">
                        <p class="text-sm font-bold text-slate-500">Jobs Available</p>
                        <h3 class="mt-2 text-4xl font-black text-[#003b6f]">{{ $jobCount }}</h3>
                        <p class="mt-2 text-sm text-slate-500">
                            Active jobs posted by employers.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 p-5">
                        <p class="text-sm font-bold text-slate-500">Applications Sent</p>
                        <h3 class="mt-2 text-4xl font-black text-[#003b6f]">{{ $applicationCount }}</h3>
                        <p class="mt-2 text-sm text-slate-500">
                            Jobs you already applied for.
                        </p>
                    </div>
                </div>

                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('pwd.jobs') }}"
                       class="rounded-xl bg-[#003b6f] px-5 py-3 text-white font-black hover:bg-[#005b96] transition">
                        Browse Jobs
                    </a>

                    <a href="{{ route('pwd.applications') }}"
                       class="rounded-xl border border-slate-200 px-5 py-3 font-black text-[#003b6f] hover:bg-slate-50 transition">
                        View Applications
                    </a>
                </div>
            </div>

        </div>

        {{-- RIGHT --}}
        <div class="space-y-6">

            {{-- ACCOUNT CHECKLIST --}}
            <div class="rounded-3xl bg-white p-7 shadow-sm border border-slate-100">
                <h2 class="text-2xl font-black text-[#003b6f]">Account Checklist</h2>

                <div class="mt-5 space-y-5">

                    <div class="flex gap-4">
                        <span class="h-10 w-10 rounded-full bg-green-50 flex items-center justify-center text-green-700 font-black">✓</span>
                        <div>
                            <h3 class="font-black">Account Created</h3>
                            <p class="text-sm text-slate-500">Your account is ready.</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <span class="h-10 w-10 rounded-full bg-green-50 flex items-center justify-center text-green-700 font-black">✓</span>
                        <div>
                            <h3 class="font-black">Dashboard Access</h3>
                            <p class="text-sm text-slate-500">You can access the PWD portal.</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <span class="h-10 w-10 rounded-full {{ $profileCompleted ? 'bg-green-50 text-green-700' : 'bg-orange-50 text-orange-600' }} flex items-center justify-center font-black">
                            {{ $profileCompleted ? '✓' : '!' }}
                        </span>
                        <div>
                            <h3 class="font-black">Profile Completion</h3>
                            <p class="text-sm text-slate-500">
                                {{ $profileCompleted ? 'Profile completed.' : 'More details required.' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <span class="h-10 w-10 rounded-full {{ $applicationCount > 0 ? 'bg-green-50 text-green-700' : 'bg-slate-100 text-slate-500' }} flex items-center justify-center font-black">
                            {{ $applicationCount > 0 ? '✓' : '○' }}
                        </span>
                        <div>
                            <h3 class="font-black">Job Application</h3>
                            <p class="text-sm text-slate-500">
                                {{ $applicationCount > 0 ? 'You already submitted an application.' : 'No application submitted yet.' }}
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            {{-- SUPPORT BOX --}}
            <div class="rounded-3xl bg-[#003b6f] p-7 text-white shadow-lg">
                <h2 class="text-2xl font-black">Need help?</h2>

                <p class="mt-2 text-sm text-blue-100">
                    Use the sidebar to access your profile, PWD validation, job recommendations,
                    applications, trainings, and resume page.
                </p>

                <a href="{{ route('pwd.validate.show') }}"
                   class="inline-block mt-6 rounded-xl bg-white px-5 py-3 font-black text-[#003b6f] hover:bg-slate-100 transition">
                    Validate PWD ID
                </a>
            </div>

        </div>

    </div>

</div>

</x-pwd-layout>
