<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-3xl text-gray-800">
                    Nouvelle transaction 💰
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Enregistrer une vente ou une location signée.
                </p>
            </div>

            <a href="{{ route('transactions.index') }}"
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
                        Enregistrer une transaction
                    </h1>
                    <p class="text-purple-100 mt-2">
                        Sélectionnez le bien, le client, le montant et ajoutez les documents si besoin.
                    </p>
                </div>

                <form action="{{ route('transactions.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
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
                            <label class="block font-bold text-gray-700 mb-2">Bien immobilier</label>
                            <select name="property_id"
                                    class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                                <option value="">Choisir un bien</option>

                                @foreach($properties as $property)
                                    <option value="{{ $property->id }}" {{ old('property_id') == $property->id ? 'selected' : '' }}>
                                        {{ $property->type }} - {{ $property->district }} - {{ number_format($property->price, 0, ',', ' ') }} FCFA
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Client</label>
                            <select name="client_id"
                                    class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                                <option value="">Choisir un client</option>

                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                        {{ $client->name }} - {{ $client->email }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Type de transaction</label>
                            <select name="type"
                                    class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                                <option value="">Choisir un type</option>
                                <option value="Vente" {{ old('type') == 'Vente' ? 'selected' : '' }}>Vente</option>
                                <option value="Location" {{ old('type') == 'Location' ? 'selected' : '' }}>Location</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Montant</label>
                            <input type="number"
                                   step="0.01"
                                   name="amount"
                                   value="{{ old('amount') }}"
                                   placeholder="Exemple : 50000000"
                                   class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Date de signature</label>
                            <input type="date"
                                   name="signed_date"
                                   value="{{ old('signed_date') }}"
                                   class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Commission agence</label>
                            <input type="number"
                                   step="0.01"
                                   name="agency_commission"
                                   value="{{ old('agency_commission') }}"
                                   placeholder="Exemple : 2500000"
                                   class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block font-bold text-gray-700 mb-2">Documents joints</label>
                            <input type="file"
                                   name="documents[]"
                                   multiple
                                   class="w-full rounded-xl border-gray-300 bg-white focus:border-purple-500 focus:ring-purple-500">
                            <p class="text-xs text-gray-500 mt-1">
                                Formats acceptés : PDF, DOC, DOCX, JPG, JPEG, PNG.
                            </p>
                        </div>

                    </div>

                    <div class="mt-8 flex justify-between">
                        <a href="{{ route('transactions.index') }}"
                           class="px-6 py-3 rounded-2xl bg-gray-200 text-gray-700 font-bold hover:bg-gray-300">
                            Annuler
                        </a>

                        <button type="submit"
                                class="px-8 py-3 rounded-2xl bg-gradient-to-r from-purple-600 via-pink-600 to-orange-500 text-white font-extrabold shadow-lg hover:scale-105 transition">
                            Enregistrer la transaction
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>