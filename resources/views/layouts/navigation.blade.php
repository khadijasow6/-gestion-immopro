<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-20">

            <!-- Logo + liens -->
            <div class="flex items-center">

                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 flex items-center justify-center text-white text-xl shadow">
                        🏡
                    </div>

                    <div>
                        <h1 class="text-xl font-extrabold text-gray-900">
                            Gestion ImmoPro
                        </h1>
                        <p class="text-xs text-gray-500">
                            Gestion immobilière
                        </p>
                    </div>
                </a>

                <!-- Menu desktop -->
                <div class="hidden lg:flex items-center ms-12 gap-1">

                    <a href="{{ route('dashboard') }}"
                       class="px-4 py-2 rounded-xl text-sm font-bold transition
                       {{ request()->routeIs('dashboard') ? 'bg-purple-100 text-purple-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('properties.index') }}"
                       class="px-4 py-2 rounded-xl text-sm font-bold transition
                       {{ request()->routeIs('properties.*') ? 'bg-purple-100 text-purple-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                        Biens immobiliers
                    </a>

                    <a href="{{ route('visits.index') }}"
                       class="px-4 py-2 rounded-xl text-sm font-bold transition
                       {{ request()->routeIs('visits.*') ? 'bg-purple-100 text-purple-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                        Visites
                    </a>

                    @if(auth()->user()->isAdmin() || auth()->user()->isAgent())
                        <a href="{{ route('transactions.index') }}"
                           class="px-4 py-2 rounded-xl text-sm font-bold transition
                           {{ request()->routeIs('transactions.*') ? 'bg-purple-100 text-purple-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            Transactions
                        </a>

                        <a href="{{ route('reports.index') }}"
                           class="px-4 py-2 rounded-xl text-sm font-bold transition
                           {{ request()->routeIs('reports.*') ? 'bg-purple-100 text-purple-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            Reporting
                        </a>
                    @endif

                </div>
            </div>

            <!-- Partie droite desktop -->
            <div class="hidden lg:flex items-center gap-4">

                <!-- Badge rôle -->
                <span class="px-4 py-2 rounded-full bg-gradient-to-r from-purple-50 to-pink-50 text-purple-700 text-xs font-extrabold uppercase border border-purple-100">
                    {{ auth()->user()->role }}
                </span>

                <!-- Dropdown utilisateur -->
                <div class="relative" x-data="{ userMenu: false }">
                    <button @click="userMenu = ! userMenu"
                            class="flex items-center gap-3 px-3 py-2 rounded-2xl hover:bg-gray-50 transition">

                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-purple-600 to-pink-600 flex items-center justify-center text-white font-extrabold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>

                        <div class="text-left">
                            <p class="text-sm font-bold text-gray-800">
                                {{ auth()->user()->name }}
                            </p>
                            <p class="text-xs text-gray-500">
                                {{ auth()->user()->email }}
                            </p>
                        </div>

                        <span class="text-gray-400 text-sm">
                            ▼
                        </span>
                    </button>

                    <div x-show="userMenu"
                         @click.outside="userMenu = false"
                         x-transition
                         class="absolute right-0 mt-3 w-64 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden z-50">

                        <div class="px-5 py-4 border-b border-gray-100">
                            <p class="font-extrabold text-gray-900">
                                {{ auth()->user()->name }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ auth()->user()->email }}
                            </p>
                        </div>

                        <div class="p-2">
                            <a href="{{ route('profile.edit') }}"
                               class="block px-4 py-3 rounded-xl text-gray-700 font-bold hover:bg-purple-50 hover:text-purple-700">
                                Mon profil
                            </a>

                            <a href="{{ route('home') }}"
                               class="block px-4 py-3 rounded-xl text-gray-700 font-bold hover:bg-purple-50 hover:text-purple-700">
                                Page d’accueil
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit"
                                        class="w-full text-left px-4 py-3 rounded-xl text-red-600 font-bold hover:bg-red-50">
                                    Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Bouton mobile -->
            <div class="flex items-center lg:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-3 rounded-xl text-gray-600 hover:text-purple-700 hover:bg-purple-50 transition">

                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }"
                              class="inline-flex"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />

                        <path :class="{ 'hidden': !open, 'inline-flex': open }"
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
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden lg:hidden bg-white border-t border-gray-100">

        <div class="px-4 py-4 space-y-2">

            <a href="{{ route('dashboard') }}"
               class="block px-5 py-3 rounded-xl font-bold
               {{ request()->routeIs('dashboard') ? 'bg-purple-100 text-purple-700' : 'text-gray-700 hover:bg-gray-100' }}">
                Dashboard
            </a>

            <a href="{{ route('properties.index') }}"
               class="block px-5 py-3 rounded-xl font-bold
               {{ request()->routeIs('properties.*') ? 'bg-purple-100 text-purple-700' : 'text-gray-700 hover:bg-gray-100' }}">
                Biens immobiliers
            </a>

            <a href="{{ route('visits.index') }}"
               class="block px-5 py-3 rounded-xl font-bold
               {{ request()->routeIs('visits.*') ? 'bg-purple-100 text-purple-700' : 'text-gray-700 hover:bg-gray-100' }}">
                Visites
            </a>

            @if(auth()->user()->isAdmin() || auth()->user()->isAgent())
                <a href="{{ route('transactions.index') }}"
                   class="block px-5 py-3 rounded-xl font-bold
                   {{ request()->routeIs('transactions.*') ? 'bg-purple-100 text-purple-700' : 'text-gray-700 hover:bg-gray-100' }}">
                    Transactions
                </a>

                <a href="{{ route('reports.index') }}"
                   class="block px-5 py-3 rounded-xl font-bold
                   {{ request()->routeIs('reports.*') ? 'bg-purple-100 text-purple-700' : 'text-gray-700 hover:bg-gray-100' }}">
                    Reporting
                </a>
            @endif

        </div>

        <div class="px-4 py-4 border-t border-gray-100 bg-gray-50">

            <div class="flex items-center gap-3 mb-4">
                <div class="w-11 h-11 rounded-full bg-gradient-to-r from-purple-600 to-pink-600 flex items-center justify-center text-white font-extrabold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div>
                    <p class="font-bold text-gray-800">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="text-sm text-gray-500">
                        {{ auth()->user()->email }}
                    </p>
                    <p class="text-xs font-extrabold text-purple-700 uppercase">
                        {{ auth()->user()->role }}
                    </p>
                </div>
            </div>

            <a href="{{ route('profile.edit') }}"
               class="block px-5 py-3 rounded-xl bg-white text-gray-700 font-bold mb-2">
                Mon profil
            </a>

            <a href="{{ route('home') }}"
               class="block px-5 py-3 rounded-xl bg-white text-gray-700 font-bold mb-2">
                Page d’accueil
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                        class="w-full text-left px-5 py-3 rounded-xl bg-white text-red-600 font-bold">
                    Déconnexion
                </button>
            </form>
        </div>
    </div>
</nav>