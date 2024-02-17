<?php

namespace App\Http\Controllers;

use App\Models\Concession;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Objects\Polygon;
use MatanYadaev\EloquentSpatial\Objects\LineString;

class ConcessionController extends Controller
{
    public function create()
    {
        return view('concession.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'concession_name' => 'required|string|max:255',
            'geometry' => 'required',
        ]);
        Concession::create($request->all());

        return redirect()->route('concessions.showAll')->with('success', 'Concession added successfully.');
    }
    public function show($id)
    {
        $concession = Concession::findOrFail($id);

        return view('concession.show', compact('concession'));
    }
    public function showAll()
    {
        $concessions = Concession::all();

        return view('concession.showall', ['concessions' => $concessions]);
    }
}
