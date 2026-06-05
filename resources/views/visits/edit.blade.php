<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-3xl text-gray-800">
                    Modifier la visite 📋
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Mettez à jour le statut et le rapport de visite.
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
                        Visite de {{ $visit->client->name ?? 'Client supprimé' }}
                    </h1>
                    <p class="text-purple-100 mt-2">
                        Bien : {{ $visit->property->type ?? 'Bien supprimé' }} —
                        {{ $visit->property->district ?? '' }}
                    </p>
                </div>

                <form action="{{ route('visits.update', $visit) }}" method="POST" class="p-8">
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

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                        <div class="bg-purple-50 rounded-2xl p-5 border border-purple-100">
                            <p class="text-sm text-gray-500">Client</p>
                            <h3 class="text-xl font-extrabold text-gray-800">
                                {{ $visit->client->name ?? 'Client supprimé' }}
                            </h3>
                        </div>

                        <div class="bg-pink-50 rounded-2xl p-5 border border-pink-100">
                            <p class="text-sm text-gray-500">Agent</p>
                            <h3 class="text-xl font-extrabold text-gray-800">
                                {{ $visit->agent->name ?? 'Agent supprimé' }}
                            </h3>
                        </div>

                        <div class="bg-indigo-50 rounded-2xl p-5 border border-indigo-100">
                            <p class="text-sm text-gray-500">Bien immobilier</p>
                            <h3 class="text-xl font-extrabold text-gray-800">
                                {{ $visit->property->type ?? 'Bien supprimé' }}
                            </h3>
                            <p class="text-sm text-gray-500">
                                {{ $visit->property->district ?? '' }}
                            </p>
                        </div>

                        <div class="bg-orange-50 rounded-2xl p-5 border border-orange-100">
                            <p class="text-sm text-gray-500">Date de visite</p>
                            <h3 class="text-xl font-extrabold text-gray-800">
                                {{ \Carbon\Carbon::parse($visit->visit_date)->format('d/m/Y H:i') }}
                            </h3>
                        </div>

                    </div>

                    <div class="mb-6">
                        <label class="block font-bold text-gray-700 mb-2">
                            Statut de la visite
                        </label>

                        <select name="status"
                                class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                            <option value="Planifiée" {{ old('status', $visit->status) == 'Planifiée' ? 'selected' : '' }}>
                                Planifiée
                            </option>
                            <option value="Réalisée" {{ old('status', $visit->status) == 'Réalisée' ? 'selected' : '' }}>
                                Réalisée
                            </option>
                            <option value="Annulée" {{ old('status', $visit->status) == 'Annulée' ? 'selected' : '' }}>
                                Annulée
                            </option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block font-bold text-gray-700 mb-2">
                            Rapport de visite
                        </label>

                        <textarea name="report"
                                  rows="6"
                                  class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500"
                                  placeholder="Exemple : Le client est intéressé par le bien, mais souhaite négocier le prix.">{{ old('report', $visit->report) }}</textarea>
                    </div>

                    <div class="mt-8 flex justify-between">
                        <a href="{{ route('visits.index') }}"
                           class="px-6 py-3 rounded-2xl bg-gray-200 text-gray-700 font-bold hover:bg-gray-300">
                            Annuler
                        </a>

                        <button type="submit"
                                class="px-8 py-3 rounded-2xl bg-gradient-to-r from-purple-600 via-pink-600 to-orange-500 text-white font-extrabold shadow-lg hover:scale-105 transition">
                            Enregistrer
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>