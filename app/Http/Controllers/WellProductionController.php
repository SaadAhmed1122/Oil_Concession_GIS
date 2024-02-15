<?php

namespace App\Http\Controllers;

use App\Models\Well;
use App\Models\WellProduction;
use Illuminate\Http\Request;

class WellProductionController extends Controller
{
    public function create()
    {
        $wells = Well::all();
        return view('well.well_production_create', compact('wells'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'well_id' => 'required|string|max:255',
            'monthly_production' => 'required|numeric|min:0',
            'month' => 'required|date',
        ]);

        WellProduction::create($request->all());

        return redirect()->route('well_productions.index')->with('success', 'Well production data added successfully.');
    }
    public function index(Request $request)
    {
        $query = WellProduction::query();

        if ($request->filled('well_code')) {
            $query->where('well_id', $request->well_code);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('month', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('month', '<=', $request->end_date);
        }

        $wellProductions = $query->get();
        $totalProduction = $wellProductions->sum('monthly_production');


        $wells = Well::all();

        return view('well.well_production_list', compact('wellProductions', 'wells','totalProduction'));
    }

}
