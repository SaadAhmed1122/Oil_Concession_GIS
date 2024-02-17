<?php

namespace App\Http\Controllers;

use App\Models\Concession;
use App\Models\Tank;
use App\Models\Well;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Objects\Polygon;
use MatanYadaev\EloquentSpatial\Objects\LineString;

class tankController extends Controller
{
    public function create()
    {
        $concessions = Concession::all();
        $wells = Well::all();
        return view('tanks.create_tank', compact('concessions', 'wells'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'concession_code' => 'required',
            'well_code' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'polyline' => 'required',
        ]);

        Tank::create($request->all());

        return redirect()->route('tank.index')
            ->with('success', 'Tank created successfully.');
    }

    public function index(Request $request)
    {
        $tanks = Tank::with('well.concession')->get();
        $concessions = Concession::all();
        $wells = Well::query();

        if ($request->has('concession_code')) {
            $wells->where('concession_code', $request->concession_code);
        }

        $wells = $wells->get();

        $filteredWellIds = $wells->pluck('id')->toArray();

        $filteredTanks = $tanks->filter(function ($tank) use ($filteredWellIds) {
            return in_array($tank->well->id, $filteredWellIds);
        });

        return view('tanks.tank_list', compact('filteredTanks', 'concessions', 'wells'));
    }

}
