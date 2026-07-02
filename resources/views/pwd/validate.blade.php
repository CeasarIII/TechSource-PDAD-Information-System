<x-pwd-layout title="PWD ID Validation" header="PWD ID Validation">

    <div class="max-w-4xl mx-auto space-y-6">

        <div class="rounded-3xl bg-white border border-slate-100 p-8 shadow-sm">
            <div class="flex items-start gap-5">
                <div class="h-16 w-16 rounded-3xl bg-blue-50 flex items-center justify-center text-3xl">
                    🪪
                </div>

                <div>
                    <h1 class="text-3xl font-black text-[#003b6f]">PWD ID Verification</h1>
                    <p class="mt-2 text-slate-500">
                        Enter your PWD ID number to verify your registry record and continue completing your profile.
                    </p>
                </div>
            </div>
        </div>

        <div class="rounded-3xl bg-white border border-slate-100 p-8 shadow-sm">
            <form id="validateForm" class="space-y-5">
                @csrf

                <div>
                    <label for="pwd_id_number" class="block font-black text-slate-700 mb-2">
                        PWD ID Number
                    </label>

                    <input
                        type="text"
                        id="pwd_id_number"
                        name="pwd_id_number"
                        class="w-full min-h-[52px] rounded-2xl border-2 border-slate-200 bg-slate-50 px-5 focus:border-[#003b6f] focus:ring-4 focus:ring-blue-100 focus:outline-none"
                        placeholder="Example: 13-7401-000-XXXXXXX"
                        required
                    >
                </div>

                <button
                    type="submit"
                    id="validateBtn"
                    class="w-full rounded-2xl bg-[#003b6f] px-6 py-4 text-white font-black hover:bg-[#005b96] transition shadow-lg"
                >
                    Verify PWD ID
                </button>
            </form>

            <div id="result" class="mt-6"></div>
        </div>

    </div>

    <script>
        document.getElementById('validateForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            const btn = document.getElementById('validateBtn');
            const result = document.getElementById('result');

            btn.disabled = true;
            btn.textContent = 'Verifying...';

            result.innerHTML = `
                <div class="rounded-2xl bg-blue-50 border border-blue-200 p-5 text-blue-700 font-bold">
                    Checking registry record...
                </div>
            `;

            try {
                const response = await fetch("{{ route('pwd.validate') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        pwd_id_number: document.getElementById('pwd_id_number').value
                    })
                });

                const data = await response.json();

                if (data.status === 'valid' || data.valid === true) {
                    result.innerHTML = `
                        <div class="rounded-2xl bg-green-50 border border-green-200 p-5 text-green-700">
                            <p class="font-black text-lg">Verified successfully!</p>
                            <p class="mt-1">Your PWD ID record has been found.</p>
                            <a href="{{ route('pwd.profile.create') }}"
                               class="inline-block mt-4 rounded-xl bg-green-600 px-5 py-3 text-white font-bold">
                                Continue to Profile
                            </a>
                        </div>
                    `;
                } else {
                    result.innerHTML = `
                        <div class="rounded-2xl bg-red-50 border border-red-200 p-5 text-red-700">
                            <p class="font-black text-lg">PWD ID not found</p>
                            <p class="mt-1">${data.message ?? 'Please check your PWD ID number or contact PDAD support.'}</p>
                        </div>
                    `;
                }

            } catch (error) {
                result.innerHTML = `
                    <div class="rounded-2xl bg-red-50 border border-red-200 p-5 text-red-700">
                        <p class="font-black text-lg">Verification error</p>
                        <p class="mt-1">${error.message}</p>
                    </div>
                `;
            }

            btn.disabled = false;
            btn.textContent = 'Verify PWD ID';
        });
    </script>

</x-pwd-layout>