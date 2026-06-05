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
                        Planning des visites
                    </h1>
                    <p class="text-purple-100 text-lg max-w-2xl">
                        Consultez les visites planifiées, réalisées ou annulées.
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-purple-100">
                <div class="p-6 bg-gradient-to-r from-purple-50 to-pink-50 border-b flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-extrabold text-gray-800">
                            Liste des visites
                        </h3>
                        <p class="text-sm text-gray-500">
                            Client, bien, agent, date et statut
                        </p>
                    </div>

                    <span class="bg-purple-100 text-purple-700 px-5 py-2 rounded-full text-sm font-bold">
                        Total : {{ $visits->total() }}
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white text-sm uppercase">
                                <th class="p-4 text-left">Client</th>
                                <th class="p-4 text-left">Bien</th>
                                <th class="p-4 text-left">Agent</th>
                                <th class="p-4 text-left">Date</th>
                                <th class="p-4 text-left">Statut</th>
                                <th class="p-4 text-left min-w-[220px]">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-purple-100">
                            @forelse($visits as $visit)
                                <tr class="hover:bg-purple-50 transition">
                                    <td class="p-4 font-bold text-gray-800">
                                        {{ $visit->client->name ?? 'Client supprimé' }}
                                    </td>

                                    <td class="p-4">
                                        <div class="font-extrabold text-gray-800">
                                            {{ $visit->property->type ?? 'Bien supprimé' }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $visit->property->district ?? '' }}
                                        </div>
                                    </td>

                                    <td class="p-4 font-semibold text-gray-700">
                                        {{ $visit->agent->name ?? 'Agent supprimé' }}
                                    </td>

                                    <td class="p-4 font-semibold text-gray-700">
                                        {{ \Carbon\Carbon::parse($visit->visit_date)->format('d/m/Y H:i') }}
                                    </td>

                                    <td class="p-4">
                                        @if($visit->status === 'Planifiée')
                                            <span class="px-4 py-2 rounded-full text-xs font-extrabold bg-yellow-100 text-yellow-700">
                                                Planifiée
                                            </span>
                                        @elseif($visit->status === 'Réalisée')
                                            <span class="px-4 py-2 rounded-full text-xs font-extrabold bg-green-100 text-green-700">
                                                Réalisée
                                            </span>
                                        @else
                                            <span class="px-4 py-2 rounded-full text-xs font-extrabold bg-red-100 text-red-700">
                                                Annulée
                                            </span>
                                        @endif
                                    </td>

                                    <td class="p-4">
                                        <div class="flex items-center gap-2 whitespace-nowrap">
                                            @if(auth()->user()->isAdmin() || auth()->user()->isAgent())
                                                <a href="{{ route('visits.edit', $visit) }}"
                                                   class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-yellow-100 text-yellow-700 text-sm font-bold hover:bg-yellow-200 transition">
                                                    Modifier
                                                </a>
                                            @endif

                                            <form action="{{ route('visits.destroy', $visit) }}"
                                                  method="POST"
                                                  class="inline-flex m-0">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        onclick="return confirm('Supprimer cette visite ?')"
                                                        class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-red-100 text-red-700 text-sm font-bold hover:bg-red-200 transition">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-14 text-center">
                                        <div class="text-7xl mb-4">📅</div>
                                        <h3 class="text-2xl font-extrabold text-gray-700">
                                            Aucune visite planifiée
                                        </h3>
                                        <p class="text-gray-500 mt-2">
                                            Planifiez une visite pour un bien disponible.
                                        </p>

                                        <a href="{{ route('visits.create') }}"
                                           class="inline-block mt-6 bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-3 rounded-2xl shadow-lg font-bold hover:scale-105 transition">
                                            Planifier une visite
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-6 bg-gradient-to-r from-purple-50 to-pink-50 border-t">
                    {{ $visits->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>