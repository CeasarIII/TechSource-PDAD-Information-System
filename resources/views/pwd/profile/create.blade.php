<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create PWD Profile
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <h3 class="text-xl font-bold mb-6">
                    Complete Your Profile
                </h3>

                <form method="POST" action="{{ route('pwd.profile.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium mb-2">
                            Registry Reference
                        </label>

                        <select
                            name="registry_reference_id"
                            class="w-full border rounded px-3 py-2"
                            required
                        >
                            <option value="">Select Registry Record</option>

                            @foreach($registryReferences as $registry)
                                <option value="{{ $registry->id }}">
                                    {{ $registry->id }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">
                            Contact Number
                        </label>

                        <input
                            type="text"
                            name="contact_number"
                            class="w-full border rounded px-3 py-2"
                        >
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">
                            Education
                        </label>

                        <input
                            type="text"
                            name="education"
                            class="w-full border rounded px-3 py-2"
                        >
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">
                            Experience
                        </label>

                        <textarea
                            name="experience"
                            class="w-full border rounded px-3 py-2"
                            rows="5"
                        ></textarea>
                    </div>

                    <button
                        type="submit"
                        style="background:#2563eb;color:white;padding:10px 20px;border-radius:6px;"
                    >
                        Save Profile
                    </button>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>