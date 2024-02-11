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
            'geometry' => 'required|string',
        ]);

        $geometryData = json_decode($request->geometry, true);
        $coordinates = $geometryData['coordinates'][0];

        $points = array_map(function ($coordinate) {
            return new Point($coordinate[0], $coordinate[1]);
        }, $coordinates);

        $lineString = new LineString($points);
        dd($lineString);

        Concession::create([
            'concession_name' => $request->concession_name,
            'geometry' => $lineString,
        ]);
        $concession = new Concession();
        $concession->concession_name = $request->concession_name;
        $geometryData = json_decode($request->geometry, true);
        $coordinates = $geometryData['coordinates'][0];
        $points = array_map(function ($coordinate) {
            return new Point($coordinate[0], $coordinate[1]);
        }, $coordinates);
        $lineString = new LineString($points);

        $concession->geometry = $lineString;

        $concession->save();

        Session::flash('success', 'Concession saved successfully');

        // return redirect()->route('index')->with('success', 'Concession added successfully.');
    }
    public function show($id)
    {
        $concession = Concession::findOrFail($id);

        return view('concession.show', compact('concession'));
    }
    public function showAll()
{
    $concessions = Concession::all();

    return view('concession.showall',  ['concessions' => $concessions]);
}
}
