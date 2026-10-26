<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center space-x-3">
                <div class="p-2.5 bg-emerald-600/20 border border-emerald-500/30 rounded-xl">
                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-white leading-tight tracking-wide">
                        Add New {{ ucfirst($role) }}
                    </h2>
                    <p class="text-xs text-slate-400">CICT Academic Scheduling & User Management System</p>
                </div>
            </div>

            <!-- Back Button -->
            <a href="{{ route('admin.users.index', ['role' => $role]) }}" 
               class="inline-flex items-center space-x-2 px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 rounded-xl text-sm font-semibold transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Back to {{ ucfirst($role) }}s</span>
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-950 min-h-screen text-slate-100">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Error Alert Box -->
            @if($errors->any())
                <div class="bg-rose-500/10 border border-rose-500/40 text-rose-300 px-5 py-4 rounded-2xl mb-6 backdrop-blur-md">
                    <div class="flex items-center space-x-3 mb-2">
                        <svg class="w-5 h-5 text-rose-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-bold text-sm">Paki-ayos ang mga sumusunod na error:</span>
                    </div>
                    <ul class="list-disc list-inside text-xs space-y-1 text-rose-200/90 pl-8">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Dark Card Container -->
            <div class="bg-slate-900/80 border border-slate-800 shadow-2xl rounded-2xl p-8 backdrop-blur-xl">
                <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Hidden Role Field -->
                    <input type="hidden" name="role" value="{{ $role }}">

                    <!-- Full Name -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-2">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="e.g. Juan Dela Cruz" 
                            class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 text-white placeholder-slate-500 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition outline-none text-sm">
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-2">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="e.g. juan@cict.edu.ph" 
                            class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 text-white placeholder-slate-500 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition outline-none text-sm">
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-2">Password</label>
                        <input type="password" name="password" required placeholder="Minimum 8 characters" 
                            class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 text-white placeholder-slate-500 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition outline-none text-sm">
                    </div>

                    <!-- Student Specific Fields -->
                    @if($role === 'student')
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-4 border-t border-slate-800">
                            <!-- Course Dropdown -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Course</label>
                                <select name="course" 
                                    class="w-full px-4 py-2.5 rounded-xl bg-slate-950 border border-slate-800 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition outline-none text-sm">
                                    <option value="">Select Course</option>
                                    <option value="BSIT" {{ old('course') === 'BSIT' ? 'selected' : '' }}>BSIT</option>
                                    <option value="BSCS" {{ old('course') === 'BSCS' ? 'selected' : '' }}>BSCS</option>
                                    <option value="BSEM" {{ old('course') === 'BSEM' ? 'selected' : '' }}>BSEM</option>
                                    <option value="ACT" {{ old('course') === 'ACT' ? 'selected' : '' }}>ACT</option>
                                </select>
                            </div>

                            <!-- Year Level Dropdown -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Year Level</label>
                                <select name="year_level" 
                                    class="w-full px-4 py-2.5 rounded-xl bg-slate-950 border border-slate-800 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition outline-none text-sm">
                                    <option value="">Select Year</option>
                                    <option value="1st Year" {{ old('year_level') === '1st Year' ? 'selected' : '' }}>1st Year</option>
                                    <option value="2nd Year" {{ old('year_level') === '2nd Year' ? 'selected' : '' }}>2nd Year</option>
                                    <option value="3rd Year" {{ old('year_level') === '3rd Year' ? 'selected' : '' }}>3rd Year</option>
                                    <option value="4th Year" {{ old('year_level') === '4th Year' ? 'selected' : '' }}>4th Year</option>
                                </select>
                            </div>

                            <!-- Section -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Section</label>
                                <input type="text" name="section" value="{{ old('section') }}" placeholder="e.g. A" 
                                    class="w-full px-4 py-2.5 rounded-xl bg-slate-950 border border-slate-800 text-white placeholder-slate-500 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition outline-none text-sm">
                            </div>
                        </div>
                    @endif

                    <!-- Instructor Specific Fields -->
                    @if($role === 'instructor')
                        <div class="pt-4 border-t border-slate-800">
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Academic Rank</label>
                            <select name="academic_rank" 
                                class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition outline-none text-sm">
                                <option value="">Select Academic Rank</option>
                                <option value="Instructor I" {{ old('academic_rank') === 'Instructor I' ? 'selected' : '' }}>Instructor I</option>
                                <option value="Instructor II" {{ old('academic_rank') === 'Instructor II' ? 'selected' : '' }}>Instructor II</option>
                                <option value="Instructor III" {{ old('academic_rank') === 'Instructor III' ? 'selected' : '' }}>Instructor III</option>
                                <option value="Assistant Professor" {{ old('academic_rank') === 'Assistant Professor' ? 'selected' : '' }}>Assistant Professor</option>
                                <option value="Associate Professor" {{ old('academic_rank') === 'Associate Professor' ? 'selected' : '' }}>Associate Professor</option>
                                <option value="Professor" {{ old('academic_rank') === 'Professor' ? 'selected' : '' }}>Professor</option>
                            </select>
                        </div>
                    @endif

                    <!-- Account Type / Role (Disabled display field) -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-2">Account Type / Role</label>
                        <input type="text" value="{{ ucfirst($role) }}" disabled 
                            class="w-full px-4 py-3 rounded-xl bg-slate-950/60 border border-slate-800/80 text-slate-400 font-medium cursor-not-allowed text-sm">
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-3 pt-6 border-t border-slate-800">
                        <a href="{{ route('admin.users.index', ['role' => $role]) }}" 
                           class="px-5 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 font-semibold transition text-sm">
                            Cancel
                        </a>

                        <button type="submit" 
                                class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold text-sm shadow-lg shadow-blue-900/30 transition transform hover:-translate-y-0.5">
                            Save {{ ucfirst($role) }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>