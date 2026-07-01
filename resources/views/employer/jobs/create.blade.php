<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Job Posting
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

            <form method="POST" action="{{ route('employer.jobs.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block font-medium mb-2">Job Title</label>
                    <input
                        type="text"
                        name="job_title"
                        value="{{ old('job_title') }}"
                        class="w-full border rounded px-3 py-2"
                        required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-2">Job Description</label>
                    <textarea
                        name="job_description"
                        rows="6"
                        class="w-full border rounded px-3 py-2"
                        required>{{ old('job_description') }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-2">Employment Type</label>

                    <select
                        name="employment_type"
                        class="w-full border rounded px-3 py-2"
                        required>

                        <option value="">Select</option>

                        <option>Permanent</option>
                        <option>Contractual</option>
                        <option>Casual</option>
                        <option>Job Order</option>
                        <option>Probationary</option>
                        <option>Seasonal</option>
                        <option>Self-employed</option>

                    </select>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-2">
                        Required Skills
                    </label>

                    <input
                        type="text"
                        name="required_skills"
                        value="{{ old('required_skills') }}"
                        class="w-full border rounded px-3 py-2">

                    <small class="text-gray-500">
                        Separate multiple skills using commas.
                    </small>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-2">
                        Required Skill Level
                    </label>

                    <select
                        name="required_level"
                        class="w-full border rounded px-3 py-2">

                        <option>Beginner</option>
                        <option selected>Intermediate</option>
                        <option>Advanced</option>
                        <option>Expert</option>

                    </select>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-2">
                        Job Location
                    </label>

                    <input
                        type="text"
                        name="job_location"
                        value="{{ old('job_location') }}"
                        class="w-full border rounded px-3 py-2">
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">

                    <div>
                        <label class="block font-medium mb-2">
                            Minimum Salary
                        </label>

                        <input
                            type="number"
                            name="salary_min"
                            value="{{ old('salary_min') }}"
                            class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block font-medium mb-2">
                            Maximum Salary
                        </label>

                        <input
                            type="number"
                            name="salary_max"
                            value="{{ old('salary_max') }}"
                            class="w-full border rounded px-3 py-2">
                    </div>

                </div>

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">

                    Post Job

                </button>

            </form>

        </div>
    </div>
</x-app-layout>