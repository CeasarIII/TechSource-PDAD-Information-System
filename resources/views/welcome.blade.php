<x-public-layout title="PDAD Employment Portal">
    <div class="min-h-screen bg-white text-[#003b6f]">
        <header x-data="{ open: false }" class="bg-white border-b border-slate-200 sticky top-0 z-50 shadow-sm">
            <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
                <a href="/" class="flex items-center gap-3">
                    <img src="{{ asset('images/pdad_logo.jpg') }}" alt="PDAD Logo" class="w-12 h-12 rounded-full object-contain">
                    <div>
                        <h1 class="text-xl font-extrabold leading-none">PDAD Employment Portal</h1>
                        <p class="text-xs text-slate-500 mt-1">PWD Employment Matching System</p>
                    </div>
                </a>

                <nav class="hidden lg:flex items-center gap-7 text-sm font-semibold text-slate-600">
                    <a href="#portals" class="hover:text-[#003b6f]">Portals</a>
                    <a href="#how" class="hover:text-[#003b6f]">How It Works</a>
                    <a href="#accessibility" class="hover:text-[#003b6f]">Accessibility</a>
                    <a href="#compliance" class="hover:text-[#003b6f]">Compliance</a>
                    <a href="#faq" class="hover:text-[#003b6f]">FAQ</a>
                </nav>

                <div class="hidden md:flex gap-2">
                    <a href="{{ route('login') }}" class="px-5 py-2.5 rounded-xl border border-[#003b6f] text-[#003b6f] text-sm font-bold hover:bg-blue-50">Login</a>
                    <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-xl bg-[#003b6f] text-white text-sm font-bold hover:bg-[#002f59]">Register</a>
                </div>

                <button @click="open = !open" class="lg:hidden w-11 h-11 rounded-xl border border-slate-300 flex items-center justify-center text-[#003b6f] font-bold">
                    ☰
                </button>
            </div>

            <div x-show="open" x-transition class="lg:hidden border-t border-slate-200 bg-white">
                <div class="px-6 py-4 space-y-3 text-sm font-semibold text-slate-700">
                    <a href="#portals" @click="open = false" class="block">Portals</a>
                    <a href="#how" @click="open = false" class="block">How It Works</a>
                    <a href="#accessibility" @click="open = false" class="block">Accessibility</a>
                    <a href="#compliance" @click="open = false" class="block">Compliance</a>
                    <a href="#faq" @click="open = false" class="block">FAQ</a>

                    <div class="grid grid-cols-2 gap-2 pt-3">
                        <a href="{{ route('login') }}" class="text-center px-4 py-3 rounded-xl border border-[#003b6f] text-[#003b6f] font-bold">Login</a>
                        <a href="{{ route('register') }}" class="text-center px-4 py-3 rounded-xl bg-[#003b6f] text-white font-bold">Register</a>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <section class="relative overflow-hidden bg-gradient-to-br from-[#003b6f] via-[#0b4fba] to-[#123fae] text-white">
                <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_20%_20%,white,transparent_25%),radial-gradient(circle_at_80%_30%,white,transparent_20%)]"></div>

                <div class="relative max-w-7xl mx-auto px-6 pt-20 pb-28 grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <span class="inline-flex bg-yellow-400 text-[#003b6f] text-xs font-extrabold px-4 py-2 rounded-full mb-6 shadow">
                            Official Government Employment Portal
                        </span>

                        <h2 class="text-5xl md:text-6xl font-extrabold leading-tight">
                            Empowering <span class="text-yellow-300">PWDs</span> Through Meaningful Employment
                        </h2>

                        <p class="mt-6 text-blue-100 max-w-xl text-lg leading-relaxed">
                            Connecting persons with disabilities to inclusive employers through ability-based job matching,
                            skill assessment, verification, and accessible employment support.
                        </p>

                        <div class="mt-8 flex flex-wrap gap-3">
                            <a href="{{ route('register') }}" class="bg-yellow-400 text-[#003b6f] px-6 py-3 rounded-xl font-extrabold shadow-lg hover:bg-yellow-300">
                                Apply as PWD Applicant
                            </a>
                            <a href="{{ route('register') }}" class="bg-white/10 border border-white/30 text-white px-6 py-3 rounded-xl font-extrabold hover:bg-white/20">
                                Register as Employer
                            </a>
                        </div>

                        <div class="mt-6 flex flex-wrap gap-5 text-xs text-blue-100 font-semibold">
                            <span>🔒 Secure & Private</span>
                            <span>♿ WCAG 2.1 Compliant</span>
                            <span>🛡️ Data Protected</span>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="absolute -top-8 -right-8 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>

                        <div class="relative bg-white/10 backdrop-blur rounded-3xl p-6 shadow-2xl border border-white/20">
                            <div class="flex justify-between items-center mb-5">
                                <span class="font-bold">Employment Matching Stats</span>
                                <span class="bg-green-400 text-green-950 px-3 py-1 rounded-full text-xs font-bold">Verified Portal</span>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-white/10 rounded-xl p-5 border border-white/10">
                                    <p class="text-3xl font-extrabold text-yellow-300">12,480+</p>
                                    <p class="text-sm text-blue-100">PWDs Registered</p>
                                </div>
                                <div class="bg-white/10 rounded-xl p-5 border border-white/10">
                                    <p class="text-3xl font-extrabold text-green-300">3,256</p>
                                    <p class="text-sm text-blue-100">Successfully Hired</p>
                                </div>
                                <div class="bg-white/10 rounded-xl p-5 border border-white/10">
                                    <p class="text-3xl font-extrabold text-purple-300">890+</p>
                                    <p class="text-sm text-blue-100">Partner Employers</p>
                                </div>
                                <div class="bg-white/10 rounded-xl p-5 border border-white/10">
                                    <p class="text-3xl font-extrabold text-orange-300">78%</p>
                                    <p class="text-sm text-blue-100">Placement Rate</p>
                                </div>
                            </div>

                            <div class="mt-6">
                                <div class="flex justify-between text-xs mb-2 font-semibold">
                                    <span>Job Placement Rate</span>
                                    <span>78%</span>
                                </div>
                                <div class="h-3 bg-white/20 rounded-full overflow-hidden">
                                    <div class="h-full w-[78%] bg-yellow-400 rounded-full"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="absolute bottom-0 left-0 right-0">
                    <svg viewBox="0 0 1440 120" class="w-full h-20 fill-white">
                        <path d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,42.7C1120,32,1280,32,1360,32L1440,32L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"></path>
                    </svg>
                </div>
            </section>

            <section class="bg-white">
                <div class="max-w-7xl mx-auto px-6 -mt-8 relative z-10">
                    <div class="bg-white rounded-2xl shadow-xl border border-slate-200 grid grid-cols-2 md:grid-cols-4 gap-6 text-center py-8">
                        <div>
                            <p class="text-3xl font-extrabold text-[#003b6f]">12,480+</p>
                            <p class="text-sm text-slate-500">PWD Applicants</p>
                        </div>
                        <div>
                            <p class="text-3xl font-extrabold text-[#009688]">3,256</p>
                            <p class="text-sm text-slate-500">Successful Placements</p>
                        </div>
                        <div>
                            <p class="text-3xl font-extrabold text-purple-500">890+</p>
                            <p class="text-sm text-slate-500">Partner Employers</p>
                        </div>
                        <div>
                            <p class="text-3xl font-extrabold text-orange-500">78%</p>
                            <p class="text-sm text-slate-500">Placement Rate</p>
                        </div>
                    </div>
                </div>
            </section>

            <section id="portals" class="py-20 bg-white">
                <div class="max-w-7xl mx-auto px-6">
                    <div class="text-center mb-12">
                        <span class="text-xs bg-blue-100 text-[#003b6f] px-3 py-1 rounded-full font-bold">Get Started</span>
                        <h2 class="text-3xl font-extrabold text-[#003b6f] mt-3">Choose Your Portal</h2>
                        <p class="text-slate-500 mt-2">Access tools and services based on your role.</p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
                        <div class="bg-white rounded-3xl border border-slate-200 shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 p-8 flex flex-col">
                            <div class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center text-3xl mb-6">♿</div>
                            <h3 class="text-2xl font-extrabold text-[#003b6f]">PWD Applicant</h3>
                            <p class="text-slate-500 mt-4 leading-7">
                                Create your profile, complete your ability assessment, receive AI-powered job recommendations, and monitor all applications.
                            </p>

                            <div class="mt-6 space-y-3 text-slate-600 text-sm">
                                <div>✅ AI Job Matching</div>
                                <div>✅ Ability Assessment</div>
                                <div>✅ PWD Verification</div>
                                <div>✅ Resume Builder</div>
                                <div>✅ Application Tracking</div>
                            </div>

                            <div class="mt-auto pt-8 flex gap-3">
                                <a href="{{ route('register') }}" class="flex-1 py-3 rounded-xl bg-[#003b6f] text-center text-white font-bold hover:bg-[#002e57]">Register</a>
                                <a href="{{ route('login') }}" class="flex-1 py-3 rounded-xl border border-[#003b6f] text-center text-[#003b6f] font-bold hover:bg-blue-50">Login</a>
                            </div>
                        </div>

                        <div class="bg-white rounded-3xl border border-slate-200 shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 p-8 flex flex-col">
                            <div class="w-16 h-16 rounded-2xl bg-teal-100 flex items-center justify-center text-3xl mb-6">🏢</div>
                            <h3 class="text-2xl font-extrabold text-[#003b6f]">Employer</h3>
                            <p class="text-slate-500 mt-4 leading-7">
                                Post inclusive vacancies, review matched applicants, rank candidates by compatibility, and track hiring progress.
                            </p>

                            <div class="mt-6 space-y-3 text-slate-600 text-sm">
                                <div>✅ Post Job Vacancies</div>
                                <div>✅ Candidate Ranking</div>
                                <div>✅ Applicant Tracking</div>
                                <div>✅ Interview Scheduling</div>
                                <div>✅ Compliance Reports</div>
                            </div>

                            <div class="mt-auto pt-8 flex gap-3">
                                <a href="{{ route('register') }}" class="flex-1 py-3 rounded-xl bg-[#009688] text-center text-white font-bold hover:bg-[#007f75]">Register</a>
                                <a href="{{ route('login') }}" class="flex-1 py-3 rounded-xl border border-[#009688] text-center text-[#009688] font-bold hover:bg-teal-50">Login</a>
                            </div>
                        </div>

                        <div class="bg-white rounded-3xl border border-slate-200 shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 p-8 flex flex-col">
                            <div class="w-16 h-16 rounded-2xl bg-purple-100 flex items-center justify-center text-3xl mb-6">🛡️</div>
                            <h3 class="text-2xl font-extrabold text-[#003b6f]">Government Admin</h3>
                            <p class="text-slate-500 mt-4 leading-7">
                                Verify credentials, manage users, monitor activity, and generate compliance reports for employment programs.
                            </p>

                            <div class="mt-6 space-y-3 text-slate-600 text-sm">
                                <div>✅ PWD Verification Queue</div>
                                <div>✅ User Management</div>
                                <div>✅ Analytics Dashboard</div>
                                <div>✅ Reports Center</div>
                                <div>✅ Compliance Monitoring</div>
                            </div>

                            <div class="mt-auto pt-8">
                                <a href="{{ route('login') }}" class="block py-3 rounded-xl bg-purple-600 text-center text-white font-bold hover:bg-purple-700">Admin Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="how" class="bg-slate-50 py-20">
                <div class="max-w-7xl mx-auto px-6 text-center">
                    <span class="text-xs bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full font-bold">Our Process</span>
                    <h2 class="text-3xl font-extrabold text-[#003b6f] mt-3">How PDAD Employment Portal Works</h2>
                    <p class="text-slate-500 mt-2">A simple process to connect PWDs with meaningful employment.</p>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-12">
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                            <div class="text-4xl mb-4">🪪</div>
                            <h3 class="font-bold text-[#003b6f]">Register & Verify</h3>
                            <p class="text-sm text-slate-500 mt-2">Create your account and submit your PWD ID for verification.</p>
                        </div>
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                            <div class="text-4xl mb-4">🧠</div>
                            <h3 class="font-bold text-[#003b6f]">Ability Assessment</h3>
                            <p class="text-sm text-slate-500 mt-2">Complete your skill, ability, and work preference profile.</p>
                        </div>
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                            <div class="text-4xl mb-4">🔎</div>
                            <h3 class="font-bold text-[#003b6f]">Smart Matching</h3>
                            <p class="text-sm text-slate-500 mt-2">Receive job matches based on skills and accessibility needs.</p>
                        </div>
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                            <div class="text-4xl mb-4">🤝</div>
                            <h3 class="font-bold text-[#003b6f]">Get Hired</h3>
                            <p class="text-sm text-slate-500 mt-2">Apply with confidence and track your employment progress.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section id="accessibility" class="bg-white py-20">
                <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <span class="text-xs bg-blue-100 text-[#003b6f] px-3 py-1 rounded-full font-bold">Accessibility First</span>
                        <h2 class="text-3xl font-extrabold text-[#003b6f] mt-4">Built for Inclusivity & Accessibility</h2>
                        <p class="text-slate-500 mt-4">
                            The portal supports accessible navigation, readable interfaces, and inclusive employment matching.
                        </p>

                        <div class="mt-8 space-y-4">
                            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                                <h3 class="font-bold text-[#003b6f]">WCAG 2.1 AA Compliant</h3>
                                <p class="text-sm text-slate-500 mt-1">Readable UI, large clickable targets, and accessible navigation.</p>
                            </div>
                            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                                <h3 class="font-bold text-[#003b6f]">Ability-Based Matching</h3>
                                <p class="text-sm text-slate-500 mt-1">Focuses on skills, abilities, and job fit instead of limitations.</p>
                            </div>
                            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                                <h3 class="font-bold text-[#003b6f]">Secure Data Protection</h3>
                                <p class="text-sm text-slate-500 mt-1">Protects sensitive applicant information and employment records.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl border border-slate-200 shadow-lg p-6">
                        <div class="bg-slate-100 rounded-2xl p-5">
                            <div class="bg-[#003b6f] text-white rounded-t-xl px-5 py-3 font-bold">PWD Applicant Dashboard</div>
                            <div class="bg-white rounded-b-xl p-5 space-y-4">
                                <div class="flex justify-between">
                                    <span>Profile Completion</span>
                                    <strong class="text-[#009688]">72%</strong>
                                </div>
                                <div class="h-3 bg-slate-200 rounded-full">
                                    <div class="h-3 bg-[#009688] rounded-full w-[72%]"></div>
                                </div>
                                <div class="grid grid-cols-3 gap-3 text-center">
                                    <div class="bg-blue-50 rounded-xl p-4"><strong class="text-[#003b6f] text-2xl">12</strong><p class="text-xs">Matches</p></div>
                                    <div class="bg-green-50 rounded-xl p-4"><strong class="text-[#009688] text-2xl">3</strong><p class="text-xs">Applied</p></div>
                                    <div class="bg-yellow-50 rounded-xl p-4"><strong class="text-orange-500 text-2xl">1</strong><p class="text-xs">Interview</p></div>
                                </div>
                                <div class="bg-slate-50 rounded-xl p-4">
                                    <p class="text-sm font-bold text-[#003b6f]">Latest Match</p>
                                    <p class="text-sm text-slate-500">Data Entry Specialist · 92% Match</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="compliance" class="bg-slate-50 py-20">
                <div class="max-w-7xl mx-auto px-6 text-center">
                    <span class="text-xs bg-purple-100 text-purple-700 px-3 py-1 rounded-full font-bold">Trust & Compliance</span>
                    <h2 class="text-3xl font-extrabold text-[#003b6f] mt-3">Government Backed & Legally Compliant</h2>
                    <p class="text-slate-500 mt-2">Protecting the rights of persons with disabilities through secure and compliant processes.</p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 text-left">
                            <h3 class="font-bold text-[#003b6f]">Republic Act 7277</h3>
                            <p class="text-sm text-slate-500 mt-2">Supports equal opportunities and welfare of persons with disabilities.</p>
                        </div>
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 text-left">
                            <h3 class="font-bold text-[#003b6f]">Data Privacy Act 2012</h3>
                            <p class="text-sm text-slate-500 mt-2">Protects personal and sensitive information submitted to the system.</p>
                        </div>
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 text-left">
                            <h3 class="font-bold text-[#003b6f]">WCAG 2.1 AA Certified</h3>
                            <p class="text-sm text-slate-500 mt-2">Promotes accessible digital services for all users.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-white py-20">
                <div class="max-w-7xl mx-auto px-6 text-center">
                    <span class="text-xs bg-blue-100 text-[#003b6f] px-3 py-1 rounded-full font-bold">Success Stories</span>
                    <h2 class="text-3xl font-extrabold text-[#003b6f] mt-3">Lives Changed Through Employment</h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10 text-left">
                        <div class="bg-blue-50 rounded-2xl border border-blue-100 p-6">
                            <p class="text-yellow-500">★★★★★</p>
                            <p class="text-sm text-slate-600 mt-3">“PDAD Employment Portal helped me find a job that matches my skills and accessibility needs.”</p>
                            <p class="font-bold text-[#003b6f] mt-5">Maria Santos</p>
                        </div>
                        <div class="bg-green-50 rounded-2xl border border-green-100 p-6">
                            <p class="text-yellow-500">★★★★★</p>
                            <p class="text-sm text-slate-600 mt-3">“The matching system made our hiring process more inclusive and organized.”</p>
                            <p class="font-bold text-[#003b6f] mt-5">Roberto Cruz</p>
                        </div>
                        <div class="bg-purple-50 rounded-2xl border border-purple-100 p-6">
                            <p class="text-yellow-500">★★★★★</p>
                            <p class="text-sm text-slate-600 mt-3">“The verification and application tracking helped me apply with confidence.”</p>
                            <p class="font-bold text-[#003b6f] mt-5">Ana Reyes</p>
                        </div>
                    </div>
                </div>
            </section>

            <section id="faq" class="bg-slate-50 py-20">
                <div class="max-w-4xl mx-auto px-6">
                    <div class="text-center mb-10">
                        <span class="text-xs bg-blue-100 text-[#003b6f] px-3 py-1 rounded-full font-bold">FAQ</span>
                        <h2 class="text-3xl font-extrabold text-[#003b6f] mt-3">Frequently Asked Questions</h2>
                    </div>

                    <div class="space-y-4">
                        <div x-data="{ open: false }" class="bg-white rounded-2xl border border-slate-200 p-5">
                            <button @click="open = !open" class="w-full flex justify-between items-center font-bold text-[#003b6f]">
                                How do I register as a PWD applicant?
                                <span>+</span>
                            </button>
                            <p x-show="open" x-transition class="text-slate-500 text-sm mt-3">
                                Click Register, choose PWD Applicant, complete your profile, and submit your PWD ID for verification.
                            </p>
                        </div>

                        <div x-data="{ open: false }" class="bg-white rounded-2xl border border-slate-200 p-5">
                            <button @click="open = !open" class="w-full flex justify-between items-center font-bold text-[#003b6f]">
                                How are jobs matched?
                                <span>+</span>
                            </button>
                            <p x-show="open" x-transition class="text-slate-500 text-sm mt-3">
                                Jobs are matched based on skills, ability profile, work preference, and accessibility requirements.
                            </p>
                        </div>

                        <div x-data="{ open: false }" class="bg-white rounded-2xl border border-slate-200 p-5">
                            <button @click="open = !open" class="w-full flex justify-between items-center font-bold text-[#003b6f]">
                                Is my personal data protected?
                                <span>+</span>
                            </button>
                            <p x-show="open" x-transition class="text-slate-500 text-sm mt-3">
                                Yes. The portal follows privacy-focused handling of sensitive user information and credential records.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-[#123fae] text-white py-20">
                <div class="max-w-4xl mx-auto px-6 text-center">
                    <span class="text-xs bg-yellow-400 text-[#003b6f] px-3 py-1 rounded-full font-extrabold">Start Your Journey Today</span>
                    <h2 class="text-4xl font-extrabold mt-5">Ready to Find Your Perfect Job Match?</h2>
                    <p class="text-blue-100 mt-4">Join the PDAD Employment Portal and start your inclusive employment journey.</p>

                    <div class="mt-8 flex justify-center flex-wrap gap-3">
                        <a href="{{ route('register') }}" class="bg-yellow-400 text-[#003b6f] px-6 py-3 rounded-xl font-extrabold">Register as PWD Applicant</a>
                        <a href="{{ route('register') }}" class="bg-white/10 border border-white/30 px-6 py-3 rounded-xl font-extrabold">Register as Employer</a>
                    </div>
                </div>
            </section>
        </main>

        <footer class="bg-[#071a3d] text-white py-12">
            <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-10">
                <div>
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/pdad_logo.jpg') }}" alt="PDAD Logo" class="w-12 h-12 rounded-full object-contain bg-white p-1">
                        <div>
                            <h2 class="text-xl font-bold">PDAD Employment Portal</h2>
                            <p class="text-xs text-blue-200">PWD Employment Matching System</p>
                        </div>
                    </div>
                    <p class="text-sm text-blue-200 mt-4">Building an inclusive and accessible employment ecosystem for Persons with Disabilities.</p>
                </div>

                <div>
                    <h3 class="font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-sm text-blue-200">
                        <li><a href="#" class="hover:text-white">Home</a></li>
                        <li><a href="#portals" class="hover:text-white">PWD Applicant Portal</a></li>
                        <li><a href="#portals" class="hover:text-white">Employer Portal</a></li>
                        <li><a href="#portals" class="hover:text-white">Admin Console</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-bold mb-4">Resources</h3>
                    <ul class="space-y-2 text-sm text-blue-200">
                        <li>FAQs</li>
                        <li>Accessibility Guide</li>
                        <li>Privacy Policy</li>
                        <li>Terms of Use</li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-bold mb-4">Contact Us</h3>
                    <ul class="space-y-2 text-sm text-blue-200">
                        <li>📍 Mandaluyong City</li>
                        <li>✉️ pdad.portal@example.gov.ph</li>
                        <li>☎️ (02) 8888-0000</li>
                        <li>🕘 Mon-Fri, 8:00 AM - 5:00 PM</li>
                    </ul>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-6 mt-10 pt-6 border-t border-white/10 text-center text-sm text-blue-200">
                © 2026 PDAD Employment Portal. All rights reserved.
            </div>
        </footer>
    </div>
</x-public-layout>