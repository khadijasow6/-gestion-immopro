<x-app-layout>

    <div class="py-10 min-h-screen bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Bannière -->
            <div class="relative overflow-hidden bg-gradient-to-r from-indigo-700 via-purple-700 to-pink-600 rounded-3xl shadow-2xl p-10 mb-10 text-white">
                <div class="absolute top-0 right-0 w-72 h-72 bg-white opacity-10 rounded-full -mr-24 -mt-24"></div>
                <div class="absolute bottom-0 left-0 w-56 h-56 bg-white opacity-10 rounded-full -ml-20 -mb-20"></div>

                <div class="relative z-10">
                    <h1 class="text-4xl font-extrabold mb-3">
                        Reporting de l’agence 📊
                    </h1>

                    <p class="text-purple-100 text-lg max-w-2xl">
                        Analyse des biens, transactions, commissions et performances des agents.
                    </p>
                </div>
            </div>

            <!-- Cartes statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

                <div class="bg-white rounded-3xl shadow-xl p-6 border-t-4 border-green-500">
                    <p class="text-sm text-gray-500 font-semibold">Biens disponibles</p>
                    <h3 class="text-4xl font-extrabold text-green-600 mt-2">
                        {{ $availableProperties }}
                    </h3>
                    <p class="text-sm text-gray-400 mt-2">Actuellement sur le marché</p>
                </div>

                <div class="bg-white rounded-3xl shadow-xl p-6 border-t-4 border-red-500">
                    <p class="text-sm text-gray-500 font-semibold">Biens vendus/loués</p>
                    <h3 class="text-4xl font-extrabold text-red-600 mt-2">
                        {{ $soldProperties }}
                    </h3>
                    <p class="text-sm text-gray-400 mt-2">Transactions finalisées</p>
                </div>

                <div class="bg-white rounded-3xl shadow-xl p-6 border-t-4 border-yellow-500">
                    <p class="text-sm text-gray-500 font-semibold">Biens réservés</p>
                    <h3 class="text-4xl font-extrabold text-yellow-600 mt-2">
                        {{ $reservedProperties }}
                    </h3>
                    <p class="text-sm text-gray-400 mt-2">En attente de finalisation</p>
                </div>

                <div class="bg-white rounded-3xl shadow-xl p-6 border-t-4 border-purple-600">
                    <p class="text-sm text-gray-500 font-semibold">Commissions totales</p>
                    <h3 class="text-2xl font-extrabold text-purple-700 mt-2">
                        {{ number_format($totalCommission, 0, ',', ' ') }} FCFA
                    </h3>
                    <p class="text-sm text-gray-400 mt-2">Revenus de l’agence</p>
                </div>

            </div>

            <!-- Deuxième ligne statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">

                <div class="bg-white rounded-3xl shadow-xl p-6">
                    <h3 class="text-2xl font-extrabold text-gray-800 mb-4">
                        Résumé des biens 🏘️
                    </h3>

                    <div class="space-y-4">
                        <div class="flex justify-between items-center bg-green-50 p-4 rounded-2xl">
                            <span class="font-bold text-gray-700">Disponibles</span>
                            <span class="font-extrabold text-green-700">{{ $availableProperties }}</span>
                        </div>

                        <div class="flex justify-between items-center bg-yellow-50 p-4 rounded-2xl">
                            <span class="font-bold text-gray-700">Réservés</span>
                            <span class="font-extrabold text-yellow-700">{{ $reservedProperties }}</span>
                        </div>

                        <div class="flex justify-between items-center bg-red-50 p-4 rounded-2xl">
                            <span class="font-bold text-gray-700">Vendus/Loués</span>
                            <span class="font-extrabold text-red-700">{{ $soldProperties }}</span>
                        </div>

                        <div class="flex justify-between items-center bg-gray-50 p-4 rounded-2xl">
                            <span class="font-bold text-gray-700">Archivés</span>
                            <span class="font-extrabold text-gray-700">{{ $archivedProperties }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-xl p-6">
                    <h3 class="text-2xl font-extrabold text-gray-800 mb-4">
                        Résumé financier 💰
                    </h3>

                    <div class="space-y-4">
                        <div class="bg-purple-50 p-5 rounded-2xl border border-purple-100">
                            <p class="text-sm text-gray-500">Nombre de transactions</p>
                            <h4 class="text-3xl font-extrabold text-purple-700">
                                {{ $totalTransactions }}
                            </h4>
                        </div>

                        <div class="bg-green-50 p-5 rounded-2xl border border-green-100">
                            <p class="text-sm text-gray-500">Total des commissions</p>
                            <h4 class="text-3xl font-extrabold text-green-700">
                                {{ number_format($totalCommission, 0, ',', ' ') }} FCFA
                            </h4>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Performance agents -->
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-purple-100">
                <div class="p-6 bg-gradient-to-r from-purple-50 to-pink-50 border-b">
                    <h3 class="text-2xl font-extrabold text-gray-800">
                        Performance par agent 👤
                    </h3>
                    <p class="text-sm text-gray-500">
                        Nombre de transactions et commissions générées par agent.
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white text-sm uppercase">
                                <th class="p-4 text-left">Agent</th>
                                <th class="p-4 text-left">Transactions</th>
                                <th class="p-4 text-left">Commissions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-purple-100">
                            @forelse($performanceByAgent as $performance)
                                <tr class="hover:bg-purple-50 transition">
                                    <td class="p-4 font-extrabold text-gray-800">
                                        {{ $performance->agent->name ?? 'Agent supprimé' }}
                                    </td>

                                    <td class="p-4 font-bold text-gray-700">
                                        {{ $performance->total_transactions }}
                                    </td>

                                    <td class="p-4 font-extrabold text-green-700">
                                        {{ number_format($performance->total_commission, 0, ',', ' ') }} FCFA
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="p-10 text-center text-gray-500">
                                        Aucune performance disponible pour le moment.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>