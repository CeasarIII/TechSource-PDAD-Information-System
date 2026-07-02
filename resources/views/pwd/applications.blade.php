<x-pwd-layout title="My Applications" header="My Applications">

@php
    $statusLabels = [
        'applied' => 'Applied',
        'under_review' => 'Under Review',
        'shortlisted' => 'Shortlisted',
        'interview' => 'Interview',
        'accepted' => 'Accepted',
        'rejected' => 'Rejected',
        'withdrawn' => 'Withdrawn',
    ];

    $statusClasses = [
        'applied' => 'bg-blue-50 text-blue-700 border-blue-200',
        'under_review' => 'bg-yellow-50 text-yellow-700 border-yellow-200',
        'shortlisted' => 'bg-purple-50 text-purple-700 border-purple-200',
        'interview' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
        'accepted' => 'bg-green-50 text-green-700 border-green-200',
        'rejected' => 'bg-red-50 text-red-700 border-red-200',
        'withdrawn' => 'bg-slate-100 text-slate-600 border-slate-200',
    ];
@endphp

<div class="space-y-6">

    @if(session('success'))
        <div class="rounded-2xl bg-green-50 border border-green-200 p-5 text-green-700 font-bold">
            {{ session('success') }}
        </div>
    @endif

    {{-- HEADER --}}
    <div class="rounded-3xl bg-white p-7 shadow-sm border border-slate-100">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div>
                <h1 class="text-3xl font-black text-[#003b6f]">
                    My Applications
                </h1>

                <p class="text-slate-500 mt-2">
                    Track the jobs you applied for and monitor your application status.
                </p>
            </div>

            <a href="{{ route('pwd.jobs') }}"
               class="inline-flex w-fit items-center rounded-2xl bg-[#003b6f] px-6 py-3 text-white font-black hover:bg-[#005b96] transition">
                Browse More Jobs
            </a>
        </div>
    </div>

    {{-- SUMMARY CARDS --}}
    <div class="grid md:grid-cols-3 gap-5">
        <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-100">
            <p class="text-sm font-bold text-slate-500">Total Applications</p>
            <h2 class="mt-3 text-4xl font-black text-[#003b6f]">
                {{ $applications->count() }}
            </h2>
            <p class="mt-2 text-sm text-slate-400">Submitted job applications</p>
        </div>

        <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-100">
            <p class="text-sm font-bold text-slate-500">Latest Status</p>
            <h2 class="mt-3 text-3xl font-black text-[#003b6f]">
                {{ $applications->count() ? ($statusLabels[$applications->first()->status] ?? ucfirst($applications->first()->status)) : 'None' }}
            </h2>
            <p class="mt-2 text-sm text-slate-400">Most recent application</p>
        </div>

        <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-100">
            <p class="text-sm font-bold text-slate-500">Next Step</p>
            <h2 class="mt-3 text-3xl font-black text-[#003b6f]">
                Wait for Review
            </h2>
            <p class="mt-2 text-sm text-slate-400">Employer will update your status</p>
        </div>
    </div>

    @if(isset($applications) && $applications->count())

        <div class="space-y-5">

            @foreach($applications as $application)

                @php
                    $job = $application->jobPost;
                    $status = $application->status ?? 'applied';
                    $badgeClass = $statusClasses[$status] ?? 'bg-slate-100 text-slate-600 border-slate-200';
                    $badgeLabel = $statusLabels[$status] ?? ucfirst($status);
                @endphp

                <div class="rounded-3xl bg-white p-7 shadow-sm border border-slate-100">

                    <div class="flex flex-col xl:flex-row xl:items-start xl:justify-between gap-6">

                        {{-- LEFT DETAILS --}}
                        <div class="flex-1">
                            <div class="flex flex-wrap items-center gap-3">
                                <h2 class="text-2xl font-black text-[#003b6f]">
                                    {{ $job->job_title ?? 'Job title unavailable' }}
                                </h2>

                                <span class="rounded-full border px-4 py-1 text-sm font-black {{ $badgeClass }}">
                                    {{ $badgeLabel }}
                                </span>
                            </div>

                            <div class="mt-3 flex flex-wrap gap-3 text-sm text-slate-500">
                                <span>📍 {{ $job->location ?? 'Location unavailable' }}</span>
                                <span>•</span>
                                <span>💼 {{ $job->employment_type ?? 'Employment type unavailable' }}</span>
                            </div>

                            <p class="mt-5 text-slate-600 leading-relaxed">
                                {{ $job->job_description ?? 'No description available.' }}
                            </p>

                            <div class="mt-5 grid md:grid-cols-2 gap-4">

                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-xs font-bold text-slate-400 uppercase">Required Education</p>
                                    <p class="mt-1 font-black text-slate-700">
                                        {{ $job->required_education ?? 'Not specified' }}
                                    </p>
                                </div>

                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-xs font-bold text-slate-400 uppercase">Salary Range</p>
                                    <p class="mt-1 font-black text-[#003b6f]">
                                        ₱{{ number_format($job->salary_min ?? 0) }}
                                        -
                                        ₱{{ number_format($job->salary_max ?? 0) }}
                                    </p>
                                </div>

                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-xs font-bold text-slate-400 uppercase">Applied Date</p>
                                    <p class="mt-1 font-black text-slate-700">
                                        {{ $application->applied_at ? \Carbon\Carbon::parse($application->applied_at)->format('M d, Y h:i A') : 'N/A' }}
                                    </p>
                                </div>

                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-xs font-bold text-slate-400 uppercase">Application Deadline</p>
                                    <p class="mt-1 font-black text-slate-700">
                                        {{ $job->application_deadline ? \Carbon\Carbon::parse($job->application_deadline)->format('M d, Y') : 'Open until filled' }}
                                    </p>
                                </div>

                            </div>

                            @if($job && $job->disability_friendly_notes)
                                <div class="mt-5 rounded-2xl bg-blue-50 border border-blue-100 p-4 text-blue-700">
                                    <p class="font-black">Accessibility Notes</p>
                                    <p class="mt-1 text-sm">
                                        {{ $job->disability_friendly_notes }}
                                    </p>
                                </div>
                            @endif
                        </div>

                        {{-- RIGHT STATUS TIMELINE --}}
                        <div class="xl:w-80 rounded-3xl bg-slate-50 p-5 border border-slate-100">
                            <h3 class="font-black text-[#003b6f]">
                                Application Progress
                            </h3>

                            <div class="mt-5 space-y-4">

                                <div class="flex gap-3">
                                    <span class="h-9 w-9 rounded-full bg-green-50 text-green-700 flex items-center justify-center font-black">✓</span>
                                    <div>
                                        <p class="font-black text-slate-800">Application Sent</p>
                                        <p class="text-sm text-slate-500">Your application was submitted.</p>
                                    </div>
                                </div>

                                <div class="flex gap-3">
                                    <span class="h-9 w-9 rounded-full {{ in_array($status, ['under_review', 'shortlisted', 'interview', 'accepted']) ? 'bg-green-50 text-green-700' : 'bg-slate-100 text-slate-500' }} flex items-center justify-center font-black">
                                        {{ in_array($status, ['under_review', 'shortlisted', 'interview', 'accepted']) ? '✓' : '○' }}
                                    </span>
                                    <div>
                                        <p class="font-black text-slate-800">Employer Review</p>
                                        <p class="text-sm text-slate-500">Employer checks your profile.</p>
                                    </div>
                                </div>

                                <div class="flex gap-3">
                                    <span class="h-9 w-9 rounded-full {{ in_array($status, ['interview', 'accepted']) ? 'bg-green-50 text-green-700' : 'bg-slate-100 text-slate-500' }} flex items-center justify-center font-black">
                                        {{ in_array($status, ['interview', 'accepted']) ? '✓' : '○' }}
                                    </span>
                                    <div>
                                        <p class="font-black text-slate-800">Interview / Decision</p>
                                        <p class="text-sm text-slate-500">Wait for employer update.</p>
                                    </div>
                                </div>

                            </div>

                            <div class="mt-6 rounded-2xl bg-white p-4">
                                <p class="text-xs font-bold text-slate-400 uppercase">Current Status</p>
                                <p class="mt-1 text-lg font-black text-[#003b6f]">
                                    {{ $badgeLabel }}
                                </p>
                            </div>
                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="rounded-3xl bg-white p-12 shadow-sm border text-center">

            <div class="text-6xl">
                📄
            </div>

            <h2 class="mt-5 text-2xl font-black">
                No Applications Yet
            </h2>

            <p class="mt-2 text-slate-500">
                Apply to a job to see your applications here.
            </p>

            <a href="{{ route('pwd.jobs') }}"
               class="inline-block mt-6 rounded-xl bg-[#003b6f] px-6 py-3 text-white font-bold hover:bg-[#005b96]">
                Browse Jobs
            </a>

        </div>

    @endif

</div>

</x-pwd-layout>