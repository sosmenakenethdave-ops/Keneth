<x-app-layout>
    <!-- Alpine.js State Navigation with Computed Units -->
    <div x-data="{ 
            helpOpen: false, 
            showHowToUse: false, 
            showAbout: false,
            showCurriculumModal: false,
            yearFilter: 'ALL',
            semesterFilter: '{{ $studentSemester ?? 1 }}', 
            searchQuery: '',
            
            get filteredUnits() {
                let subjects = [
                    @foreach($subjects as $subject)
                        { semester: {{ $subject->semester }}, units: {{ $subject->units }} },
                    @endforeach
                ];
                return subjects
                    .filter(sub => sub.semester == this.semesterFilter)
                    .reduce((sum, sub) => sum + sub.units, 0);
            }
         }" 
         class="py-8 bg-slate-50 min-h-screen">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Top Action Header -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center bg-white p-5 rounded-2xl shadow-sm border border-slate-100 gap-4 no-print">
                <div>
                    <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">Student Portal Dashboard</h2>
                    <p class="text-xs text-slate-500 font-medium">Schedule Overview & Academic Program Details</p>
                </div>
                
                <div class="flex items-center space-x-3">
                    <!-- INAYOS: Nakokonekta na ito sa bagong Print Matrix View route -->
                    <a href="{{ route('student.print.schedule') }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold rounded-xl shadow-sm transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Print Schedule Matrix
                    </a>

                    <!-- Help & Support Dropdown -->
                    <div class="relative">
                        <button @click="helpOpen = !helpOpen" @click.away="helpOpen = false" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-xl shadow-sm transition">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Help & Support</span>
                        </button>

                        <div x-show="helpOpen" 
                             x-transition
                             class="absolute right-0 mt-2 w-52 bg-white rounded-xl shadow-xl border border-slate-100 py-1.5 z-50">
                            <button @click="showHowToUse = true; helpOpen = false" class="w-full text-left px-4 py-2.5 text-xs text-slate-700 hover:bg-blue-50 hover:text-blue-600 font-medium flex items-center transition">
                                <span class="mr-2 text-base">📖</span> How to Use System
                            </button>
                            <button @click="showAbout = true; helpOpen = false" class="w-full text-left px-4 py-2.5 text-xs text-slate-700 hover:bg-blue-50 hover:text-blue-600 font-medium flex items-center border-t border-slate-50 transition">
                                <span class="mr-2 text-base">ℹ️</span> About & Contact Support
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Info Banner -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6 border border-slate-100">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h3 class="text-2xl font-bold text-slate-900">Official Student Schedule: {{ Auth::user()->name ?? 'Student' }}</h3>
                        <p class="text-slate-500 text-sm">Bachelor of Science in Information Technology (BSIT)</p>
                    </div>
                    <div class="flex flex-wrap gap-2.5">
                        <div class="bg-blue-50 px-4 py-2 rounded-xl border border-blue-100 text-blue-700 text-center">
                            <span class="text-[10px] uppercase tracking-wider font-bold block text-blue-500">Program</span>
                            <span class="font-extrabold text-sm">BSIT</span>
                        </div>
                        <div class="bg-indigo-50 px-4 py-2 rounded-xl border border-indigo-100 text-indigo-700 text-center">
                            <span class="text-[10px] uppercase tracking-wider font-bold block text-indigo-500">Year Level</span>
                            <span class="font-extrabold text-sm">{{ $studentYear ?? '3rd' }}</span>
                        </div>
                        <div class="bg-purple-50 px-4 py-2 rounded-xl border border-purple-100 text-purple-700 text-center">
                            <span class="text-[10px] uppercase tracking-wider font-bold block text-purple-500">Section</span>
                            <span class="font-extrabold text-sm">{{ $studentSection ?? '3A' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Essential Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-5 border border-slate-100 border-l-4 border-blue-500 flex justify-between items-center">
                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Curriculum Subjects</p>
                        <p class="text-3xl font-extrabold text-slate-900 mt-1">{{ isset($allCurriculumSubjects) ? count($allCurriculumSubjects) : 0 }}</p>
                    </div>
                    <button @click="showCurriculumModal = true" class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-md transition flex items-center space-x-1.5">
                        <span>📂</span>
                        <span>View BSIT Curriculum</span>
                    </button>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-5 border border-slate-100 border-l-4 border-green-500">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Units (Current Sem)</p>
                    <p class="text-3xl font-extrabold text-slate-900 mt-1">
                        <span x-text="filteredUnits"></span> <span class="text-sm font-normal text-slate-500">Units</span>
                    </p>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-5 border border-slate-100 border-l-4 border-amber-500">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Schedule Status</p>
                    <p class="text-sm font-bold text-amber-600 mt-2">Active Schedule Loaded</p>
                </div>
            </div>

            <!-- Official Enrolled Classes Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6 border border-slate-100 space-y-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center border-b border-slate-100 pb-5 gap-4">
                    <div>
                        <h4 class="text-lg font-bold text-slate-900">Enrolled Classes & Schedules</h4>
                        <p class="text-xs text-slate-500">Official schedules assigned by the administrator for your year level.</p>
                    </div>

                    <!-- SEMESTER FILTER BUTTONS -->
                    <div class="flex items-center bg-slate-100 p-1 rounded-xl space-x-1">
                        <button @click="semesterFilter = 1" 
                                :class="semesterFilter == 1 ? 'bg-white text-blue-600 font-bold shadow-sm' : 'text-slate-600 hover:text-slate-900'" 
                                class="px-3.5 py-1.5 rounded-lg text-xs transition">
                            1st Semester
                        </button>
                        <button @click="semesterFilter = 2" 
                                :class="semesterFilter == 2 ? 'bg-white text-blue-600 font-bold shadow-sm' : 'text-slate-600 hover:text-slate-900'" 
                                class="px-3.5 py-1.5 rounded-lg text-xs transition">
                            2nd Semester
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto border border-slate-100 rounded-xl">
                    <table class="min-w-full divide-y divide-slate-100">
                        <thead class="bg-slate-50/70">
                            <tr>
                                <th class="px-6 py-3.5 text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider">Subject Code</th>
                                <th class="px-6 py-3.5 text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider">Subject Title</th>
                                <th class="px-6 py-3.5 text-center text-[11px] font-bold text-slate-500 uppercase tracking-wider">Units</th>
                                <th class="px-6 py-3.5 text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider">Day & Time</th>
                                <th class="px-6 py-3.5 text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider">Room & Building</th>
                                <th class="px-6 py-3.5 text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider">Instructor</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100">
                            @forelse($subjects as $subject)
                                <tr x-show="semesterFilter == {{ $subject->semester }}" class="hover:bg-blue-50/40 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-xs font-bold text-blue-600 font-mono">{{ $subject->code }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-xs font-semibold text-slate-900">{{ $subject->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-xs text-slate-600 font-medium">{{ $subject->units }}</td>
                                    
                                    <!-- Day & Time Display -->
                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-amber-600 font-semibold italic">
                                        @if(isset($subject->schedule) && $subject->schedule)
                                            @php
                                                $sched = $subject->schedule;
                                                $day = $sched->day ?? '';
                                                $timeSlot = $sched->time_slot ?? $sched->time ?? '';
                                                if(empty($timeSlot) && !empty($sched->start_time) && !empty($sched->end_time)) {
                                                    $timeSlot = \Carbon\Carbon::parse($sched->start_time)->format('g:i A') . ' - ' . \Carbon\Carbon::parse($sched->end_time)->format('g:i A');
                                                }
                                            @endphp

                                            @if(!empty($day) && !empty($timeSlot))
                                                📅 {{ $day }} ⏰ {{ $timeSlot }}
                                            @elseif(!empty($timeSlot))
                                                ⏰ {{ $timeSlot }}
                                            @elseif(!empty($day))
                                                📅 {{ $day }}
                                            @else
                                                Pending Admin Schedule
                                            @endif
                                        @else
                                            Pending Admin Schedule
                                        @endif
                                    </td>

                                    <!-- Room & Building Display -->
                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-600 font-medium">
                                        @if(isset($subject->schedule->room))
                                            @php
                                                $roomObj = $subject->schedule->room;
                                                $roomName = is_object($roomObj) ? ($roomObj->name ?? 'TBD') : $roomObj;
                                                $buildingName = is_object($roomObj) ? ($roomObj->building ?? '') : '';
                                            @endphp
                                            🚪 {{ $roomName }} <br>
                                            <span class="text-[10px] text-slate-400">🏢 {{ $buildingName }}</span>
                                        @else
                                            <span class="italic text-slate-400">TBD</span>
                                        @endif
                                    </td>

                                    <!-- Instructor Display -->
                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-600 font-medium">
                                        @if(isset($subject->schedule->instructor))
                                            {{ is_object($subject->schedule->instructor) ? ($subject->schedule->instructor->name ?? $subject->schedule->instructor) : $subject->schedule->instructor }}
                                        @else
                                            <span class="italic text-slate-400">TBD</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-slate-400 text-xs font-medium">
                                        No schedules assigned yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- INCLUDE CURRICULUM MODAL PARTIAL -->
        @include('student.partials.curriculum-modal')

        <!-- MODAL 1: How to Use System -->
        <div x-show="showHowToUse" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm p-4" style="display: none;">
            <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-gray-100 relative">
                <button @click="showHowToUse = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 font-bold">✕</button>
                <div class="flex items-center space-x-3 mb-4">
                    <div class="p-3 bg-blue-50 text-blue-600 rounded-xl font-bold text-lg">📖</div>
                    <h3 class="text-base font-bold text-gray-900">How to Use System</h3>
                </div>
                <div class="text-xs text-gray-600 space-y-2.5 mb-6 leading-relaxed">
                    <p>1. Click <strong>View BSIT Curriculum</strong> to view all subjects across 4 years.</p>
                    <p>2. Check your daily enrolled classes and room assignments on your main dashboard table.</p>
                    <p>3. Click <strong>Print Schedule Matrix</strong> for an official colored matrix copy of your schedule.</p>
                </div>
                <button @click="showHowToUse = false" class="w-full py-2.5 bg-blue-600 text-white text-xs rounded-xl font-bold transition">Got it, Thanks!</button>
            </div>
        </div>

        <!-- MODAL 2: About & Support Contact Info -->
        <div x-show="showAbout" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm p-4" style="display: none;">
            <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-gray-100 relative">
                <button @click="showAbout = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 font-bold">✕</button>
                <div class="flex items-center space-x-3 mb-4">
                    <div class="p-3 bg-blue-50 text-blue-600 rounded-xl font-bold text-lg">ℹ️</div>
                    <div>
                        <h3 class="text-base font-bold text-gray-900">CICT Scheduling System</h3>
                        <p class="text-[11px] text-gray-400 font-medium">Version 1.0.0 • Copyright © {{ date('Y') }}</p>
                    </div>
                </div>
                <div class="text-xs text-gray-600 space-y-2 border-t border-b border-gray-100 py-3.5 mb-6 leading-relaxed">
                    <p><strong>System Developer:</strong> Keneth Dave M. Sosmeña</p>
                    <p><strong>System Administrator:</strong> CICT IT Department</p>
                    <p><strong>Support Email:</strong> <span class="text-blue-600 font-medium">support@cictportal.edu.ph</span></p>
                </div>
                <button @click="showAbout = false" class="w-full py-2.5 bg-blue-600 text-white text-xs rounded-xl font-bold transition">Close</button>
            </div>
        </div>

    </div>
</x-app-layout>