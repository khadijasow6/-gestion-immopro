<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Property;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $visits = Visit::with('client', 'agent', 'property')
                ->latest()
                ->paginate(10);
        } elseif ($user->isAgent()) {
            $visits = Visit::with('client', 'agent', 'property')
                ->where('agent_id', $user->id)
                ->latest()
                ->paginate(10);
        } else {
            $visits = Visit::with('client', 'agent', 'property')
                ->where('client_id', $user->id)
                ->latest()
                ->paginate(10);
        }

        return view('visits.index', compact('visits'));
    }

    public function create(Request $request)
    {
        $property = null;

        if ($request->has('property_id')) {
            $property = Property::findOrFail($request->property_id);
        }

        $properties = Property::where('status', 'Disponible')
            ->latest()
            ->get();

        return view('visits.create', compact('property', 'properties'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'visit_date' => 'required|date',
        ]);

        $property = Property::findOrFail($data['property_id']);

        Visit::create([
            'client_id' => auth()->id(),
            'property_id' => $property->id,
            'agent_id' => $property->agent_id,
            'visit_date' => $data['visit_date'],
            'status' => 'Planifiée',
        ]);

        return redirect()->route('visits.index')
            ->with('success', 'Visite planifiée avec succès.');
    }

    public function edit(Visit $visit)
    {
        if (auth()->user()->isClient()) {
            abort(403, 'Accès refusé.');
        }

        if (auth()->user()->isAgent() && $visit->agent_id !== auth()->id()) {
            abort(403, 'Accès refusé.');
        }

        return view('visits.edit', compact('visit'));
    }

    public function update(Request $request, Visit $visit)
    {
        if (auth()->user()->isClient()) {
            abort(403, 'Accès refusé.');
        }

        if (auth()->user()->isAgent() && $visit->agent_id !== auth()->id()) {
            abort(403, 'Accès refusé.');
        }

        $data = $request->validate([
            'status' => 'required|in:Planifiée,Réalisée,Annulée',
            'report' => 'nullable|string',
        ]);

        $visit->update($data);

        return redirect()->route('visits.index')
            ->with('success', 'Visite mise à jour avec succès.');
    }

    public function destroy(Visit $visit)
    {
        if (auth()->user()->isClient() && $visit->client_id !== auth()->id()) {
            abort(403, 'Accès refusé.');
        }

        if (auth()->user()->isAgent() && $visit->agent_id !== auth()->id()) {
            abort(403, 'Accès refusé.');
        }

        $visit->delete();

        return redirect()->route('visits.index')
            ->with('success', 'Visite supprimée avec succès.');
    }
}