<?php

namespace App\Http\Controllers;

use App\Models\Concession;
use App\Models\Well;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Objects\Polygon;
use MatanYadaev\EloquentSpatial\Objects\LineString;

class wellController extends Controller
{

    // Controller
    public function create()
    {
        $concessions = Concession::all();
        return view('well.create_well', compact('concessions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'concession_code' => 'required',
            'monthly_production' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        Well::create($request->all());

        return redirect()->route('well.list')
            ->with('success', 'Well created successfully.');
    }
    public function index(Request $request)
    {
        $concessions = Concession::all();
        $wells = Well::query();

        if ($request->has('concession_code')) {
            $wells->where('concession_code', $request->concession_code);
        }

        $wells = $wells->get();

        return view('well.list', compact('wells', 'concessions'));
    }
}
