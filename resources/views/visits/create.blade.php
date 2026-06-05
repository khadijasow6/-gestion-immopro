<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-3xl text-gray-800">
                    Planifier une visite 📅
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Choisissez un bien et une date de rendez-vous.
                </p>
            </div>

            <a href="{{ route('visits.index') }}"
               class="bg-gray-200 text-gray-700 px-5 py-3 rounded-2xl font-bold hover:bg-gray-300">
                Retour
            </a>
        </div>
    </x-slot>

    <div class="py-10 min-h-screen bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-purple-100">

                <div class="bg-gradient-to-r from-indigo-700 via-purple-700 to-pink-600 p-8 text-white">
                    <h1 class="text-3xl font-extrabold">
                        Nouvelle visite
                    </h1>
                    <p class="text-purple-100 mt-2">
                        Le client peut demander une visite pour un bien disponible.
                    </p>
                </div>

                <form action="{{ route('visits.store') }}" method="POST" class="p-8">
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

                    <div class="mb-6">
                        <label class="block font-bold text-gray-700 mb-2">
                            Bien immobilier
                        </label>

                        <select name="property_id"
                                class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                            <option value="">Choisir un bien</option>

                            @foreach($properties as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('property_id', $property->id ?? '') == $item->id ? 'selected' : '' }}>
                                    {{ $item->type }} - {{ $item->district }} - {{ number_format($item->price, 0, ',', ' ') }} FCFA
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block font-bold text-gray-700 mb-2">
                            Date et heure de visite
                        </label>

                        <input type="datetime-local"
                               name="visit_date"
                               value="{{ old('visit_date') }}"
                               class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                    </div>

                    <div class="mt-8 flex justify-between">
                        <a href="{{ route('visits.index') }}"
                           class="px-6 py-3 rounded-2xl bg-gray-200 text-gray-700 font-bold hover:bg-gray-300">
                            Annuler
                        </a>

                        <button type="submit"
                                class="px-8 py-3 rounded-2xl bg-gradient-to-r from-purple-600 via-pink-600 to-orange-500 text-white font-extrabold shadow-lg hover:scale-105 transition">
                            Planifier la visite
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>