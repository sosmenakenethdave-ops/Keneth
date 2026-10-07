<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-white leading-tight">
                Add New Room
            </h2>
            <a href="{{ route('admin.rooms.index') }}" class="px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white rounded-xl text-sm font-semibold transition">
                ← Back to Rooms
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <!-- Error Alert Box -->
            @if($errors->any())
                <div class="bg-red-500/10 border border-red-500/50 text-red-400 px-5 py-4 rounded-xl mb-6 backdrop-blur-md">
                    <div class="font-bold mb-1">Paki-ayos ang mga sumusunod na error:</div>
                    <ul class="list-disc list-inside text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Dark Card Container -->
            <div class="bg-slate-800/90 border border-slate-700/80 shadow-2xl rounded-2xl p-8 backdrop-blur-md">
                <form action="{{ route('admin.rooms.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Room Name -->
                    <div>
                        <label class="block text-base font-semibold text-white mb-2">Room Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="e.g. Lab 1" 
                            class="w-full px-4 py-3 rounded-xl bg-slate-900 border-2 border-slate-600 text-white placeholder-slate-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/40 transition outline-none">
                    </div>

                    <!-- Building -->
                    <div>
                        <label class="block text-base font-semibold text-white mb-2">Building</label>
                        <input type="text" name="building" value="{{ old('building') }}" placeholder="e.g. CICT Building" 
                            class="w-full px-4 py-3 rounded-xl bg-slate-900 border-2 border-slate-600 text-white placeholder-slate-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/40 transition outline-none">
                    </div>

                    <!-- Capacity -->
                    <div>
                        <label class="block text-base font-semibold text-white mb-2">Capacity</label>
                        <input type="number" name="capacity" value="{{ old('capacity', '30') }}" required min="1" 
                            class="w-full px-4 py-3 rounded-xl bg-slate-900 border-2 border-slate-600 text-white placeholder-slate-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/40 transition outline-none">
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-4 pt-4 border-t border-slate-700/60">
                        <a href="{{ route('admin.rooms.index') }}" 
                           class="px-5 py-3 rounded-xl bg-slate-700 hover:bg-slate-600 text-slate-200 font-semibold transition">
                            Cancel
                        </a>

                        <button type="submit" 
                                class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold shadow-lg shadow-indigo-600/30 transition transform hover:-translate-y-0.5">
                            Save Room
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>