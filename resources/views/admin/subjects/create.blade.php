<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-white leading-tight">
                Add New Subject
            </h2>
            <a href="{{ route('admin.subjects.index') }}" class="px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white rounded-xl text-sm font-semibold transition">
                ← Back to Subjects
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
                <form action="{{ route('admin.subjects.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Course / Curriculum (IT o CS) -->
                    <div>
                        <label class="block text-base font-semibold text-white mb-2">Course Program</label>
                        <select name="course" required 
                            class="w-full px-4 py-3 rounded-xl bg-slate-900 border-2 border-slate-600 text-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/40 transition outline-none">
                            <option value="IT" {{ old('course') == 'IT' ? 'selected' : '' }}>BS Information Technology (IT)</option>
                            <option value="CS" {{ old('course') == 'CS' ? 'selected' : '' }}>BS Computer Science (CS)</option>
                        </select>
                    </div>

                    <!-- Subject Code -->
                    <div>
                        <label class="block text-base font-semibold text-white mb-2">Subject Code</label>
                        <input type="text" name="code" value="{{ old('code') }}" required autofocus placeholder="e.g. IPT2" 
                            class="w-full px-4 py-3 rounded-xl bg-slate-900 border-2 border-slate-600 text-white placeholder-slate-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/40 transition outline-none">
                    </div>

                    <!-- Subject Title -->
                    <div>
                        <label class="block text-base font-semibold text-white mb-2">Subject Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" required placeholder="e.g. Integrative Programming 2" 
                            class="w-full px-4 py-3 rounded-xl bg-slate-900 border-2 border-slate-600 text-white placeholder-slate-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/40 transition outline-none">
                    </div>

                    <!-- Year Level & Semester (Grid Layout) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Year Level -->
                        <div>
                            <label class="block text-base font-semibold text-white mb-2">Year Level</label>
                            <select name="year" required 
                                class="w-full px-4 py-3 rounded-xl bg-slate-900 border-2 border-slate-600 text-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/40 transition outline-none">
                                <option value="1" {{ old('year') == 1 ? 'selected' : '' }}>1st Year</option>
                                <option value="2" {{ old('year') == 2 ? 'selected' : '' }}>2nd Year</option>
                                <option value="3" {{ old('year') == 3 ? 'selected' : '' }}>3rd Year</option>
                                <option value="4" {{ old('year') == 4 ? 'selected' : '' }}>4th Year</option>
                            </select>
                        </div>

                        <!-- Semester -->
                        <div>
                            <label class="block text-base font-semibold text-white mb-2">Semester</label>
                            <select name="semester" required 
                                class="w-full px-4 py-3 rounded-xl bg-slate-900 border-2 border-slate-600 text-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/40 transition outline-none">
                                <option value="1" {{ old('semester') == 1 ? 'selected' : '' }}>1st Semester</option>
                                <option value="2" {{ old('semester') == 2 ? 'selected' : '' }}>2nd Semester</option>
                            </select>
                        </div>
                    </div>

                    <!-- Units -->
                    <div>
                        <label class="block text-base font-semibold text-white mb-2">Units</label>
                        <input type="number" name="units" value="{{ old('units') }}" required min="1" placeholder="e.g. 3" 
                            class="w-full px-4 py-3 rounded-xl bg-slate-900 border-2 border-slate-600 text-white placeholder-slate-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/40 transition outline-none">
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-4 pt-4 border-t border-slate-700/60">
                        <a href="{{ route('admin.subjects.index') }}" 
                           class="px-5 py-3 rounded-xl bg-slate-700 hover:bg-slate-600 text-slate-200 font-semibold transition">
                            Cancel
                        </a>

                        <button type="submit" 
                                class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold shadow-lg shadow-indigo-600/30 transition transform hover:-translate-y-0.5">
                            Save Subject
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>