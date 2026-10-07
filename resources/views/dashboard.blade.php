<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white leading-tight flex items-center space-x-2">
            <span>CICT Scheduling Dashboard</span>
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <!-- Welcome Card -->
        <div class="p-8 bg-slate-800/80 border border-slate-700/60 shadow-2xl rounded-2xl relative overflow-hidden">
            <div class="absolute -right-10 -bottom-10 text-9xl opacity-5 pointer-events-none">🎓</div>
            
            <div class="relative z-10">
                <span class="inline-block px-3 py-1 rounded-full bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 text-xs font-semibold uppercase tracking-wider mb-3">
                    {{ strtoupper(Auth::user()->role) }} PANEL
                </span>
                <h3 class="text-2xl font-bold text-white mb-2">
                    Maligayang Pagdating, {{ Auth::user()->name }}!
                </h3>

                @if(Auth::user()->role === 'admin')
                    <p class="text-slate-300 max-w-2xl text-base leading-relaxed mb-6">
                        Gagamitin ang Admin Panel para pamahalaan ang mga Subjects, Rooms, at Schedules.
                    </p>

                    <!-- Admin Action Buttons -->
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('admin.subjects.index') }}" 
                           class="inline-flex items-center space-x-2 px-5 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-semibold shadow-lg shadow-indigo-600/30 transition transform hover:-translate-y-0.5">
                            <span>📚</span>
                            <span>Manage Subjects</span>
                        </a>

                        <a href="{{ route('admin.rooms.index') }}" 
                           class="inline-flex items-center space-x-2 px-5 py-3 rounded-xl bg-slate-700 hover:bg-slate-600 text-white font-semibold border border-slate-600 shadow-md transition transform hover:-translate-y-0.5">
                            <span>🏫</span>
                            <span>Manage Rooms</span>
                        </a>

                        <a href="{{ route('admin.schedules.index') }}" 
                           class="inline-flex items-center space-x-2 px-5 py-3 rounded-xl bg-slate-700 hover:bg-slate-600 text-white font-semibold border border-slate-600 shadow-md transition transform hover:-translate-y-0.5">
                            <span>🗓️</span>
                            <span>Manage Schedules</span>
                        </a>
                    </div>
                @else
                    <p class="text-slate-300 max-w-2xl text-base leading-relaxed mb-4">
                        Tingnan ang iyong nakatakdang mga klase at oras para sa semester na ito.
                    </p>
                @endif
            </div>
        </div>

        <!-- Student / Instructor Schedule Table View -->
        @if(Auth::user()->role !== 'admin')
            <div class="bg-slate-800/80 border border-slate-700/60 rounded-2xl shadow-xl overflow-hidden p-6">
                <h4 class="font-bold text-lg mb-4 text-white flex items-center space-x-2">
                    <span>🗓️</span>
                    <span>Aking Class Schedule</span>
                </h4>

                <div class="overflow-x-auto rounded-xl border border-slate-700/80">
                    <table class="min-w-full divide-y divide-slate-700">
                        <thead class="bg-slate-900/80">
                            <tr>
                                <th class="px-6 py-3.5 text-left text-xs font-bold text-indigo-400 uppercase tracking-wider">Subject</th>
                                <th class="px-6 py-3.5 text-left text-xs font-bold text-indigo-400 uppercase tracking-wider">Instructor</th>
                                <th class="px-6 py-3.5 text-left text-xs font-bold text-indigo-400 uppercase tracking-wider">Room</th>
                                <th class="px-6 py-3.5 text-left text-xs font-bold text-indigo-400 uppercase tracking-wider">Day & Time</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700/60 bg-slate-800/40 text-slate-200">
                            @forelse($schedules ?? [] as $schedule)
                                <tr class="hover:bg-slate-700/30 transition">
                                    <td class="px-6 py-4 font-semibold text-white">
                                        {{ $schedule->subject->code }} - {{ $schedule->subject->title }}
                                    </td>
                                    <td class="px-6 py-4 text-slate-300">
                                        {{ $schedule->instructor ? $schedule->instructor->name : 'Unassigned' }}
                                    </td>
                                    <td class="px-6 py-4 text-slate-300">
                                        <span class="px-3 py-1 bg-slate-700 border border-slate-600 rounded-lg text-xs font-medium">
                                            {{ $schedule->room->name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-slate-300">
                                        {{ $schedule->day }} <span class="text-indigo-400 font-medium">({{ $schedule->start_time }} - {{ $schedule->end_time }})</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-slate-400 font-medium">
                                        Walang nakakabit na schedule sa kasalukuyan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>