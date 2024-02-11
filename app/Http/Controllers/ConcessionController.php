<?php

namespace App\Http\Controllers;

use App\Models\Concession;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

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
        Concession::create([
            'concession_name' => $request->name,
            // 'geometry' => $request->geometry,

            'geometry' => json_decode($request->geometry),
        ]);
        $concession = new Concession();
        $concession->concession_name = $request->name;
        $concession->geometry = json_decode($request->geometry);
        $concession->save();

        // Flash a success message to the session
        Session::flash('success', 'Concession saved successfully');

        return redirect()->route('index')->with('success', 'Concession added successfully.');
    }
}
