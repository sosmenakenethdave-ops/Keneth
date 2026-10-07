<x-guest-layout>
    @php
        $type = request('type', strtolower($type ?? 'student'));
    @endphp

    <div class="min-h-screen bg-slate-100 flex flex-col font-sans text-slate-800 antialiased">
        
        <!-- Top Header Bar -->
        <header class="bg-blue-600 text-white px-6 py-2.5 flex justify-between items-center shadow-md">
            <span class="text-sm font-semibold tracking-wide">CICT Portal</span>
            <span class="text-sm font-semibold tracking-wide">Schedule Online v1.0</span>
        </header>

        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col items-center justify-center p-4 sm:p-6">
            
            <!-- Registration Form Card -->
            <div class="w-full max-w-lg bg-white rounded-2xl shadow-xl border border-slate-200/80 overflow-hidden">
                
                <!-- Card Header Layout (Side-by-side Header Banner) -->
                <div class="bg-slate-50 border-b border-slate-200 p-5 text-center sm:text-left">
                    <div class="flex flex-col sm:flex-row items-center space-y-3 sm:space-y-0 sm:space-x-4">
                        <!-- Logos -->
                        <div class="flex items-center space-x-2 shrink-0">
                            <img src="{{ asset('images/school-logo.png') }}" 
                                 alt="CFCST Logo" 
                                 class="h-14 w-14 object-contain"
                                 onerror="this.src='https://via.placeholder.com/60?text=CFCST'">
                            <img src="{{ asset('images/cict-logo.png') }}" 
                                 alt="CICT Logo" 
                                 class="h-14 w-14 object-contain"
                                 onerror="this.src='https://via.placeholder.com/60?text=CICT'">
                        </div>
                        
                        <!-- School Title & Registration Badge -->
                        <div>
                            <span class="inline-block px-2.5 py-0.5 bg-blue-100 text-blue-700 font-bold text-xs rounded-full uppercase tracking-wider mb-1">
                                {{ ucfirst($type) }} Registration
                            </span>
                            <h1 class="text-base font-bold text-slate-900 leading-tight">
                                Cotabato Foundation College of Science and Technology
                            </h1>
                            <p class="text-xs text-slate-500 font-medium">Arakan, Cotabato</p>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <form method="POST" action="{{ route('register') }}" class="p-6 space-y-4">
                    @csrf

                    <!-- Hidden Role Field -->
                    <input type="hidden" name="role" value="{{ $type }}">

                    <!-- Full Name -->
                    <div>
                        <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                            placeholder="e.g. {{ $type === 'instructor' ? 'Bergelyn A. Hermo' : 'Juan Dela Cruz' }}"
                            class="w-full px-3.5 py-2 bg-slate-50 border border-slate-300 rounded-lg text-slate-800 text-sm placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-red-500" />
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                            placeholder="e.g. {{ $type === 'instructor' ? 'instructor@cfcst.edu.ph' : 'student@cfcst.edu.ph' }}"
                            class="w-full px-3.5 py-2 bg-slate-50 border border-slate-300 rounded-lg text-slate-800 text-sm placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-500" />
                    </div>

                    {{-- INSTRUCTOR SPECIFIC FIELD --}}
                    @if ($type === 'instructor')
                        <div>
                            <label for="academic_rank" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Academic Rank <span class="text-red-500">*</span>
                            </label>
                            <select id="academic_rank" name="academic_rank" required
                                class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-lg text-slate-800 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                <option value="" disabled selected>Select Academic Rank</option>
                                <option value="Instructor I" {{ old('academic_rank') == 'Instructor I' ? 'selected' : '' }}>Instructor I</option>
                                <option value="Instructor II" {{ old('academic_rank') == 'Instructor II' ? 'selected' : '' }}>Instructor II</option>
                                <option value="Instructor III" {{ old('academic_rank') == 'Instructor III' ? 'selected' : '' }}>Instructor III</option>
                                <option value="Assistant Professor I" {{ old('academic_rank') == 'Assistant Professor I' ? 'selected' : '' }}>Assistant Professor I</option>
                                <option value="Assistant Professor II" {{ old('academic_rank') == 'Assistant Professor II' ? 'selected' : '' }}>Assistant Professor II</option>
                                <option value="Associate Professor" {{ old('academic_rank') == 'Associate Professor' ? 'selected' : '' }}>Associate Professor</option>
                                <option value="Professor" {{ old('academic_rank') == 'Professor' ? 'selected' : '' }}>Professor</option>
                            </select>
                            <x-input-error :messages="$errors->get('academic_rank')" class="mt-1 text-xs text-red-500" />
                        </div>

                    {{-- STUDENT SPECIFIC FIELDS --}}
                    @else
                        <!-- Course, Year Level & Section Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <!-- Course / Program -->
                            <div>
                                <label for="course" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                    Course <span class="text-red-500">*</span>
                                </label>
                                <select id="course" name="course" required
                                    class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-lg text-slate-800 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                    <option value="" disabled selected>Select</option>
                                    <option value="BSIT" {{ old('course') == 'BSIT' ? 'selected' : '' }}>BSIT</option>
                                    <option value="BSCS" {{ old('course') == 'BSCS' ? 'selected' : '' }}>BSCS</option>
                                    <option value="BSEMC" {{ old('course') == 'BSEMC' ? 'selected' : '' }}>BSEMC</option>
                                    <option value="ACT" {{ old('course') == 'ACT' ? 'selected' : '' }}>ACT</option>
                                </select>
                                <x-input-error :messages="$errors->get('course')" class="mt-1 text-xs text-red-500" />
                            </div>

                            <!-- Year Level -->
                            <div>
                                <label for="year_level" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                    Year <span class="text-red-500">*</span>
                                </label>
                                <select id="year_level" name="year_level" required
                                    class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-lg text-slate-800 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                    <option value="" disabled selected>Select</option>
                                    <option value="1st Year" {{ old('year_level') == '1st Year' ? 'selected' : '' }}>1st Year</option>
                                    <option value="2nd Year" {{ old('year_level') == '2nd Year' ? 'selected' : '' }}>2nd Year</option>
                                    <option value="3rd Year" {{ old('year_level') == '3rd Year' ? 'selected' : '' }}>3rd Year</option>
                                    <option value="4th Year" {{ old('year_level') == '4th Year' ? 'selected' : '' }}>4th Year</option>
                                </select>
                                <x-input-error :messages="$errors->get('year_level')" class="mt-1 text-xs text-red-500" />
                            </div>

                            <!-- Section / Group -->
                            <div>
                                <label for="section" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                    Section
                                </label>
                                <input id="section" type="text" name="section" value="{{ old('section') }}"
                                    placeholder="e.g. 3A"
                                    class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-lg text-slate-800 text-sm placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                <x-input-error :messages="$errors->get('section')" class="mt-1 text-xs text-red-500" />
                            </div>
                        </div>
                    @endif

                    <!-- Password & Confirm Password Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Password <span class="text-red-500">*</span>
                            </label>
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                placeholder="••••••••"
                                class="w-full px-3.5 py-2 bg-slate-50 border border-slate-300 rounded-lg text-slate-800 text-sm placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-500" />
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Confirm Password <span class="text-red-500">*</span>
                            </label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                placeholder="••••••••"
                                class="w-full px-3.5 py-2 bg-slate-50 border border-slate-300 rounded-lg text-slate-800 text-sm placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-red-500" />
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3">
                        <a href="{{ route('login') }}" 
                            class="text-xs font-semibold text-blue-600 hover:text-blue-800 hover:underline transition order-2 sm:order-1">
                            Already registered? Login here
                        </a>

                        <button type="submit" 
                            class="w-full sm:w-auto px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-200 text-sm order-1 sm:order-2">
                            Complete Registration
                        </button>
                    </div>

                </form>

            </div>

        </main>

        <!-- Footer -->
        <footer class="pb-4 text-center text-xs text-slate-500">
            &copy; {{ date('Y') }} CICT Portal. All rights reserved.
        </footer>

    </div>
</x-guest-layout>