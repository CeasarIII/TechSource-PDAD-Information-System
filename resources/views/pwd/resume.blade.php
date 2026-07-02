<x-pwd-layout title="Resume & Certificates" header="Resume & Certificates">
    <div class="rounded-3xl bg-white p-7 shadow-sm border border-slate-100">
        <h1 class="text-3xl font-black text-[#003b6f]">Resume & Certificates</h1>
        <p class="text-slate-500 mt-2">Upload your resume and supporting documents for employer review.</p>

        <form class="mt-8 space-y-6">
            <div class="rounded-3xl border border-dashed border-slate-300 bg-slate-50 p-6">
                <label class="block font-black text-slate-700">Resume File</label>
                <input type="file" class="mt-3 w-full rounded-2xl bg-white border border-slate-200 p-4">
                <p class="text-sm text-slate-500 mt-2">Accepted: PDF, DOCX</p>
            </div>

            <div class="rounded-3xl border border-dashed border-slate-300 bg-slate-50 p-6">
                <label class="block font-black text-slate-700">Certificates</label>
                <input type="file" multiple class="mt-3 w-full rounded-2xl bg-white border border-slate-200 p-4">
                <p class="text-sm text-slate-500 mt-2">Upload trainings, seminars, or skill certificates.</p>
            </div>

            <button type="button" class="rounded-2xl bg-[#003b6f] px-7 py-3 text-white font-black hover:bg-[#005b96] transition">
                Upload Documents
            </button>
        </form>
    </div>
</x-pwd-layout>