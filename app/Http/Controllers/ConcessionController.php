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
        // dd(request()->all());
        $request->validate([
            'concession_name' => 'required|string|max:255',
            'geometry' => 'required|string',
        ]);
        // dd($request->geometry);
        $geometryData = json_decode($request->geometry, true);

        // Create a LineString object from the coordinates array
        // dd($geometryData['coordinates'][0]);

        $coordinates = $geometryData['coordinates'][0];

        // Convert the coordinates array into an array of Point objects
        $points = array_map(function ($coordinate) {
            return new Point($coordinate[0], $coordinate[1]);
        }, $coordinates);

        // Create a LineString object from the array of Point objects
        $lineString = new LineString($points);
        dd($lineString);

        Concession::create([
            'concession_name' => $request->concession_name,
            'geometry' => $lineString,
            // 'geometry' => json_decode($request->geometry),
        ]);
        $concession = new Concession();
        $concession->concession_name = $request->concession_name;
        $geometryData = json_decode($request->geometry, true);
        $coordinates = $geometryData['coordinates'][0];
        $points = array_map(function ($coordinate) {
            return new Point($coordinate[0], $coordinate[1]);
        }, $coordinates);
        $lineString = new LineString($points);

        // Assign the LineString object to the geometry attribute
        $concession->geometry = $lineString;

        $concession->save();

        // Flash a success message to the session
        Session::flash('success', 'Concession saved successfully');

        // return redirect()->route('index')->with('success', 'Concession added successfully.');
    }
}
