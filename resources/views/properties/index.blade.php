<x-app-layout>
    

    <div class="py-10 min-h-screen bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded-2xl shadow">
                    {{ session('success') }}
                </div>
            @endif

            <div class="relative overflow-hidden bg-gradient-to-r from-indigo-700 via-purple-700 to-pink-600 rounded-3xl shadow-2xl p-10 mb-10 text-white">
                <div class="absolute top-0 right-0 w-72 h-72 bg-white opacity-10 rounded-full -mr-24 -mt-24"></div>
                <div class="absolute bottom-0 left-0 w-56 h-56 bg-white opacity-10 rounded-full -ml-20 -mb-20"></div>

                <div class="relative z-10">
                    <h1 class="text-4xl font-extrabold mb-3">
                        Catalogue des biens disponibles
                    </h1>

                    <p class="text-purple-100 text-lg max-w-2xl">
                        Consultez, ajoutez, modifiez et gérez les biens immobiliers de votre agence.
                    </p>

                    <div class="mt-6 flex flex-wrap gap-4">
                        <span class="bg-white text-purple-700 px-5 py-3 rounded-2xl font-bold shadow">
                            Total : {{ $properties->total() }} biens
                        </span>

                        @if(auth()->user()->isAdmin() || auth()->user()->isAgent())
                            <a href="{{ route('properties.create') }}"
                               class="bg-yellow-400 text-gray-900 px-5 py-3 rounded-2xl font-bold shadow hover:bg-yellow-300 hover:scale-105 transition">
                                Ajouter maintenant
                            </a>
                        @endif
                    </div>
                </div>
            </div>
<!-- Filtres de recherche -->
<div class="bg-white rounded-3xl shadow-2xl p-6 mb-8 border border-purple-100">
    <div class="mb-5">
        <h3 class="text-2xl font-extrabold text-gray-800">
            Recherche avancée 🔎
        </h3>
        <p class="text-sm text-gray-500">
            
        </p>
    </div>

    <form method="GET" action="{{ route('properties.index') }}">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Type</label>
                <select name="type" class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                    <option value="">Tous</option>
                    <option value="Appartement" {{ request('type') == 'Appartement' ? 'selected' : '' }}>Appartement</option>
                    <option value="Villa" {{ request('type') == 'Villa' ? 'selected' : '' }}>Villa</option>
                    <option value="Bureau" {{ request('type') == 'Bureau' ? 'selected' : '' }}>Bureau</option>
                    <option value="Terrain" {{ request('type') == 'Terrain' ? 'selected' : '' }}>Terrain</option>
                    <option value="Commerce" {{ request('type') == 'Commerce' ? 'selected' : '' }}>Commerce</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Transaction</label>
                <select name="transaction_type" class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                    <option value="">Toutes</option>
                    <option value="Vente" {{ request('transaction_type') == 'Vente' ? 'selected' : '' }}>Vente</option>
                    <option value="Location" {{ request('transaction_type') == 'Location' ? 'selected' : '' }}>Location</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Quartier</label>
                <input type="text" name="district" value="{{ request('district') }}"
                       placeholder="Ex : Sacré-Cœur"
                       class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Prix min</label>
                <input type="number" name="min_price" value="{{ request('min_price') }}"
                       placeholder="Ex : 100000"
                       class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Prix max</label>
                <input type="number" name="max_price" value="{{ request('max_price') }}"
                       placeholder="Ex : 50000000"
                       class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Surface min</label>
                <input type="number" name="min_surface" value="{{ request('min_surface') }}"
                       placeholder="Ex : 50"
                       class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Surface max</label>
                <input type="number" name="max_surface" value="{{ request('max_surface') }}"
                       placeholder="Ex : 200"
                       class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">
            </div>

            <div class="flex items-end gap-2">
                <button type="submit"
                        class="w-full px-5 py-3 rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 text-white font-extrabold shadow hover:scale-105 transition">
                    Rechercher
                </button>
            </div>

        </div>

        <div class="mt-4">
            <a href="{{ route('properties.index') }}"
               class="inline-block px-5 py-3 rounded-xl bg-gray-200 text-gray-700 font-bold hover:bg-gray-300">
                Réinitialiser
            </a>
        </div>
    </form>
