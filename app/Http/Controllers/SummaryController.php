<?php

namespace App\Http\Controllers;

use App\Models\Concession;
use App\Models\Inspection;
use App\Models\Tank;
use App\Models\Well;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    public function index()
    {
        $totalConcessions = Concession::count();
        $totalWells = Well::count();
        $totalTanks = Tank::count();
        $totalInspections = Inspection::count();

        return view('index', compact('totalConcessions', 'totalWells', 'totalTanks', 'totalInspections'));
    }
}
