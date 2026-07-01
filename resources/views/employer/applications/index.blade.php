<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Job Applications
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto space-y-6">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded p-6">
                @forelse ($applications as $application)
                    <div class="border-b py-4">
                        <h3 class="font-bold text-lg">
                            {{ $application->jobPost->job_title ?? 'Job Deleted' }}
                        </h3>

                        <p>
                            Applicant:
                            {{ $application->pwdProfile->user->name ?? 'Unknown Applicant' }}
                        </p>

                        <p>
                            Current Status:
                            <strong>{{ $application->application_status }}</strong>
                        </p>

                        <p>
                            Applied At:
                            {{ $application->applied_at?->format('M d, Y h:i A') ?? 'N/A' }}
                        </p>

                        <form method="POST"
                              action="{{ route('employer.applications.update', $application->id) }}"
                              class="mt-3 flex gap-2">
                            @csrf
                            @method('PATCH')

                            <select name="application_status" class="border rounded px-3 py-1">
                                @foreach(['Pending', 'Interview', 'Accepted', 'Rejected'] as $status)
                                    <option value="{{ $status }}"
                                        {{ $application->application_status === $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>

                            <button type="submit"
                                    style="background:#2563eb;color:white;padding:6px 12px;border-radius:6px;">
                                Update Status
                            </button>
                        </form>
                    </div>
                @empty
                    <p>No applications yet.</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>