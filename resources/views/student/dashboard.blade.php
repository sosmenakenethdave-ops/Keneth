<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Dashboard - Semester Schedule') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Banner -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-bold mb-2 text-gray-900">Welcome, Student!</h3>
                <p class="text-gray-600">Dito mo makikita ang iyong fixed semester schedule para sa buong semester, kasama ang mga subject, oras, room assignment, at instructor[cite: 2].</p>
            </div>

            <!-- Schedule Table Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h4 class="text-md font-semibold text-gray-800 mb-4">My Enrolled Classes & Schedule</h4>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject Code / Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Day</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Room</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Instructor</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Halimbawa ng Data Loop (Palitan ng actual variable mula sa iyong Controller/Database) -->
                            <!-- @foreach($studentSchedules as $schedule) -->
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">IPT 2 / IAS 1</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Monday / Wednesday</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">1:00 PM - 3:00 PM</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Lab Room 3</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Instructor Name</td>
                            </tr>
                            <!-- @endforeach -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>