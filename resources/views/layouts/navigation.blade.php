<nav x-data="{ open: false }" class="bg-gradient-to-r from-indigo-700 via-purple-700 to-pink-600 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">

            <div class="flex items-center">
                <!-- Logo / Nom projet -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <div class="bg-white text-purple-700 w-12 h-12 rounded-2xl flex items-center justify-center shadow-lg font-extrabold text-xl">
                            GI
                        </div>

                        <div class="hidden md:block">
                            <h1 class="text-white font-extrabold text-xl">
                                Gestion ImmoPro
                            </h1>
                            <p class="text-purple-100 text-xs">
                                Agence immobilière intelligente
                            </p>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-3 sm:ms-10 sm:flex">

                    <a href="{{ route('dashboard') }}"
                       class="px-5 py-3 rounded-2xl font-bold transition
                       {{ request()->routeIs('dashboard') ? 'bg-white text-purple-700 shadow-lg' : 'text-white hover:bg-white/20' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('properties.index') }}"
                       class="px-5 py-3 rounded-2xl font-bold transition
                       {{ request()->routeIs('properties.*') ? 'bg-white text-purple-700 shadow-lg' : 'text-white hover:bg-white/20' }}">
                        Biens
                    </a>

                    <a href="{{ route('visits.index') }}"
                       class="px-5 py-3 rounded-2xl font-bold transition
                       {{ request()->routeIs('visits.*') ? 'bg-white text-purple-700 shadow-lg' : 'text-white hover:bg-white/20' }}">
                        Visites
                    </a>

                    <a href="{{ route('transactions.index') }}"
                       class="px-5 py-3 rounded-2xl font-bold transition
                       {{ request()->routeIs('transactions.*') ? 'bg-white text-purple-700 shadow-lg' : 'text-white hover:bg-white/20' }}">
                        Transactions
                    </a>

                    <a href="{{ route('reports.index') }}"
                       class="px-5 py-3 rounded-2xl font-bold transition
                       {{ request()->routeIs('reports.*') ? 'bg-white text-purple-700 shadow-lg' : 'text-white hover:bg-white/20' }}">
                        Reporting
                    </a>

                </div>
            </div>

            <!-- User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-3 px-4 py-3 rounded-2xl bg-white/20 text-white hover:bg-white/30 transition shadow">
                            <div class="w-9 h-9 rounded-full bg-white text-purple-700 flex items-center justify-center font-extrabold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>

                            <div class="text-left">
                                <div class="text-sm font-bold">
                                    {{ Auth::user()->name }}
                                </div>
                                <div class="text-xs text-purple-100">
                                    {{ ucfirst(Auth::user()->role) }}
                                </div>
                            </div>

                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                Déconnexion
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger mobile -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-3 rounded-xl text-white hover:bg-white/20 focus:outline-none transition">
                    <svg class="h-7 w-7" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }"
                              class="inline-flex"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />

                        <path :class="{'hidden': ! open, 'inline-flex': open }"
                              class="hidden"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Menu mobile -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-purple-800/95">
        <div class="pt-3 pb-4 space-y-2 px-4">

            <a href="{{ route('dashboard') }}"
               class="block px-4 py-3 rounded-xl font-bold
               {{ request()->routeIs('dashboard') ? 'bg-white text-purple-700' : 'text-white hover:bg-white/20' }}">
                Dashboard
            </a>

            <a href="{{ route('properties.index') }}"
               class="block px-4 py-3 rounded-xl font-bold
               {{ request()->routeIs('properties.*') ? 'bg-white text-purple-700' : 'text-white hover:bg-white/20' }}">
                Biens immobiliers
            </a>

            <a href="{{ route('visits.index') }}"
               class="block px-4 py-3 rounded-xl font-bold
               {{ request()->routeIs('visits.*') ? 'bg-white text-purple-700' : 'text-white hover:bg-white/20' }}">
                Visites
            </a>

            <a href="{{ route('transactions.index') }}"
               class="block px-4 py-3 rounded-xl font-bold
               {{ request()->routeIs('transactions.*') ? 'bg-white text-purple-700' : 'text-white hover:bg-white/20' }}">
                Transactions
            </a>

            <a href="{{ route('reports.index') }}"
               class="block px-4 py-3 rounded-xl font-bold
               {{ request()->routeIs('reports.*') ? 'bg-white text-purple-700' : 'text-white hover:bg-white/20' }}">
                Reporting
            </a>

        </div>

        <div class="pt-4 pb-4 border-t border-white/20 px-4">
            <div class="text-white font-bold">
                {{ Auth::user()->name }}
            </div>
            <div class="text-purple-100 text-sm">
                {{ Auth::user()->email }}
            </div>

            <div class="mt-4 space-y-2">
                <a href="{{ route('profile.edit') }}"
                   class="block px-4 py-3 rounded-xl text-white font-bold hover:bg-white/20">
                    Profil
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); this.closest('form').submit();"
                       class="block px-4 py-3 rounded-xl text-white font-bold hover:bg-white/20">
                        Déconnexion
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>