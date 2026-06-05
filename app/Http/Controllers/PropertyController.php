<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyPhoto;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
   public function index(Request $request)
{
    $query = Property::with('agent', 'photos');

    if (auth()->user()->isAgent()) {
        $query->where('agent_id', auth()->id());
    }

    if (auth()->user()->isClient()) {
        $query->where('status', 'Disponible');
    }

    if ($request->filled('type')) {
        $query->where('type', $request->type);
    }

    if ($request->filled('transaction_type')) {
        $query->where('transaction_type', $request->transaction_type);
    }

    if ($request->filled('district')) {
        $query->where('district', 'like', '%' . $request->district . '%');
    }

    if ($request->filled('min_price')) {
        $query->where('price', '>=', $request->min_price);
    }

    if ($request->filled('max_price')) {
        $query->where('price', '<=', $request->max_price);
    }

    if ($request->filled('min_surface')) {
        $query->where('surface', '>=', $request->min_surface);
    }

    if ($request->filled('max_surface')) {
        $query->where('surface', '<=', $request->max_surface);
    }

    $properties = $query->latest()->paginate(10)->withQueryString();

    return view('properties.index', compact('properties'));
}

    public function create()
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isAgent()) {
            abort(403, 'Accès refusé.');
        }

        return view('properties.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isAgent()) {
            abort(403, 'Accès refusé.');
        }

        $data = $request->validate([
            'type' => 'required|in:Appartement,Villa,Bureau,Terrain,Commerce',
            'transaction_type' => 'required|in:Vente,Location',
            'surface' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:1',
            'address' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'status' => 'required|in:Disponible,Réservé,Vendu-Loué,Archivé',
            'description' => 'nullable|string',
            'photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data['agent_id'] = auth()->id();

        $property = Property::create($data);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('properties', 'public');

                PropertyPhoto::create([
                    'property_id' => $property->id,
                    'path' => $path,
                ]);
            }
        }

        return redirect()->route('properties.index')
            ->with('success', 'Bien immobilier ajouté avec succès.');
    }

    public function show(Property $property)
    {
        $property->load('photos', 'agent');

        return view('properties.show', compact('property'));
    }

    public function edit(Property $property)
    {
        if (auth()->user()->isAgent() && $property->agent_id !== auth()->id()) {
            abort(403, 'Accès refusé.');
        }

        if (auth()->user()->isClient()) {
            abort(403, 'Accès refusé.');
        }

        return view('properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        if (auth()->user()->isAgent() && $property->agent_id !== auth()->id()) {
            abort(403, 'Accès refusé.');
        }

        if (auth()->user()->isClient()) {
            abort(403, 'Accès refusé.');
        }

        $data = $request->validate([
            'type' => 'required|in:Appartement,Villa,Bureau,Terrain,Commerce',
            'transaction_type' => 'required|in:Vente,Location',
            'surface' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:1',
            'address' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'status' => 'required|in:Disponible,Réservé,Vendu-Loué,Archivé',
            'description' => 'nullable|string',
            'photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $property->update($data);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('properties', 'public');

                PropertyPhoto::create([
                    'property_id' => $property->id,
                    'path' => $path,
                ]);
            }
        }

        return redirect()->route('properties.index')
            ->with('success', 'Bien immobilier modifié avec succès.');
    }

    public function destroy(Property $property)
    {
        if (auth()->user()->isAgent() && $property->agent_id !== auth()->id()) {
            abort(403, 'Accès refusé.');
        }

        if (auth()->user()->isClient()) {
            abort(403, 'Accès refusé.');
        }

        $property->delete();

        return redirect()->route('properties.index')
            ->with('success', 'Bien immobilier supprimé avec succès.');
    }
}