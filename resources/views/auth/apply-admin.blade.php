<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Apply for Administrator - CICT Portal</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 flex flex-col font-sans text-slate-800 antialiased">

    <!-- Top Header Bar -->
    <header class="bg-blue-600 text-white px-6 py-2.5 flex justify-between items-center shadow-md">
        <span class="text-sm font-semibold tracking-wide">CICT Portal</span>
        <span class="text-sm font-semibold tracking-wide">Schedule Online v1.0</span>
    </header>

    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col items-center justify-center p-4 sm:p-6">
        
        <!-- Application Form Card -->
        <div class="w-full max-w-lg bg-white rounded-2xl shadow-xl border border-slate-200/80 overflow-hidden">
            
            <!-- Card Header Layout (Side-by-Side Banner) -->
            <div class="bg-slate-50 border-b border-slate-200 p-5 text-center sm:text-left">
                <div class="flex flex-col sm:flex-row items-center space-y-3 sm:space-y-0 sm:space-x-4">
                    <!-- Logos -->
                    <div class="flex items-center space-x-2 shrink-0">
                        <img src="{{ asset('images/school-logo.png') }}" 
                             alt="CFCST Logo" 
                             class="h-14 w-14 object-contain"
                             onerror="this.src='https://via.placeholder.com/60?text=CFCST'">
                        <img src="{{ asset('images/cict-logo.png') }}" 
                             alt="CICT Logo" 
                             class="h-14 w-14 object-contain"
                             onerror="this.src='https://via.placeholder.com/60?text=CICT'">
                    </div>
                    
                    <!-- Title & Subtitle -->
                    <div>
                        <span class="inline-block px-2.5 py-0.5 bg-blue-100 text-blue-700 font-bold text-xs rounded-full uppercase tracking-wider mb-1">
                            Administrator Application
                        </span>
                        <h1 class="text-base font-bold text-slate-900 leading-tight">
                            Cotabato Foundation College of Science and Technology
                        </h1>
                        <p class="text-xs text-slate-500 font-medium">Submit your details and required credentials for review.</p>
                    </div>
                </div>
            </div>

            <!-- Form Body -->
            <div class="p-6">
                <!-- Session Status Message -->
                @if (session('status'))
                    <div class="mb-4 p-3 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-medium text-center">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Application Form -->
                <form action="{{ route('admin.apply.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <!-- Full Name -->
                    <div>
                        <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                            class="w-full px-3.5 py-2 bg-slate-50 border border-slate-300 rounded-lg text-slate-800 text-sm placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="Juan Dela Cruz">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required 
                            class="w-full px-3.5 py-2 bg-slate-50 border border-slate-300 rounded-lg text-slate-800 text-sm placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="admin.applicant@cfcst.edu.ph">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Fields (2 Columns) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Password <span class="text-red-500">*</span>
                            </label>
                            <input type="password" name="password" id="password" required 
                                class="w-full px-3.5 py-2 bg-slate-50 border border-slate-300 rounded-lg text-slate-800 text-sm placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                placeholder="Create password">
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                                Confirm Password <span class="text-red-500">*</span>
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required 
                                class="w-full px-3.5 py-2 bg-slate-50 border border-slate-300 rounded-lg text-slate-800 text-sm placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                placeholder="Confirm password">
                        </div>
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="phone" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                            Contact / Phone Number <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required 
                            class="w-full px-3.5 py-2 bg-slate-50 border border-slate-300 rounded-lg text-slate-800 text-sm placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="09123456789">
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Position Applied -->
                    <div>
                        <label for="position_applied" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                            Position / Designation <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="position_applied" id="position_applied" value="{{ old('position_applied', 'System Administrator') }}" required 
                            class="w-full px-3.5 py-2 bg-slate-50 border border-slate-300 rounded-lg text-slate-800 text-sm placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        @error('position_applied')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Requirements Upload -->
                    <div>
                        <label for="requirements" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                            Upload Credentials / Requirements (PDF, ZIP, DOCX) <span class="text-red-500">*</span>
                        </label>
                        <input type="file" name="requirements" id="requirements" required 
                            class="w-full text-sm text-slate-600 bg-slate-50 border border-slate-300 rounded-lg cursor-pointer focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-l-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 transition">
                        <p class="text-[11px] text-slate-500 mt-1">Include Appointment Paper, School ID, Resume, etc. (Max 10MB)</p>
                        @error('requirements')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Additional Notes -->
                    <div>
                        <label for="notes" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                            Additional Remarks (Optional)
                        </label>
                        <textarea name="notes" id="notes" rows="2" 
                            class="w-full px-3.5 py-2 bg-slate-50 border border-slate-300 rounded-lg text-slate-800 text-sm placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="Provide any additional context or details...">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button & Back Link -->
                    <div class="pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3">
                        <a href="{{ url('/') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-800 hover:underline transition order-2 sm:order-1">
                            ← Back to Welcome Page
                        </a>

                        <button type="submit" 
                            class="w-full sm:w-auto px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-200 text-sm order-1 sm:order-2">
                            Submit Application
                        </button>
                    </div>

                </form>
            </div>

        </div>

    </main>

    <!-- Footer -->
    <footer class="pb-4 text-center text-xs text-slate-500">
        &copy; {{ date('Y') }} CICT Portal. All rights reserved.
    </footer>

</body>
</html>