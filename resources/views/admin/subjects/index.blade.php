<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-white leading-tight">
                Subject Management & Curriculum
            </h2>
            <a href="{{ route('admin.subjects.create') }}" 
               class="inline-flex items-center space-x-2 px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold shadow-lg shadow-indigo-600/30 transition transform hover:-translate-y-0.5">
                <span>+ Add New Subject</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12" x-data="{ curriculumTab: 'IT', yearFilter: 'ALL' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Success Alert Box -->
            @if(session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/50 text-emerald-400 px-5 py-4 rounded-xl backdrop-blur-md">
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Curriculum Tabs & Filters Section -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-2">
                <div class="flex space-x-3">
                    <button @click="curriculumTab = 'IT'" 
                            :class="curriculumTab === 'IT' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30 border-indigo-500' : 'bg-slate-800/80 text-slate-400 hover:bg-slate-700 hover:text-white border-slate-700'"
                            class="px-6 py-3 rounded-xl font-bold text-sm transition-all duration-300 flex items-center space-x-2 border">
                        <span>💻</span>
                        <span>BS Information Technology (BSIT)</span>
                    </button>
                    <button @click="curriculumTab = 'CS'" 
                            :class="curriculumTab === 'CS' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30 border-indigo-500' : 'bg-slate-800/80 text-slate-400 hover:bg-slate-700 hover:text-white border-slate-700'"
                            class="px-6 py-3 rounded-xl font-bold text-sm transition-all duration-300 flex items-center space-x-2 border">
                        <span>🖥️</span>
                        <span>BS Computer Science (BSCS)</span>
                    </button>
                </div>

                <!-- Year Filter Pills -->
                <div class="flex items-center space-x-1.5 bg-slate-900/80 p-1.5 rounded-xl border border-slate-700/80 text-xs shadow-inner">
                    <span class="text-slate-400 px-2 font-semibold">Filter:</span>
                    <button @click="yearFilter = 'ALL'" :class="yearFilter === 'ALL' ? 'bg-indigo-600 text-white font-bold shadow' : 'text-slate-400 hover:text-white'" class="px-3 py-1.5 rounded-lg transition">All</button>
                    <button @click="yearFilter = 1" :class="yearFilter === 1 ? 'bg-indigo-600 text-white font-bold shadow' : 'text-slate-400 hover:text-white'" class="px-3 py-1.5 rounded-lg transition">1st Yr</button>
                    <button @click="yearFilter = 2" :class="yearFilter === 2 ? 'bg-indigo-600 text-white font-bold shadow' : 'text-slate-400 hover:text-white'" class="px-3 py-1.5 rounded-lg transition">2nd Yr</button>
                    <button @click="yearFilter = 3" :class="yearFilter === 3 ? 'bg-indigo-600 text-white font-bold shadow' : 'text-slate-400 hover:text-white'" class="px-3 py-1.5 rounded-lg transition">3rd Yr</button>
                    <button @click="yearFilter = 4" :class="yearFilter === 4 ? 'bg-indigo-600 text-white font-bold shadow' : 'text-slate-400 hover:text-white'" class="px-3 py-1.5 rounded-lg transition">4th Yr</button>
                </div>
            </div>

            <!-- Modern Flat Table List (Wala nang malaking puti o hiwalay na box container) -->
            <div class="overflow-hidden">
                <div class="max-h-[720px] overflow-y-auto pr-1 space-y-4">
                    <table class="min-w-full divide-y divide-slate-700/60">
                        <thead class="bg-slate-900/90 sticky top-0 z-20 backdrop-blur-md">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-indigo-400 uppercase tracking-wider rounded-l-xl">Subject Code</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-indigo-400 uppercase tracking-wider">Descriptive Title</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-indigo-400 uppercase tracking-wider">Year & Semester</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-indigo-400 uppercase tracking-wider">Units</th>
                                <th class="px-6 py-4 text-right text-xs font-bold text-indigo-400 uppercase tracking-wider rounded-r-xl">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800 text-slate-200">
                            @forelse($subjects->groupBy(['course', 'year', 'semester']) as $course => $years)
                                @foreach($years as $year => $semesters)
                                    @foreach($semesters as $semester => $groupedSubjects)
                                        
                                        <!-- Section Divider per Year & Semester -->
                                        <tr x-show="curriculumTab === '{{ $course }}' && (yearFilter === 'ALL' || yearFilter === {{ $year }})"
                                            class="bg-indigo-950/30 border-y border-indigo-500/20">
                                            <td colspan="5" class="px-6 py-3 font-bold text-xs text-indigo-300 uppercase tracking-wider">
                                                <div class="flex items-center space-x-2">
                                                    <span class="w-2.5 h-2.5 rounded-full bg-indigo-500 shadow-sm shadow-indigo-500/50"></span>
                                                    <span>Year {{ $year }} — {{ $semester == 1 ? '1st Semester' : '2nd Semester' }}</span>
                                                    <span class="text-slate-400 font-normal lowercase">({{ $groupedSubjects->count() }} subjects)</span>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Subject Items -->
                                        @foreach($groupedSubjects as $subject)
                                            <tr class="hover:bg-slate-800/50 transition-all duration-150" 
                                                x-show="curriculumTab === '{{ $course }}' && (yearFilter === 'ALL' || yearFilter === {{ $year }})"
                                                x-transition:enter="transition ease-out duration-200"
                                                x-transition:enter-start="opacity-0 transform -translate-y-1"
                                                x-transition:enter-end="opacity-100 transform translate-y-0">
                                                
                                                <!-- Code -->
                                                <td class="px-6 py-4 font-bold text-white whitespace-nowrap">
                                                    <span class="px-3 py-1 rounded-lg bg-slate-900 border border-slate-700/80 font-mono text-indigo-300 text-xs shadow-sm">
                                                        {{ $subject->code }}
                                                    </span>
                                                </td>

                                                <!-- Title -->
                                                <td class="px-6 py-4 text-slate-200 font-medium">
                                                    {{ $subject->title }}
                                                </td>

                                                <!-- Year & Semester -->
                                                <td class="px-6 py-4 whitespace-nowrap text-center text-xs">
                                                    <span class="px-3 py-1 bg-slate-800/80 border border-slate-700 rounded-full font-semibold text-slate-300">
                                                        Year {{ $subject->year }} • Sem {{ $subject->semester }}
                                                    </span>
                                                </td>

                                                <!-- Units -->
                                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                                    <span class="px-3 py-1 bg-slate-800/60 border border-slate-700/60 rounded-lg text-xs font-bold text-slate-300">
                                                        {{ $subject->units }} {{ Str::plural('Unit', $subject->units) }}
                                                    </span>
                                                </td>

                                                <!-- Actions -->
                                                <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                                                    <a href="{{ route('admin.subjects.edit', $subject) }}" 
                                                       class="inline-block px-3 py-1.5 bg-indigo-600/20 text-indigo-300 border border-indigo-500/30 rounded-lg hover:bg-indigo-600 hover:text-white transition text-xs font-semibold shadow-sm">
                                                        Edit
                                                    </a>

                                                    <form action="{{ route('admin.subjects.destroy', $subject) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this subject?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="px-3 py-1.5 bg-rose-600/20 text-rose-300 border border-rose-500/30 rounded-lg hover:bg-rose-600 hover:text-white transition text-xs font-semibold shadow-sm">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach

                                    @endforeach
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-slate-400 font-medium">
                                        No subjects found in the database.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>