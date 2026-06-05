<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDocument;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $transactions = Transaction::with('property', 'client', 'agent', 'documents')
                ->latest()
                ->paginate(10);
        } elseif ($user->isAgent()) {
            $transactions = Transaction::with('property', 'client', 'agent', 'documents')
                ->where('agent_id', $user->id)
                ->latest()
                ->paginate(10);
        } else {
            $transactions = Transaction::with('property', 'client', 'agent', 'documents')
                ->where('client_id', $user->id)
                ->latest()
                ->paginate(10);
        }

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        if (auth()->user()->isClient()) {
            abort(403, 'Accès refusé.');
        }

        $properties = Property::whereIn('status', ['Disponible', 'Réservé'])
            ->latest()
            ->get();

        $clients = User::where('role', 'client')->get();

        return view('transactions.create', compact('properties', 'clients'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->isClient()) {
            abort(403, 'Accès refusé.');
        }

        $data = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'client_id' => 'required|exists:users,id',
            'type' => 'required|in:Vente,Location',
            'amount' => 'required|numeric|min:1',
            'signed_date' => 'required|date',
            'agency_commission' => 'required|numeric|min:0',
            'documents.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:4096',
        ]);

        $property = Property::findOrFail($data['property_id']);

        if (auth()->user()->isAgent() && $property->agent_id !== auth()->id()) {
            abort(403, 'Accès refusé.');
        }

        $transaction = Transaction::create([
            'property_id' => $property->id,
            'client_id' => $data['client_id'],
            'agent_id' => $property->agent_id,
            'type' => $data['type'],
            'amount' => $data['amount'],
            'signed_date' => $data['signed_date'],
            'agency_commission' => $data['agency_commission'],
        ]);

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $document) {
                $path = $document->store('transactions', 'public');

                TransactionDocument::create([
                    'transaction_id' => $transaction->id,
                    'path' => $path,
                ]);
            }
        }

        $property->update([
            'status' => 'Vendu-Loué',
        ]);

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction enregistrée avec succès.');
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('property', 'client', 'agent', 'documents');

        if (auth()->user()->isAgent() && $transaction->agent_id !== auth()->id()) {
            abort(403, 'Accès refusé.');
        }

        if (auth()->user()->isClient() && $transaction->client_id !== auth()->id()) {
            abort(403, 'Accès refusé.');
        }

        return view('transactions.show', compact('transaction'));
    }

    public function destroy(Transaction $transaction)
    {
        if (auth()->user()->isClient()) {
            abort(403, 'Accès refusé.');
        }

        if (auth()->user()->isAgent() && $transaction->agent_id !== auth()->id()) {
            abort(403, 'Accès refusé.');
        }

        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction supprimée avec succès.');
    }
}