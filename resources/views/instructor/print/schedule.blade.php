<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Instructor Teaching Schedule Matrix</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .no-print { display: none !important; }
            @page { size: landscape; margin: 10mm; }
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 p-6 min-h-screen">
    <div class="max-w-7xl mx-auto bg-white p-8 rounded-2xl shadow-xl border border-slate-200">
        
        <div class="flex justify-between items-center mb-6 pb-4 border-b border-slate-200 no-print">
            <h1 class="text-lg font-bold text-slate-900">🖨️ Instructor Print Preview</h1>
            <div class="space-x-3">
                <button onclick="window.print()" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow transition">Print Schedule Now</button>
                <a href="{{ route('instructor.dashboard') }}" class="px-5 py-2.5 bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold text-xs rounded-xl transition">Back to Dashboard</a>
            </div>
        </div>

        <div class="text-center mb-6">
            <h2 class="text-xl font-extrabold uppercase tracking-wider text-slate-900">College of Information and Computing Technology</h2>
            <p class="text-xs text-slate-500 font-medium">Official Instructor Teaching Schedule Matrix</p>
        </div>

        <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 mb-6 text-xs font-semibold flex justify-between">
            <div><span class="text-slate-400 block text-[10px] uppercase">Instructor Name:</span> <span class="text-slate-900 font-bold text-sm">{{ Auth::user()->name ?? 'Instructor' }}</span></div>
            <div><span class="text-slate-400 block text-[10px] uppercase">Department:</span> <span class="text-slate-900 font-bold text-sm">CICT Faculty</span></div>
            <div><span class="text-slate-400 block text-[10px] uppercase">Academic Year:</span> <span class="text-slate-900 font-bold text-sm">2026 - 2027</span></div>
        </div>

        <table class="w-full border-collapse table-fixed text-center border border-slate-300">
            <thead>
                <tr class="bg-slate-900 text-white text-xs font-bold uppercase">
                    <th class="border border-slate-300 py-3">Monday</th>
                    <th class="border border-slate-300 py-3">Tuesday</th>
                    <th class="border border-slate-300 py-3">Wednesday</th>
                    <th class="border border-slate-300 py-3">Thursday</th>
                    <th class="border border-slate-300 py-3">Friday</th>
                </tr>
            </thead>
            <tbody class="text-xs bg-white">
                <tr class="align-top">
                    <td class="border border-slate-300 p-2 h-64">
                        <div class="bg-sky-400 text-slate-900 p-3 rounded-xl shadow-sm text-left">
                            <div class="font-extrabold text-[11px] border-b border-black/10 pb-1">7:00 AM - 9:00 AM</div>
                            <div class="font-bold text-xs mt-1">Mobile App Dev</div>
                            <div class="text-[10px] mt-2 pt-1 border-t border-black/10">🚪 Lecture Hall A<br>👥 BSIT 3-A</div>
                        </div>
                    </td>
                    <td class="border border-slate-300 p-2 h-64"></td>
                    <td class="border border-slate-300 p-2 h-64"></td>
                    <td class="border border-slate-300 p-2 h-64"></td>
                    <td class="border border-slate-300 p-2 h-64"></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>