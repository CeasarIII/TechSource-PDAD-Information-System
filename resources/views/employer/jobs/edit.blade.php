<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit Job Posting
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6">

            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('employer.jobs.update', $job->id) }}">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label class="block font-medium mb-2">Job Title</label>
                    <input type="text" name="job_title"
                           value="{{ old('job_title', $job->job_title) }}"
                           class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-2">Job Description</label>
                    <textarea name="job_description" rows="6"
                              class="w-full border rounded px-3 py-2"
                              required>{{ old('job_description', $job->job_description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-2">Employment Type</label>
                    <select name="employment_type" class="w-full border rounded px-3 py-2" required>
                        @foreach(['Permanent','Contractual','Casual','Job Order','Probationary','Seasonal','Self-employed'] as $type)
                            <option value="{{ $type }}" {{ old('employment_type', $job->employment_type) === $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-2">Job Location</label>
                    <input type="text" name="job_location"
                           value="{{ old('job_location', $job->job_location) }}"
                           class="w-full border rounded px-3 py-2">
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block font-medium mb-2">Minimum Salary</label>
                        <input type="number" name="salary_min"
                               value="{{ old('salary_min', $job->salary_min) }}"
                               class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block font-medium mb-2">Maximum Salary</label>
                        <input type="number" name="salary_max"
                               value="{{ old('salary_max', $job->salary_max) }}"
                               class="w-full border rounded px-3 py-2">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block font-medium mb-2">Status</label>
                    <select name="status" class="w-full border rounded px-3 py-2" required>
                        @foreach(['open','closed','draft'] as $status)
                            <option value="{{ $status }}" {{ old('status', $job->status) === $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit"
                        style="background:#2563eb;color:white;padding:10px 20px;border-radius:6px;">
                    Update Job
                </button>

                <a href="{{ route('employer.jobs.index') }}"
                    style="margin-left:10px;color:#4b5563;">
                        Cancel
                </a>
            </form>

        </div>
    </div>
</x-app-layout>