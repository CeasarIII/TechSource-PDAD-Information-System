<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Terms and Conditions
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">

                <h3 class="text-2xl font-bold mb-4">
                    PDAD Employment Matching System
                </h3>

                <p class="mb-4">
                    Welcome to the Predictive Ability-Based Employment Matching and Recommender System for Persons with Disabilities (PWDs).
                </p>

                <p class="mb-4">
                    By using this system, you agree that your personal information may be collected,
                    stored, processed, and used only for employment matching,
                    profile verification, recommendation generation, and other system-related services.
                </p>

                <p class="mb-4">
                    Your information will remain confidential and will only be accessible
                    to authorized personnel and verified employers in accordance with
                    applicable data privacy regulations.
                </p>

                <p class="mb-6">
                    Please read these Terms and Conditions carefully before proceeding.
                </p>

                <form method="POST" action="{{ route('terms.accept') }}">
                    @csrf

                    <div class="mb-6">
                        <label class="flex items-center">
                            <input
                                type="checkbox"
                                required
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            >

                            <span class="ml-2">
                                I have read and agree to the Terms and Conditions.
                            </span>
                        </label>
                    </div>

                    <button
                        type="submit"
                        style="background: blue; color: white; padding: 10px 20px; border-radius: 6px;"
                    >
                        Accept and Continue
                    </button>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>