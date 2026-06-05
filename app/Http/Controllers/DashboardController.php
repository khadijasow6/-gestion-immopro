<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Visit;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $availableProperties = Property::where('status', 'Disponible')->count();
            $soldProperties = Property::where('status', 'Vendu-Loué')->count();
            $plannedVisits = Visit::where('status', 'Planifiée')->count();
            $totalCommission = Transaction::sum('agency_commission');

            $latestProperties = Property::latest()->take(5)->get();
        } elseif ($user->isAgent()) {
            $availableProperties = Property::where('agent_id', $user->id)
                ->where('status', 'Disponible')
                ->count();

            $soldProperties = Property::where('agent_id', $user->id)
                ->where('status', 'Vendu-Loué')
                ->count();

            $plannedVisits = Visit::where('agent_id', $user->id)
                ->where('status', 'Planifiée')
                ->count();

            $totalCommission = Transaction::where('agent_id', $user->id)
                ->sum('agency_commission');

            $latestProperties = Property::where('agent_id', $user->id)
                ->latest()
                ->take(5)
                ->get();
        } else {
            $availableProperties = Property::where('status', 'Disponible')->count();
            $soldProperties = 0;

            $plannedVisits = Visit::where('client_id', $user->id)
                ->where('status', 'Planifiée')
                ->count();

            $totalCommission = 0;

            $latestProperties = Property::where('status', 'Disponible')
                ->latest()
                ->take(5)
                ->get();
        }

        return view('dashboard', compact(
            'availableProperties',
            'soldProperties',
            'plannedVisits',
            'totalCommission',
            'latestProperties'
        ));
    }
}