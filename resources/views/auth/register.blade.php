<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - PDAD Employment Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>[x-cloak]{display:none!important}</style>
</head>

<body>
    <div x-data="{ showTerms: false, showPrivacy: false }" class="min-h-screen bg-slate-100 grid lg:grid-cols-2">

        {{-- LEFT PANEL --}}
        <section
            class="hidden lg:flex relative overflow-hidden text-white flex-col justify-between p-14 bg-cover bg-center"
            style="
                background-image:
                linear-gradient(rgba(0, 45, 90, 0.58), rgba(0, 27, 60, 0.82)),
                url('{{ asset('images/Mandaluyong_Cityhall.jpg') }}');
            "
        >
            <div class="absolute inset-0 bg-gradient-to-br from-[#003b6f]/55 via-[#003b6f]/25 to-[#071a3d]/70"></div>
            <div class="absolute inset-0 backdrop-blur-[0.2px]"></div>
            <div class="absolute -top-28 -left-28 w-[420px] h-[420px] rounded-full bg-white/10 blur-2xl"></div>
            <div class="absolute bottom-[-120px] right-[-80px] w-[500px] h-[500px] rounded-full bg-[#009688]/20 blur-2xl"></div>

            <div class="relative z-10">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('images/pdad_logo.jpg') }}" alt="PDAD Logo" class="w-16 h-16 rounded-full bg-white object-contain p-1 shadow-lg">

                    <div>
                        <h1 class="text-3xl font-extrabold">PDAD Employment Portal</h1>
                        <p class="text-blue-100">PWD Employment Matching System</p>
                    </div>
                </div>

                <div class="mt-16">
                    <span class="inline-flex items-center px-4 py-2 rounded-full bg-white/15 border border-white/25 text-sm font-bold text-white shadow-lg backdrop-blur">
                        🏛️ Mandaluyong City Workforce Portal
                    </span>

                    <h2 class="mt-8 text-6xl font-black leading-tight drop-shadow-xl">
                        Create Your<br>
                        Inclusive Career<br>
                        Access
                    </h2>

                    <p class="mt-8 max-w-xl text-lg leading-9 text-blue-50 drop-shadow">
                        Register as a PWD applicant, employer, or administrator and access a secure platform designed
                        for inclusive hiring, profile verification, and ability-based job matching.
                    </p>
                </div>
            </div>

            <div class="relative z-10">
                <div class="grid grid-cols-3 gap-5">
                    <div class="bg-white/15 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-xl">
                        <div class="text-4xl font-extrabold text-[#00d0b7]">2,847</div>
                        <div class="text-blue-50 mt-2">Active Applicants</div>
                    </div>

                    <div class="bg-white/15 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-xl">
                        <div class="text-4xl font-extrabold text-[#00d0b7]">94%</div>
                        <div class="text-blue-50 mt-2">Match Accuracy</div>
                    </div>

                    <div class="bg-white/15 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-xl">
                        <div class="text-4xl font-extrabold text-[#00d0b7]">512</div>
                        <div class="text-blue-50 mt-2">Partner Employers</div>
                    </div>
                </div>

                <div class="mt-10 text-sm text-blue-100 drop-shadow">
                    WCAG 2.1 AA Compliant · Section 508 Ready · Government-Grade Security
                </div>
            </div>
        </section>

        {{-- RIGHT PANEL --}}
        <section class="flex items-center justify-center px-6 py-10 bg-slate-100">
            <div class="w-full max-w-lg bg-white rounded-3xl shadow-2xl border border-slate-200 p-8">
                <div class="lg:hidden flex justify-center mb-8">
                    <img src="{{ asset('images/pdad_logo.jpg') }}" alt="PDAD Logo" class="w-20 h-20 rounded-full object-contain bg-white">
                </div>

                <div class="mb-7">
                    <h2 class="text-3xl font-extrabold text-[#003b6f]">Create an account</h2>
                    <p class="text-slate-500 mt-2">Register to access the PDAD Employment Portal</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-5">
                        <label class="block text-sm font-bold text-[#003b6f] mb-3">Select your role</label>

                        <div class="grid grid-cols-3 gap-3">
                            <label class="cursor-pointer">
                                <input type="radio" name="role" value="pwd" class="peer sr-only" checked>
                                <div class="min-h-[76px] rounded-2xl border-2 border-slate-200 flex flex-col items-center justify-center text-sm text-slate-600 peer-checked:border-[#009688] peer-checked:bg-teal-50 peer-checked:text-[#009688] transition">
                                    <span class="text-xl">♿</span>
                                    <span>PWD</span>
                                </div>
                            </label>

                            <label class="cursor-pointer">
                                <input type="radio" name="role" value="employer" class="peer sr-only">
                                <div class="min-h-[76px] rounded-2xl border-2 border-slate-200 flex flex-col items-center justify-center text-sm text-slate-600 peer-checked:border-[#003b6f] peer-checked:bg-blue-50 peer-checked:text-[#003b6f] transition">
                                    <span class="text-xl">🏢</span>
                                    <span>Employer</span>
                                </div>
                            </label>

                            <label class="cursor-pointer">
                                <input type="radio" name="role" value="admin" class="peer sr-only">
                                <div class="min-h-[76px] rounded-2xl border-2 border-slate-200 flex flex-col items-center justify-center text-sm text-slate-600 peer-checked:border-orange-500 peer-checked:bg-orange-50 peer-checked:text-orange-600 transition">
                                    <span class="text-xl">🛡️</span>
                                    <span>Admin</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label for="name" class="block text-sm font-bold text-[#003b6f] mb-2">Full Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Juan Dela Cruz" class="w-full min-h-[48px] rounded-xl border-2 border-[#003b6f] bg-slate-100 px-4 focus:ring-4 focus:ring-blue-100 focus:outline-none">
                        @error('name') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-5">
                        <label for="email" class="block text-sm font-bold text-[#003b6f] mb-2">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="you@example.gov.ph" class="w-full min-h-[48px] rounded-xl border-2 border-[#003b6f] bg-slate-100 px-4 focus:ring-4 focus:ring-blue-100 focus:outline-none">
                        @error('email') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="mb-5">
                            <label for="password" class="block text-sm font-bold text-[#003b6f] mb-2">Password</label>
                            <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" class="w-full min-h-[48px] rounded-xl border-2 border-[#003b6f] bg-slate-100 px-4 focus:ring-4 focus:ring-blue-100 focus:outline-none">
                            @error('password') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-5">
                            <label for="password_confirmation" class="block text-sm font-bold text-[#003b6f] mb-2">Confirm</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" class="w-full min-h-[48px] rounded-xl border-2 border-[#003b6f] bg-slate-100 px-4 focus:ring-4 focus:ring-blue-100 focus:outline-none">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="flex items-start gap-3 text-sm text-slate-600 leading-6">
                            <input type="checkbox" name="terms" value="1" required class="mt-1 rounded border-slate-300 text-[#003b6f] focus:ring-[#003b6f]">

                            <span>
                                I agree to the
                                <button type="button" @click="showTerms = true" class="font-bold text-[#009688] hover:underline">
                                    Terms and Conditions
                                </button>
                                and
                                <button type="button" @click="showPrivacy = true" class="font-bold text-[#009688] hover:underline">
                                    Privacy Consent
                                </button>.
                            </span>
                        </label>

                        @error('terms')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full min-h-[52px] rounded-xl bg-[#003b6f] text-white font-extrabold hover:bg-[#002f59] transition shadow-lg">
                        Create account
                    </button>

                    <p class="text-center text-sm text-slate-500 mt-6">
                        Already have an account?
                        <a href="{{ route('login') }}" class="font-bold text-[#009688] hover:underline">Sign in</a>
                    </p>
                </form>
            </div>
        </section>

        {{-- TERMS MODAL --}}
        <div x-show="showTerms" x-cloak x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 px-4">
            <div @click.outside="showTerms = false" class="bg-white w-full max-w-3xl max-h-[85vh] overflow-y-auto rounded-3xl shadow-2xl p-8">
                <div class="flex justify-between gap-4 border-b pb-4 mb-6">
                    <div>
                        <h2 class="text-2xl font-extrabold text-[#003b6f]">Terms and Conditions</h2>
                        <p class="text-sm text-slate-500">PDAD Employment Portal</p>
                    </div>
                    <button type="button" @click="showTerms = false" class="text-3xl font-bold text-slate-500">×</button>
                </div>

                <div class="space-y-5 text-sm leading-7 text-slate-700">
                    <p><strong>1. Acceptance.</strong> By creating an account or using the portal, you agree to follow these Terms and Conditions.</p>
                    <p><strong>2. Purpose.</strong> The portal supports PWD applicants, employers, and administrators through inclusive employment matching, verification, and application monitoring.</p>
                    <p><strong>3. Accurate Information.</strong> Users must submit true and complete information. False details, fake documents, or impersonation may lead to account restriction.</p>
                    <p><strong>4. PWD Verification.</strong> PWD applicants may be required to submit PWD ID and supporting documents before full access to selected services is granted.</p>
                    <p><strong>5. Employer Responsibility.</strong> Employers must post legitimate vacancies and follow fair, inclusive, and non-discriminatory hiring practices.</p>
                    <p><strong>6. Job Matching.</strong> Recommendations may be generated based on skills, profile information, work preferences, and accessibility needs. Recommendations do not guarantee hiring.</p>
                    <p><strong>7. Account Security.</strong> Users are responsible for keeping their login credentials safe and reporting suspicious account activity.</p>
                    <p><strong>8. Suspension.</strong> The system administrator may suspend accounts involved in misuse, false submissions, abusive behavior, or security violations.</p>
                    <p><strong>9. Changes.</strong> These terms may be updated when the system changes or when legal requirements need to be followed.</p>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="button" @click="showTerms = false" class="px-6 py-3 rounded-xl bg-[#003b6f] text-white font-bold">
                        I Understand
                    </button>
                </div>
            </div>
        </div>

        {{-- PRIVACY MODAL --}}
        <div x-show="showPrivacy" x-cloak x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 px-4">
            <div @click.outside="showPrivacy = false" class="bg-white w-full max-w-3xl max-h-[85vh] overflow-y-auto rounded-3xl shadow-2xl p-8">
                <div class="flex justify-between gap-4 border-b pb-4 mb-6">
                    <div>
                        <h2 class="text-2xl font-extrabold text-[#003b6f]">Privacy Consent</h2>
                        <p class="text-sm text-slate-500">Data Privacy Act-aligned consent notice</p>
                    </div>
                    <button type="button" @click="showPrivacy = false" class="text-3xl font-bold text-slate-500">×</button>
                </div>

                <div class="space-y-5 text-sm leading-7 text-slate-700">
                    <p><strong>1. Consent.</strong> By registering, you allow the portal to collect and process information needed for employment matching and verification services.</p>
                    <p><strong>2. Data Collected.</strong> The system may collect name, email, role, contact details, skills, work preferences, uploaded documents, and verification status.</p>
                    <p><strong>3. Sensitive Information.</strong> PWD-related information and documents are treated as sensitive data and are used only for verification and accessibility-based matching.</p>
                    <p><strong>4. Purpose of Use.</strong> Data may be used for account creation, profile management, PWD verification, job recommendations, application tracking, reports, and security.</p>
                    <p><strong>5. Employer Access.</strong> Employers may only view information relevant to job applications, recruitment, and compatibility matching.</p>
                    <p><strong>6. Admin Access.</strong> Authorized administrators may review documents, verification data, and system records for compliance and monitoring.</p>
                    <p><strong>7. Security.</strong> The system applies reasonable safeguards to protect personal information from unauthorized access, misuse, or disclosure.</p>
                    <p><strong>8. User Rights.</strong> Users may request correction, updating, or deletion of their information subject to system requirements and applicable law.</p>
                    <p><strong>9. Retention.</strong> Information may be kept while the account is active or as needed for audit, employment records, and legal compliance.</p>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="button" @click="showPrivacy = false" class="px-6 py-3 rounded-xl bg-[#009688] text-white font-bold">
                        I Understand
                    </button>
                </div>
            </div>
        </div>

    </div>
</body>
</html>