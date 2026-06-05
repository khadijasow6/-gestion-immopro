<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-extrabold text-3xl text-gray-800">
                Ajouter un bien immobilier 🏡
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Remplissez les informations du nouveau bien.
            </p>
        </div>
    </x-slot>

    <div class="py-10 min-h-screen bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-purple-100">

                <div class="bg-gradient-to-r from-indigo-700 via-purple-700 to-pink-600 p-8 text-white">
                    <h1 class="text-3xl font-extrabold">
                        Nouveau bien
                    </h1>
                    <p class="text-purple-100 mt-2">
                        Ajoutez un appartement, une villa, un bureau, un terrain ou un commerce.
                    </p>
                </div>

                <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                    @csrf

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
                                <option value="">Choisir un type</option>
                                <option value="Appartement">Appartement</option>
                                <option value="Villa">Villa</option>
                                <option value="Bureau">Bureau</option>
                                <option value="Terrain">Terrain</option>
                                <option value="Commerce">Commerce</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Transaction</label>
                            <select name="transaction_type" class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                                <option value="">Choisir une transaction</option>
                                <option value="Vente">Vente</option>
                                <option value="Location">Location</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Surface en m²</label>
                            <input type="number" step="0.01" name="surface" value="{{ old('surface') }}"
                                   class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500"
                                   placeholder="Exemple : 120">
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Prix</label>
                            <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                                   class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500"
                                   placeholder="Exemple : 50000000">
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Adresse</label>
                            <input type="text" name="address" value="{{ old('address') }}"
                                   class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500"
                                   placeholder="Exemple : Rue 10, Dakar">
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Quartier</label>
                            <input type="text" name="district" value="{{ old('district') }}"
                                   class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500"
                                   placeholder="Exemple : Sacré-Cœur">
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Latitude</label>
                            <input type="text" name="latitude" value="{{ old('latitude') }}"
                                   class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500"
                                   placeholder="Exemple : 14.6928">
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Longitude</label>
                            <input type="text" name="longitude" value="{{ old('longitude') }}"
                                   class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500"
                                   placeholder="Exemple : -17.4467">
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Statut</label>
                            <select name="status" class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                                <option value="Disponible">Disponible</option>
                                <option value="Réservé">Réservé</option>
                                <option value="Vendu-Loué">Vendu-Loué</option>
                                <option value="Archivé">Archivé</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Photos du bien</label>
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
                                  class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500"
                                  placeholder="Décrivez le bien immobilier...">{{ old('description') }}</textarea>
                    </div>

                    <div class="mt-8 flex justify-between">
                        <a href="{{ route('properties.index') }}"
                           class="px-6 py-3 rounded-2xl bg-gray-200 text-gray-700 font-bold hover:bg-gray-300">
                            Retour
                        </a>

                        <button type="submit"
                                class="px-8 py-3 rounded-2xl bg-gradient-to-r from-purple-600 via-pink-600 to-orange-500 text-white font-extrabold shadow-lg hover:scale-105 transition">
                            Enregistrer le bien
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>