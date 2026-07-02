<x-pwd-layout title="Create PWD Profile" header="Create Profile">

    <div class="max-w-5xl mx-auto space-y-6">

        <div class="rounded-3xl bg-white border border-slate-100 p-8 shadow-sm">
            <h1 class="text-3xl font-black text-[#003b6f]">Complete Your PWD Profile</h1>
            <p class="mt-2 text-slate-500">
                Fill out your profile information to improve job matching and employment recommendation accuracy.
            </p>
        </div>

        <form method="POST" action="{{ route('pwd.profile.store') }}" class="space-y-6">
            @csrf

            <div class="rounded-3xl bg-white border border-slate-100 p-8 shadow-sm">
                <h2 class="text-xl font-black text-[#003b6f] mb-6">Registry Information</h2>

                <label class="block font-bold text-slate-700 mb-2">Registry Reference</label>
                <select
                    name="registry_reference_id"
                    class="w-full min-h-[52px] rounded-2xl border-2 border-slate-200 bg-slate-50 px-5 focus:border-[#003b6f] focus:ring-4 focus:ring-blue-100 focus:outline-none"
                    required
                >
                    <option value="">Select Registry Record</option>

                    @foreach($registryReferences as $registry)
                        <option value="{{ $registry->id }}">
                            Registry ID: {{ $registry->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="rounded-3xl bg-white border border-slate-100 p-8 shadow-sm">
                <h2 class="text-xl font-black text-[#003b6f] mb-6">Personal Details</h2>

                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="block font-bold text-slate-700 mb-2">Contact Number</label>
                        <input
                            type="text"
                            name="contact_number"
                            class="w-full min-h-[52px] rounded-2xl border-2 border-slate-200 bg-slate-50 px-5 focus:border-[#003b6f] focus:ring-4 focus:ring-blue-100 focus:outline-none"
                            placeholder="09XXXXXXXXX"
                        >
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-2">Education</label>
                        <input
                            type="text"
                            name="education"
                            class="w-full min-h-[52px] rounded-2xl border-2 border-slate-200 bg-slate-50 px-5 focus:border-[#003b6f] focus:ring-4 focus:ring-blue-100 focus:outline-none"
                            placeholder="College Level / Graduate / High School"
                        >
                    </div>
                </div>
            </div>

            <div class="rounded-3xl bg-white border border-slate-100 p-8 shadow-sm">
                <h2 class="text-xl font-black text-[#003b6f] mb-6">Experience</h2>

                <textarea
                    name="experience"
                    class="w-full rounded-2xl border-2 border-slate-200 bg-slate-50 px-5 py-4 focus:border-[#003b6f] focus:ring-4 focus:ring-blue-100 focus:outline-none"
                    rows="6"
                    placeholder="Describe your work experience, internships, skills, or training background."
                ></textarea>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 justify-end">
                <a href="{{ route('pwd.dashboard') }}"
                   class="rounded-2xl border border-slate-300 px-6 py-3 font-black text-slate-600 hover:bg-slate-50 text-center">
                    Cancel
                </a>

                <button
                    type="submit"
                    class="rounded-2xl bg-[#003b6f] px-8 py-3 font-black text-white hover:bg-[#005b96] transition shadow-lg"
                >
                    Save Profile
                </button>
            </div>
        </form>

    </div>

</x-pwd-layout>