</div>
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-purple-100">

                <div class="p-6 bg-gradient-to-r from-purple-50 to-pink-50 border-b flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-extrabold text-gray-800">
                            Liste des biens
                        </h3>
                        <p class="text-sm text-gray-500">
                            
                        </p>
                    </div>

                    <div class="bg-purple-100 text-purple-700 px-5 py-2 rounded-full text-sm font-bold">
                        Gestion ImmoPro
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white text-sm uppercase">
                                <th class="p-4 text-left">Photo</th>
                                <th class="p-4 text-left">Bien</th>
                                <th class="p-4 text-left">Transaction</th>
                                <th class="p-4 text-left">Quartier</th>
                                <th class="p-4 text-left">Surface</th>
                                <th class="p-4 text-left">Prix</th>
                                <th class="p-4 text-left">Statut</th>
                                <th class="p-4 text-left min-w-[280px]">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-purple-100">
                            @forelse($properties as $property)
                                <tr class="hover:bg-purple-50 transition">

                                    <td class="p-4">
                                        @if($property->photos->count() > 0)
                                            <img src="{{ asset('storage/' . $property->photos->first()->path) }}"
                                                 class="w-28 h-20 object-cover rounded-2xl shadow-lg">
                                        @else
                                            <div class="w-28 h-20 bg-gradient-to-br from-gray-200 to-gray-300 rounded-2xl flex items-center justify-center text-gray-500 text-xs shadow">
                                                Aucune photo
                                            </div>
                                        @endif
                                    </td>

                                    <td class="p-4">
                                        <div class="font-extrabold text-gray-800 text-lg">
                                            {{ $property->type }}
                                        </div>
                                        <div class="text-xs text-gray-500 mt-1">
                                            Référence #{{ $property->id }}
                                        </div>
                                    </td>

                                    <td class="p-4">
                                        @if($property->transaction_type === 'Vente')
                                            <span class="px-4 py-2 rounded-full text-xs font-extrabold bg-orange-100 text-orange-700">
                                                Vente
                                            </span>
                                        @else
                                            <span class="px-4 py-2 rounded-full text-xs font-extrabold bg-cyan-100 text-cyan-700">
                                                Location
                                            </span>
                                        @endif
                                    </td>

                                    <td class="p-4 text-gray-700 font-semibold">
                                        📍 {{ $property->district }}
                                    </td>

                                    <td class="p-4 text-gray-700 font-semibold">
                                        {{ $property->surface }} m²
                                    </td>

                                    <td class="p-4">
                                        <span class="font-extrabold text-purple-700 text-lg">
                                            {{ number_format($property->price, 0, ',', ' ') }} FCFA
                                        </span>
                                    </td>

                                    <td class="p-4">
                                        @if($property->status === 'Disponible')
                                            <span class="px-4 py-2 rounded-full text-xs font-extrabold bg-green-100 text-green-700">
                                                Disponible
                                            </span>
                                        @elseif($property->status === 'Réservé')
                                            <span class="px-4 py-2 rounded-full text-xs font-extrabold bg-yellow-100 text-yellow-700">
                                                Réservé
                                            </span>
                                        @elseif($property->status === 'Vendu-Loué')
                                            <span class="px-4 py-2 rounded-full text-xs font-extrabold bg-red-100 text-red-700">
                                                Vendu/Loué
                                            </span>
                                        @else
                                            <span class="px-4 py-2 rounded-full text-xs font-extrabold bg-gray-200 text-gray-700">
                                                Archivé
                                            </span>
                                        @endif
                                    </td>

                                    <td class="p-4">
                                        <div class="flex items-center gap-2 whitespace-nowrap">

                                            <a href="{{ route('properties.show', $property) }}"
                                               class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-blue-100 text-blue-700 text-sm font-bold hover:bg-blue-200 transition">
                                                Voir
                                            </a>

                                            @if(auth()->user()->isAdmin() || auth()->user()->isAgent())
                                                <a href="{{ route('properties.edit', $property) }}"
                                                   class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-yellow-100 text-yellow-700 text-sm font-bold hover:bg-yellow-200 transition">
                                                    Modifier
                                                </a>

                                                <form action="{{ route('properties.destroy', $property) }}"
                                                      method="POST"
                                                      class="inline-flex m-0">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            onclick="return confirm('Supprimer ce bien ?')"
                                                            class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-red-100 text-red-700 text-sm font-bold hover:bg-red-200 transition">
                                                        Supprimer
                                                    </button>
                                                </form>
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="p-14 text-center">
                                        <div class="text-7xl mb-4">🏡</div>

                                        <h3 class="text-2xl font-extrabold text-gray-700">
                                            Aucun bien immobilier trouvé
                                        </h3>

                                        <p class="text-gray-500 mt-2">
                                            Ajoutez votre premier bien pour commencer à remplir le catalogue.
                                        </p>

                                        @if(auth()->user()->isAdmin() || auth()->user()->isAgent())
                                            <a href="{{ route('properties.create') }}"
                                               class="inline-block mt-6 bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-3 rounded-2xl shadow-lg font-bold hover:scale-105 transition">
                                                Ajouter un bien
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-6 bg-gradient-to-r from-purple-50 to-pink-50 border-t">
                    {{ $properties->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>