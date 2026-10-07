<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-white leading-tight">
                Subject Management
            </h2>
            <a href="{{ route('admin.subjects.create') }}" 
               class="inline-flex items-center space-x-2 px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold shadow-lg shadow-indigo-600/30 transition transform hover:-translate-y-0.5">
                <span>+ Add New Subject</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Success Alert Box -->
            @if(session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/50 text-emerald-400 px-5 py-4 rounded-xl backdrop-blur-md">
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Dark Table Card -->
            <div class="bg-slate-800/90 border border-slate-700/80 shadow-2xl rounded-2xl overflow-hidden backdrop-blur-md">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-700">
                        <thead class="bg-slate-900/80">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-indigo-400 uppercase tracking-wider">Code</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-indigo-400 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-indigo-400 uppercase tracking-wider">Units</th>
                                <th class="px-6 py-4 text-right text-xs font-bold text-indigo-400 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700/60 bg-slate-800/40 text-slate-200">
                            @forelse($subjects as $subject)
                                <tr class="hover:bg-slate-700/30 transition">
                                    <td class="px-6 py-4 font-bold text-white whitespace-nowrap">
                                        {{ $subject->code }}
                                    </td>
                                    <td class="px-6 py-4 text-slate-300 font-medium whitespace-nowrap">
                                        {{ $subject->title }}
                                    </td>
                                    <td class="px-6 py-4 text-slate-300 whitespace-nowrap">
                                        <span class="px-3 py-1 bg-slate-700/60 border border-slate-600 rounded-lg text-xs font-semibold text-slate-300">
                                            {{ $subject->units }} {{ Str::plural('Unit', $subject->units) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                                        <!-- Edit Button -->
                                        <a href="{{ route('admin.subjects.edit', $subject) }}" 
                                           class="inline-block px-3 py-1.5 bg-indigo-600/20 text-indigo-300 border border-indigo-500/30 rounded-lg hover:bg-indigo-600 hover:text-white transition text-xs font-semibold">
                                            Edit
                                        </a>

                                        <!-- Delete Form -->
                                        <form action="{{ route('admin.subjects.destroy', $subject) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
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
                                    <td colspan="4" class="px-6 py-8 text-center text-slate-400 font-medium">
                                        No subjects found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination (kung nakaset sa Controller) -->
                @if(method_exists($subjects, 'links'))
                    <div class="p-4 border-t border-slate-700/60 bg-slate-900/40">
                        {{ $subjects->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>