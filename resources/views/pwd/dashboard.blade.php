<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            PWD Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white p-6 rounded-lg shadow">
                Welcome PWD User
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="font-semibold text-lg mb-3">
                    Predicted Suitable Employment Type
                </h3>

                @if($prediction)
                    <p>
                        Type:
                        <strong>{{ $prediction->predicted_type ?? 'Not available' }}</strong>
                    </p>

                    <p>
                        Confidence:
                        <strong>{{ number_format(($prediction->confidence ?? 0) * 100, 1) }}%</strong>
                    </p>

                    <p>
                        Generated:
                        <strong>{{ $prediction->generated_at?->format('M d, Y h:i A') ?? 'Not yet generated' }}</strong>
                    </p>
                @else
                    <p class="text-gray-600">
                        Complete your profile to generate your employment type prediction.
                    </p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>