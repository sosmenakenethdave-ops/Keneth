<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-white leading-tight">
                Edit Schedule
            </h2>
            <a href="{{ route('admin.schedules.index') }}" 
               class="px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white rounded-xl text-sm font-semibold transition">
                ← Back to Schedules
            </a>
        </div>
    </x-slot>

    <div class="py-12" x-data="{ 
        selectedCourse: '{{ $schedule->subject->course ?? 'IT' }}', 
        selectedYear: '{{ $schedule->subject->year ?? '1' }}', 
        selectedSubjectId: '{{ old('subject_id', $schedule->subject_id) }}',
        selectedInstructorId: '{{ old('instructor_id', $schedule->instructor_id) }}',
        selectedRoomId: '{{ old('room_id', $schedule->room_id) }}',
        searchSubject: '',
        searchRoom: ''
    }">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
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
                <form action="{{ route('admin.schedules.update', $schedule) }}" method="POST" class="space-y-8">
                    @csrf 
                    @method('PUT')

                    <!-- 1. SUBJECT PICKER SECTION (Modern Grid Cards) -->
                    <div class="space-y-4 bg-slate-900/40 p-5 rounded-2xl border border-slate-700/60">
                        <div class="flex justify-between items-center">
                            <label class="block text-base font-bold text-indigo-400">1. Baguhin ang Subject <span class="text-rose-500">*</span></label>
                            <span class="text-xs text-slate-400 font-medium">I-click ang subject para mapalitan</span>
                        </div>
                        <input type="hidden" name="subject_id" x-model="selectedSubjectId" required>

                        <!-- Course Filter Tabs -->
                        <div class="flex space-x-2 border-b border-slate-700 pb-3">
                            <button type="button" @click="selectedCourse = 'IT'" 
                                    :class="selectedCourse === 'IT' ? 'bg-indigo-600 text-white shadow-lg' : 'bg-slate-900 text-slate-400 hover:text-white'"
                                    class="px-5 py-2.5 rounded-xl font-bold text-xs transition border border-slate-700">
                                💻 BS Information Technology (BSIT)
                            </button>
                            <button type="button" @click="selectedCourse = 'CS'" 
                                    :class="selectedCourse === 'CS' ? 'bg-indigo-600 text-white shadow-lg' : 'bg-slate-900 text-slate-400 hover:text-white'"
                                    class="px-5 py-2.5 rounded-xl font-bold text-xs transition border border-slate-700">
                                🖥️ BS Computer Science (BSCS)
                            </button>
                        </div>

                        <!-- Year Level Pills -->
                        <div class="flex items-center space-x-2 pt-1">
                            <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Year Level:</span>
                            <template x-for="yr in [1, 2, 3, 4]">
                                <button type="button" @click="selectedYear = yr.toString()" 
                                        :class="selectedYear === yr.toString() ? 'bg-indigo-600 text-white font-bold border-indigo-500' : 'bg-slate-900 text-slate-400 border-slate-700 hover:bg-slate-800'"
                                        class="px-3.5 py-1.5 rounded-lg text-xs border transition" x-text="yr + 'th/nd Yr'"></button>
                            </template>
                        </div>

                        <!-- Search Box for Subjects -->
                        <div class="relative">
                            <input type="text" x-model="searchSubject" placeholder="Mag-search ng Subject Code o Title..." 
                                class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white placeholder-slate-500 text-sm focus:border-indigo-400 focus:ring-1 focus:ring-indigo-400 outline-none">
                        </div>

                        <!-- Subject Cards Grid -->
                        <div class="max-h-64 overflow-y-auto pr-1 space-y-2.5">
                            @foreach($subjects as $course => $courseSubjects)
                                @foreach($courseSubjects as $subject)
                                    <div @click="selectedSubjectId = '{{ $subject->id }}'"
                                         x-show="'{{ $subject->course }}' === selectedCourse && 
                                                 '{{ $subject->year }}' === selectedYear && 
                                                 ('{{ strtolower($subject->code) . ' ' . strtolower($subject->title) }}'.includes(searchSubject.toLowerCase()))"
                                         :class="selectedSubjectId == '{{ $subject->id }}' ? 'bg-indigo-600/30 border-indigo-500 ring-2 ring-indigo-500/50 text-white shadow-lg' : 'bg-slate-900/80 border-slate-700 text-slate-300 hover:border-slate-500'"
                                         class="p-3.5 rounded-xl border cursor-pointer transition flex items-center justify-between text-sm">
                                        
                                        <div class="space-y-1">
                                            <div class="flex items-center space-x-2">
                                                <span class="px-2.5 py-0.5 bg-slate-950 font-mono text-xs font-bold text-indigo-300 rounded border border-slate-800">{{ $subject->code }}</span>
                                                <span class="font-semibold text-white">{{ $subject->title }}</span>
                                            </div>
                                            <div class="text-xs text-slate-400">
                                                Year {{ $subject->year }} • Sem {{ $subject->semester }} • {{ $subject->units }} Units
                                            </div>
                                        </div>

                                        <div>
                                            <span x-show="selectedSubjectId == '{{ $subject->id }}'" class="text-indigo-400 font-bold text-xs bg-indigo-500/20 px-2.5 py-1 rounded-full border border-indigo-500/40">✓ Selected</span>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>

                    <!-- 2. INSTRUCTOR PICKER (Clean Cards Grid) -->
                    <div class="space-y-4 bg-slate-900/40 p-5 rounded-2xl border border-slate-700/60">
                        <div class="flex justify-between items-center">
                            <label class="block text-base font-bold text-indigo-400">2. Baguhin ang Instructor (Opsyonal)</label>
                            <button type="button" @click="selectedInstructorId = ''" class="text-xs text-rose-400 hover:underline">I-clear / Unassigned</button>
                        </div>
                        <input type="hidden" name="instructor_id" x-model="selectedInstructorId">

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-48 overflow-y-auto pr-1">
                            <div @click="selectedInstructorId = ''"
                                 :class="selectedInstructorId === '' ? 'bg-indigo-600/30 border-indigo-500 text-white' : 'bg-slate-900/80 border-slate-700 text-slate-400 hover:border-slate-500'"
                                 class="p-3 rounded-xl border cursor-pointer transition text-xs font-semibold flex items-center space-x-2">
                                <span>⚠️</span>
                                <span>Unassigned (Itatakda mamaya)</span>
                            </div>

                            @foreach($instructors as $instructor)
                                <div @click="selectedInstructorId = '{{ $instructor->id }}'"
                                     :class="selectedInstructorId == '{{ $instructor->id }}' ? 'bg-indigo-600/30 border-indigo-500 text-white shadow-md' : 'bg-slate-900/80 border-slate-700 text-slate-300 hover:border-slate-500'"
                                     class="p-3 rounded-xl border cursor-pointer transition flex items-center justify-between text-xs font-medium">
                                    <div class="flex items-center space-x-2">
                                        <span>👨‍🏫</span>
                                        <span class="font-bold text-white">{{ $instructor->name }}</span>
                                    </div>
                                    <span x-show="selectedInstructorId == '{{ $instructor->id }}'" class="text-indigo-400 font-bold">✓</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- 3. ROOM & BUILDING PICKER (Cards Grid) -->
                    <div class="space-y-4 bg-slate-900/40 p-5 rounded-2xl border border-slate-700/60">
                        <div class="flex justify-between items-center">
                            <label class="block text-base font-bold text-indigo-400">3. Baguhin ang Room & Building <span class="text-rose-500">*</span></label>
                        </div>
                        <input type="hidden" name="room_id" x-model="selectedRoomId" required>

                        <!-- Search Room Input -->
                        <div class="relative">
                            <input type="text" x-model="searchRoom" placeholder="Mag-search ng Room o Building..." 
                                class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white placeholder-slate-500 text-sm focus:border-indigo-400 focus:ring-1 focus:ring-indigo-400 outline-none">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-48 overflow-y-auto pr-1">
                            @foreach($rooms as $building => $buildingRooms)
                                @foreach($buildingRooms as $room)
                                    <div @click="selectedRoomId = '{{ $room->id }}'"
                                         x-show="('{{ strtolower($room->name) . ' ' . strtolower($room->building) }}'.includes(searchRoom.toLowerCase()))"
                                         :class="selectedRoomId == '{{ $room->id }}' ? 'bg-indigo-600/30 border-indigo-500 ring-2 ring-indigo-500/50 text-white shadow-md' : 'bg-slate-900/80 border-slate-700 text-slate-300 hover:border-slate-500'"
                                         class="p-3 rounded-xl border cursor-pointer transition flex items-center justify-between text-xs">
                                        
                                        <div class="space-y-0.5">
                                            <div class="font-bold text-white text-sm">🚪 {{ $room->name }}</div>
                                            <div class="text-slate-400">🏢 {{ $room->building }} • Capacity: {{ $room->capacity ?? 'N/A' }}</div>
                                        </div>

                                        <span x-show="selectedRoomId == '{{ $room->id }}'" class="text-indigo-400 font-bold">✓</span>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>

                    <!-- 4. DAY & TIME SECTION -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-slate-900/40 p-5 rounded-2xl border border-slate-700/60">
                        <!-- Day Select -->
                        <div>
                            <label class="block text-sm font-bold text-indigo-400 mb-2">Araw (Day) <span class="text-rose-500">*</span></label>
                            <select name="day" required 
                                class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-600 text-white text-sm focus:border-indigo-400 focus:ring-1 focus:ring-indigo-400 outline-none">
                                <option value="" disabled class="text-slate-400">Pumili...</option>
                                @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day)
                                    <option value="{{ $day }}" {{ (old('day', $schedule->day) == $day) ? 'selected' : '' }}>{{ $day }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Start Time -->
                        <div>
                            <label class="block text-sm font-bold text-indigo-400 mb-2">Oras ng Simula (Start) <span class="text-rose-500">*</span></label>
                            <input type="time" name="start_time" value="{{ old('start_time', $schedule->start_time) }}" required 
                                class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-600 text-white text-sm focus:border-indigo-400 focus:ring-1 focus:ring-indigo-400 outline-none [color-scheme:dark]">
                        </div>

                        <!-- End Time -->
                        <div>
                            <label class="block text-sm font-bold text-indigo-400 mb-2">Oras ng Tapos (End) <span class="text-rose-500">*</span></label>
                            <input type="time" name="end_time" value="{{ old('end_time', $schedule->end_time) }}" required 
                                class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-600 text-white text-sm focus:border-indigo-400 focus:ring-1 focus:ring-indigo-400 outline-none [color-scheme:dark]">
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-4 pt-4 border-t border-slate-700/60">
                        <a href="{{ route('admin.schedules.index') }}" 
                           class="px-5 py-3 rounded-xl bg-slate-700 hover:bg-slate-600 text-slate-200 font-semibold transition">
                            Cancel
                        </a>

                        <button type="submit" 
                                class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold shadow-lg shadow-indigo-600/30 transition transform hover:-translate-y-0.5">
                            Update Schedule
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>