<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-3xl text-gray-800">
                    Modifier le bien 🏡
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Mettez à jour les informations du bien immobilier.
                </p>
            </div>

            <a href="{{ route('properties.index') }}"
               class="bg-gray-200 text-gray-700 px-5 py-3 rounded-2xl font-bold hover:bg-gray-300">
                Retour
            </a>
        </div>
    </x-slot>

    <div class="py-10 min-h-screen bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-purple-100">

                <div class="bg-gradient-to-r from-indigo-700 via-purple-700 to-pink-600 p-8 text-white">
                    <h1 class="text-3xl font-extrabold">
                        Modifier : {{ $property->type }} — {{ $property->district }}
                    </h1>
                    <p class="text-purple-100 mt-2">
                        Vous pouvez modifier le type, le prix, l’adresse, le statut et ajouter de nouvelles photos.
                    </p>
                </div>

                <form action="{{ route('properties.update', $property) }}" method="POST" enctype="multipart/form-data" class="p-8">
                    @csrf
                    @method('PUT')

                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-2xl border border-red-300">
                            <ul class="list-disc ml-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Type de bien</label>
                            <select name="type" class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                                <option value="Appartement" {{ old('type', $property->type) == 'Appartement' ? 'selected' : '' }}>Appartement</option>
                                <option value="Villa" {{ old('type', $property->type) == 'Villa' ? 'selected' : '' }}>Villa</option>
                                <option value="Bureau" {{ old('type', $property->type) == 'Bureau' ? 'selected' : '' }}>Bureau</option>
                                <option value="Terrain" {{ old('type', $property->type) == 'Terrain' ? 'selected' : '' }}>Terrain</option>
                                <option value="Commerce" {{ old('type', $property->type) == 'Commerce' ? 'selected' : '' }}>Commerce</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Transaction</label>
                            <select name="transaction_type" class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                                <option value="Vente" {{ old('transaction_type', $property->transaction_type) == 'Vente' ? 'selected' : '' }}>Vente</option>
                                <option value="Location" {{ old('transaction_type', $property->transaction_type) == 'Location' ? 'selected' : '' }}>Location</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Surface en m²</label>
                            <input type="number" step="0.01" name="surface"
                                   value="{{ old('surface', $property->surface) }}"
                                   class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Prix</label>
                            <input type="number" step="0.01" name="price"
                                   value="{{ old('price', $property->price) }}"
                                   class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Adresse</label>
                            <input type="text" name="address"
                                   value="{{ old('address', $property->address) }}"
                                   class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Quartier</label>
                            <input type="text" name="district"
                                   value="{{ old('district', $property->district) }}"
                                   class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Latitude</label>
                            <input type="text" name="latitude"
                                   value="{{ old('latitude', $property->latitude) }}"
                                   class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Longitude</label>
                            <input type="text" name="longitude"
                                   value="{{ old('longitude', $property->longitude) }}"
                                   class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Statut</label>
                            <select name="status" class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                                <option value="Disponible" {{ old('status', $property->status) == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                                <option value="Réservé" {{ old('status', $property->status) == 'Réservé' ? 'selected' : '' }}>Réservé</option>
                                <option value="Vendu-Loué" {{ old('status', $property->status) == 'Vendu-Loué' ? 'selected' : '' }}>Vendu-Loué</option>
                                <option value="Archivé" {{ old('status', $property->status) == 'Archivé' ? 'selected' : '' }}>Archivé</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Ajouter de nouvelles photos</label>
                            <input type="file" name="photos[]" multiple
                                   class="w-full rounded-xl border-gray-300 bg-white focus:border-purple-500 focus:ring-purple-500">
                            <p class="text-xs text-gray-500 mt-1">
                                Formats acceptés : jpg, jpeg, png.
                            </p>
                        </div>

                    </div>

                    <div class="mt-6">
                        <label class="block font-bold text-gray-700 mb-2">Description</label>
                        <textarea name="description" rows="5"
                                  class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">{{ old('description', $property->description) }}</textarea>
                    </div>

                    @if($property->photos->count() > 0)
                        <div class="mt-8">
                            <h3 class="text-xl font-extrabold text-gray-800 mb-4">
                                Photos actuelles
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                @foreach($property->photos as $photo)
                                    <img src="{{ asset('storage/' . $photo->path) }}"
                                         class="w-full h-48 object-cover rounded-2xl shadow-lg">
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="mt-8 flex justify-between">
                        <a href="{{ route('properties.index') }}"
                           class="px-6 py-3 rounded-2xl bg-gray-200 text-gray-700 font-bold hover:bg-gray-300">
                            Annuler
                        </a>

                        <button type="submit"
                                class="px-8 py-3 rounded-2xl bg-gradient-to-r from-purple-600 via-pink-600 to-orange-500 text-white font-extrabold shadow-lg hover:scale-105 transition">
                            Enregistrer les modifications
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>