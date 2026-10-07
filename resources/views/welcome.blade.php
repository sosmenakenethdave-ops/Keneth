<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Schedule Online - Cotabato Foundation College of Science and Technology</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js (para sa Pop-up/Modal ng Registration Options) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-100 min-h-screen flex flex-col font-sans text-slate-800 antialiased" x-data="{ showRegisterModal: false, regType: 'student' }">

    <!-- Top Header Bar -->
    <header class="bg-blue-600 text-white px-6 py-2.5 flex justify-between items-center shadow-md">
        <span class="text-sm font-semibold tracking-wide">CICT Portal</span>
        <span class="text-sm font-semibold tracking-wide">Schedule Online v1.0</span>
    </header>

    <!-- Main Content Container -->
    <main class="flex-1 flex flex-col items-center justify-center p-6 text-center">
        
        <!-- Logos Section (Dalawang Logo) -->
        <div class="flex items-center justify-center space-x-6 mb-4">
            <!-- Logo 1: CFCST School Logo -->
            <img src="{{ asset('images/school-logo.png') }}" 
                 alt="CFCST Logo" 
                 class="h-24 w-24 object-contain"
                 onerror="this.src='https://via.placeholder.com/100?text=CFCST+Logo'">
            
            <!-- Logo 2: CICT Department Logo -->
            <img src="{{ asset('images/cict-logo.png') }}" 
                 alt="CICT Logo" 
                 class="h-24 w-24 object-contain"
                 onerror="this.src='https://via.placeholder.com/100?text=CICT+Logo'">
        </div>

        <!-- School Name & Address Header -->
        <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
            Cotabato Foundation College of Science and Technology
        </h1>
        <p class="text-sm font-semibold text-slate-700 mt-1 mb-6">
            Arakan, Cotabato
        </p>

        <!-- Role Action Buttons -->
        <div class="w-full max-w-xs space-y-3">
            
            <!-- Administrator Login -->
            <a href="{{ route('login', ['role' => 'admin']) }}" 
               class="block w-full py-2.5 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-full shadow-md transition duration-200 text-center">
                Administrator
            </a>

            <!-- Instructor Login -->
            <a href="{{ route('login', ['role' => 'instructor']) }}" 
               class="block w-full py-2.5 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-full shadow-md transition duration-200 text-center">
                Instructor
            </a>

            <!-- Student Login -->
            <a href="{{ route('login', ['role' => 'student']) }}" 
               class="block w-full py-2.5 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-full shadow-md transition duration-200 text-center">
                Student
            </a>

            <!-- Apply for Admission / Register Button (Modal Trigger) -->
            <button @click="showRegisterModal = true" 
                    class="block w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-full shadow-md transition duration-200 text-center">
                Create Account / Registration
            </button>

            <!-- Apply for Administrator (Requirements Upload) -->
            <a href="{{ route('admin.apply') }}" 
               class="block w-full py-2.5 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-full shadow-md transition duration-200 text-center">
                Apply for Administrator
            </a>

        </div>

    </main>

    <!-- Registration / Application Modal -->
    <div x-show="showRegisterModal" 
         class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 z-50"
         x-cloak>
        <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6 text-left space-y-4" @click.away="showRegisterModal = false">
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="text-lg font-bold text-slate-800">Select Registration Type</h3>
                <button @click="showRegisterModal = false" class="text-slate-400 hover:text-slate-600">&times;</button>
            </div>

            <!-- Tab Switcher -->
            <div class="flex rounded-lg bg-slate-100 p-1">
                <button @click="regType = 'student'" 
                        :class="regType === 'student' ? 'bg-white shadow text-blue-600' : 'text-slate-600'" 
                        class="flex-1 py-1.5 text-sm font-semibold rounded-md transition text-center">
                    Student
                </button>
                <button @click="regType = 'instructor'" 
                        :class="regType === 'instructor' ? 'bg-white shadow text-blue-600' : 'text-slate-600'" 
                        class="flex-1 py-1.5 text-sm font-semibold rounded-md transition text-center">
                    Instructor
                </button>
            </div>

            <!-- Student Registration Info -->
            <div x-show="regType === 'student'" class="space-y-3">
                <p class="text-xs text-slate-500">Requirements in registration form:</p>
                <ul class="text-xs text-slate-700 list-disc list-inside space-y-1 bg-slate-50 p-3 rounded-lg border">
                    <li>Select Course: <strong>BS Computer Science (BSCS)</strong> or <strong>BS Information Technology (BSIT)</strong></li>
                    <li>Select Year Level: <strong>1st, 2nd, 3rd, or 4th Year</strong></li>
                    <li>Student ID Number & Personal Details</li>
                </ul>
                <a href="{{ route('register', ['type' => 'student']) }}" 
                   class="block w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg text-center text-sm shadow">
                    Proceed to Student Registration
                </a>
            </div>

            <!-- Instructor Registration Info -->
            <div x-show="regType === 'instructor'" class="space-y-3">
                <p class="text-xs text-slate-500">Requirements in registration form:</p>
                <ul class="text-xs text-slate-700 list-disc list-inside space-y-1 bg-slate-50 p-3 rounded-lg border">
                    <li>Faculty ID / Employee Number</li>
                    <li>Academic Rank (Instructor I-III, Assistant Professor, etc.)</li>
                    <li>Department / Specialization</li>
                </ul>
                <a href="{{ route('register', ['type' => 'instructor']) }}" 
                   class="block w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg text-center text-sm shadow">
                    Proceed to Instructor Registration
                </a>
            </div>

        </div>
    </div>

</body>
</html>