<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Employer Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Flash Messages --}}
            @if (session('warning'))
                <div class="bg-yellow-200 border border-yellow-500 text-yellow-900 px-4 py-3 rounded">
                    {{ session('warning') }}
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-200 border border-green-500 text-green-900 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    Welcome, {{ $employer->company_name ?? 'Employer' }}
                </div>
            </div>

            @if ($employer && $employer->verification_status !== 'verified')
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-6 py-4 rounded">
                    Your employer account is currently
                    <strong>{{ strtoupper($employer->verification_status) }}</strong>.
                    You can access the dashboard, but job posting will be available once verified by admin.
                </div>
            @else
                <div class="bg-green-100 border border-green-400 text-green-800 px-6 py-4 rounded">
                    Your employer account is verified. You may now post jobs.
                </div>
            @endif

        </div>
    </div>
</x-app-layout>