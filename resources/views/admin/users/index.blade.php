<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center space-x-3">
                <div class="p-2.5 bg-blue-600/20 border border-blue-500/30 rounded-xl">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-white leading-tight tracking-wide">
                        Manage {{ ucfirst($role) }}s
                    </h2>
                    <p class="text-xs text-slate-400">CICT Academic Scheduling & User Management System</p>
                </div>
            </div>

            <!-- Add New User Button -->
            <a href="{{ route('admin.users.create', ['role' => $role]) }}" 
               class="inline-flex items-center space-x-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-bold text-sm shadow-lg shadow-emerald-900/30 transition transform hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                <span>Add New {{ ucfirst($role) }}</span>
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-950 min-h-screen text-slate-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Success Alert Box -->
            @if(session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/40 text-emerald-300 px-5 py-4 rounded-2xl backdrop-blur-md flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-medium text-sm">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Error Alert Box -->
            @if(session('error'))
                <div class="bg-rose-500/10 border border-rose-500/40 text-rose-300 px-5 py-4 rounded-2xl backdrop-blur-md flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-medium text-sm">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <!-- Navigation Controls & Search Bar -->
            <div class="bg-slate-900/80 border border-slate-800 p-5 rounded-2xl shadow-2xl backdrop-blur-xl flex flex-col md:flex-row justify-between items-center gap-4">
                
                <!-- Navigation Tabs (Role Toggles + Admin Applications Tab) -->
                <div class="flex flex-wrap items-center gap-2 bg-slate-950 p-1.5 rounded-xl border border-slate-800/80 w-full md:w-auto">
                    <a href="{{ route('admin.users.index', ['role' => 'student']) }}" 
                       class="px-4 py-2 rounded-lg font-semibold text-xs sm:text-sm transition flex items-center gap-2 {{ $role === 'student' ? 'bg-blue-600 text-white shadow-md shadow-blue-900/40' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                        Students
                    </a>
                    <a href="{{ route('admin.users.index', ['role' => 'instructor']) }}" 
                       class="px-4 py-2 rounded-lg font-semibold text-xs sm:text-sm transition flex items-center gap-2 {{ $role === 'instructor' ? 'bg-blue-600 text-white shadow-md shadow-blue-900/40' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                        Instructors
                    </a>
                    <a href="{{ route('admin.users.index', ['role' => 'admin']) }}" 
                       class="px-4 py-2 rounded-lg font-semibold text-xs sm:text-sm transition flex items-center gap-2 {{ $role === 'admin' ? 'bg-blue-600 text-white shadow-md shadow-blue-900/40' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                        Admins
                    </a>

                    <!-- Admin Applications Link -->
                    @if(Route::has('admin.applications.index'))
                        <a href="{{ route('admin.applications.index') }}" 
                           class="px-4 py-2 rounded-lg font-semibold text-xs sm:text-sm transition flex items-center gap-2 text-amber-400 hover:text-amber-300 hover:bg-amber-500/10 border border-amber-500/20">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Pending Applications
                        </a>
                    @endif
                </div>

                <!-- Live Search Input -->
                <div class="w-full md:w-80">
                    <div class="relative">
                        <input type="text" id="offline-search-input" placeholder="Search name or email..." 
                               class="w-full pl-10 pr-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Users Table Card -->
            <div class="bg-slate-900/80 border border-slate-800 shadow-2xl rounded-2xl overflow-hidden backdrop-blur-xl">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-800">
                        <thead class="bg-slate-950/60">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">User Details</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Email Address</th>
                                @if($role === 'student')
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Course & Year</th>
                                @elseif($role === 'instructor')
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Academic Rank</th>
                                @endif
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-right text-xs font-bold text-slate-400 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="users-table-body" class="divide-y divide-slate-800/60 bg-slate-900/30 text-slate-200">
                            @forelse($users as $user)
                                <tr class="user-row hover:bg-slate-800/50 transition">
                                    <!-- Name -->
                                    <td class="user-name px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                            <div class="h-9 w-9 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center font-bold text-blue-400 text-sm uppercase">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-semibold text-white flex items-center gap-2">
                                                    {{ $user->name }}
                                                    @if($user->id === auth()->id())
                                                        <span class="px-2 py-0.5 text-[10px] font-bold bg-blue-500/20 text-blue-300 border border-blue-500/30 rounded-full">YOU</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Email -->
                                    <td class="user-email px-6 py-4 text-slate-300 whitespace-nowrap text-sm">
                                        {{ $user->email }}
                                    </td>

                                    <!-- Course/Year or Academic Rank -->
                                    @if($role === 'student')
                                        <td class="px-6 py-4 text-slate-300 whitespace-nowrap text-sm">
                                            <span class="text-slate-200 font-medium">{{ $user->course ?? 'N/A' }}</span> 
                                            <span class="text-xs text-slate-500">({{ $user->year_level ?? 'N/A' }})</span>
                                        </td>
                                    @elseif($role === 'instructor')
                                        <td class="px-6 py-4 text-slate-300 whitespace-nowrap text-sm">
                                            <span class="text-slate-200 font-medium">{{ $user->academic_rank ?? 'Instructor' }}</span>
                                        </td>
                                    @endif

                                    <!-- Status -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full {{ ($user->status ?? 'active') === 'active' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/30' : 'bg-rose-500/10 text-rose-400 border border-rose-500/30' }}">
                                            <span class="w-1.5 h-1.5 rounded-full mr-2 {{ ($user->status ?? 'active') === 'active' ? 'bg-emerald-400' : 'bg-rose-400' }}"></span>
                                            {{ ucfirst($user->status ?? 'active') }}
                                        </span>
                                    </td>

                                    <!-- Actions -->
                                    <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                                        @if($user->id !== auth()->id())
                                            <!-- Toggle Status -->
                                            <form action="{{ route('admin.users.toggle-status', $user->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" 
                                                        class="px-3 py-1.5 text-xs font-semibold rounded-lg transition border {{ ($user->status ?? 'active') === 'active' ? 'bg-amber-500/10 text-amber-300 border-amber-500/30 hover:bg-amber-500 hover:text-white' : 'bg-emerald-500/10 text-emerald-300 border-emerald-500/30 hover:bg-emerald-500 hover:text-white' }}">
                                                    {{ ($user->status ?? 'active') === 'active' ? 'Deactivate' : 'Activate' }}
                                                </button>
                                            </form>
                                        @endif

                                        <!-- Edit -->
                                        <a href="{{ route('admin.users.edit', $user->id) }}" 
                                           class="inline-block px-3 py-1.5 bg-blue-600/20 text-blue-300 border border-blue-500/30 rounded-lg hover:bg-blue-600 hover:text-white transition text-xs font-semibold">
                                            Edit
                                        </a>

                                        @if($user->id !== auth()->id())
                                            <!-- Delete -->
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Sigurado ka bang gusto mong idelete ang user na ito?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="px-3 py-1.5 bg-rose-600/20 text-rose-300 border border-rose-500/30 rounded-lg hover:bg-rose-600 hover:text-white transition text-xs font-semibold">
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr id="no-users-row">
                                    <td colspan="5" class="px-6 py-12 text-center text-slate-500 font-medium">
                                        Walang nahanap na record para sa {{ $role }}.
                                    </td>
                                </tr>
                            @endforelse

                            <!-- Hidden dynamic row for live search -->
                            <tr id="no-search-results" class="hidden">
                                <td colspan="5" class="px-6 py-12 text-center text-slate-500 font-medium">
                                    Walang tumugmang {{ $role }} sa iyong ginawang paghahanap.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if(method_exists($users, 'links'))
                    <div class="p-4 border-t border-slate-800 bg-slate-950/40">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>

    <!-- Offline Live Search Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('offline-search-input');
            const rows = document.querySelectorAll('.user-row');
            const noResultsRow = document.getElementById('no-search-results');

            if (searchInput) {
                searchInput.addEventListener('keyup', function () {
                    const query = this.value.toLowerCase().trim();
                    let visibleCount = 0;

                    rows.forEach(row => {
                        const nameEl = row.querySelector('.user-name');
                        const emailEl = row.querySelector('.user-email');

                        const name = nameEl ? nameEl.textContent.toLowerCase() : '';
                        const email = emailEl ? emailEl.textContent.toLowerCase() : '';

                        if (name.includes(query) || email.includes(query)) {
                            row.classList.remove('hidden');
                            visibleCount++;
                        } else {
                            row.classList.add('hidden');
                        }
                    });

                    if (noResultsRow) {
                        if (visibleCount === 0 && rows.length > 0) {
                            noResultsRow.classList.remove('hidden');
                        } else {
                            noResultsRow.classList.add('hidden');
                        }
                    }
                });
            }
        });
    </script>
</x-app-layout>