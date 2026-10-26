<x-app-layout>
    <x-slot name="header">
        <!-- Header Container with Alpine.js State for Modals and Help Dropdown -->
        <div x-data="{ openHelp: false, showAbout: false, showGuide: false }" class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <span class="p-2 bg-blue-600 text-white rounded-xl shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                </span>
                <h2 class="font-extrabold text-2xl tracking-wide flex items-center space-x-1">
                    <span class="text-white">CICT</span>
                    <span class="text-blue-500">Scheduling Dashboard</span>
                </h2>
            </div>

            <!-- Help Navigation Menu Dropdown -->
            <div class="relative">
                <button @click="openHelp = !openHelp" @click.away="openHelp = false" class="flex items-center space-x-2 px-4 py-2 bg-slate-800 hover:bg-slate-700 text-white font-semibold rounded-xl border border-slate-700 transition shadow-sm">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Help</span>
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <!-- Help Dropdown Items -->
                <div x-show="openHelp" 
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-56 bg-white border border-slate-200 rounded-xl shadow-xl z-50 py-1 overflow-hidden"
                     style="display: none;">
                    
                    <button @click="showGuide = true; openHelp = false" class="w-full text-left px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 flex items-center space-x-2.5 transition">
                        <span>📖</span>
                        <span class="font-medium">How to Use System</span>
                    </button>

                    <div class="border-t border-slate-100"></div>

                    <button @click="showAbout = true; openHelp = false" class="w-full text-left px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 flex items-center space-x-2.5 transition">
                        <span>ℹ️</span>
                        <span class="font-medium">About</span>
                    </button>
                </div>
            </div>

            <!-- MODAL 1: ABOUT POPUP -->
            <template x-teleport="body">
                <div x-show="showAbout" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 z-[9999] flex items-center justify-center bg-slate-900/60 backdrop-blur-md p-4 min-h-screen w-screen overflow-y-auto" 
                     x-cloak 
                     style="display: none;">
                    
                    <div x-show="showAbout"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         @click.away="showAbout = false"
                         class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden border border-slate-200 my-auto">
                        
                        <div class="bg-blue-600 px-5 py-3.5 flex items-center justify-between text-white font-bold text-lg">
                            <span>About</span>
                            <button @click="showAbout = false" class="text-white/80 hover:text-white transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <div class="p-6">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-14 h-14 bg-blue-500 rounded-full flex items-center justify-center text-white font-extrabold text-3xl shadow-md border-2 border-blue-400">
                                        i
                                    </div>
                                </div>
                                <div class="space-y-1.5 text-slate-900">
                                    <h3 class="text-xl font-bold text-blue-800">CICT Scheduling System v1.0.0</h3>
                                    <p class="text-sm font-semibold text-slate-800">Copyright © 2026 CICT Portal</p>
                                    <p class="text-sm text-slate-700"><strong>Developer:</strong> Keneth Dave M. Sosmeña</p>
                                    <p class="text-sm text-slate-700"><strong>System Admin:</strong> CICT IT Department</p>
                                    <p class="text-sm text-slate-700"><strong>Website:</strong> <a href="#" class="text-blue-600 hover:underline">https://cict.portal.edu.ph</a></p>
                                    <p class="text-sm text-slate-700"><strong>Facebook:</strong> <a href="#" class="text-blue-600 hover:underline">https://facebook.com/CICTOfficial</a></p>
                                </div>
                            </div>

                            <div class="mt-6 flex justify-center">
                                <button @click="showAbout = false" class="px-8 py-2 bg-sky-500 hover:bg-sky-600 text-white font-bold rounded-full shadow-md transition text-sm">
                                    OK
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <!-- MODAL 2: HOW TO USE POPUP -->
            <template x-teleport="body">
                <div x-show="showGuide" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 z-[9999] flex items-center justify-center bg-slate-900/60 backdrop-blur-md p-4 min-h-screen w-screen overflow-y-auto" 
                     x-cloak 
                     style="display: none;">
                    
                    <div x-show="showGuide"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         @click.away="showGuide = false"
                         class="bg-white rounded-2xl shadow-2xl w-full max-w-xl overflow-hidden border border-slate-200 my-auto">
                        <!-- Curriculum Display Section (Separated for IT and CS) -->
