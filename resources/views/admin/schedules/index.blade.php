<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-white leading-tight tracking-wide">
                    Schedule Management
                </h2>
                <p class="text-xs text-slate-400">CICT Academic Scheduling & Conflict Prevention Dashboard</p>
            </div>
            
            <div class="flex items-center space-x-3">
                <!-- Export / Print Button -->
                <button onclick="window.print()" 
                        class="inline-flex items-center space-x-2 px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 font-semibold text-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    <span>Print Schedule</span>
                </button>

                <!-- Add New Schedule Button -->
                <a href="{{ route('admin.schedules.create') }}" 
                   class="inline-flex items-center space-x-2 px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-sm shadow-lg shadow-indigo-600/30 transition transform hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span>Add New Schedule</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-950 min-h-screen text-slate-100" x-data="{ search: '', selectedDay: 'All', selectedCourse: 'All' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Quick Stats Overview Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-slate-900/80 border border-slate-800 p-4 rounded-2xl flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-400 font-medium">Kabuuang Schedules</p>
                        <p class="text-2xl font-bold text-white mt-1">{{ method_exists($schedules, 'total') ? $schedules->total() : $schedules->count() }}</p>
                    </div>
                    <div class="p-3 bg-indigo-600/20 text-indigo-400 rounded-xl border border-indigo-500/30">
                        🗓️
                    </div>
                </div>

                <div class="bg-slate-900/80 border border-slate-800 p-4 rounded-2xl flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-400 font-medium">May Instructor</p>
                        <p class="text-2xl font-bold text-emerald-400 mt-1">
                            {{ $schedules->filter(fn($s) => $s->instructor_id !== null)->count() }}
                        </p>
                    </div>
                    <div class="p-3 bg-emerald-600/20 text-emerald-400 rounded-xl border border-emerald-500/30">
                        👨‍🏫
                    </div>
                </div>

                <div class="bg-slate-900/80 border border-slate-800 p-4 rounded-2xl flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-400 font-medium">Unassigned Classes</p>
                        <p class="text-2xl font-bold text-amber-400 mt-1">
                            {{ $schedules->filter(fn($s) => $s->instructor_id === null)->count() }}
                        </p>
                    </div>
                    <div class="p-3 bg-amber-600/20 text-amber-400 rounded-xl border border-amber-500/30">
                        ⚠️
                    </div>
                </div>
            </div>

            <!-- Success Alert Box -->
            @if(session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/50 text-emerald-300 px-5 py-4 rounded-2xl backdrop-blur-md flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-medium text-sm">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Navigation Controls & Filters Bar -->
            <div class="bg-slate-900/80 border border-slate-800 p-5 rounded-2xl shadow-2xl backdrop-blur-xl flex flex-col md:flex-row justify-between items-center gap-4">
                
                <!-- Day & Course Filter Tabs -->
                <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                    <!-- Day Filter -->
                    <div class="flex items-center gap-1 bg-slate-950 p-1.5 rounded-xl border border-slate-800/80 overflow-x-auto">
                        <button @click="selectedDay = 'All'" 
                                :class="selectedDay === 'All' ? 'bg-indigo-600 text-white shadow-md' : 'text-slate-400 hover:text-white hover:bg-slate-800/60'"
                                class="px-3 py-1.5 rounded-lg font-semibold text-xs transition whitespace-nowrap">
                            Lahat
                        </button>
                        <template x-for="day in ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']">
                            <button @click="selectedDay = day" 
                                    :class="selectedDay === day ? 'bg-indigo-600 text-white shadow-md' : 'text-slate-400 hover:text-white hover:bg-slate-800/60'"
                                    class="px-3 py-1.5 rounded-lg font-semibold text-xs transition whitespace-nowrap" x-text="day"></button>
                        </template>
                    </div>

                    <!-- Course Filter Dropdown -->
                    <select x-model="selectedCourse" 
                            class="px-3 py-2 bg-slate-950 border border-slate-800 rounded-xl text-xs text-white focus:outline-none focus:border-indigo-500">
                        <option value="All">Lahat ng Course</option>
                        <option value="BSIT">BSIT</option>
                        <option value="BSCS">BSCS</option>
                    </select>
                </div>

                <!-- Live Search Box -->
                <div class="w-full md:w-72">
                    <div class="relative">
                        <input type="text" x-model="search" placeholder="Search Subject, Instructor, Room..." 
                               class="w-full pl-10 pr-4 py-2 bg-slate-950 border border-slate-800 rounded-xl text-xs text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dark Table Card Container -->
            <div class="bg-slate-900/80 border border-slate-800 shadow-2xl rounded-2xl overflow-hidden backdrop-blur-xl">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-800">
                        <thead class="bg-slate-950/60">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-indigo-400 uppercase tracking-wider">Subject Details</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-indigo-400 uppercase tracking-wider">Instructor</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-indigo-400 uppercase tracking-wider">Room & Building</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-indigo-400 uppercase tracking-wider">Day & Time</th>
                                <th class="px-6 py-4 text-right text-xs font-bold text-indigo-400 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/60 bg-slate-900/30 text-slate-200">
                            @forelse($schedules as $schedule)
                                <tr class="hover:bg-slate-800/50 transition"
                                    x-show="(selectedDay === 'All' || '{{ $schedule->day }}' === selectedDay) &&
                                            (selectedCourse === 'All' || '{{ $schedule->subject->course ?? '' }}' === selectedCourse) &&
                                            ('{{ strtolower(($schedule->subject->code ?? '') . ' ' . ($schedule->subject->title ?? '') . ' ' . ($schedule->instructor->name ?? '') . ' ' . ($schedule->room->name ?? '')) }}'.includes(search.toLowerCase()))">
                                    
                                    <!-- Subject Details -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="space-y-1">
                                            <div class="flex items-center space-x-2">
                                                <span class="px-2.5 py-0.5 bg-indigo-500/20 font-mono text-xs font-bold text-indigo-300 rounded border border-indigo-500/30">
                                                    {{ $schedule->subject->code ?? 'N/A' }}
                                                </span>
                                                <span class="font-bold text-white text-sm">{{ $schedule->subject->title ?? 'N/A' }}</span>
                                            </div>
                                            <div class="text-xs text-slate-400 flex items-center space-x-2">
                                                <span class="text-slate-300 font-medium">{{ $schedule->subject->course ?? 'BSIT' }} (Yr {{ $schedule->subject->year ?? '1' }})</span>
                                                <span>•</span>
                                                <span>{{ $schedule->subject->units ?? '3' }} Units</span>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Instructor -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($schedule->instructor)
                                            <div class="flex items-center space-x-2">
                                                <div class="h-7 w-7 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center font-bold text-indigo-400 text-xs">
                                                    👨‍🏫
                                                </div>
                                                <span class="text-slate-200 font-medium text-sm">{{ $schedule->instructor->name }}</span>
                                            </div>
                                        @else
                                            <span class="px-2.5 py-1 bg-amber-500/10 text-amber-400 border border-amber-500/30 rounded-lg text-xs font-semibold">
                                                ⚠️ Unassigned
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Room & Building -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="space-y-0.5">
                                            <span class="inline-block px-3 py-1 bg-slate-800 border border-slate-700 rounded-lg text-xs font-semibold text-slate-200">
                                                🚪 {{ $schedule->room->name ?? 'N/A' }}
                                            </span>
                                            <div class="text-[11px] text-slate-400">🏢 {{ $schedule->room->building ?? 'N/A' }}</div>
                                        </div>
                                    </td>

                                    <!-- Day & Time -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-indigo-300 font-semibold text-sm">
                                            🗓️ {{ $schedule->day }}
                                        </div>
                                        <div class="text-xs text-slate-400 font-mono">
                                            ⏰ {{ date('g:i A', strtotime($schedule->start_time)) }} - {{ date('g:i A', strtotime($schedule->end_time)) }}
                                        </div>
                                    </td>

                                    <!-- Actions -->
                                    <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                                        <a href="{{ route('admin.schedules.edit', $schedule) }}" 
                                           class="inline-block px-3 py-1.5 bg-indigo-600/20 text-indigo-300 border border-indigo-500/30 rounded-lg hover:bg-indigo-600 hover:text-white transition text-xs font-semibold">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.schedules.destroy', $schedule) }}" method="POST" class="inline-block" onsubmit="return confirm('Sigurado ka bang gusto mong idelete ang schedule na ito?')">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="px-3 py-1.5 bg-rose-600/20 text-rose-300 border border-rose-500/30 rounded-lg hover:bg-rose-600 hover:text-white transition text-xs font-semibold">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-slate-500 font-medium">
                                        Walang nakita o naidagdag na schedule records.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if(method_exists($schedules, 'links'))
                    <div class="p-4 border-t border-slate-800 bg-slate-950/40">
                        {{ $schedules->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>