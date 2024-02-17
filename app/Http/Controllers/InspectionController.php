<?php

namespace App\Http\Controllers;

use App\Models\Concession;
use App\Models\Tank;
use App\Models\Well;
use Illuminate\Http\Request;
use App\Models\Inspection;
use Illuminate\Support\Facades\Log;

class InspectionController extends Controller
{
    public function index(Request $request)
    {
        $query = Inspection::query();

        Log::debug($request);
        // Check if start date is provided and add where clause
        if ($request->filled('start_date')) {
            $query->whereDate('inspection_date', '>=', $request->start_date);
        }

        // Check if end date is provided and add where clause
        if ($request->filled('end_date')) {
            $query->whereDate('inspection_date', '<=', $request->end_date);
        }

        // Retrieve filtered or all inspections based on the presence of filter parameters
        if ($request->filled('start_date') && $request->has('end_date')) {
            $inspections = $query->get();
        } else {
            $inspections = Inspection::all();
        }

        // Filter by concession
        if ($request->filled('concession') && $request->concession !== '') {
            $query->where('related_id', $request->concession);
        }

        // Filter by well
        if ($request->filled('well') && $request->well !== '') {
            $query->where('related_id', $request->well);
        }

        // Filter by tank
        if ($request->filled('tank') && $request->tank !== '') {
            $query->where('related_id', $request->tank);
        }

        // Retrieve filtered inspections
        $inspections = $query->get();

        // Retrieve all concessions, wells, and tanks for filter options
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
        // dd($request);

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
