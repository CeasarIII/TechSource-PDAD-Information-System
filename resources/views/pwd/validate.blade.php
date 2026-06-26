<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Validate PWD ID
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <h3 class="text-xl font-bold mb-4">
                    PWD ID Verification
                </h3>

                <form id="validateForm">
                    @csrf

                    <label class="block mb-2">
                        PWD ID Number
                    </label>

                    <input
                        type="text"
                        id="pwd_id_number"
                        name="pwd_id_number"
                        class="w-full border rounded px-3 py-2"
                        placeholder="Enter your PWD ID Number"
                        required
                    >

                    <br><br>

                    <button
                        type="submit"
                        style="background: blue; color: white; padding: 10px 20px; border-radius: 6px;"
                    >
                        Verify
                    </button>
                </form>

                <div id="result" style="margin-top: 20px;"></div>

            </div>
        </div>
    </div>

    <script>
        document.getElementById('validateForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            document.getElementById('result').innerHTML = 'Checking...';

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

                document.getElementById('result').innerHTML =
                    '<pre style="background:#f3f4f6; padding:15px; border-radius:6px;">'
                    + JSON.stringify(data, null, 2)
                    + '</pre>';

            } catch (error) {
                document.getElementById('result').innerHTML =
                    '<p style="color:red;">Error: ' + error.message + '</p>';
            }
        });
    </script>
</x-app-layout>