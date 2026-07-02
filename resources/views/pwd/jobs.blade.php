<x-pwd-layout title="Job Recommendations" header="Job Recommendations">

    <div class="space-y-6">

        @if(session('success'))
            <div class="rounded-2xl bg-green-50 border border-green-200 p-5 text-green-700 font-bold">
                {{ session('success') }}
            </div>
        @endif

        <div class="rounded-3xl bg-white p-7 shadow-sm border border-slate-100">
            <h1 class="text-3xl font-black text-[#003b6f]">
                AI Job Recommendations
            </h1>
            <p class="text-slate-500 mt-2">
                Active job posts from the database.
            </p>
        </div>

        @if(isset($jobs) && $jobs->count())
            <div class="grid lg:grid-cols-2 gap-6">
                @foreach($jobs as $job)
                    <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition">

                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h2 class="text-xl font-black text-[#003b6f]">
                                    {{ $job->job_title }}
                                </h2>

                                <p class="text-slate-500 mt-1">
                                    {{ $job->location ?? 'Location not specified' }} · {{ $job->employment_type ?? 'N/A' }}
                                </p>
                            </div>

                            <span class="rounded-full bg-green-50 px-3 py-1 text-sm font-black text-green-600">
                                Active
                            </span>
                        </div>

                        <p class="mt-5 text-slate-600">
                            {{ $job->job_description ?? 'No description available.' }}
                        </p>

                        @if($job->required_education)
                            <p class="mt-3 text-sm text-slate-500">
                                <span class="font-bold text-slate-700">Required Education:</span>
                                {{ $job->required_education }}
                            </p>
                        @endif

                        @if($job->disability_friendly_notes)
                            <div class="mt-4 rounded-2xl bg-blue-50 p-4 text-sm text-blue-700">
                                <span class="font-black">Accessibility Notes:</span>
                                {{ $job->disability_friendly_notes }}
                            </div>
                        @endif

                        <div class="mt-6 flex items-center justify-between gap-4">
                            <div>
                                <p class="font-black text-[#003b6f]">
                                    ₱{{ number_format($job->salary_min ?? 0) }}
                                    -
                                    ₱{{ number_format($job->salary_max ?? 0) }}
                                </p>

                                <p class="text-sm text-slate-500">
                                    Deadline:
                                    {{ $job->application_deadline ? \Carbon\Carbon::parse($job->application_deadline)->format('M d, Y') : 'Open until filled' }}
                                </p>
                            </div>

                            <form method="POST" action="{{ route('pwd.jobs.apply') }}">
                                @csrf

                                <input type="hidden" name="job_post_id" value="{{ $job->id }}">

                                <button type="submit"
                                    class="rounded-xl bg-[#003b6f] px-5 py-2 text-white font-bold hover:bg-[#005b96] transition">
                                    Apply
                                </button>
                            </form>
                        </div>

                    </div>
                @endforeach
            </div>
        @else
            <div class="rounded-3xl bg-white p-10 shadow-sm border text-center">
                <div class="text-6xl">💼</div>

                <h2 class="mt-5 text-2xl font-black text-slate-700">
                    No Jobs Available
                </h2>

                <p class="mt-2 text-slate-500">
                    Employers have not posted any active jobs yet.
                </p>
            </div>
        @endif

    </div>

</x-pwd-layout>