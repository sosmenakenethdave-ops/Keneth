<!-- Curriculum Modal para sa Instructor Portal -->
<div x-show="showCurriculumModal" 
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0 scale-95"
     x-transition:enter-end="opacity-100 scale-100"
     class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4 overflow-y-auto" 
     style="display: none;">
    
    <div class="bg-white rounded-3xl max-w-5xl w-full p-6 sm:p-8 shadow-2xl border border-slate-100 relative my-8 max-h-[90vh] flex flex-col space-y-6">
        
        <!-- Header -->
        <div class="flex justify-between items-center pb-4 border-b border-slate-100">
            <div class="flex items-center space-x-3.5">
                <div class="p-3.5 bg-blue-50 text-blue-600 rounded-2xl font-bold text-xl shadow-sm">
                    🎓
                </div>
                <div>
                    <h3 class="text-lg font-black text-slate-900 tracking-tight">Official Curriculum Breakdown & Reference</h3>
                    <p class="text-xs text-slate-500 font-medium">BSIT & BSCS Complete 4-Year Prospectus</p>
                </div>
            </div>
            <button @click="showCurriculumModal = false" class="text-slate-400 hover:text-slate-600 font-bold text-sm bg-slate-100 hover:bg-slate-200 w-9 h-9 rounded-full flex items-center justify-center transition cursor-pointer">
                ✕
            </button>
        </div>

        <!-- Controls: Program Tabs, Year Filter, Semester Filter & Search Bar -->
        <div class="flex flex-col md:flex-row justify-between items-stretch md:items-center gap-3 bg-slate-50/70 p-3 rounded-2xl border border-slate-100">
            
            <!-- Program Tabs (BSIT / BSCS) -->
            <div class="flex items-center space-x-1.5 bg-white p-1 rounded-xl border border-slate-200 shadow-sm shrink-0">
                <button @click="curriculumProgram = 'IT'" :class="curriculumProgram === 'IT' ? 'bg-blue-600 text-white font-bold shadow-sm' : 'text-slate-600 hover:text-slate-900'" class="px-4 py-1.5 rounded-lg text-xs transition duration-150 flex items-center gap-1.5 cursor-pointer">
                    <span>💻</span> BSIT Curriculum
                </button>
                <button @click="curriculumProgram = 'CS'" :class="curriculumProgram === 'CS' ? 'bg-indigo-600 text-white font-bold shadow-sm' : 'text-slate-600 hover:text-slate-900'" class="px-4 py-1.5 rounded-lg text-xs transition duration-150 flex items-center gap-1.5 cursor-pointer">
                    <span>🖥️</span> BSCS Curriculum
                </button>
            </div>

            <!-- Filters & Search -->
            <div class="flex flex-wrap items-center gap-2 flex-1 justify-end">
                
                <!-- Year Filter Pills -->
                <div class="flex items-center space-x-1 bg-slate-200/60 p-1 rounded-xl">
                    <button @click="yearFilter = 'ALL'" :class="yearFilter === 'ALL' ? 'bg-slate-900 text-white font-bold shadow-md' : 'text-slate-600 hover:bg-slate-200'" class="px-3 py-1.5 rounded-xl text-xs transition duration-150 cursor-pointer">All Years</button>
                    <button @click="yearFilter = 1" :class="yearFilter === 1 ? 'bg-slate-900 text-white font-bold shadow-md' : 'text-slate-600 hover:bg-slate-200'" class="px-3 py-1.5 rounded-xl text-xs transition duration-150 cursor-pointer">1st Year</button>
                    <button @click="yearFilter = 2" :class="yearFilter === 2 ? 'bg-slate-900 text-white font-bold shadow-md' : 'text-slate-600 hover:bg-slate-200'" class="px-3 py-1.5 rounded-xl text-xs transition duration-150 cursor-pointer">2nd Year</button>
                    <button @click="yearFilter = 3" :class="yearFilter === 3 ? 'bg-slate-900 text-white font-bold shadow-md' : 'text-slate-600 hover:bg-slate-200'" class="px-3 py-1.5 rounded-xl text-xs transition duration-150 cursor-pointer">3rd Year</button>
                    <button @click="yearFilter = 4" :class="yearFilter === 4 ? 'bg-slate-900 text-white font-bold shadow-md' : 'text-slate-600 hover:bg-slate-200'" class="px-3 py-1.5 rounded-xl text-xs transition duration-150 cursor-pointer">4th Year</button>
                </div>

                <!-- Semester Filter Pills -->
                <div class="flex items-center space-x-1 bg-slate-200/60 p-1 rounded-xl">
                    <button @click="semesterFilter = 'ALL'" :class="semesterFilter === 'ALL' ? 'bg-blue-900 text-white font-bold shadow-md' : 'text-slate-600 hover:bg-slate-200'" class="px-3 py-1.5 rounded-xl text-xs transition duration-150 cursor-pointer">All Sem</button>
                    <button @click="semesterFilter = 1" :class="semesterFilter == 1 ? 'bg-blue-900 text-white font-bold shadow-md' : 'text-slate-600 hover:bg-slate-200'" class="px-3 py-1.5 rounded-xl text-xs transition duration-150 cursor-pointer">1st Sem</button>
                    <button @click="semesterFilter = 2" :class="semesterFilter == 2 ? 'bg-blue-900 text-white font-bold shadow-md' : 'text-slate-600 hover:bg-slate-200'" class="px-3 py-1.5 rounded-xl text-xs transition duration-150 cursor-pointer">2nd Sem</button>
                </div>

                <!-- Search Input -->
                <div class="relative w-full sm:w-48">
                    <input x-model="searchQuery" type="text" placeholder="Search code or title..." class="w-full text-xs bg-white border border-slate-200 rounded-xl shadow-sm pl-9 pr-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- ================= BSIT TABLE ================= -->
        <div x-show="curriculumProgram === 'IT'" class="overflow-y-auto flex-1 border border-slate-100 rounded-2xl max-h-[50vh] shadow-inner">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-100/90 sticky top-0 z-20 backdrop-blur-md">
                    <tr class="text-[11px] font-bold text-slate-600 uppercase tracking-wider">
                        <th class="px-6 py-3.5 text-left">Subject Code</th>
                        <th class="px-6 py-3.5 text-left">Descriptive Title</th>
                        <th class="px-6 py-3.5 text-center">Year Level</th>
                        <th class="px-6 py-3.5 text-center">Units</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100 text-xs">
                    
                    @php
                        $currentItYearSem = null;
                    @endphp

                    @forelse($itSubjects ?? [] as $subject)
                        @php
                            $yearSemKey = "Year {$subject->year} - " . ($subject->semester == 1 ? '1st Semester' : '2nd Semester');
                            $isNewSection = ($currentItYearSem !== $yearSemKey);
                            $currentItYearSem = $yearSemKey;
                        @endphp

                        <!-- SECTION HEADER PARA SA BSIT -->
                        @if($isNewSection)
                            <tr x-show="(yearFilter === 'ALL' || yearFilter == {{ $subject->year }}) && (semesterFilter === 'ALL' || semesterFilter == {{ $subject->semester }})" 
                                class="bg-gradient-to-r from-blue-50 via-slate-50 to-indigo-50 border-y border-blue-100/60 sticky top-[41px] z-10">
                                <td colspan="4" class="px-6 py-2.5">
                                    <div class="flex items-center space-x-2">
                                        <span class="w-2.5 h-2.5 rounded-full bg-blue-600"></span>
                                        <span class="font-black text-xs text-blue-900 tracking-wide uppercase">
                                            Year {{ $subject->year }} - {{ $subject->semester == 1 ? '1st Semester' : '2nd Semester' }}
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @endif

                        <!-- SUBJECT ROW PARA SA BSIT -->
                        <tr x-show="(yearFilter === 'ALL' || yearFilter == {{ $subject->year }}) && (semesterFilter === 'ALL' || semesterFilter == {{ $subject->semester }}) && (searchQuery === '' || '{{ strtolower($subject->code) }}'.includes(searchQuery.toLowerCase()) || '{{ strtolower($subject->title) }}'.includes(searchQuery.toLowerCase()))" 
                            class="hover:bg-blue-50/40 transition-colors">
                            
                            <td class="px-6 py-3.5 font-bold text-blue-600 font-mono">
                                {{ $subject->code }}
                            </td>
                            <td class="px-6 py-3.5 font-semibold text-slate-800">
                                {{ $subject->title }}
                            </td>
                            <td class="px-6 py-3.5 text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[11px] font-semibold bg-blue-50 text-blue-700 border border-blue-100">
                                    Year {{ $subject->year }}
                                </span>
                            </td>
                            <td class="px-6 py-3.5 text-center font-bold text-slate-700">
                                <span class="px-2.5 py-1 bg-slate-50 text-slate-700 rounded-md border border-slate-200">
                                    {{ $subject->units }} {{ $subject->units > 1 ? 'Units' : 'Unit' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-slate-400 text-xs">No BSIT subjects found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- ================= BSCS TABLE ================= -->
        <div x-show="curriculumProgram === 'CS'" class="overflow-y-auto flex-1 border border-slate-100 rounded-2xl max-h-[50vh] shadow-inner" style="display: none;">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-100/90 sticky top-0 z-20 backdrop-blur-md">
                    <tr class="text-[11px] font-bold text-slate-600 uppercase tracking-wider">
                        <th class="px-6 py-3.5 text-left">Subject Code</th>
                        <th class="px-6 py-3.5 text-left">Descriptive Title</th>
                        <th class="px-6 py-3.5 text-center">Year Level</th>
                        <th class="px-6 py-3.5 text-center">Units</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100 text-xs">
                    
                    @php
                        $currentCsYearSem = null;
                    @endphp

                    @forelse($csSubjects ?? [] as $subject)
                        @php
                            $yearSemKey = "Year {$subject->year} - " . ($subject->semester == 1 ? '1st Semester' : '2nd Semester');
                            $isNewSection = ($currentCsYearSem !== $yearSemKey);
                            $currentCsYearSem = $yearSemKey;
                        @endphp

                        <!-- SECTION HEADER PARA SA BSCS -->
                        @if($isNewSection)
                            <tr x-show="(yearFilter === 'ALL' || yearFilter == {{ $subject->year }}) && (semesterFilter === 'ALL' || semesterFilter == {{ $subject->semester }})" 
                                class="bg-gradient-to-r from-indigo-50 via-slate-50 to-purple-50 border-y border-indigo-100/60 sticky top-[41px] z-10">
                                <td colspan="4" class="px-6 py-2.5">
                                    <div class="flex items-center space-x-2">
                                        <span class="w-2.5 h-2.5 rounded-full bg-indigo-600"></span>
                                        <span class="font-black text-xs text-indigo-900 tracking-wide uppercase">
                                            Year {{ $subject->year }} - {{ $subject->semester == 1 ? '1st Semester' : '2nd Semester' }}
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @endif

                        <!-- SUBJECT ROW PARA SA BSCS -->
                        <tr x-show="(yearFilter === 'ALL' || yearFilter == {{ $subject->year }}) && (semesterFilter === 'ALL' || semesterFilter == {{ $subject->semester }}) && (searchQuery === '' || '{{ strtolower($subject->code) }}'.includes(searchQuery.toLowerCase()) || '{{ strtolower($subject->title) }}'.includes(searchQuery.toLowerCase()))" 
                            class="hover:bg-indigo-50/40 transition-colors">
                            
                            <td class="px-6 py-3.5 font-bold text-indigo-600 font-mono">
                                {{ $subject->code }}
                            </td>
                            <td class="px-6 py-3.5 font-semibold text-slate-800">
                                {{ $subject->title }}
                            </td>
                            <td class="px-6 py-3.5 text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[11px] font-semibold bg-indigo-50 text-indigo-700 border border-indigo-100">
                                    Year {{ $subject->year }}
                                </span>
                            </td>
                            <td class="px-6 py-3.5 text-center font-bold text-slate-700">
                                <span class="px-2.5 py-1 bg-slate-50 text-slate-700 rounded-md border border-slate-200">
                                    {{ $subject->units }} {{ $subject->units > 1 ? 'Units' : 'Unit' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-slate-400 text-xs">No BSCS subjects found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Footer Close Button -->
        <div class="pt-2 flex justify-end">
            <button @click="showCurriculumModal = false" class="px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-xs rounded-xl font-bold transition shadow-md shadow-slate-900/10 cursor-pointer">
                Close Curriculum Viewer
            </button>
        </div>

    </div>
</div>