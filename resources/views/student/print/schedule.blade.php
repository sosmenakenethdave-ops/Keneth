<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Class Schedule Matrix</title>
    <!-- Tailwind CSS CDN para magamit ang mga utility classes -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .no-print {
                display: none !important;
            }
            @page {
                size: landscape;
                margin: 10mm;
            }
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 p-6 min-h-screen">

    <div class="max-w-7xl mx-auto bg-white p-8 rounded-2xl shadow-xl border border-slate-200">
        
        <!-- Top Action Buttons (Nawawala kapag nag-print) -->
        <div class="flex justify-between items-center mb-6 pb-4 border-b border-slate-200 no-print">
            <h1 class="text-lg font-bold text-slate-900">🖨️ Print Preview Mode</h1>
            <div class="space-x-3">
                <button onclick="window.print()" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow transition">
                    Print Schedule Now
                </button>
                <a href="{{ route('student.dashboard') }}" class="px-5 py-2.5 bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold text-xs rounded-xl transition">
                    Back to Dashboard
                </a>
            </div>
        </div>

        <!-- School Header -->
        <div class="text-center mb-6">
            <h2 class="text-xl font-extrabold uppercase tracking-wider text-slate-900">College of Information and Computing Technology</h2>
            <p class="text-xs text-slate-500 font-medium">Official Student Class Schedule Matrix</p>
        </div>

        <!-- Student Information Banner -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 bg-slate-50 p-4 rounded-xl border border-slate-200 mb-6 text-xs font-semibold">
            <div><span class="text-slate-400 block text-[10px] uppercase">Student Name:</span> <span class="text-slate-900 font-bold text-sm">{{ Auth::user()->name ?? 'Student' }}</span></div>
            <div><span class="text-slate-400 block text-[10px] uppercase">Program & Year:</span> <span class="text-slate-900 font-bold text-sm">BSIT - {{ $studentYear ?? '3rd' }} Year</span></div>
            <div><span class="text-slate-400 block text-[10px] uppercase">Section:</span> <span class="text-slate-900 font-bold text-sm">Section {{ $studentSection ?? '3A' }}</span></div>
        </div>

        <!-- Matrix Grid Table (Araw-araw na Kolum) -->
        <div class="overflow-x-auto border border-slate-300 rounded-xl">
            <table class="w-full border-collapse table-fixed text-center">
                <thead>
                    <tr class="bg-slate-900 text-white text-xs font-bold uppercase tracking-wider">
                        <th class="border border-slate-300 py-3.5 px-2">Monday</th>
                        <th class="border border-slate-300 py-3.5 px-2">Tuesday</th>
                        <th class="border border-slate-300 py-3.5 px-2">Wednesday</th>
                        <th class="border border-slate-300 py-3.5 px-2">Thursday</th>
                        <th class="border border-slate-300 py-3.5 px-2">Friday</th>
                    </tr>
                </thead>
                <tbody class="text-xs bg-white">
                    <tr class="align-top">
                        <!-- MONDAY -->
                        <td class="border border-slate-300 p-2 h-72 space-y-2">
                            @foreach($subjects as $index => $subject)
                                @if(isset($subject->schedule) && strtolower($subject->schedule->day) == 'monday')
                                    @php $colorClass = ['bg-sky-400 text-slate-900', 'bg-amber-300 text-slate-900', 'bg-emerald-400 text-slate-900', 'bg-orange-400 text-white', 'bg-rose-500 text-white', 'bg-violet-400 text-white'][$index % 6]; @endphp
                                    <div class="{{ $colorClass }} p-3 rounded-xl shadow-sm text-left flex flex-col justify-between space-y-2 border border-black/10">
                                        <div>
                                            <div class="font-extrabold text-[11px] border-b border-black/10 pb-1">
                                                {{ \Carbon\Carbon::parse($subject->schedule->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($subject->schedule->end_time)->format('g:i A') }}
                                            </div>
                                            <div class="font-bold text-xs mt-1 leading-snug">{{ $subject->title }}</div>
                                        </div>
                                        <div class="text-[10px] font-medium pt-1 border-t border-black/10">
                                            <div>🚪 {{ $subject->schedule->room->name ?? 'TBD' }}</div>
                                            <div class="italic">👨‍🏫 {{ $subject->schedule->instructor->name ?? 'TBD' }}</div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </td>

                        <!-- TUESDAY -->
                        <td class="border border-slate-300 p-2 h-72 space-y-2">
                            @foreach($subjects as $index => $subject)
                                @if(isset($subject->schedule) && strtolower($subject->schedule->day) == 'tuesday')
                                    @php $colorClass = ['bg-sky-400 text-slate-900', 'bg-amber-300 text-slate-900', 'bg-emerald-400 text-slate-900', 'bg-orange-400 text-white', 'bg-rose-500 text-white', 'bg-violet-400 text-white'][$index % 6]; @endphp
                                    <div class="{{ $colorClass }} p-3 rounded-xl shadow-sm text-left flex flex-col justify-between space-y-2 border border-black/10">
                                        <div>
                                            <div class="font-extrabold text-[11px] border-b border-black/10 pb-1">
                                                {{ \Carbon\Carbon::parse($subject->schedule->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($subject->schedule->end_time)->format('g:i A') }}
                                            </div>
                                            <div class="font-bold text-xs mt-1 leading-snug">{{ $subject->title }}</div>
                                        </div>
                                        <div class="text-[10px] font-medium pt-1 border-t border-black/10">
                                            <div>🚪 {{ $subject->schedule->room->name ?? 'TBD' }}</div>
                                            <div class="italic">👨‍🏫 {{ $subject->schedule->instructor->name ?? 'TBD' }}</div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </td>

                        <!-- WEDNESDAY -->
                        <td class="border border-slate-300 p-2 h-72 space-y-2">
                            @foreach($subjects as $index => $subject)
                                @if(isset($subject->schedule) && strtolower($subject->schedule->day) == 'wednesday')
                                    @php $colorClass = ['bg-sky-400 text-slate-900', 'bg-amber-300 text-slate-900', 'bg-emerald-400 text-slate-900', 'bg-orange-400 text-white', 'bg-rose-500 text-white', 'bg-violet-400 text-white'][$index % 6]; @endphp
                                    <div class="{{ $colorClass }} p-3 rounded-xl shadow-sm text-left flex flex-col justify-between space-y-2 border border-black/10">
                                        <div>
                                            <div class="font-extrabold text-[11px] border-b border-black/10 pb-1">
                                                {{ \Carbon\Carbon::parse($subject->schedule->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($subject->schedule->end_time)->format('g:i A') }}
                                            </div>
                                            <div class="font-bold text-xs mt-1 leading-snug">{{ $subject->title }}</div>
                                        </div>
                                        <div class="text-[10px] font-medium pt-1 border-t border-black/10">
                                            <div>🚪 {{ $subject->schedule->room->name ?? 'TBD' }}</div>
                                            <div class="italic">👨‍🏫 {{ $subject->schedule->instructor->name ?? 'TBD' }}</div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </td>

                        <!-- THURSDAY -->
                        <td class="border border-slate-300 p-2 h-72 space-y-2">
                            @foreach($subjects as $index => $subject)
                                @if(isset($subject->schedule) && strtolower($subject->schedule->day) == 'thursday')
                                    @php $colorClass = ['bg-sky-400 text-slate-900', 'bg-amber-300 text-slate-900', 'bg-emerald-400 text-slate-900', 'bg-orange-400 text-white', 'bg-rose-500 text-white', 'bg-violet-400 text-white'][$index % 6]; @endphp
                                    <div class="{{ $colorClass }} p-3 rounded-xl shadow-sm text-left flex flex-col justify-between space-y-2 border border-black/10">
                                        <div>
                                            <div class="font-extrabold text-[11px] border-b border-black/10 pb-1">
                                                {{ \Carbon\Carbon::parse($subject->schedule->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($subject->schedule->end_time)->format('g:i A') }}
                                            </div>
                                            <div class="font-bold text-xs mt-1 leading-snug">{{ $subject->title }}</div>
                                        </div>
                                        <div class="text-[10px] font-medium pt-1 border-t border-black/10">
                                            <div>🚪 {{ $subject->schedule->room->name ?? 'TBD' }}</div>
                                            <div class="italic">👨‍🏫 {{ $subject->schedule->instructor->name ?? 'TBD' }}</div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </td>

                        <!-- FRIDAY -->
                        <td class="border border-slate-300 p-2 h-72 space-y-2">
                            @foreach($subjects as $index => $subject)
                                @if(isset($subject->schedule) && strtolower($subject->schedule->day) == 'friday')
                                    @php $colorClass = ['bg-sky-400 text-slate-900', 'bg-amber-300 text-slate-900', 'bg-emerald-400 text-slate-900', 'bg-orange-400 text-white', 'bg-rose-500 text-white', 'bg-violet-400 text-white'][$index % 6]; @endphp
                                    <div class="{{ $colorClass }} p-3 rounded-xl shadow-sm text-left flex flex-col justify-between space-y-2 border border-black/10">
                                        <div>
                                            <div class="font-extrabold text-[11px] border-b border-black/10 pb-1">
                                                {{ \Carbon\Carbon::parse($subject->schedule->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($subject->schedule->end_time)->format('g:i A') }}
                                            </div>
                                            <div class="font-bold text-xs mt-1 leading-snug">{{ $subject->title }}</div>
                                        </div>
                                        <div class="text-[10px] font-medium pt-1 border-t border-black/10">
                                            <div>🚪 {{ $subject->schedule->room->name ?? 'TBD' }}</div>
                                            <div class="italic">👨‍🏫 {{ $subject->schedule->instructor->name ?? 'TBD' }}</div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>