<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Transaction;
use App\Models\User;

class ReportController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isClient()) {
            abort(403, 'Accès refusé.');
        }

        if ($user->isAdmin()) {
            $availableProperties = Property::where('status', 'Disponible')->count();
            $soldProperties = Property::where('status', 'Vendu-Loué')->count();
            $reservedProperties = Property::where('status', 'Réservé')->count();
            $archivedProperties = Property::where('status', 'Archivé')->count();

            $totalCommission = Transaction::sum('agency_commission');
            $totalTransactions = Transaction::count();

            $agents = User::where('role', 'agent')
                ->withCount('properties')
                ->get();

            $performanceByAgent = Transaction::selectRaw('agent_id, COUNT(*) as total_transactions, SUM(agency_commission) as total_commission')
                ->groupBy('agent_id')
                ->with('agent')
                ->get();
        } else {
            $availableProperties = Property::where('agent_id', $user->id)
                ->where('status', 'Disponible')
                ->count();

            $soldProperties = Property::where('agent_id', $user->id)
                ->where('status', 'Vendu-Loué')
                ->count();

            $reservedProperties = Property::where('agent_id', $user->id)
                ->where('status', 'Réservé')
                ->count();

            $archivedProperties = Property::where('agent_id', $user->id)
                ->where('status', 'Archivé')
                ->count();

            $totalCommission = Transaction::where('agent_id', $user->id)
                ->sum('agency_commission');

            $totalTransactions = Transaction::where('agent_id', $user->id)
                ->count();

            $agents = collect();

            $performanceByAgent = Transaction::selectRaw('agent_id, COUNT(*) as total_transactions, SUM(agency_commission) as total_commission')
                ->where('agent_id', $user->id)
                ->groupBy('agent_id')
                ->with('agent')
                ->get();
        }

        return view('reports.index', compact(
            'availableProperties',
            'soldProperties',
            'reservedProperties',
            'archivedProperties',
            'totalCommission',
            'totalTransactions',
            'agents',
            'performanceByAgent'
        ));
    }
}