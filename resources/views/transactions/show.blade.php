<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-3xl text-gray-800">
                    Détails de la transaction 💰
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Informations complètes de la vente ou location signée.
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
                        Transaction #{{ $transaction->id }}
                    </h1>
                    <p class="text-purple-100 mt-2">
                        {{ $transaction->type }} signée le
                        {{ \Carbon\Carbon::parse($transaction->signed_date)->format('d/m/Y') }}
                    </p>
                </div>

                <div class="p-8">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

                        <div class="bg-purple-50 rounded-2xl p-5 border border-purple-100">
                            <p class="text-sm text-gray-500">Bien immobilier</p>
                            <h3 class="text-xl font-extrabold text-gray-800">
                                {{ $transaction->property->type ?? 'Bien supprimé' }}
                            </h3>
                            <p class="text-sm text-gray-500">
                                {{ $transaction->property->district ?? '' }}
                            </p>
                        </div>

                        <div class="bg-pink-50 rounded-2xl p-5 border border-pink-100">
                            <p class="text-sm text-gray-500">Client</p>
                            <h3 class="text-xl font-extrabold text-gray-800">
                                {{ $transaction->client->name ?? 'Client supprimé' }}
                            </h3>
                        </div>

                        <div class="bg-indigo-50 rounded-2xl p-5 border border-indigo-100">
                            <p class="text-sm text-gray-500">Agent</p>
                            <h3 class="text-xl font-extrabold text-gray-800">
                                {{ $transaction->agent->name ?? 'Agent supprimé' }}
                            </h3>
                        </div>

                        <div class="bg-orange-50 rounded-2xl p-5 border border-orange-100">
                            <p class="text-sm text-gray-500">Type</p>
                            <h3 class="text-xl font-extrabold text-gray-800">
                                {{ $transaction->type }}
                            </h3>
                        </div>

                        <div class="bg-green-50 rounded-2xl p-5 border border-green-100">
                            <p class="text-sm text-gray-500">Montant</p>
                            <h3 class="text-xl font-extrabold text-green-700">
                                {{ number_format($transaction->amount, 0, ',', ' ') }} FCFA
                            </h3>
                        </div>

                        <div class="bg-yellow-50 rounded-2xl p-5 border border-yellow-100">
                            <p class="text-sm text-gray-500">Commission agence</p>
                            <h3 class="text-xl font-extrabold text-yellow-700">
                                {{ number_format($transaction->agency_commission, 0, ',', ' ') }} FCFA
                            </h3>
                        </div>

                    </div>

                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-100 rounded-2xl p-6">
                        <h3 class="text-2xl font-extrabold text-gray-800 mb-4">
                            Documents joints
                        </h3>

                        @if($transaction->documents->count() > 0)
                            <div class="space-y-3">
                                @foreach($transaction->documents as $document)
                                    <a href="{{ asset('storage/' . $document->path) }}"
                                       target="_blank"
                                       class="block bg-white rounded-xl p-4 font-bold text-purple-700 hover:bg-purple-50 border">
                                        📎 Voir le document {{ $loop->iteration }}
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500">
                                Aucun document joint pour cette transaction.
                            </p>
                        @endif
                    </div>

                    <div class="mt-8">
                        <a href="{{ route('transactions.index') }}"
                           class="px-6 py-3 rounded-2xl bg-gray-200 text-gray-700 font-bold hover:bg-gray-300">
                            Retour à la liste
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>