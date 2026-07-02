<x-pwd-layout title="Trainings" header="Trainings">
    <div class="space-y-6">
        <div class="rounded-3xl bg-white p-7 shadow-sm border border-slate-100">
            <h1 class="text-3xl font-black text-[#003b6f]">Recommended Trainings</h1>
            <p class="text-slate-500 mt-2">Suggested trainings based on missing skills and job readiness.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            @foreach([
                ['💻','Digital Literacy','Basic computer, email, and online tools.'],
                ['🗣️','Communication Skills','Workplace communication and interview readiness.'],
                ['📊','Office Productivity','Documents, spreadsheets, and reports.'],
            ] as $training)
                <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition">
                    <div class="text-4xl">{{ $training[0] }}</div>
                    <h2 class="mt-4 text-xl font-black text-[#003b6f]">{{ $training[1] }}</h2>
                    <p class="mt-2 text-slate-500">{{ $training[2] }}</p>
                    <form method="POST" action="{{ route('pwd.trainings.enroll') }}">
    @csrf

    <button
        type="submit"
        class="mt-5 rounded-xl bg-[#003b6f] px-4 py-2 text-white font-bold hover:bg-[#005b96] transition w-full">
        Enroll
    </button>
</form>
                </div>
            @endforeach
        </div>
    </div>
</x-pwd-layout>