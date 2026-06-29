<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            PWD Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    Welcome PWD User
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-3">
                        Predicted Suitable Employment Type
                    </h3>

                    @if ($prediction)
                        <p>
                            Type:
                            <strong>{{ $prediction->predicted_employment_type }}</strong>
                        </p>

                        <p>
                            Confidence:
                            <strong>{{ number_format($prediction->confidence_score * 100, 1) }}%</strong>
                        </p>

                        <p>
                            Model Version:
                            <strong>{{ $prediction->model_version }}</strong>
                        </p>

                        <p>
                            Generated:
                            <strong>{{ $prediction->updated_at->format('M d, Y h:i A') }}</strong>
                        </p>
                    @else
                        <p>
                            Complete your profile to generate your employment type prediction.
                        </p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>