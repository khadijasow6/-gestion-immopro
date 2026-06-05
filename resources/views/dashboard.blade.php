<x-app-layout>


    <div class="py-10 min-h-screen bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Grande bannière -->
            <div class="relative overflow-hidden bg-gradient-to-r from-indigo-700 via-purple-700 to-pink-600 rounded-3xl shadow-2xl p-10 mb-10 text-white">

                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full -mr-20 -mt-20"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-10 rounded-full -ml-16 -mb-16"></div>

                <div class="relative z-10">
                    <h1 class="text-4xl font-extrabold mb-3">
                        Gestion ImmoPro 🏡
                    </h1>

                    <p class="text-purple-100 text-lg max-w-2xl">
                        Votre plateforme moderne pour gérer les biens, les clients, les visites et les transactions immobilières.
                    </p>

                    <div class="mt-8 flex flex-wrap gap-4">
                        <a href="{{ route('properties.index') }}"
                           class="bg-white text-purple-700 px-6 py-3 rounded-2xl font-bold shadow-lg hover:bg-purple-50 hover:scale-105 transition">
                            Voir les biens
                        </a>

                        @if(auth()->user()->isAdmin() || auth()->user()->isAgent())
                            <a href="{{ route('properties.create') }}"
                               class="bg-yellow-400 text-gray-900 px-6 py-3 rounded-2xl font-bold shadow-lg hover:bg-yellow-300 hover:scale-105 transition">
                                + Ajouter un bien
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Cartes statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

                <div class="bg-white rounded-3xl shadow-xl p-6 border-t-4 border-indigo-600 hover:scale-105 transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-semibold">Biens disponibles</p>
                            <h3 class="text-4xl font-extrabold text-indigo-700 mt-2">
                                {{ $availableProperties ?? 0 }}
                            </h3>
                        </div>
                        <div class="bg-indigo-100 text-indigo-700 p-5 rounded-2xl text-3xl">
                            🏠
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-xl p-6 border-t-4 border-emerald-500 hover:scale-105 transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-semibold">Biens vendus/loués</p>
                            <h3 class="text-4xl font-extrabold text-emerald-600 mt-2">
                                {{ $soldProperties ?? 0 }}
                            </h3>
                        </div>
                        <div class="bg-emerald-100 text-emerald-700 p-5 rounded-2xl text-3xl">
                            ✅
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-xl p-6 border-t-4 border-orange-500 hover:scale-105 transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-semibold">Visites planifiées</p>
                            <h3 class="text-4xl font-extrabold text-orange-600 mt-2">
                                {{ $plannedVisits ?? 0 }}
                            </h3>
                        </div>
                        <div class="bg-orange-100 text-orange-700 p-5 rounded-2xl text-3xl">
                            📅
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-xl p-6 border-t-4 border-pink-600 hover:scale-105 transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-semibold">Commissions</p>
                            <h3 class="text-2xl font-extrabold text-pink-600 mt-2">
                                {{ number_format($totalCommission ?? 0, 0, ',', ' ') }} FCFA
                            </h3>
                        </div>
                        <div class="bg-pink-100 text-pink-700 p-5 rounded-2xl text-3xl">
                            💰
                        </div>
                    </div>
                </div>

            </div>

            <!-- Sections principales -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Actions rapides -->
                <div class="bg-white rounded-3xl shadow-xl p-7">
                    <h3 class="text-2xl font-extrabold text-gray-800 mb-5">
                        Actions rapides ⚡
                    </h3>

                    <div class="space-y-4">
                        <a href="{{ route('properties.index') }}"
                           class="block p-5 rounded-2xl bg-gradient-to-r from-indigo-50 to-purple-50 hover:from-indigo-100 hover:to-purple-100 border border-purple-100 font-semibold text-gray-700 transition">
                            🏘️ Consulter les biens immobiliers
                        </a>

                        @if(auth()->user()->isAdmin() || auth()->user()->isAgent())
                            <a href="{{ route('properties.create') }}"
                               class="block p-5 rounded-2xl bg-gradient-to-r from-yellow-50 to-orange-50 hover:from-yellow-100 hover:to-orange-100 border border-orange-100 font-semibold text-gray-700 transition">
                                ➕ Ajouter un nouveau bien
                            </a>
                        @endif

                        <a href="#"
                           class="block p-5 rounded-2xl bg-gradient-to-r from-green-50 to-emerald-50 hover:from-green-100 hover:to-emerald-100 border border-emerald-100 font-semibold text-gray-700 transition">
                            📅 Gérer les visites
                        </a>

                        <a href="#"
                           class="block p-5 rounded-2xl bg-gradient-to-r from-pink-50 to-rose-50 hover:from-pink-100 hover:to-rose-100 border border-pink-100 font-semibold text-gray-700 transition">
                            📊 Voir le reporting
                        </a>
                    </div>
                </div>

                <!-- Derniers biens -->
                <div class="lg:col-span-2 bg-white rounded-3xl shadow-xl p-7">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-2xl font-extrabold text-gray-800">
                                Derniers biens ajoutés
                            </h3>
                            <p class="text-sm text-gray-500">
                                Les nouvelles annonces immobilières
                            </p>
                        </div>

                        <a href="{{ route('properties.index') }}"
                           class="bg-purple-100 text-purple-700 px-4 py-2 rounded-full text-sm font-bold hover:bg-purple-200">
                            Voir tout
                        </a>
                    </div>

                    <div class="space-y-4">
                        @forelse($latestProperties ?? [] as $property)
                            <div class="flex items-center justify-between border border-purple-100 rounded-2xl p-5 hover:bg-purple-50 transition shadow-sm">
                                <div>
                                    <h4 class="font-extrabold text-gray-800">
                                        {{ $property->type }} — {{ $property->district }}
                                    </h4>

                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $property->transaction_type }} • {{ $property->surface }} m²
                                    </p>
                                </div>

                                <div class="text-right">
                                    <p class="font-extrabold text-purple-700">
                                        {{ number_format($property->price, 0, ',', ' ') }} FCFA
                                    </p>

                                    <span class="inline-block mt-2 text-xs px-3 py-1 rounded-full bg-green-100 text-green-700 font-bold">
                                        {{ $property->status }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12 text-gray-500">
                                <div class="text-6xl mb-4">🏡</div>
                                <p class="font-semibold">
                                    Aucun bien ajouté pour le moment.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>