<?php

namespace App\Http\Controllers;

use App\Models\Concession;
use App\Models\Tank;
use App\Models\Well;
use Illuminate\Http\Request;
use App\Models\Inspection;

class InspectionController extends Controller
{
    public function index()
    {
        $inspections = Inspection::all();
        $concessions = Concession::all();
        $wells = Well::all();
        $tanks = Tank::all();

        return view('inspections.inspection_list', compact('inspections', 'concessions', 'wells', 'tanks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'inspection_date' => 'required|date',
            'resolution_time' => 'nullable|date',
            'description' => 'nullable|string',
            'concession_code' => 'nullable|integer',
            'well_code' => 'nullable|integer',
            'tank_code' => 'nullable|integer',
        ]);

        $inspection = new Inspection();
        $inspection->type = $request->type;
        $inspection->inspection_date = $request->inspection_date;
        $inspection->status = 'pending';
        $inspection->resolution_time = $request->resolution_time;
        $inspection->description = $request->description;

        // Assign related_id based on the type
        switch ($request->type) {
            case 'concession':
                $inspection->related_id = $request->concession_code;
                break;
            case 'well':
                $inspection->related_id = $request->well_code;
                break;
            case 'tank':
                $inspection->related_id = $request->tank_code;
                break;
        }

        $inspection->save();

        return redirect()->route('inspections.index')
            ->with('success', 'Inspection created successfully.');
    }
    public function create()
    {
        $inspections = Inspection::all();
        $concessions = Concession::all();
        $wells = Well::all();
        $tanks = Tank::all();
        return view('inspections.create_inspection', compact('inspections', 'concessions', 'wells', 'tanks'));
    }
    public function edit($id)
    {
        $inspection = Inspection::findOrFail($id);

        return view('inspections.edit_inspection', compact('inspection'));
    }
    public function update(Request $request, $id)
    {
        $inspection = Inspection::findOrFail($id);

        $request->validate([
            'description' => 'nullable|string',
            'estimation_date' => 'required|date',
            'status' => 'required|in:Pending,Completed,Cancelled',
        ]);

        $inspection->update([
            'description' => $request->description,
            'estimation_date' => $request->estimation_date,
            'status' => $request->status,
        ]);

        return redirect()->route('inspections.index')->with('success', 'Inspection updated successfully.');
    }
    public function destroy(Inspection $inspection)
    {
        $inspection->delete();

        return redirect()->route('inspections.index')->with('success', 'Inspection deleted successfully.');
    }
}
