<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Available Jobs
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto space-y-6">

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
                @forelse ($jobs as $job)
                    <div class="border-b py-4">
                        <h3 class="font-bold text-lg">{{ $job->job_title }}</h3>
                        <p>{{ $job->job_description }}</p>
                        <p>Company: {{ $job->employer->company_name ?? 'N/A' }}</p>
                        <p>Type: {{ $job->employment_type }}</p>
                        <p>Location: {{ $job->job_location ?? 'Not specified' }}</p>

                        <form method="POST" action="{{ route('applications.apply', $job->id) }}" class="mt-3">
                            @csrf
                            <button type="submit"
                                style="background:#2563eb;color:white;padding:8px 14px;border-radius:6px;">
                                Apply
                            </button>
                        </form>
                    </div>
                @empty
                    <p>No available jobs yet.</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>