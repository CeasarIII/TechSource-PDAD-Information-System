<x-pwd-layout title="Edit PWD Profile" header="My Profile">

@php
    $currentProfile = $profile ?? $pwdProfile ?? null;
    $registryList = $registryReferences ?? $pwdRegistryReferences ?? $registryRecords ?? $references ?? collect();

    $selectedRegistry = null;

    if ($currentProfile && $currentProfile->registry_reference_id && $registryList) {
        $selectedRegistry = collect($registryList)->firstWhere('id', $currentProfile->registry_reference_id);
    }

    $completion = 35;

    if ($currentProfile) {
        $filled = 0;
        $total = 4;

        if ($currentProfile->registry_reference_id) $filled++;
        if ($currentProfile->contact_number) $filled++;
        if ($currentProfile->education) $filled++;
        if ($currentProfile->experience) $filled++;

        $completion = intval(($filled / $total) * 100);
    }
@endphp

<div class="space-y-6">

    <section class="relative overflow-hidden rounded-[32px] bg-[#003b6f] p-8 text-white shadow-xl">
        <div class="absolute inset-0 bg-gradient-to-r from-[#003b6f] via-[#005b96] to-[#00a896]"></div>

        <div class="relative grid lg:grid-cols-3 gap-8 items-center">
            <div class="lg:col-span-2">
                <span class="inline-flex rounded-full bg-white/15 px-5 py-2 text-sm font-black">
                    PWD Profile Management
                </span>

                <h1 class="mt-5 text-4xl font-black">
                    Edit Your PWD Profile
                </h1>

                <p class="mt-3 max-w-3xl text-white/90">
                    Keep your personal details, education, and experience updated so job recommendations
                    and applications can be processed properly.
                </p>
            </div>

            <div class="rounded-3xl bg-white/15 border border-white/20 p-6 backdrop-blur-md">
                <p class="font-black">Profile Completion</p>

                <div class="mt-4 flex items-end gap-3">
                    <span class="text-5xl font-black">{{ $completion }}%</span>
                    <span class="mb-2 text-white/80">completed</span>
                </div>

                <div class="mt-4 h-3 rounded-full bg-white/20 overflow-hidden">
                    <div class="h-full rounded-full bg-white" style="width: {{ $completion }}%"></div>
                </div>
            </div>
        </div>
    </section>

    @if(session('success'))
        <div class="rounded-2xl bg-green-50 border border-green-200 p-5 text-green-700 font-bold">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="rounded-2xl bg-red-50 border border-red-200 p-5 text-red-700">
            <p class="font-black">Please fix the following:</p>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid xl:grid-cols-3 gap-6">

        <div class="xl:col-span-2">
            <form method="POST" action="{{ route('pwd.profile.update', $currentProfile->id) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="rounded-3xl bg-white p-7 shadow-sm border border-slate-100">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h2 class="text-2xl font-black text-[#003b6f]">Registry Information</h2>
                            <p class="mt-1 text-slate-500">
                                Select the verified PWD registry record connected to this profile.
                            </p>
                        </div>

                        <span class="rounded-full bg-blue-50 px-4 py-2 text-sm font-black text-blue-700">
                            Required
                        </span>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-black text-slate-700">
                            Registry Reference
                        </label>

                        <select name="registry_reference_id"
                                class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-4 font-semibold focus:border-[#003b6f] focus:ring-[#003b6f]"
                                required>
                            <option value="">Select Registry Record</option>

                            @foreach($registryList as $record)
                                <option value="{{ $record->id }}"
                                    {{ old('registry_reference_id', $currentProfile->registry_reference_id) == $record->id ? 'selected' : '' }}>
                                    {{ $record->id }} - {{ $record->id_number }}
                                    @if(isset($record->first_name) || isset($record->last_name))
                                        | {{ $record->first_name }} {{ $record->last_name }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="rounded-3xl bg-white p-7 shadow-sm border border-slate-100">
                    <h2 class="text-2xl font-black text-[#003b6f]">Personal Details</h2>
                    <p class="mt-1 text-slate-500">
                        These details will be used for job matching and application tracking.
                    </p>

                    <div class="mt-6 grid md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-black text-slate-700">
                                Contact Number
                            </label>
                            <input type="text"
                                   name="contact_number"
                                   value="{{ old('contact_number', $currentProfile->contact_number) }}"
                                   placeholder="Example: 09181234567"
                                   class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-4 font-semibold focus:border-[#003b6f] focus:ring-[#003b6f]"
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-black text-slate-700">
                                Education
                            </label>
                            <input type="text"
                                   name="education"
                                   value="{{ old('education', $currentProfile->education) }}"
                                   placeholder="Example: College Level"
                                   class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-4 font-semibold focus:border-[#003b6f] focus:ring-[#003b6f]"
                                   required>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl bg-white p-7 shadow-sm border border-slate-100">
                    <h2 class="text-2xl font-black text-[#003b6f]">Work Experience</h2>
                    <p class="mt-1 text-slate-500">
                        Add your work background, skills, and related experience.
                    </p>

                    <div class="mt-6">
                        <label class="block text-sm font-black text-slate-700">
                            Experience
                        </label>

                        <textarea name="experience"
                                  rows="7"
                                  placeholder="Example: I have experience in technical support, encoding, basic computer tasks, and customer assistance."
                                  class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-4 font-semibold focus:border-[#003b6f] focus:ring-[#003b6f]"
                                  required>{{ old('experience', $currentProfile->experience) }}</textarea>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-end gap-3">
                    <a href="{{ route('pwd.dashboard') }}"
                       class="rounded-2xl border border-slate-200 bg-white px-7 py-4 text-center font-black text-slate-600 hover:bg-slate-50 transition">
                        Cancel
                    </a>

                    <button type="submit"
                            class="rounded-2xl bg-[#003b6f] px-7 py-4 font-black text-white shadow-lg hover:bg-[#005b96] transition">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>

        <div class="space-y-6">

            <div class="rounded-3xl bg-white p-7 shadow-sm border border-slate-100">
                <h2 class="text-2xl font-black text-[#003b6f]">Registry Preview</h2>

                @if($selectedRegistry)
                    <div class="mt-5 space-y-4 text-sm">
                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-slate-400 font-bold uppercase text-xs">PWD ID Number</p>
                            <p class="mt-1 font-black text-slate-800">{{ $selectedRegistry->id_number ?? 'N/A' }}</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-slate-400 font-bold uppercase text-xs">Full Name</p>
                            <p class="mt-1 font-black text-slate-800">
                                {{ $selectedRegistry->first_name ?? '' }}
                                {{ $selectedRegistry->middle_name ?? '' }}
                                {{ $selectedRegistry->last_name ?? '' }}
                            </p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-slate-400 font-bold uppercase text-xs">Disability Type</p>
                            <p class="mt-1 font-black text-slate-800">{{ $selectedRegistry->disability_type ?? 'N/A' }}</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-slate-400 font-bold uppercase text-xs">Verification Status</p>
                            <p class="mt-1 font-black text-green-700">
                                {{ ucfirst($selectedRegistry->verification_status ?? 'pending') }}
                            </p>
                        </div>
                    </div>
                @else
                    <div class="mt-5 rounded-2xl bg-orange-50 border border-orange-100 p-5 text-orange-700">
                        <p class="font-black">No registry record selected</p>
                        <p class="mt-1 text-sm">
                            Select a registry reference to connect your PWD profile.
                        </p>
                    </div>
                @endif
            </div>

            <div class="rounded-3xl bg-[#003b6f] p-7 text-white shadow-lg">
                <h2 class="text-2xl font-black">Profile Checklist</h2>

                <div class="mt-5 space-y-4 text-sm">
                    <div class="flex items-center gap-3">
                        <span class="h-8 w-8 rounded-full bg-white/15 flex items-center justify-center">
                            {{ $currentProfile->registry_reference_id ? '✓' : '○' }}
                        </span>
                        <span>Registry Reference</span>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="h-8 w-8 rounded-full bg-white/15 flex items-center justify-center">
                            {{ $currentProfile->contact_number ? '✓' : '○' }}
                        </span>
                        <span>Contact Number</span>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="h-8 w-8 rounded-full bg-white/15 flex items-center justify-center">
                            {{ $currentProfile->education ? '✓' : '○' }}
                        </span>
                        <span>Education</span>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="h-8 w-8 rounded-full bg-white/15 flex items-center justify-center">
                            {{ $currentProfile->experience ? '✓' : '○' }}
                        </span>
                        <span>Experience</span>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

</x-pwd-layout>
