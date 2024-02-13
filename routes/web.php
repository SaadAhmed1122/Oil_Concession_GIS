<?php

use App\Http\Controllers\ConcessionController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\tankController;
use App\Http\Controllers\wellController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return redirect(route('filament.admin.auth.login'));
})->name('login');

// Route::get('/concession', function () {
//     return view('index');
// });
Route::get('/concessions/create', [ConcessionController::class, 'create'])->name('concessions.create');
Route::post('/concessions/store', [ConcessionController::class, 'store'])->name('concessions.store');
Route::get('/concessions/{id}',[ConcessionController::class,'show'])->name('concessions.show');
Route::get('/concessions', [ConcessionController::class,'showAll'])->name('concessions.showAll');
// routes/web.php
Route::get('/wells/create', [wellController::class, 'create'])->name('well.create');
Route::post('/wells/store', [WellController::class, 'store'])->name('well.store');
Route::get('/wells', [WellController::class, 'index'])->name('well.list');

Route::get('/tanks/create', [tankController::class,'create'])->name('tanks.create');
Route::post('/tanks/store', [tankController::class,'store'])->name('tanks.store');
Route::get('/tanks', [TankController::class, 'index'])->name('tank.index');


Route::get('/inspections', [InspectionController::class, 'index'])->name('inspections.index');
Route::post('/inspections/store', [InspectionController::class, 'store'])->name('inspections.store');
Route::get('/inspections/create', [InspectionController::class, 'create'])->name('inspections.create');
Route::get('/inspections/{inspection}/edit', [InspectionController::class, 'edit'])->name('inspections.edit_inspection');
Route::delete('/inspections/{inspection}', [InspectionController::class, 'destroy'])->name('inspections.destroy');
Route::put('/inspections/{id}', [InspectionController::class,'update'])->name('inspections.update');
