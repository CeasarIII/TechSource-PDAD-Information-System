<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            My Job Posts
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto space-y-6">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('employer.jobs.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded">
                Create Job
            </a>

            <div class="bg-white shadow rounded p-6">
                @forelse($jobs as $job)

                    <div class="border-b py-4">
                        <h3 class="font-bold text-lg">
                            {{ $job->job_title }}
                        </h3>

                        <p>{{ $job->employment_type }}</p>

                        <p>
                            Location: {{ $job->job_location ?? 'Not specified' }}
                        </p>

                        <p>
                            Salary:
                            ₱{{ $job->salary_min ?? 'N/A' }}
                            -
                            ₱{{ $job->salary_max ?? 'N/A' }}
                        </p>

                        <p>
                            Status:
                            <strong>{{ strtoupper($job->status) }}</strong>
                        </p>

                        @if($job->skills->count())
                            <p>
                                Skills:
                                {{ $job->skills->pluck('skill_name')->implode(', ') }}
                            </p>
                        @endif

                        <div class="mt-3 flex gap-2">
                            <a href="{{ route('employer.jobs.edit', $job->id) }}"
                               class="inline-block bg-yellow-400 text-black px-3 py-1 rounded">
                                Edit
                            </a>

                            <form method="POST"
                                  action="{{ route('employer.jobs.destroy', $job->id) }}"
                                  onsubmit="return confirm('Are you sure you want to delete this job?');">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="bg-red-600 text-white px-3 py-1 rounded">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>

                @empty
                    <p>No jobs posted yet.</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>