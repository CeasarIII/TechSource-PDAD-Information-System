<x-public-layout title="Terms and Conditions - PDAD Employment Portal">
    <main class="min-h-screen bg-slate-100 py-12 px-6">
        <div class="max-w-5xl mx-auto bg-white rounded-3xl shadow-xl border border-slate-200 p-8 md:p-12">
            <div class="mb-10">
                <a href="{{ route('register') }}" class="text-sm font-bold text-[#009688] hover:underline">
                    ← Back to Register
                </a>

                <h1 class="text-4xl font-extrabold text-[#003b6f] mt-6">
                    Terms and Conditions
                </h1>

                <p class="text-slate-500 mt-3">
                    PDAD Employment Portal — PWD Employment Matching System
                </p>
            </div>

            <div class="space-y-8 text-slate-700 leading-8">
                <section>
                    <h2 class="text-xl font-bold text-[#003b6f]">1. Acceptance of Terms</h2>
                    <p class="mt-2">
                        By creating an account or using the PDAD Employment Portal, you agree to follow these Terms and Conditions.
                        If you do not agree, please do not continue using the system.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-[#003b6f]">2. Purpose of the Portal</h2>
                    <p class="mt-2">
                        This portal is designed to support persons with disabilities in finding inclusive employment opportunities
                        through profile creation, ability-based matching, employer access, verification, and application tracking.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-[#003b6f]">3. User Responsibilities</h2>
                    <p class="mt-2">
                        Users must provide accurate, complete, and truthful information. Users must not submit false documents,
                        impersonate another person, misuse the system, or interfere with the portal’s operation.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-[#003b6f]">4. PWD Verification</h2>
                    <p class="mt-2">
                        PWD applicants may be required to upload supporting documents such as a PWD ID or other valid proof.
                        Submitted information will be reviewed for verification before full access to certain features is granted.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-[#003b6f]">5. Employer Responsibilities</h2>
                    <p class="mt-2">
                        Employers must post legitimate job vacancies, provide inclusive hiring practices, and avoid discrimination
                        based on disability, age, gender, religion, or other protected characteristics.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-[#003b6f]">6. Job Matching and Recommendations</h2>
                    <p class="mt-2">
                        The portal may provide job recommendations based on applicant skills, profile information, accessibility needs,
                        and employer requirements. Recommendations are system-generated and do not guarantee hiring or employment.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-[#003b6f]">7. Account Security</h2>
                    <p class="mt-2">
                        Users are responsible for keeping their login credentials secure. Any suspicious activity should be reported
                        immediately to the system administrator.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-[#003b6f]">8. Suspension or Termination</h2>
                    <p class="mt-2">
                        The administrator may suspend or restrict accounts that submit false information, violate these terms,
                        abuse system features, or compromise portal security.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-[#003b6f]">9. Data Protection</h2>
                    <p class="mt-2">
                        The portal handles personal and sensitive information with care. Users are encouraged to review the Privacy
                        Consent page to understand how their data is collected, used, stored, and protected.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-[#003b6f]">10. Changes to Terms</h2>
                    <p class="mt-2">
                        These Terms and Conditions may be updated when necessary. Continued use of the portal means that the user
                        accepts the updated terms.
                    </p>
                </section>
            </div>

            <div class="mt-12 p-5 rounded-2xl bg-blue-50 border border-blue-100 text-sm text-slate-600">
                Last updated: {{ date('F d, Y') }}
            </div>
        </div>
    </main>
</x-public-layout>