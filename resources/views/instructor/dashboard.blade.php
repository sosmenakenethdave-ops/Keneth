<x-app-layout>
    <!-- Alpine.js State Navigation -->
    <div x-data="{ 
            helpOpen: false, 
            showHowToUse: false, 
            showAbout: false,
            showCurriculumModal: false,
            curriculumProgram: 'IT',
            yearFilter: 'ALL',
            semesterFilter: '1',
            searchQuery: ''
         }" 
         class="py-8 bg-slate-50 min-h-screen">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Top Action Header (Kapareho ng Student Dashboard) -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center bg-white p-5 rounded-2xl shadow-sm border border-slate-100 gap-4 no-print">
                <div>
                    <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">Instructor Portal Dashboard</h2>
                    <p class="text-xs text-slate-500 font-medium">Teaching Load Overview & Academic Program Details</p>
                </div>
                
                <div class="flex items-center space-x-3">
                    <!-- Print Schedule Matrix Button -->
                    <a href="{{ route('instructor.print.schedule') }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold rounded-xl shadow-sm transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Print Schedule Matrix
                    </a>

                    <!-- Help & Support Dropdown -->
                    <div class="relative" @click.away="helpOpen = false">
                        <button @click="helpOpen = !helpOpen" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-xl shadow-sm transition cursor-pointer">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Help & Support</span>
                        </button>

                        <div x-show="helpOpen" 
                             x-transition 
                             class="absolute right-0 mt-2 w-52 bg-white rounded-xl shadow-xl border border-slate-100 py-1.5 z-50"
                             style="display: none;">
                            <button @click="showHowToUse = true; helpOpen = false" class="w-full text-left px-4 py-2.5 text-xs text-slate-700 hover:bg-blue-50 hover:text-blue-600 font-medium flex items-center transition cursor-pointer">
                                <span class="mr-2 text-base">📖</span> How to Use System
                            </button>
                            <button @click="showAbout = true; helpOpen = false" class="w-full text-left px-4 py-2.5 text-xs text-slate-700 hover:bg-blue-50 hover:text-blue-600 font-medium flex items-center border-t border-slate-50 transition cursor-pointer">
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
                        <h3 class="text-2xl font-bold text-slate-900">Instructor Dashboard: {{ Auth::user()->name ?? 'Instructor' }}</h3>
                        <p class="text-slate-500 text-sm">Department of Information Technology & Computer Science</p>
                    </div>
                    <div class="flex flex-wrap gap-2.5">
                        <div class="bg-blue-50 px-4 py-2 rounded-xl border border-blue-100 text-blue-700 text-center">
                            <span class="text-[10px] uppercase tracking-wider font-bold block text-blue-500">Role</span>
                            <span class="font-extrabold text-sm">Instructor</span>
                        </div>
                        <div class="bg-indigo-50 px-4 py-2 rounded-xl border border-indigo-100 text-indigo-700 text-center">
                            <span class="text-[10px] uppercase tracking-wider font-bold block text-indigo-500">Building</span>
                            <span class="font-extrabold text-sm">CICT Building</span>
                        </div>
                        <div class="bg-purple-50 px-4 py-2 rounded-xl border border-purple-100 text-purple-700 text-center">
                            <span class="text-[10px] uppercase tracking-wider font-bold block text-purple-500">Status</span>
                            <span class="font-extrabold text-sm">Active</span>
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
                    <button @click="showCurriculumModal = true" class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-md transition flex items-center space-x-1.5 cursor-pointer">
                        <span>📂</span>
                        <span>View Curriculum</span>
                    </button>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-5 border border-slate-100 border-l-4 border-green-500">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Assigned Classes</p>
                    <p class="text-3xl font-extrabold text-slate-900 mt-1">
                        4 <span class="text-sm font-normal text-slate-500">Classes</span>
                    </p>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-5 border border-slate-100 border-l-4 border-amber-500">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Schedule Verification</p>
                    <p class="text-sm font-bold text-amber-600 mt-2">Conflict-Free System</p>
                </div>
            </div>

            <!-- Teaching Load / Schedule Table Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6 border border-slate-100 space-y-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center border-b border-slate-100 pb-5 gap-4">
                    <div>
                        <h4 class="text-lg font-bold text-slate-900">My Assigned Teaching Load & Schedules</h4>
                        <p class="text-xs text-slate-500">Listahan ng mga klase kasama ang building at silid-aralan na naka-assign sa iyo.</p>
                    </div>

                    <!-- SEMESTER FILTER BUTTONS -->
                    <div class="flex items-center bg-slate-100 p-1 rounded-xl space-x-1">
                        <button @click="semesterFilter = '1'" 
                                :class="semesterFilter == '1' ? 'bg-white text-blue-600 font-bold shadow-sm' : 'text-slate-600 hover:text-slate-900'" 
                                class="px-3.5 py-1.5 rounded-lg text-xs transition cursor-pointer">
                            1st Semester
                        </button>
                        <button @click="semesterFilter = '2'" 
                                :class="semesterFilter == '2' ? 'bg-white text-blue-600 font-bold shadow-sm' : 'text-slate-600 hover:text-slate-900'" 
                                class="px-3.5 py-1.5 rounded-lg text-xs transition cursor-pointer">
                            2nd Semester
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto border border-slate-100 rounded-xl">
                    <table class="min-w-full divide-y divide-slate-100">
                        <thead class="bg-slate-50/70">
                            <tr>
                                <th class="px-6 py-3.5 text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider">Subject Code / Name</th>
                                <th class="px-6 py-3.5 text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider">Section</th>
                                <th class="px-6 py-3.5 text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider">Day & Time</th>
                                <th class="px-6 py-3.5 text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider">Room & Building</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100">
                            <tr class="hover:bg-blue-50/40 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-blue-950">IT3101 - Mobile Application Development</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-medium">BSIT 3-A</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-amber-600 font-semibold">📅 Monday ⏰ 7:00 AM - 9:00 AM</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                    🚪 Lecture Hall A <br>
                                    <span class="text-[10px] text-slate-400">🏢 CICT Building</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- INCLUDE CURRICULUM MODAL PARTIAL -->
        @include('instructor.partials.curriculum-modal')

        <!-- MODAL 1: How to Use System -->
        <div x-show="showHowToUse" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm p-4" style="display: none;">
            <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-gray-100 relative">
                <button @click="showHowToUse = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 font-bold cursor-pointer">✕</button>
                <div class="flex items-center space-x-3 mb-4">
                    <div class="p-3 bg-blue-50 text-blue-600 rounded-xl font-bold text-lg">📖</div>
                    <h3 class="text-base font-bold text-gray-900">How to Use System</h3>
                </div>
                <div class="text-xs text-gray-600 space-y-2.5 mb-6 leading-relaxed">
                    <p>1. Click <strong>View Curriculum</strong> para matingnan ang lahat ng subjects mula 1st hanggang 4th year.</p>
                    <p>2. I-check ang iyong assigned teaching loads, oras, room, at building sa iyong dashboard table.</p>
                    <p>3. Click <strong>Print Schedule Matrix</strong> para sa pormal na kopya ng iyong schedule.</p>
                </div>
                <button @click="showHowToUse = false" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs rounded-xl font-bold transition cursor-pointer shadow-sm">Got it, Thanks!</button>
            </div>
        </div>

        <!-- MODAL 2: About & Support Contact Info -->
        <div x-show="showAbout" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm p-4" style="display: none;">
            <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-gray-100 relative">
                <button @click="showAbout = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 font-bold cursor-pointer">✕</button>
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
                <button @click="showAbout = false" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs rounded-xl font-bold transition cursor-pointer shadow-sm">Close</button>
            </div>
        </div>

    </div>
</x-app-layout>