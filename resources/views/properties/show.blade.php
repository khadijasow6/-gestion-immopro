<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-3xl text-gray-800">
                    Détails du bien 🏡
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Informations complètes du bien immobilier.
                </p>
            </div>

            <a href="{{ route('properties.index') }}"
               class="bg-gray-200 text-gray-700 px-5 py-3 rounded-2xl font-bold hover:bg-gray-300">
                Retour
            </a>
        </div>
    </x-slot>

    <div class="py-10 min-h-screen bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-purple-100">

                <div class="bg-gradient-to-r from-indigo-700 via-purple-700 to-pink-600 p-8 text-white">
                    <h1 class="text-4xl font-extrabold">
                        {{ $property->type }} — {{ $property->district }}
                    </h1>

                    <p class="text-purple-100 mt-2">
                        {{ $property->transaction_type }} • {{ $property->surface }} m²
                    </p>
                </div>

                <div class="p-8">

                    <!-- Photos -->
                    <div class="mb-8">
                        <h3 class="text-2xl font-extrabold text-gray-800 mb-4">
                            Photos du bien
                        </h3>

                        @if($property->photos->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                @foreach($property->photos as $photo)
                                    <img src="{{ asset('storage/' . $photo->path) }}"
                                         class="w-full h-56 object-cover rounded-2xl shadow-lg">
                                @endforeach
                            </div>
                        @else
                            <div class="bg-gray-100 rounded-2xl p-10 text-center text-gray-500">
                                Aucune photo disponible.
                            </div>
                        @endif
                    </div>

                    <!-- Informations -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

                        <div class="bg-purple-50 rounded-2xl p-5 border border-purple-100">
                            <p class="text-sm text-gray-500">Type</p>
                            <h4 class="text-xl font-extrabold text-gray-800">
                                {{ $property->type }}
                            </h4>
                        </div>

                        <div class="bg-pink-50 rounded-2xl p-5 border border-pink-100">
                            <p class="text-sm text-gray-500">Transaction</p>
                            <h4 class="text-xl font-extrabold text-gray-800">
                                {{ $property->transaction_type }}
                            </h4>
                        </div>

                        <div class="bg-indigo-50 rounded-2xl p-5 border border-indigo-100">
                            <p class="text-sm text-gray-500">Prix</p>
                            <h4 class="text-xl font-extrabold text-purple-700">
                                {{ number_format($property->price, 0, ',', ' ') }} FCFA
                            </h4>
                        </div>

                        <div class="bg-orange-50 rounded-2xl p-5 border border-orange-100">
                            <p class="text-sm text-gray-500">Surface</p>
                            <h4 class="text-xl font-extrabold text-gray-800">
                                {{ $property->surface }} m²
                            </h4>
                        </div>

                        <div class="bg-green-50 rounded-2xl p-5 border border-green-100">
                            <p class="text-sm text-gray-500">Adresse</p>
                            <h4 class="text-xl font-extrabold text-gray-800">
                                {{ $property->address }}
                            </h4>
                        </div>

                        <div class="bg-blue-50 rounded-2xl p-5 border border-blue-100">
                            <p class="text-sm text-gray-500">Quartier</p>
                            <h4 class="text-xl font-extrabold text-gray-800">
                                📍 {{ $property->district }}
                            </h4>
                        </div>

                        <div class="bg-yellow-50 rounded-2xl p-5 border border-yellow-100">
                            <p class="text-sm text-gray-500">Statut</p>

                            @if($property->status === 'Disponible')
                                <span class="inline-block mt-2 px-4 py-2 rounded-full bg-green-100 text-green-700 font-bold">
                                    Disponible
                                </span>
                            @elseif($property->status === 'Réservé')
                                <span class="inline-block mt-2 px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 font-bold">
                                    Réservé
                                </span>
                            @elseif($property->status === 'Vendu-Loué')
                                <span class="inline-block mt-2 px-4 py-2 rounded-full bg-red-100 text-red-700 font-bold">
                                    Vendu/Loué
                                </span>
                            @else
                                <span class="inline-block mt-2 px-4 py-2 rounded-full bg-gray-200 text-gray-700 font-bold">
                                    Archivé
                                </span>
                            @endif
                        </div>

                        <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">
                            <p class="text-sm text-gray-500">Agent</p>
                            <h4 class="text-xl font-extrabold text-gray-800">
                                {{ $property->agent->name ?? 'Non défini' }}
                            </h4>
                        </div>

                    </div>

                    <!-- Description -->
                    <div class="bg-white border border-purple-100 rounded-2xl p-6 shadow-sm mb-8">
                        <h3 class="text-2xl font-extrabold text-gray-800 mb-3">
                            Description
                        </h3>

                        <p class="text-gray-600 leading-relaxed">
                            {{ $property->description ?? 'Aucune description disponible.' }}
                        </p>
                    </div>

                    <!-- Coordonnées GPS + Carte -->
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-100 rounded-2xl p-6">
                        <h3 class="text-2xl font-extrabold text-gray-800 mb-4">
                            Localisation GPS 🗺️
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div class="bg-white rounded-xl p-4">
                                <p class="text-sm text-gray-500">Latitude</p>
                                <p class="font-bold text-gray-800">
                                    {{ $property->latitude ?? 'Non renseignée' }}
                                </p>
                            </div>

                            <div class="bg-white rounded-xl p-4">
                                <p class="text-sm text-gray-500">Longitude</p>
                                <p class="font-bold text-gray-800">
                                    {{ $property->longitude ?? 'Non renseignée' }}
                                </p>
                            </div>
                        </div>

                        <div id="map" class="w-full h-96 rounded-2xl shadow-lg border border-purple-100"></div>

@if(!$property->latitude || !$property->longitude)
    <p class="text-sm text-gray-500 mt-3">
        Coordonnées non renseignées : la carte affiche Dakar par défaut.
    </p>
@endif
                    </div>

                    <div class="mt-8 flex flex-wrap gap-4">

                        @if($property->status === 'Disponible')
                            <a href="{{ route('visits.create', ['property_id' => $property->id]) }}"
                               class="px-6 py-3 rounded-2xl bg-gradient-to-r from-purple-600 via-pink-600 to-orange-500 text-white font-extrabold shadow hover:scale-105 transition">
                                Planifier une visite
                            </a>
                        @endif

                        @if(auth()->user()->isAdmin() || auth()->user()->isAgent())
                            <a href="{{ route('properties.edit', $property) }}"
                               class="px-6 py-3 rounded-2xl bg-yellow-400 text-gray-900 font-extrabold shadow hover:bg-yellow-300">
                                Modifier
                            </a>
                        @endif

                        <a href="{{ route('properties.index') }}"
                           class="px-6 py-3 rounded-2xl bg-gray-200 text-gray-700 font-bold hover:bg-gray-300">
                            Retour à la liste
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const latitude = {{ $property->latitude ?? 14.6928 }};
        const longitude = {{ $property->longitude ?? -17.4467 }};

        const map = L.map('map').setView([latitude, longitude], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        L.marker([latitude, longitude])
            .addTo(map)
            .bindPopup("{{ $property->type }} - {{ $property->district }}")
            .openPopup();
    });
</script>
</x-app-layout>