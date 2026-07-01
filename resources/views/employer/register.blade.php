<x-guest-layout>
    <form method="POST" action="{{ route('employer.register') }}">
        @csrf

        <div>
            <x-input-label for="company_name" value="Company Name" />
            <x-text-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" required />
        </div>

        <div class="mt-4">
            <x-input-label for="contact_person" value="Contact Person" />
            <x-text-input id="contact_person" class="block mt-1 w-full" type="text" name="contact_person" required />
        </div>

        <div class="mt-4">
            <x-input-label for="company_email" value="Company Email" />
            <x-text-input id="company_email" class="block mt-1 w-full" type="email" name="company_email" required />
        </div>

        <div class="mt-4">
            <x-input-label for="company_phone" value="Company Phone" />
            <x-text-input id="company_phone" class="block mt-1 w-full" type="text" name="company_phone" />
        </div>

        <div class="mt-4">
            <x-input-label for="company_address" value="Company Address" />
            <textarea id="company_address" name="company_address" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required></textarea>
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Confirm Password" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                Register Employer
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>