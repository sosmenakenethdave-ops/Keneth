<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-white leading-tight">
                Edit {{ ucfirst($user->role) }}: {{ $user->name }}
            </h2>
            <a href="{{ route('admin.users.index', ['role' => $user->role]) }}" 
               class="px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white rounded-xl text-sm font-semibold transition">
                ← Back to {{ ucfirst($user->role) }}s
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <!-- Error Alert Box -->
            @if($errors->any())
                <div class="bg-red-500/10 border border-red-500/50 text-red-400 px-5 py-4 rounded-xl mb-6 backdrop-blur-md">
                    <div class="font-bold mb-1">Paki-ayos ang mga sumusunod na error:</div>
                    <ul class="list-disc list-inside text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Dark Card Container -->
            <div class="bg-slate-800/90 border border-slate-700/80 shadow-2xl rounded-2xl p-8 backdrop-blur-md">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Hidden Role Field para maipasa sa Update Request -->
                    <input type="hidden" name="role" value="{{ $user->role }}">

                    <!-- Full Name -->
                    <div>
                        <label class="block text-base font-semibold text-white mb-2">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus 
                            class="w-full px-4 py-3 rounded-xl bg-slate-900 border-2 border-slate-600 text-white placeholder-slate-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/40 transition outline-none">
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label class="block text-base font-semibold text-white mb-2">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required 
                            class="w-full px-4 py-3 rounded-xl bg-slate-900 border-2 border-slate-600 text-white placeholder-slate-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/40 transition outline-none">
                    </div>

                    <!-- Student Specific Fields (Lalabas lamang kung 'student' ang role) -->
                    @if($user->role === 'student')
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-2 border-t border-slate-700/60">
                            <!-- Course Dropdown -->
                            <div>
                                <label class="block text-sm font-semibold text-white mb-2">Course</label>
                                <select name="course" 
                                    class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border-2 border-slate-600 text-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/40 transition outline-none text-sm">
                                    <option value="">Select Course</option>
                                    <option value="BSIT" {{ old('course', $user->course) === 'BSIT' ? 'selected' : '' }}>BSIT</option>
                                    <option value="BSCS" {{ old('course', $user->course) === 'BSCS' ? 'selected' : '' }}>BSCS</option>
                                    <option value="BSEM" {{ old('course', $user->course) === 'BSEM' ? 'selected' : '' }}>BSEM</option>
                                    <option value="ACT" {{ old('course', $user->course) === 'ACT' ? 'selected' : '' }}>ACT</option>
                                </select>
                            </div>

                            <!-- Year Level Dropdown -->
                            <div>
                                <label class="block text-sm font-semibold text-white mb-2">Year Level</label>
                                <select name="year_level" 
                                    class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border-2 border-slate-600 text-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/40 transition outline-none text-sm">
                                    <option value="">Select Year</option>
                                    <option value="1st Year" {{ old('year_level', $user->year_level) === '1st Year' ? 'selected' : '' }}>1st Year</option>
                                    <option value="2nd Year" {{ old('year_level', $user->year_level) === '2nd Year' ? 'selected' : '' }}>2nd Year</option>
                                    <option value="3rd Year" {{ old('year_level', $user->year_level) === '3rd Year' ? 'selected' : '' }}>3rd Year</option>
                                    <option value="4th Year" {{ old('year_level', $user->year_level) === '4th Year' ? 'selected' : '' }}>4th Year</option>
                                </select>
                            </div>

                            <!-- Section -->
                            <div>
                                <label class="block text-sm font-semibold text-white mb-2">Section</label>
                                <input type="text" name="section" value="{{ old('section', $user->section) }}" placeholder="e.g. A" 
                                    class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border-2 border-slate-600 text-white placeholder-slate-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/40 transition outline-none text-sm">
                            </div>
                        </div>
                    @endif

                    <!-- Instructor Specific Fields (Lalabas lamang kung 'instructor' ang role) -->
                    @if($user->role === 'instructor')
                        <div class="pt-2 border-t border-slate-700/60">
                            <label class="block text-base font-semibold text-white mb-2">Academic Rank</label>
                            <select name="academic_rank" 
                                class="w-full px-4 py-3 rounded-xl bg-slate-900 border-2 border-slate-600 text-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/40 transition outline-none">
                                <option value="">Select Academic Rank</option>
                                <option value="Instructor I" {{ old('academic_rank', $user->academic_rank) === 'Instructor I' ? 'selected' : '' }}>Instructor I</option>
                                <option value="Instructor II" {{ old('academic_rank', $user->academic_rank) === 'Instructor II' ? 'selected' : '' }}>Instructor II</option>
                                <option value="Instructor III" {{ old('academic_rank', $user->academic_rank) === 'Instructor III' ? 'selected' : '' }}>Instructor III</option>
                                <option value="Assistant Professor" {{ old('academic_rank', $user->academic_rank) === 'Assistant Professor' ? 'selected' : '' }}>Assistant Professor</option>
                                <option value="Associate Professor" {{ old('academic_rank', $user->academic_rank) === 'Associate Professor' ? 'selected' : '' }}>Associate Professor</option>
                                <option value="Professor" {{ old('academic_rank', $user->academic_rank) === 'Professor' ? 'selected' : '' }}>Professor</option>
                            </select>
                        </div>
                    @endif

                    <!-- Account Type / Role (Disabled display field - pareho sa Create form) -->
                    <div>
                        <label class="block text-base font-semibold text-white mb-2">Account Type / Role</label>
                        <input type="text" value="{{ ucfirst($user->role) }}" disabled 
                            class="w-full px-4 py-3 rounded-xl bg-slate-950 border-2 border-slate-700 text-slate-400 font-semibold cursor-not-allowed">
                    </div>

                    <!-- New Password (Optional) -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-base font-semibold text-white">New Password</label>
                            <span class="text-xs text-slate-400 font-normal">(Optional / Leave blank to keep current)</span>
                        </div>
                        
                        <div class="relative">
                            <input type="password" id="password" name="password" placeholder="Enter new password if resetting..."
                                class="w-full px-4 py-3 pr-12 rounded-xl bg-slate-900 border-2 border-slate-600 text-white placeholder-slate-500 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/40 transition outline-none">
                            
                            <!-- Toggle Password Visibility Button -->
                            <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-white transition">
                                <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        <p class="text-xs text-slate-400 mt-2">
                            Maaari mong baguhin o i-reset ang password ng user dito kung sakaling nakalimutan niya ito.
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-4 pt-4 border-t border-slate-700/60">
                        <a href="{{ route('admin.users.index', ['role' => $user->role]) }}" 
                           class="px-5 py-3 rounded-xl bg-slate-700 hover:bg-slate-600 text-slate-200 font-semibold transition">
                            Cancel
                        </a>

                        <button type="submit" 
                                class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold shadow-lg shadow-indigo-600/30 transition transform hover:-translate-y-0.5">
                            Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Password Toggle Script -->
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
    </script>
</x-app-layout>