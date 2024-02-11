<?php

use App\Http\Controllers\ConcessionController;
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
