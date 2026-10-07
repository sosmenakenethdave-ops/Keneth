<nav x-data="{ open: false }" class="bg-slate-800 border-b border-slate-700/80 text-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                        <span class="text-2xl">🎓</span>
                        <span class="text-xl font-extrabold tracking-wide text-white">CICT <span class="text-indigo-400">PORTAL</span></span>
                    </a>
                </div>

                <!-- Desktop Navigation Links -->
                <div class="hidden space-x-6 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}" 
                       class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 transition {{ request()->routeIs('dashboard') ? 'text-white border-b-2 border-indigo-500 font-semibold' : 'text-slate-300 hover:text-white' }}">
                        Dashboard
                    </a>

                    @if(Auth::user()->role === 'admin')
                        <!-- Unified User Management Link -->
                        <a href="{{ route('admin.users.index') }}" 
                           class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 transition {{ request()->routeIs('admin.users.*') ? 'text-white border-b-2 border-indigo-500 font-semibold' : 'text-slate-300 hover:text-white' }}">
                            Users
                        </a>

                        <!-- Academic Links -->
                        <a href="{{ route('admin.subjects.index') }}" 
                           class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 transition {{ request()->routeIs('admin.subjects.*') ? 'text-white border-b-2 border-indigo-500 font-semibold' : 'text-slate-300 hover:text-white' }}">
                            Subjects
                        </a>
                        <a href="{{ route('admin.rooms.index') }}" 
                           class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 transition {{ request()->routeIs('admin.rooms.*') ? 'text-white border-b-2 border-indigo-500 font-semibold' : 'text-slate-300 hover:text-white' }}">
                            Rooms
                        </a>
                        <a href="{{ route('admin.schedules.index') }}" 
                           class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 transition {{ request()->routeIs('admin.schedules.*') ? 'text-white border-b-2 border-indigo-500 font-semibold' : 'text-slate-300 hover:text-white' }}">
                            Schedules
                        </a>
                    @endif
                </div>
            </div>

            <!-- Profile & Logout Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-slate-700 text-sm font-medium rounded-xl text-white bg-slate-900/80 hover:bg-slate-700/80 transition">
                            <div class="flex items-center space-x-2">
                                <span>{{ Auth::user()->name }}</span>
                                <span class="px-2 py-0.5 bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 text-xs rounded-full uppercase">
                                    {{ Auth::user()->role }}
                                </span>
                            </div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="text-slate-700 hover:bg-slate-100">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600 hover:bg-slate-100">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Button (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-400 hover:text-white hover:bg-slate-700 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'inline-flex': open, 'hidden': ! open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Responsive Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-slate-900 border-b border-slate-800">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')" class="text-slate-300">
                    {{ __('Users') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.subjects.index')" :active="request()->routeIs('admin.subjects.*')" class="text-slate-300">
                    {{ __('Subjects') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.rooms.index')" :active="request()->routeIs('admin.rooms.*')" class="text-slate-300">
                    {{ __('Rooms') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.schedules.index')" :active="request()->routeIs('admin.schedules.*')" class="text-slate-300">
                    {{ __('Schedules') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Mobile Profile Options -->
        <div class="pt-4 pb-1 border-t border-slate-800">
            <div class="px-4 mb-2">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-slate-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-slate-300">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-400">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>