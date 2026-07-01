<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <div class="bg-white shadow rounded p-6">
                    <h3 class="text-gray-500">Total PWD Users</h3>
                    <p class="text-3xl font-bold">
                        {{ $stats['total_pwd'] }}
                    </p>
                </div>

                <div class="bg-white shadow rounded p-6">
                    <h3 class="text-gray-500">Total Employers</h3>
                    <p class="text-3xl font-bold">
                        {{ $stats['total_employers'] }}
                    </p>
                </div>

                <div class="bg-white shadow rounded p-6">
                    <h3 class="text-gray-500">Pending Verifications</h3>
                    <p class="text-3xl font-bold text-yellow-600">
                        {{ $stats['pending_verifications'] }}
                    </p>
                </div>

                <div class="bg-white shadow rounded p-6">
                    <h3 class="text-gray-500">Verified Employers</h3>
                    <p class="text-3xl font-bold text-green-600">
                        {{ $stats['verified_employers'] }}
                    </p>
                </div>

                <div class="bg-white shadow rounded p-6">
                    <h3 class="text-gray-500">Total Jobs</h3>
                    <p class="text-3xl font-bold">
                        {{ $stats['total_jobs'] }}
                    </p>
                </div>

                <div class="bg-white shadow rounded p-6">
                    <h3 class="text-gray-500">Open Jobs</h3>
                    <p class="text-3xl font-bold text-blue-600">
                        {{ $stats['open_jobs'] }}
                    </p>
                </div>

                <div class="bg-white shadow rounded p-6">
                    <h3 class="text-gray-500">Total Applications</h3>
                    <p class="text-3xl font-bold">
                        {{ $stats['total_applications'] }}
                    </p>
                </div>

            </div>

            <div class="mt-8 bg-white shadow rounded p-6">
                <h3 class="text-lg font-semibold mb-3">
                    Pending Admin Tasks
                </h3>

                <ul class="list-disc ml-6 space-y-2">
                    <li>Employer Verification Queue</li>
                    <li>Dispute Resolution (Coming Soon)</li>
                    <li>Audit Logs (Member 3)</li>
                    <li>System Reports</li>
                </ul>
            </div>

        </div>
    </div>

</x-app-layout>