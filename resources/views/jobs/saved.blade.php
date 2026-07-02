<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800">
                Saved Jobs
            </h2>

            <a href="{{ route('jobs.index') }}"
               style="background:#374151;color:white;padding:8px 14px;border-radius:6px;">
                Back to Jobs
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto space-y-6 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('warning'))
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-4 py-3 rounded">
                    {{ session('warning') }}
                </div>
            @endif

            <div class="bg-white shadow rounded p-6">
                @forelse ($savedJobs as $savedJob)
                    @php
                        $job = $savedJob->jobPost;
                    @endphp

                    @if($job)
                        <div class="border-b py-5">
                            <h3 class="font-bold text-lg">{{ $job->job_title }}</h3>
                            <p>{{ $job->job_description }}</p>
                            <p>Company: {{ $job->employer->company_name ?? 'N/A' }}</p>
                            <p>Type: {{ $job->employment_type }}</p>
                            <p>Location: {{ $job->location ?? 'Not specified' }}</p>
                            <p class="text-sm text-gray-500">
                                Saved: {{ $savedJob->saved_at?->diffForHumans() }}
                            </p>

                            <div class="flex gap-2 mt-3">
                                <form method="POST" action="{{ route('saved-jobs.destroy', $job->id) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        style="background:#dc2626;color:white;padding:8px 14px;border-radius:6px;">
                                        Unsave
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('applications.apply', $job->id) }}">
                                    @csrf

                                    <button type="submit"
                                        style="background:#2563eb;color:white;padding:8px 14px;border-radius:6px;">
                                        Apply
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                @empty
                    <p>No saved jobs yet.</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>