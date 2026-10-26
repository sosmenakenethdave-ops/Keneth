<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="font-bold text-xl text-blue-950 leading-tight flex items-center gap-2">
                🎓 {{ __('Instructor Portal - Teaching Dashboard') }}
            </h2>
            <div class="flex items-center gap-2">
                <span class="text-xs bg-blue-100 text-blue-800 font-semibold px-3 py-1.5 rounded-full uppercase tracking-wider flex items-center gap-1.5 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span> Active Semester
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Welcome Banner na may Quick Stats -->
            <div class="bg-gradient-to-r from-blue-900 to-blue-700 overflow-hidden shadow-lg sm:rounded-2xl p-6 text-white">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div>
                        <span class="bg-blue-800/80 text-blue-200 text-xs font-semibold px-2.5 py-1 rounded-md uppercase tracking-wider">Instructor Dashboard</span>
                        <h3 class="text-2xl font-extrabold mt-2 mb-1">Welcome back, Instructor!</h3>
                        <p class="text-blue-100 text-sm md:text-base max-w-2xl">
                            Narito ang iyong buod ng teaching load, iskedyul para sa buong semester, at mga silid-aralan na itinalaga sa iyo ng administrador[cite: 3].
                        </p>
                    </div>
                    <!-- Quick Action Button o Badge -->
                    <div class="bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/20 text-center shrink-0">
                        <span class="block text-xs text-blue-200 font-medium uppercase tracking-wider">System Status</span>
                        <span class="text-sm font-bold text-white">Online Schedule Synced</span>
                    </div>
                </div>
            </div>

            <!-- Statistics / Overview Cards (Para mas maging useful sa instructor) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <!-- Card 1: Total Classes -->
                <div class="bg-white overflow-hidden shadow-sm hover:shadow-md transition rounded-2xl p-5 border border-gray-100 border-l-4 border-l-blue-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Classes</p>
                            <h4 class="text-2xl font-bold text-blue-950 mt-1">4</h4>
                        </div>
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl font-bold">
                            📚
                        </div>
                    </div>
                    <span class="text-xs text-gray-500 mt-2 block">Assigned subjects this sem</span>
                </div>

                <!-- Card 2: Total Sections -->
                <div class="bg-white overflow-hidden shadow-sm hover:shadow-md transition rounded-2xl p-5 border border-gray-100 border-l-4 border-l-indigo-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Sections Handled</p>
                            <h4 class="text-2xl font-bold text-blue-950 mt-1">3</h4>
                        </div>
                        <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center text-xl font-bold">
                            👥
                        </div>
                    </div>
                    <span class="text-xs text-gray-500 mt-2 block">BSIT & BSIS Programs</span>
                </div>

                <!-- Card 3: Class Rooms -->
                <div class="bg-white overflow-hidden shadow-sm hover:shadow-md transition rounded-2xl p-5 border border-gray-100 border-l-4 border-l-cyan-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Assigned Rooms</p>
                            <h4 class="text-2xl font-bold text-blue-950 mt-1">Lab Room 1</h4>
                        </div>
                        <div class="w-12 h-12 bg-cyan-50 text-cyan-600 rounded-xl flex items-center justify-center text-xl font-bold">
                            🏫
                        </div>
                    </div>
                    <span class="text-xs text-gray-500 mt-2 block">Primary laboratory location</span>
                </div>

                <!-- Card 4: Teaching Hours -->
                <div class="bg-white overflow-hidden shadow-sm hover:shadow-md transition rounded-2xl p-5 border border-gray-100 border-l-4 border-l-emerald-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</p>
                            <h4 class="text-lg font-bold text-emerald-600 mt-1">Conflict-Free</h4>
                        </div>
                        <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-xl font-bold">
                            🛡️
                        </div>
                    </div>
                    <span class="text-xs text-gray-500 mt-2 block">Verified by Admin System</span>
                </div>
            </div>

            <!-- Teaching Load / Schedule Table Section -->
            <div class="bg-white overflow-hidden shadow-md sm:rounded-2xl p-6 border border-gray-100">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                    <div>
                        <h4 class="text-lg font-bold text-blue-950 flex items-center gap-2">
                            📅 My Assigned Teaching Load & Schedules
                        </h4>
                        <p class="text-xs text-gray-500 mt-0.5">Listahan ng mga klase na naka-assign sa iyong account galing sa admin[cite: 3].</p>
                    </div>
                    <!-- Search or Filter placeholder kung kinakailangan -->
                    <div class="relative">
                        <input type="text" placeholder="Search subject or section..." class="text-sm border border-gray-200 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full sm:w-64 bg-gray-50">
                    </div>
                </div>

                <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-blue-900 text-white">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Subject Code / Name</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Section</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Day</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Time</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">Room</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Kung may data na galing sa controller, i-uncomment itong foreach loop -->
                            <!-- @foreach($instructorSchedules as $schedule) -->
                            <!-- <tr class="hover:bg-blue-50/40 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-blue-950">{{ $schedule->subject->name ?? 'IPT 2' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-medium">{{ $schedule->section->name ?? 'BSIT 3-A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $schedule->day ?? 'Tuesday / Thursday' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $schedule->time ?? '9:00 AM - 12:00 PM' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">
                                        {{ $schedule->room->name ?? 'Lab Room 1' }}
                                    </span>
                                </td>
                            </tr> -->
                            <!-- @endforeach -->

                            <!-- Pansamantalang Static Rows para makita ang itsura ng napagandang table -->
                            <tr class="hover:bg-blue-50/40 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-blue-950">IPT 2 - Integrative Programming</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-medium">BSIT 3-A</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Tuesday / Thursday</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">9:00 AM - 12:00 PM</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">
                                        Lab Room 1
                                    </span>
                                </td>
                            </tr>
                            <tr class="hover:bg-blue-50/40 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-blue-950">IAS 1 - Information Assurance</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-medium">BSIT 3-B</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Monday / Wednesday</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">1:00 PM - 4:00 PM</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-3 py-1 rounded-full">
                                        Lab Room 2
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>