<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-white leading-tight">
                    Edit Schedule & Section Assignment
                </h2>
                <p class="text-xs text-slate-400 mt-0.5">I-update ang mga detalye ng klase, guro, silid-aralan, at seksyon.</p>
            </div>
            <a href="{{ route('admin.schedules.index') }}" 
               class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 rounded-xl text-sm font-semibold transition flex items-center space-x-1.5">
                <span>←</span>
                <span>Back to Schedules</span>
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-950 min-h-screen text-slate-100" x-data="{ 
        selectedCourse: '{{ $schedule->subject->course ?? 'IT' }}', 
        selectedYear: '{{ $schedule->subject->year ?? '1' }}', 
        selectedSection: '{{ old('section', $schedule->section ?? '3A') }}',
        selectedInstructorRank: 'All',
        selectedBuilding: 'All',
        selectedSubjectId: '{{ old('subject_id', $schedule->subject_id) }}',
        selectedInstructorId: '{{ old('instructor_id', $schedule->instructor_id) }}',
        selectedRoomId: '{{ old('room_id', $schedule->room_id) }}',
        searchSubject: '',
        searchInstructor: '',
        searchRoom: ''
    }">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Error Alert Box -->
            @if($errors->any())
                <div class="bg-red-500/10 border border-red-500/50 text-red-400 px-5 py-4 rounded-2xl backdrop-blur-md shadow-xl">
                    <div class="font-bold mb-1 flex items-center space-x-2">
                        <span>⚠️</span>
                        <span>Paki-ayos ang mga sumusunod na error bago ituloy:</span>
                    </div>
                    <ul class="list-disc list-inside text-xs space-y-1 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Dark Card Container -->
            <div class="bg-slate-900/90 border border-slate-800 shadow-2xl rounded-2xl p-8 backdrop-blur-xl">
                <form action="{{ route('admin.schedules.update', $schedule) }}" method="POST" class="space-y-8">
                    @csrf 
                    @method('PUT')

                    <!-- SECTION & PROGRAM CONFIGURATION -->
                    <div class="space-y-4 bg-slate-950/60 p-5 rounded-2xl border border-slate-800">
                        <div class="flex items-center justify-between">
                            <label class="block text-sm font-bold text-indigo-400">
                                📌 Seksyon at Antas (Section & Year Assignment) <span class="text-rose-500">*</span>
                            </label>
                            <span class="text-[11px] text-slate-400">Baguhin kung kinakailangan para sa seksyon</span>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Section Input -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-400 mb-1.5">Pangalan ng Seksyon (Section Name)</label>
                                <input type="text" name="section" x-model="selectedSection" placeholder="Hal. 3A, 3B, 4-1" required
                                       class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white placeholder-slate-500 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                            </div>

                            <!-- Academic Program Indicator -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-400 mb-1.5">Kurso (Program Indicator)</label>
                                <div class="px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-indigo-300 font-bold text-sm flex items-center justify-between">
                                    <span x-text="selectedCourse === 'IT' ? '💻 BS Information Technology (BSIT)' : '🖥️ BS Computer Science (BSCS)'"></span>
                                    <span class="text-xs text-slate-500 font-normal">Base sa Subject</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 1. SUBJECT PICKER SECTION -->
                    <div class="space-y-4 bg-slate-950/60 p-5 rounded-2xl border border-slate-800">
                        <div class="flex justify-between items-center">
                            <label class="block text-sm font-bold text-indigo-400">
                                1. Baguhin ang Subject <span class="text-rose-500">*</span>
                            </label>
                            <span class="text-[11px] text-slate-400">I-click ang card para mapalitan</span>
                        </div>
                        <input type="hidden" name="subject_id" x-model="selectedSubjectId" required>

                        <!-- Course Filter Tabs -->
                        <div class="flex space-x-2 border-b border-slate-800 pb-3">
                            <button type="button" @click="selectedCourse = 'IT'" 
                                    :class="selectedCourse === 'IT' ? 'bg-indigo-600 text-white shadow-lg' : 'bg-slate-900 text-slate-400 hover:text-white'"
                                    class="px-4 py-2 rounded-xl font-bold text-xs transition border border-slate-800">
                                💻 BSIT
                            </button>
                            <button type="button" @click="selectedCourse = 'CS'" 
                                    :class="selectedCourse === 'CS' ? 'bg-indigo-600 text-white shadow-lg' : 'bg-slate-900 text-slate-400 hover:text-white'"
                                    class="px-4 py-2 rounded-xl font-bold text-xs transition border border-slate-800">
                                🖥️ BSCS
                            </button>
                        </div>

                        <!-- Year Level Pills -->
                        <div class="flex items-center space-x-2 pt-1">
                            <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Year Level:</span>
                            <template x-for="yr in [1, 2, 3, 4]">
                                <button type="button" @click="selectedYear = yr.toString()" 
                                        :class="selectedYear === yr.toString() ? 'bg-indigo-600 text-white font-bold border-indigo-500' : 'bg-slate-900 text-slate-400 border-slate-800 hover:bg-slate-800'"
                                        class="px-3.5 py-1.5 rounded-lg text-xs border transition" x-text="yr + ' Year'"></button>
                            </template>
                        </div>

                        <!-- Search Box for Subjects -->
                        <div class="relative">
                            <input type="text" x-model="searchSubject" placeholder="Mag-search ng Subject Code o Title..." 
                                   class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-800 text-white placeholder-slate-500 text-xs focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                        </div>

                        <!-- Subject Cards Grid -->
                        <div class="max-h-56 overflow-y-auto pr-1 space-y-2">
                            @foreach($subjects as $course => $courseSubjects)
                                @foreach($courseSubjects as $subject)
                                    <div @click="selectedSubjectId = '{{ $subject->id }}'"
                                         x-show="'{{ $subject->course }}' === selectedCourse && 
                                                 '{{ $subject->year }}' === selectedYear && 
                                                 ('{{ strtolower($subject->code) . ' ' . strtolower($subject->title) }}'.includes(searchSubject.toLowerCase()))"
                                         :class="selectedSubjectId == '{{ $subject->id }}' ? 'bg-indigo-600/25 border-indigo-500 ring-1 ring-indigo-500 text-white shadow-md' : 'bg-slate-900 border-slate-800 text-slate-300 hover:border-slate-700'"
                                         class="p-3 rounded-xl border cursor-pointer transition flex items-center justify-between text-xs">
                                        
                                        <div class="space-y-1">
                                            <div class="flex items-center space-x-2">
                                                <span class="px-2 py-0.5 bg-slate-950 font-mono text-[11px] font-bold text-indigo-300 rounded border border-slate-800">{{ $subject->code }}</span>
                                                <span class="font-semibold text-white text-sm">{{ $subject->title }}</span>
                                            </div>
                                            <div class="text-[11px] text-slate-400">
                                                Year {{ $subject->year }} • Semester {{ $subject->semester }} • {{ $subject->units }} Units
                                            </div>
                                        </div>

                                        <div>
                                            <span x-show="selectedSubjectId == '{{ $subject->id }}'" class="text-indigo-400 font-bold text-xs bg-indigo-500/20 px-2.5 py-1 rounded-full border border-indigo-500/30">✓ Napili</span>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>

                    <!-- 2. INSTRUCTOR PICKER -->
                    <div class="space-y-4 bg-slate-950/60 p-5 rounded-2xl border border-slate-800">
                        <div class="flex justify-between items-center">
                            <label class="block text-sm font-bold text-indigo-400">2. Baguhin ang Instructor (Opsyonal / Default Slot)</label>
                            <button type="button" @click="selectedInstructorId = ''" class="text-xs text-amber-400 hover:underline">I-set bilang Unassigned</button>
                        </div>
                        <input type="hidden" name="instructor_id" x-model="selectedInstructorId">

                        <!-- Instructor Rank Filter Tabs -->
                        <div class="flex flex-wrap gap-1.5 border-b border-slate-800 pb-3">
                            <button type="button" @click="selectedInstructorRank = 'All'" 
                                    :class="selectedInstructorRank === 'All' ? 'bg-indigo-600 text-white shadow-sm' : 'bg-slate-900 text-slate-400 hover:text-white'"
                                    class="px-3 py-1 rounded-lg text-xs font-semibold transition border border-slate-800">
                                Lahat
                            </button>
                            <button type="button" @click="selectedInstructorRank = 'Instructor I'" 
                                    :class="selectedInstructorRank === 'Instructor I' ? 'bg-indigo-600 text-white shadow-sm' : 'bg-slate-900 text-slate-400 hover:text-white'"
                                    class="px-3 py-1 rounded-lg text-xs font-semibold transition border border-slate-800">
                                Instructor I
                            </button>
                            <button type="button" @click="selectedInstructorRank = 'Instructor II'" 
                                    :class="selectedInstructorRank === 'Instructor II' ? 'bg-indigo-600 text-white shadow-sm' : 'bg-slate-900 text-slate-400 hover:text-white'"
                                    class="px-3 py-1 rounded-lg text-xs font-semibold transition border border-slate-800">
                                Instructor II
                            </button>
                            <button type="button" @click="selectedInstructorRank = 'Assistant Professor'" 
                                    :class="selectedInstructorRank === 'Assistant Professor' ? 'bg-indigo-600 text-white shadow-sm' : 'bg-slate-900 text-slate-400 hover:text-white'"
                                    class="px-3 py-1 rounded-lg text-xs font-semibold transition border border-slate-800">
                                Assistant Professor
                            </button>
                        </div>

                        <!-- Search Box for Instructors -->
                        <div class="relative">
                            <input type="text" x-model="searchInstructor" placeholder="Mag-search ng Pangalan ng Instructor..." 
                                   class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-800 text-white placeholder-slate-500 text-xs focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 max-h-44 overflow-y-auto pr-1">
                            <!-- Default Unassigned Slot Option -->
                            <div @click="selectedInstructorId = ''"
                                 :class="selectedInstructorId === '' ? 'bg-amber-500/20 border-amber-500 text-amber-200' : 'bg-slate-900 border-slate-800 text-slate-400 hover:border-slate-700'"
                                 class="p-3 rounded-xl border cursor-pointer transition text-xs font-semibold flex items-center space-x-2 col-span-full">
                                <span>⚠️</span>
                                <div>
                                    <span class="font-bold">Unassigned / Default Slot (Open for Hiring)</span>
                                </div>
                            </div>

                            @foreach($instructors as $instructor)
                                @php
                                    $rank = $instructor->academic_rank ?? $instructor->profession ?? 'Instructor I';
                                @endphp
                                <div @click="selectedInstructorId = '{{ $instructor->id }}'"
                                     x-show="(selectedInstructorRank === 'All' || '{{ $rank }}'.includes(selectedInstructorRank)) && 
                                             ('{{ strtolower($instructor->name) }}'.includes(searchInstructor.toLowerCase()))"
                                     :class="selectedInstructorId == '{{ $instructor->id }}' ? 'bg-indigo-600/25 border-indigo-500 text-white shadow-sm' : 'bg-slate-900 border-slate-800 text-slate-300 hover:border-slate-700'"
                                     class="p-3 rounded-xl border cursor-pointer transition flex items-center justify-between text-xs">
                                    <div class="space-y-0.5">
                                        <div class="font-bold text-white flex items-center space-x-1.5">
                                            <span>👨‍🏫</span>
                                            <span>{{ $instructor->name }}</span>
                                        </div>
                                        <div class="text-slate-400 text-[10px]">Rank: {{ $rank }}</div>
                                    </div>
                                    <span x-show="selectedInstructorId == '{{ $instructor->id }}'" class="text-indigo-400 font-bold">✓</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- 3. ROOM & BUILDING PICKER -->
                    <div class="space-y-4 bg-slate-950/60 p-5 rounded-2xl border border-slate-800">
                        <div class="flex justify-between items-center">
                            <label class="block text-sm font-bold text-indigo-400">3. Baguhin ang Room & Building <span class="text-rose-500">*</span></label>
                        </div>
                        <input type="hidden" name="room_id" x-model="selectedRoomId" required>

                        <!-- Building Filter Tabs -->
                        <div class="flex flex-wrap gap-1.5 border-b border-slate-800 pb-3">
                            <button type="button" @click="selectedBuilding = 'All'" 
                                    :class="selectedBuilding === 'All' ? 'bg-indigo-600 text-white shadow-sm' : 'bg-slate-900 text-slate-400 hover:text-white'"
                                    class="px-3 py-1 rounded-lg text-xs font-semibold transition border border-slate-800">
                                Lahat
                            </button>
                            @foreach($rooms->keys() as $buildingName)
                                <button type="button" @click="selectedBuilding = '{{ $buildingName }}'" 
                                        :class="selectedBuilding === '{{ $buildingName }}' ? 'bg-indigo-600 text-white shadow-sm' : 'bg-slate-900 text-slate-400 hover:text-white'"
                                        class="px-3 py-1 rounded-lg text-xs font-semibold transition border border-slate-800">
                                    🏢 {{ $buildingName }}
                                </button>
                            @endforeach
                        </div>

                        <!-- Search Room Input -->
                        <div class="relative">
                            <input type="text" x-model="searchRoom" placeholder="Mag-search ng Room Name..." 
                                   class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-800 text-white placeholder-slate-500 text-xs focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 max-h-44 overflow-y-auto pr-1">
                            @foreach($rooms as $building => $buildingRooms)
                                @foreach($buildingRooms as $room)
                                    <div @click="selectedRoomId = '{{ $room->id }}'"
                                         x-show="(selectedBuilding === 'All' || '{{ $room->building }}' === selectedBuilding) && 
                                                 ('{{ strtolower($room->name) . ' ' . strtolower($room->building) }}'.includes(searchRoom.toLowerCase()))"
                                         :class="selectedRoomId == '{{ $room->id }}' ? 'bg-indigo-600/25 border-indigo-500 ring-1 ring-indigo-500 text-white shadow-sm' : 'bg-slate-900 border-slate-800 text-slate-300 hover:border-slate-700'"
                                         class="p-3 rounded-xl border cursor-pointer transition flex items-center justify-between text-xs">
                                        
                                        <div class="space-y-0.5">
                                            <div class="font-bold text-white text-xs">🚪 {{ $room->name }}</div>
                                            <div class="text-slate-400 text-[10px]">🏢 {{ $room->building }} • Capacity: {{ $room->capacity ?? 'N/A' }}</div>
                                        </div>

                                        <span x-show="selectedRoomId == '{{ $room->id }}'" class="text-indigo-400 font-bold">✓</span>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>

                    <!-- 4. DAY & TIME SECTION -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-slate-950/60 p-5 rounded-2xl border border-slate-800">
                        <!-- Day Select -->
                        <div>
                            <label class="block text-xs font-bold text-indigo-400 mb-2">Araw (Day) <span class="text-rose-500">*</span></label>
                            <select name="day" required 
                                    class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white text-xs focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                                <option value="" disabled class="text-slate-500">Pumili ng Araw...</option>
                                @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day)
                                    <option value="{{ $day }}" {{ (old('day', $schedule->day) == $day) ? 'selected' : '' }}>{{ $day }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Start Time -->
                        <div>
                            <label class="block text-xs font-bold text-indigo-400 mb-2">Oras ng Simula (Start) <span class="text-rose-500">*</span></label>
                            <input type="time" name="start_time" value="{{ old('start_time', $schedule->start_time) }}" required 
                                   class="w-full px-4 py-2 rounded-xl bg-slate-900 border border-slate-700 text-white text-xs focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none [color-scheme:dark]">
                        </div>

                        <!-- End Time -->
                        <div>
                            <label class="block text-xs font-bold text-indigo-400 mb-2">Oras ng Tapos (End) <span class="text-rose-500">*</span></label>
                            <input type="time" name="end_time" value="{{ old('end_time', $schedule->end_time) }}" required 
                                   class="w-full px-4 py-2 rounded-xl bg-slate-900 border border-slate-700 text-white text-xs focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none [color-scheme:dark]">
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-3 pt-4 border-t border-slate-800">
                        <a href="{{ route('admin.schedules.index') }}" 
                           class="px-5 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 font-semibold text-xs transition">
                            Cancel
                        </a>

                        <button type="submit" 
                                class="px-6 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs shadow-lg shadow-indigo-600/30 transition transform hover:-translate-y-0.5">
                            Update Schedule Record
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>