<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center space-x-3">
                <div class="p-2.5 bg-amber-500/20 border border-amber-500/30 rounded-xl">
                    <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-white leading-tight tracking-wide">
                        Admin Applications
                    </h2>
                    <p class="text-xs text-slate-400">Review and manage pending administrator account requests</p>
                </div>
            </div>

            <!-- Back to Users List -->
            <a href="{{ route('admin.users.index') }}" 
               class="inline-flex items-center space-x-2 px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 border border-slate-700 text-slate-300 font-semibold text-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Back to Users</span>
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-950 min-h-screen text-slate-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Success Alert -->
            @if(session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/40 text-emerald-300 px-5 py-4 rounded-2xl backdrop-blur-md flex items-center justify-between">
                    <span class="font-medium text-sm">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Error Alert -->
            @if(session('error'))
                <div class="bg-rose-500/10 border border-rose-500/40 text-rose-300 px-5 py-4 rounded-2xl backdrop-blur-md flex items-center justify-between">
                    <span class="font-medium text-sm">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Applications Table Card -->
            <div class="bg-slate-900/80 border border-slate-800 shadow-2xl rounded-2xl overflow-hidden backdrop-blur-xl">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-800">
                        <thead class="bg-slate-950/60">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Applicant Name</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Contact Info</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Optional Info / Note</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Requirements</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-right text-xs font-bold text-slate-400 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/60 bg-slate-900/30 text-slate-200">
                            @forelse($applications as $application)
                                <tr class="hover:bg-slate-800/50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-semibold text-white">{{ $application->name }}</div>
                                        <div class="text-xs text-slate-500">Applied: {{ $application->created_at ? $application->created_at->format('M d, Y') : 'N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div>{{ $application->email }}</div>
                                        <div class="text-xs text-slate-400">{{ $application->phone }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm max-w-xs">
                                        @if(!empty($application->notes) || !empty($application->optional_info) || !empty($application->remarks))
                                            <span class="text-slate-300 break-words">
                                                {{ $application->notes ?? $application->optional_info ?? $application->remarks }}
                                            </span>
                                        @else
                                            <span class="text-slate-500 text-xs italic">N/A (Walang inilagay)</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($application->requirements_path)
                                            <a href="{{ Storage::url($application->requirements_path) }}" 
                                               target="_blank" 
                                               rel="noopener noreferrer"
                                               class="inline-flex items-center space-x-1 text-blue-400 hover:text-blue-300 font-medium text-xs underline">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                <span>View File</span>
                                            </a>
                                        @else
                                            <span class="text-slate-500 text-xs">No file</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full 
                                            {{ $application->status === 'approved' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/30' : '' }}
                                            {{ $application->status === 'pending' ? 'bg-amber-500/10 text-amber-400 border border-amber-500/30' : '' }}
                                            {{ $application->status === 'rejected' ? 'bg-rose-500/10 text-rose-400 border border-rose-500/30' : '' }}">
                                            {{ ucfirst($application->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                                        @if(Route::has('admin.applications.approve') && $application->status === 'pending')
                                            <form action="{{ route('admin.applications.approve', $application->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                <button type="submit" class="px-3 py-1.5 bg-emerald-600/20 text-emerald-300 border border-emerald-500/30 rounded-lg hover:bg-emerald-600 hover:text-white transition text-xs font-semibold">
                                                    Approve
                                                </button>
                                            </form>
                                        @endif

                                        @if(Route::has('admin.applications.reject') && $application->status === 'pending')
                                            <form action="{{ route('admin.applications.reject', $application->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Sigurado ka bang gusto mong ireject ang application na ito?')">
                                                @csrf
                                                <button type="submit" class="px-3 py-1.5 bg-rose-600/20 text-rose-300 border border-rose-500/30 rounded-lg hover:bg-rose-600 hover:text-white transition text-xs font-semibold">
                                                    Reject
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-slate-500 font-medium">
                                        Walang nakukuhang application sa kasalukuyan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(method_exists($applications, 'links'))
                    <div class="p-4 border-t border-slate-800 bg-slate-950/40">
                        {{ $applications->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>