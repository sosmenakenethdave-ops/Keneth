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
                <!-- Inayos ang kulay katulad ng CICT PORTAL branding (White & Blue) -->
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
                    
                    <!-- Choice 1: How to Use -->
                    <button @click="showGuide = true; openHelp = false" class="w-full text-left px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 flex items-center space-x-2.5 transition">
                        <span>📖</span>
                        <span class="font-medium">How to Use System</span>
                    </button>

                    <div class="border-t border-slate-100"></div>

                    <!-- Choice 2: About -->
                    <button @click="showAbout = true; openHelp = false" class="w-full text-left px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 flex items-center space-x-2.5 transition">
                        <span>ℹ️</span>
                        <span class="font-medium">About</span>
                    </button>
                </div>
            </div>

            <!-- MODAL 1: ABOUT POPUP (Centered & Full Blurred Screen Backdrop) -->
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
                        
                        <!-- Title Header -->
                        <div class="bg-blue-600 px-5 py-3.5 flex items-center justify-between text-white font-bold text-lg">
                            <span>About</span>
                            <button @click="showAbout = false" class="text-white/80 hover:text-white transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Modal Content -->
                        <div class="p-6">
                            <div class="flex items-start space-x-4">
                                <!-- Info Icon -->
                                <div class="flex-shrink-0">
                                    <div class="w-14 h-14 bg-blue-500 rounded-full flex items-center justify-center text-white font-extrabold text-3xl shadow-md border-2 border-blue-400">
                                        i
                                    </div>
                                </div>
                                
                                <!-- Information Details -->
                                <div class="space-y-1.5 text-slate-900">
                                    <h3 class="text-xl font-bold text-blue-800">CICT Scheduling System v1.0.0</h3>
                                    <p class="text-sm font-semibold text-slate-800">Copyright © 2026 CICT Portal</p>
                                    <p class="text-sm text-slate-700"><strong>Developer:</strong> Keneth Dave M. Sosmeña</p>
                                    <p class="text-sm text-slate-700"><strong>System Admin:</strong> CICT IT Department</p>
                                    <p class="text-sm text-slate-700"><strong>Website:</strong> <a href="#" class="text-blue-600 hover:underline">https://cict.portal.edu.ph</a></p>
                                    <p class="text-sm text-slate-700"><strong>Facebook:</strong> <a href="#" class="text-blue-600 hover:underline">https://facebook.com/CICTOfficial</a></p>
                                </div>
                            </div>

                            <!-- Action OK Button -->
                            <div class="mt-6 flex justify-center">
                                <button @click="showAbout = false" class="px-8 py-2 bg-sky-500 hover:bg-sky-600 text-white font-bold rounded-full shadow-md transition text-sm">
                                    OK
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <!-- MODAL 2: HOW TO USE POPUP (Centered & Full Blurred Screen Backdrop) -->
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
                <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-4">
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
                    @if(isset($weatherData) && $weatherData)
                        <span class="px-3 py-1 bg-sky-50 text-sky-700 border border-sky-200 rounded-full text-xs font-bold">
                            📍 {{ $weatherData['city'] }}
                        </span>
                    @endif
                </div>

                @if(isset($weatherData) && $weatherData)
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                        <!-- Temp & Condition -->
                        <div class="flex items-center space-x-4 bg-slate-50 p-4 rounded-xl border border-slate-200">
                            @if($weatherData['icon'])
                                <img src="https://openweathermap.org/img/wn/{{ $weatherData['icon'] }}@2x.png" alt="Weather Icon" class="w-12 h-12">
                            @endif
                            <div>
                                <span class="text-2xl font-extrabold text-slate-900">{{ $weatherData['temperature'] }}°C</span>
                                <p class="text-slate-500 text-xs font-medium capitalize">{{ $weatherData['condition'] }}</p>
                            </div>
                        </div>

                        <!-- Details Grid -->
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
                            <span class="text-xs text-slate-500 font-semibold block mb-1">📍 Location</span>
                            <span class="font-bold text-slate-900 text-sm">{{ $weatherData['city'] }}</span>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
                            <span class="text-xs text-slate-500 font-semibold block mb-1">💧 Humidity</span>
                            <span class="font-bold text-slate-900 text-sm">{{ $weatherData['humidity'] }}%</span>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
                            <span class="text-xs text-slate-500 font-semibold block mb-1">💨 Wind Speed</span>
                            <span class="font-bold text-slate-900 text-sm">{{ $weatherData['wind_speed'] }} m/s</span>
                        </div>
                    </div>
                @else
                    <div class="p-4 bg-amber-50 border border-amber-200 rounded-xl text-amber-800 text-sm flex items-center space-x-3">
                        <svg class="w-5 h-5 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <span class="font-medium">⚠️ {{ $weatherError ?? 'Weather information is currently unavailable.' }}</span>
                    </div>
                @endif
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
</x-app-layout>