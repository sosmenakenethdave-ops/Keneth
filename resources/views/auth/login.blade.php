<x-guest-layout>
    <div class="min-h-screen bg-slate-100 flex flex-col font-sans text-slate-800 antialiased">
        
        <!-- Top Header Bar (Kaparehong-kapareho sa welcome.blade.php) -->
        <!-- Top Header Bar -->
    <header class="bg-blue-600 text-white px-6 py-2.5 flex justify-between items-center shadow-md">
        <span class="text-sm font-semibold tracking-wide">CICT Portal</span>
        <span class="text-sm font-semibold tracking-wide">Schedule Online v1.0</span>
    </header>

        <!-- Main Content Container -->
        <main class="flex-1 flex flex-col items-center justify-center p-6 text-center">
            
            <!-- Logos Section (Eksaktong sukat at spacing tulad ng sa welcome) -->
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

            <!-- Main Interactive Elements Container (Kapareho ng max-w-xs at space-y-3 ng welcome.blade.php) -->
            <div class="w-full max-w-xs space-y-3">

                <!-- Dynamic Role Button Badge -->
                <div class="w-full py-2.5 px-4 bg-blue-600 text-white font-semibold rounded-full shadow-md text-center">
                    {{ ucfirst(request('role', 'User')) }} Login
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <x-auth-session-status class="text-sm text-center" :status="session('status')" />
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-3">
                    @csrf

                    <!-- User ID / Email Input -->
                    <div class="relative">
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                            placeholder="Email"
                            class="w-full pb-1 pt-2 px-1 border-b-2 border-indigo-400 bg-transparent text-slate-800 placeholder-slate-500 font-medium text-center focus:outline-none focus:border-blue-600 transition">
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-500 text-center" />
                    </div>

                    <!-- Password Input -->
                    <div class="relative">
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            placeholder="Password"
                            class="w-full pb-1 pt-2 px-1 border-b-2 border-indigo-400 bg-transparent text-slate-800 placeholder-slate-500 font-medium text-center focus:outline-none focus:border-blue-600 transition">
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-500 text-center" />
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-3 pt-2">
                        <button type="submit" 
                            class="w-full py-2.5 px-4 bg-sky-400 hover:bg-sky-500 text-white font-semibold rounded-full shadow-md transition duration-200">
                            Login
                        </button>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" 
                                class="block w-full py-2.5 px-4 bg-amber-500 hover:bg-amber-600 text-white font-semibold text-center rounded-full shadow-md transition duration-200">
                                Forgot Password
                            </a>
                        @endif
                    </div>
                </form>

                <!-- Added Back to Welcome Page Link -->
                <div class="pt-2 text-center">
                    <a href="{{ url('/') }}" class="text-xs font-semibold text-slate-600 hover:text-blue-600 transition inline-flex items-center">
                        ← Back to Welcome Page
                    </a>
                </div>

            </div>

        </main>

    </div>
</x-guest-layout>