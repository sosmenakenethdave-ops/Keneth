<x-guest-layout>
    <div class="min-h-screen bg-slate-100 flex flex-col font-sans text-slate-800 antialiased">
        
        <!-- Top Header Bar -->
        <header class="bg-blue-600 text-white px-6 py-2.5 flex justify-between items-center shadow-md">
            <span class="text-sm font-semibold tracking-wide">CICT Portal</span>
            <span class="text-sm font-semibold tracking-wide">Schedule Online v1.0</span>
        </header>

        <!-- Main Content Container -->
        <main class="flex-1 flex flex-col items-center justify-center p-6 text-center">
            
            <!-- Logos Section -->
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

            <!-- Main Interactive Elements Container -->
            <div class="w-full max-w-xs space-y-3">

                <!-- Dynamic Role Button Badge -->
                <div class="w-full py-2.5 px-4 bg-blue-600 text-white font-semibold rounded-full shadow-md text-center">
                    {{ ucfirst(request('role', 'User')) }} Login
                </div>

                <!-- Session Status / Error Alert for Google Auth Debugging -->
                @if (session('error'))
                    <div class="p-3 bg-red-100 border border-red-400 text-red-700 text-xs rounded-lg text-center font-medium shadow-sm">
                        {{ session('error') }}
                    </div>
                @endif

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

                <!-- Divider / Or continue with -->
                <div class="relative flex py-1 items-center">
                    <div class="flex-grow border-t border-slate-300"></div>
                    <span class="flex-shrink mx-4 text-xs text-slate-500 font-medium">or</span>
                    <div class="flex-grow border-t border-slate-300"></div>
                </div>

                <!-- Google Sign-In Button -->
                <div>
                    <a href="{{ route('auth.google', ['role' => request('role', 'student')]) }}" 
                       class="w-full flex items-center justify-center py-2.5 px-4 bg-white hover:bg-slate-50 text-slate-700 font-semibold rounded-full shadow-md border border-slate-300 transition duration-200 text-sm">
                        <!-- Google Icon SVG -->
                        <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/>
                            <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.11-6.72-4.95H1.2v3.14C3.17 21.36 7.23 24 12 24z"/>
                            <path fill="#FBBC05" d="M5.28 14.25c-.25-.72-.38-1.49-.38-2.25s.13-1.53.38-2.25V6.61H1.2C.43 8.15 0 9.89 0 11.75s.43 3.6 1.2 5.14l4.08-2.64z"/>
                            <path fill="#EA4335" d="M12 4.75c1.76 0 3.34.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.23 0 3.17 2.64 1.2 6.61l4.08 3.14c.95-2.84 3.6-4.95 6.72-4.95z"/>
                        </svg>
                        Sign in with Google
                    </a>
                </div>

                <!-- Back to Welcome Page Link -->
                <div class="pt-2 text-center">
                    <a href="{{ url('/') }}" class="text-xs font-semibold text-slate-600 hover:text-blue-600 transition inline-flex items-center">
                        ← Back to Welcome Page
                    </a>
                </div>

            </div>

        </main>

    </div>
</x-guest-layout>