<div class="mt-8 bg-white border border-slate-200/80 rounded-2xl shadow-md p-6">
    <div class="border-b border-slate-100 pb-4 mb-6">
        <h3 class="text-xl font-bold text-slate-900 flex items-center space-x-2">
            <!-- CURRICULUM SUBJECTS DISPLAY (SEPARATED FOR IT AND CS) -->
            <div class="bg-white border border-slate-200/80 rounded-2xl shadow-md p-6">
                <div class="border-b border-slate-100 pb-4 mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <div>
                        <h3 class="text-xl font-bold text-slate-900 flex items-center space-x-2">
                            <span>🎓</span>
                            <span>CICT Academic Curriculums</span>
                        </h3>
                        <p class="text-xs text-slate-500 mt-1">Listahan ng lahat ng asignaturang nakapaloob sa BSIT at BSCS programs.</p>
                    </div>
                </div>

                <!-- Alpine.js Tabs state -->
                <div x-data="{ courseTab: 'IT' }" class="space-y-6">
                    <!-- Course Switch Buttons -->
                    <div class="flex border-b border-slate-200 space-x-2 pb-3">
                        <button @click="courseTab = 'IT'" 
                                :class="courseTab === 'IT' ? 'bg-blue-600 text-white shadow-md border-blue-600' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 border-slate-200'"
                                class="px-5 py-2.5 rounded-xl font-bold text-sm border transition flex items-center space-x-2">
                            <span>💻</span>
                            <span>BS Information Technology (BSIT)</span>
                        </button>
                        <button @click="courseTab = 'CS'" 
                                :class="courseTab === 'CS' ? 'bg-indigo-600 text-white shadow-md border-indigo-600' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 border-slate-200'"
                                class="px-5 py-2.5 rounded-xl font-bold text-sm border transition flex items-center space-x-2">
                            <span>🖥️</span>
                            <span>BS Computer Science (BSCS)</span>
                        </button>
                    </div>

                    <!-- BSIT CURRICULUM TAB -->
                    <div x-show="courseTab === 'IT'" class="space-y-6">
                        @php
                            $itGrouped = isset($itSubjects) ? $itSubjects->groupBy(['year', 'semester']) : collect();
                        @endphp

                        @if($itGrouped->isNotEmpty())
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($itGrouped as $year => $semesters)
                                    <div class="bg-slate-50 border border-slate-200 rounded-2xl p-4 shadow-sm">
                                        <div class="bg-blue-600 text-white font-extrabold px-3.5 py-1.5 rounded-xl text-xs inline-block mb-3 uppercase tracking-wider">
                                            Year Level {{ $year }}
                                        </div>

                                        @foreach($semesters as $semester => $subjects)
                                            <div class="mb-4 last:mb-0">
                                                <h5 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 border-b border-slate-200 pb-1">
                                                    {{ $semester == 1 ? '1st Semester' : '2nd Semester' }}
                                                </h5>
                                                <div class="space-y-1.5">
                                                    @foreach($subjects as $sub)
                                                        <div class="bg-white p-2.5 rounded-xl border border-slate-200 flex items-center justify-between text-xs hover:border-blue-300 transition">
                                                            <div class="pr-2">
                                                                <span class="font-bold text-blue-700 bg-blue-50 px-2 py-0.5 rounded border border-blue-100">{{ $sub->code }}</span>
                                                                <span class="text-slate-800 font-medium ml-1.5">{{ $sub->title }}</span>
                                                            </div>
                                                            <span class="flex-shrink-0 bg-slate-100 text-slate-600 font-bold px-2 py-0.5 rounded-md text-[10px] border border-slate-200">
                                                                {{ $sub->units }} Units
                                                            </span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-8 text-center text-slate-400 italic bg-slate-50 rounded-2xl border border-dashed border-slate-300">
                                Walang nahanap na IT subjects.
                            </div>
                        @endif
                    </div>

                    <!-- BSCS CURRICULUM TAB -->
                    <div x-show="courseTab === 'CS'" class="space-y-6" style="display: none;">
                        @php
                            $csGrouped = isset($csSubjects) ? $csSubjects->groupBy(['year', 'semester']) : collect();
                        @endphp

                        @if($csGrouped->isNotEmpty())
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($csGrouped as $year => $semesters)
                                    <div class="bg-slate-50 border border-slate-200 rounded-2xl p-4 shadow-sm">
                                        <div class="bg-indigo-600 text-white font-extrabold px-3.5 py-1.5 rounded-xl text-xs inline-block mb-3 uppercase tracking-wider">
                                            Year Level {{ $year }}
                                        </div>

                                        @foreach($semesters as $semester => $subjects)
                                            <div class="mb-4 last:mb-0">
                                                <h5 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 border-b border-slate-200 pb-1">
                                                    {{ $semester == 1 ? '1st Semester' : '2nd Semester' }}
                                                </h5>
                                                <div class="space-y-1.5">
                                                    @foreach($subjects as $sub)
                                                        <div class="bg-white p-2.5 rounded-xl border border-slate-200 flex items-center justify-between text-xs hover:border-indigo-300 transition">
                                                            <div class="pr-2">
                                                                <span class="font-bold text-indigo-700 bg-indigo-50 px-2 py-0.5 rounded border border-indigo-100">{{ $sub->code }}</span>
                                                                <span class="text-slate-800 font-medium ml-1.5">{{ $sub->title }}</span>
                                                            </div>
                                                            <span class="flex-shrink-0 bg-slate-100 text-slate-600 font-bold px-2 py-0.5 rounded-md text-[10px] border border-slate-200">
                                                                {{ $sub->units }} Units
                                                            </span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-8 text-center text-slate-400 italic bg-slate-50 rounded-2xl border border-dashed border-slate-300">
                                Walang nahanap na CS subjects.
                            </div>
                        @endif
                    </div>

                </div>
            </div>
                        <div class="bg-blue-600 px-6 py-4 flex items-center justify-between text-white font-bold text-lg">
                            <div class="flex items-center space-x-2">
                                <span>📖</span>
                                <span>System Usage Guide</span>
                            </div>
                            <button @click="showGuide = false" class="text-white/80 hover:text-white transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="p-6 space-y-4 max-h-[70vh] overflow-y-auto text-slate-700 text-sm">
                            <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-200">
                                <h4 class="font-bold text-slate-900 mb-1 flex items-center space-x-1.5">
                                    <span>1.</span>
                                    <span>👥 User Management</span>
                                </h4>
                                <p class="text-xs text-slate-600">Click <strong>Manage All Users</strong> to add, edit, or remove account records for Students, Instructors, and Administrators.</p>
                            </div>

                            <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-200">
                                <h4 class="font-bold text-slate-900 mb-1 flex items-center space-x-1.5">
                                    <span>2.</span>
                                    <span>📘 Academic Subjects</span>
                                </h4>
                                <p class="text-xs text-slate-600">Click <strong>Subjects</strong> under Academic Management to configure curriculum course details and subjects.</p>
                            </div>

                            <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-200">
                                <h4 class="font-bold text-slate-900 mb-1 flex items-center space-x-1.5">
                                    <span>3.</span>
                                    <span>🏢 Rooms & Facilities</span>
                                </h4>
                                <p class="text-xs text-slate-600">Use <strong>Rooms</strong> to register and manage available classrooms, laboratories, and CICT facilities.</p>
                            </div>

                            <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-200">
                                <h4 class="font-bold text-slate-900 mb-1 flex items-center space-x-1.5">
                                    <span>4.</span>
                                    <span>📅 Schedules Management</span>
                                </h4>
                                <p class="text-xs text-slate-600">Navigate to <strong>Schedules</strong> to assign Subjects, Rooms, Instructors, and Time Slots while preventing schedule conflicts.</p>
                            </div>
                        </div>

                        <div class="p-4 bg-slate-50 border-t border-slate-200 flex justify-end">
                            <button @click="showGuide = false" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl text-sm transition">
                                Got It
                            </button>
                        </div>
                    </div>
                </div>
            </template>

        </div>
    </x-slot>

    <!-- Main Dashboard Body Section -->
    <div class="py-8 bg-slate-100 min-h-screen text-slate-800">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Welcome Banner Card -->
            <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-800 rounded-2xl shadow-xl p-6 text-white border border-blue-500/30">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Welcome, System Administrator!</h1>
                        <p class="mt-2 text-blue-100 text-sm sm:text-base">
                            Manage Users, Subjects, Rooms, and Class Schedules for the CICT Portal.
                        </p>
                    </div>
                    <div class="hidden md:block opacity-20 text-6xl font-black select-none pr-4">
                        CICT
                    </div>
                </div>
            </div>

            <!-- Live Weather Dashboard Card -->
            <div class="bg-white border border-slate-200/80 rounded-2xl shadow-md p-6">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between border-b border-slate-100 pb-4 mb-4 gap-4">
                    <div class="flex items-center space-x-3">
                        <div class="p-2.5 bg-sky-50 text-sky-600 rounded-xl border border-sky-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 001-9.999 5.002 5.002 0 00-9.78 2.096A4.001 4.001 0 003 15z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">🌤️ Live Weather Dashboard</h3>
                            <p class="text-xs text-slate-500">Current real-time weather update</p>
                        </div>
                    </div>

                    <!-- Search Weather Input & Dropdown Container -->
                    <div class="flex flex-wrap items-center space-x-2 w-full sm:w-auto relative">
                        <!-- Use As Default Location Button -->
                        <button id="useLocationBtn" onclick="saveAsDefaultLocation()" class="hidden px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl transition flex items-center space-x-1 shadow-md">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Use as Default Location</span>
                        </button>

                        <div class="relative flex-1 sm:flex-initial">
                            <div class="flex items-center space-x-1.5">
                                <input type="text" id="citySearchInput" placeholder="I-search ang lugar..." class="px-3 py-1.5 text-sm border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 w-full sm:w-56" autocomplete="off">
                                <button id="citySearchBtn" onclick="handleSearch()" class="px-4 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl transition shadow-sm">
                                    Search
                                </button>
                            </div>

                            <!-- [NAIDAGDAG] Search Auto-complete Suggestions Dropdown -->
                            <div id="searchResultsDropdown" class="hidden absolute left-0 right-0 top-full mt-1 bg-white border border-slate-200 rounded-xl shadow-xl z-50 overflow-hidden max-h-56 overflow-y-auto">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status / Notification Message Container -->
                <div id="weatherStatusMessage" class="hidden mb-4 p-3 rounded-xl text-xs font-medium"></div>

                <!-- Weather Info Display Grid -->
                <div id="weatherDisplayGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 items-center">
                    <!-- Temp & Condition -->
                    <div class="flex items-center space-x-4 bg-slate-50 p-4 rounded-xl border border-slate-200">
                        <span id="weatherEmoji" class="text-3xl">🌤️</span>
                        <div>
                            <span id="weatherTemp" class="text-2xl font-extrabold text-slate-900">--°C</span>
                            <p id="weatherCondition" class="text-slate-500 text-xs font-medium capitalize">Wala pang lugar</p>
                        </div>
                    </div>

                    <!-- Details Grid -->
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
                        <span class="text-xs text-slate-500 font-semibold block mb-1">📍 Location</span>
                        <div class="flex items-center space-x-2">
                            <span id="weatherCity" class="font-bold text-slate-900 text-sm">--</span>
                            <span id="defaultBadge" class="hidden px-2 py-0.5 bg-blue-100 text-blue-700 text-[10px] font-extrabold rounded-full">DEFAULT</span>
                        </div>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
                        <span class="text-xs text-slate-500 font-semibold block mb-1">💧 Humidity</span>
                        <span id="weatherHumidity" class="font-bold text-slate-900 text-sm">--%</span>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
                        <span class="text-xs text-slate-500 font-semibold block mb-1">💨 Wind Speed</span>
                        <span id="weatherWind" class="font-bold text-slate-900 text-sm">-- m/s</span>
                    </div>
                </div>
            </div>

            <!-- Main Portal Management Sections Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Card 1: User Management -->
                <div class="bg-white border border-slate-200/80 rounded-2xl shadow-md p-6 hover:border-blue-500 transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-3 mb-3">
                            <div class="p-2.5 bg-blue-50 text-blue-600 rounded-xl border border-blue-100">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 100 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900">👥 User Management</h3>
                        </div>
                        <p class="text-slate-500 text-sm mb-6">
                            Manage all user account categories including Students, Instructors, and System Administrators.
                        </p>
                    </div>
                    
                    <div>
                        <a href="{{ route('admin.users.index') }}" class="w-full flex items-center justify-center space-x-2 px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-md transition duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Manage All Users</span>
                        </a>
                    </div>
                </div>

                <!-- Card 2: Academic Management -->
                <div class="bg-white border border-slate-200/80 rounded-2xl shadow-md p-6 hover:border-emerald-500 transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-3 mb-3">
                            <div class="p-2.5 bg-emerald-50 text-emerald-600 rounded-xl border border-emerald-100">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4m-4 0V11m0 0h4m-4 0H7"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900">🏫 Academic Management</h3>
                        </div>
                        <p class="text-slate-500 text-sm mb-6">Update and organize curriculum subjects, room allocations, and class schedules.</p>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-2.5">
                        <a href="{{ route('admin.subjects.index') }}" class="flex items-center justify-center space-x-1 px-3 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs sm:text-sm font-bold rounded-xl border border-slate-200 transition">
                            <span>📘</span>
                            <span>Subjects</span>
                        </a>
                        <a href="{{ route('admin.rooms.index') }}" class="flex items-center justify-center space-x-1 px-3 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs sm:text-sm font-bold rounded-xl border border-slate-200 transition">
                            <span>🏢</span>
                            <span>Rooms</span>
                        </a>
                        <a href="{{ route('admin.schedules.index') }}" class="flex items-center justify-center space-x-1 px-3 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs sm:text-sm font-bold rounded-xl shadow-md transition">
                            <span>📅</span>
                            <span>Schedules</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- JavaScript Weather Logic na may Live Search Autocomplete -->
    <script>
        let currentLoadedCity = '';
        let typingDebounceTimer;

        document.addEventListener('DOMContentLoaded', () => {
            const savedDefaultCity = localStorage.getItem('cict_default_weather_city');
            
            if (savedDefaultCity) {
                getWeatherByCityName(savedDefaultCity);
            } else {
                getWeatherByCityName(''); // Kunin ang default mula sa .env (Arakan)
            }

            // Event listener para sa Enter key sa search input
            document.getElementById('citySearchInput')?.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    const dropdown = document.getElementById('searchResultsDropdown');
                    if (dropdown) dropdown.classList.add('hidden');
                    handleSearch();
                }
            });

            // Live typing handler para lumabas ang autocomplete
            document.getElementById('citySearchInput')?.addEventListener('input', (e) => {
                handleTyping(e.target.value);
            });

            // Isara ang suggestion dropdown kapag nag-click sa labas
            document.addEventListener('click', (e) => {
                const dropdown = document.getElementById('searchResultsDropdown');
                const input = document.getElementById('citySearchInput');
                if (dropdown && !dropdown.contains(e.target) && e.target !== input) {
                    dropdown.classList.add('hidden');
                }
            });
        });

        // Live Auto-complete Typing Handler
        function handleTyping(query) {
            clearTimeout(typingDebounceTimer);
            const dropdown = document.getElementById('searchResultsDropdown');

            if (!query || query.trim().length < 2) {
                if (dropdown) dropdown.classList.add('hidden');
                return;
            }

            typingDebounceTimer = setTimeout(async () => {
                try {
                    const res = await fetch(`/api/weather/search?q=${encodeURIComponent(query.trim())}`);
                    const places = await res.json();

                    if (Array.isArray(places) && places.length > 0) {
                        dropdown.innerHTML = '';
                        places.forEach(place => {
                            const state = place.state ? `, ${place.state}` : '';
                            const country = place.country ? `, ${place.country}` : '';
                            const fullName = `${place.name}${state}${country}`;

                            const item = document.createElement('div');
                            item.className = 'px-3 py-2 text-xs text-slate-700 hover:bg-blue-50 hover:text-blue-600 cursor-pointer border-b border-slate-100 last:border-0 font-medium flex items-center justify-between';
                            item.innerHTML = `<span>📍 ${fullName}</span><span class="text-[10px] text-slate-400">Piliin</span>`;
                            
                            item.onclick = () => {
                                document.getElementById('citySearchInput').value = place.name;
                                dropdown.classList.add('hidden');
                                getWeatherByCityName(place.name);
                            };
                            dropdown.appendChild(item);
                        });
                        dropdown.classList.remove('hidden');
                    } else {
                        dropdown.innerHTML = `<div class="px-3 py-2 text-xs text-slate-400 italic">Walang nahanap na lugar na "${query}"</div>`;
                        dropdown.classList.remove('hidden');
                    }
                } catch (err) {
                    console.error(err);
                }
            }, 300);
        }

        function handleSearch() {
            const dropdown = document.getElementById('searchResultsDropdown');
            if (dropdown) dropdown.classList.add('hidden');

            const query = document.getElementById('citySearchInput').value.trim();
            if (query) {
                getWeatherByCityName(query);
            }
        }

        async function getWeatherByCityName(cityName) {
            showStatus('Hinahanap ang datos ng panahon...', 'info');

            try {
                const res = await fetch(`/api/weather?city=${encodeURIComponent(cityName)}`);
                const data = await res.json();

                if (res.ok && data.main) {
                    currentLoadedCity = data.name;

                    document.getElementById('weatherCity').innerText = `${data.name}, ${data.sys.country}`;
                    document.getElementById('weatherTemp').innerText = `${Math.round(data.main.temp)}°C`;
                    document.getElementById('weatherHumidity').innerText = `${data.main.humidity}%`;
                    document.getElementById('weatherWind').innerText = `${data.wind.speed} m/s`;
                    
                    const condition = data.weather[0].main;
                    const desc = data.weather[0].description;
                    const weatherInfo = parseOpenWeatherCondition(condition);

                    document.getElementById('weatherCondition').innerText = desc;
                    document.getElementById('weatherEmoji').innerText = weatherInfo.emoji;

                    checkIfDefaultLocation();
                    hideStatus();
                } else {
                    showStatus(data.error || 'Hindi nahanap ang lugar. Paki-check ang spelling.', 'error');
                }
            } catch (error) {
                console.error(error);
                showStatus('Nagka-error sa pag-fetch ng weather data.', 'error');
            }
        }

        function saveAsDefaultLocation() {
            if (currentLoadedCity) {
                localStorage.setItem('cict_default_weather_city', currentLoadedCity);
                checkIfDefaultLocation();
                showStatus(`Naitakda na ang "${currentLoadedCity}" bilang iyong permanenteng default location!`, 'info');
                setTimeout(hideStatus, 3000);
            }
        }

        function checkIfDefaultLocation() {
            const savedDefault = localStorage.getItem('cict_default_weather_city');
            const useBtn = document.getElementById('useLocationBtn');
            const defaultBadge = document.getElementById('defaultBadge');

            if (savedDefault && currentLoadedCity.toLowerCase() === savedDefault.toLowerCase()) {
                if (useBtn) useBtn.classList.add('hidden');
                if (defaultBadge) defaultBadge.classList.remove('hidden');
            } else {
                if (useBtn) useBtn.classList.remove('hidden');
                if (defaultBadge) defaultBadge.classList.add('hidden');
            }
        }

        function parseOpenWeatherCondition(mainCondition) {
            switch (mainCondition.toLowerCase()) {
                case 'clear':
                    return { emoji: '☀️' };
                case 'clouds':
                    return { emoji: '☁️' };
                case 'rain':
                case 'drizzle':
                    return { emoji: '🌧️' };
                case 'thunderstorm':
                    return { emoji: '⛈️' };
                case 'snow':
                    return { emoji: '❄️' };
                case 'mist':
                case 'fog':
                case 'haze':
                    return { emoji: '🌫️' };
                default:
                    return { emoji: '🌤️' };
            }
        }

        function showStatus(msg, type) {
            const box = document.getElementById('weatherStatusMessage');
            if (!box) return;
            box.innerText = msg;
            box.classList.remove('hidden', 'bg-amber-50', 'text-amber-800', 'bg-red-50', 'text-red-800', 'bg-blue-50', 'text-blue-800');

            if (type === 'error') {
                box.classList.add('bg-red-50', 'text-red-800', 'border', 'border-red-200');
            } else {
                box.classList.add('bg-blue-50', 'text-blue-800', 'border', 'border-blue-200');
            }
        }

        function hideStatus() {
            const box = document.getElementById('weatherStatusMessage');
            if (box) box.classList.add('hidden');
        }
    </script>
</x-app-layout>