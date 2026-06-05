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
                        Historique des transactions
                    </h1>
                    <p class="text-purple-100 text-lg max-w-2xl">
                        Retrouvez les ventes et locations signées avec leurs montants et commissions.
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-purple-100">
                <div class="p-6 bg-gradient-to-r from-purple-50 to-pink-50 border-b flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-extrabold text-gray-800">
                            Liste des transactions
                        </h3>
                        <p class="text-sm text-gray-500">
                            Bien, client, agent, montant et commission
                        </p>
                    </div>

                    <span class="bg-purple-100 text-purple-700 px-5 py-2 rounded-full text-sm font-bold">
                        Total : {{ $transactions->total() }}
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white text-sm uppercase">
                                <th class="p-4 text-left">Bien</th>
                                <th class="p-4 text-left">Client</th>
                                <th class="p-4 text-left">Agent</th>
                                <th class="p-4 text-left">Type</th>
                                <th class="p-4 text-left">Montant</th>
                                <th class="p-4 text-left">Commission</th>
                                <th class="p-4 text-left">Date</th>
                                <th class="p-4 text-left min-w-[190px]">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-purple-100">
                            @forelse($transactions as $transaction)
                                <tr class="hover:bg-purple-50 transition">
                                    <td class="p-4">
                                        <div class="font-extrabold text-gray-800">
                                            {{ $transaction->property->type ?? 'Bien supprimé' }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $transaction->property->district ?? '' }}
                                        </div>
                                    </td>

                                    <td class="p-4 font-semibold text-gray-700">
                                        {{ $transaction->client->name ?? 'Client supprimé' }}
                                    </td>

                                    <td class="p-4 font-semibold text-gray-700">
                                        {{ $transaction->agent->name ?? 'Agent supprimé' }}
                                    </td>

                                    <td class="p-4">
                                        @if($transaction->type === 'Vente')
                                            <span class="px-4 py-2 rounded-full text-xs font-extrabold bg-orange-100 text-orange-700">
                                                Vente
                                            </span>
                                        @else
                                            <span class="px-4 py-2 rounded-full text-xs font-extrabold bg-cyan-100 text-cyan-700">
                                                Location
                                            </span>
                                        @endif
                                    </td>

                                    <td class="p-4 font-extrabold text-purple-700">
                                        {{ number_format($transaction->amount, 0, ',', ' ') }} FCFA
                                    </td>

                                    <td class="p-4 font-extrabold text-green-700">
                                        {{ number_format($transaction->agency_commission, 0, ',', ' ') }} FCFA
                                    </td>

                                    <td class="p-4 font-semibold text-gray-700">
                                        {{ \Carbon\Carbon::parse($transaction->signed_date)->format('d/m/Y') }}
                                    </td>

                                    <td class="p-4">
                                        <div class="flex items-center gap-2 whitespace-nowrap">
                                            <a href="{{ route('transactions.show', $transaction) }}"
                                               class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-blue-100 text-blue-700 text-sm font-bold hover:bg-blue-200 transition">
                                                Voir
                                            </a>

                                            @if(auth()->user()->isAdmin() || auth()->user()->isAgent())
                                                <form action="{{ route('transactions.destroy', $transaction) }}"
                                                      method="POST"
                                                      class="inline-flex m-0">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            onclick="return confirm('Supprimer cette transaction ?')"
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
                                        <div class="text-7xl mb-4">💰</div>
                                        <h3 class="text-2xl font-extrabold text-gray-700">
                                            Aucune transaction enregistrée
                                        </h3>
                                        <p class="text-gray-500 mt-2">
                                            Ajoutez une vente ou une location signée.
                                        </p>

                                        @if(auth()->user()->isAdmin() || auth()->user()->isAgent())
                                            <a href="{{ route('transactions.create') }}"
                                               class="inline-block mt-6 bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-3 rounded-2xl shadow-lg font-bold hover:scale-105 transition">
                                                Nouvelle transaction
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-6 bg-gradient-to-r from-purple-50 to-pink-50 border-t">
                    {{ $transactions->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>