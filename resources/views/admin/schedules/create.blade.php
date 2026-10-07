<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-white leading-tight">
                Add New Schedule
            </h2>
            <a href="{{ route('admin.schedules.index') }}" class="px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white rounded-xl text-sm font-semibold transition">
                ← Back to Schedules
            </a>
        </div>
    </x-slot>

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

        <!-- Card Container -->
        <div class="bg-slate-800/90 border border-slate-700/80 shadow-2xl rounded-2xl p-8 backdrop-blur-md">
            <form action="{{ route('admin.schedules.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Subject Select -->
                <div>
                    <label class="block text-base font-semibold text-white mb-2">Subject</label>
                    <select name="subject_id" required 
                        class="w-full px-4 py-3 rounded-xl bg-slate-900 border-2 border-slate-600 text-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/40 transition outline-none">
                        <option value="" disabled selected class="text-slate-400">Select Subject</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                {{ $subject->code }} - {{ $subject->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Instructor Select -->
                <div>
                    <label class="block text-base font-semibold text-white mb-2">Instructor</label>
                    <select name="instructor_id" 
                        class="w-full px-4 py-3 rounded-xl bg-slate-900 border-2 border-slate-600 text-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/40 transition outline-none">
                        <option value="" selected>Unassigned</option>
                        @foreach($instructors as $instructor)
                            <option value="{{ $instructor->id }}" {{ old('instructor_id') == $instructor->id ? 'selected' : '' }}>
                                {{ $instructor->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Room Select -->
                <div>
                    <label class="block text-base font-semibold text-white mb-2">Room</label>
                    <select name="room_id" required 
                        class="w-full px-4 py-3 rounded-xl bg-slate-900 border-2 border-slate-600 text-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/40 transition outline-none">
                        <option value="" disabled selected class="text-slate-400">Select Room</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                {{ $room->name }} ({{ $room->building }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Day Select -->
                <div>
                    <label class="block text-base font-semibold text-white mb-2">Day</label>
                    <select name="day" required 
                        class="w-full px-4 py-3 rounded-xl bg-slate-900 border-2 border-slate-600 text-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/40 transition outline-none">
                        <option value="" disabled selected class="text-slate-400">Select Day</option>
                        @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day)
                            <option value="{{ $day }}" {{ old('day') == $day ? 'selected' : '' }}>
                                {{ $day }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Start Time & End Time -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-base font-semibold text-white mb-2">Start Time</label>
                        <input type="time" name="start_time" value="{{ old('start_time') }}" required 
                            class="w-full px-4 py-3 rounded-xl bg-slate-900 border-2 border-slate-600 text-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/40 transition outline-none [color-scheme:dark]">
                    </div>

                    <div>
                        <label class="block text-base font-semibold text-white mb-2">End Time</label>
                        <input type="time" name="end_time" value="{{ old('end_time') }}" required 
                            class="w-full px-4 py-3 rounded-xl bg-slate-900 border-2 border-slate-600 text-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/40 transition outline-none [color-scheme:dark]">
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 pt-4 border-t border-slate-700/60">
                    <a href="{{ route('admin.schedules.index') }}" 
                       class="px-5 py-3 rounded-xl bg-slate-700 hover:bg-slate-600 text-slate-200 font-semibold transition">
                        Cancel
                    </a>

                    <button type="submit" 
                            class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold shadow-lg shadow-indigo-600/30 transition transform hover:-translate-y-0.5">
                        Save Schedule
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>