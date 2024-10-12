<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccidentController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\FinesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Rutas para Accident
Route::get('accidents', [AccidentController::class, 'index'])->name('api.v1.accidents.index');
Route::post('accidents', [AccidentController::class, 'store'])->name('api.v1.accidents.store');
Route::get('accidents/{id}', [AccidentController::class, 'show'])->name('api.v1.accidents.show');
Route::put('accidents/{id}', [AccidentController::class, 'update'])->name('api.v1.accidents.update');
Route::delete('accidents/{id}', [AccidentController::class, 'destroy'])->name('api.v1.accidents.destroy');

//Rutas para Person
Route::get('person', [PersonController::class, 'index'])->name('api.v1.person.index');
Route::post('person', [PersonController::class, 'store'])->name('api.v1.person.store');
Route::get('person/{id}', [PersonController::class, 'show'])->name('api.v1.person.show');
Route::put('person/{id}', [PersonController::class, 'update'])->name('api.v1.person.update');
Route::delete('person/{id}', [PersonController::class, 'destroy'])->name('api.v1.person.destroy');

//Rutas para Vehicle
Route::get('vehicles', [VehicleController::class, 'index'])->name('api.v1.vehicles.index');
Route::post('vehicles', [VehicleController::class, 'store'])->name('api.v1.vehicles.store');
Route::get('vehicles/{id}', [VehicleController::class, 'show'])->name('api.v1.vehicles.show');
Route::put('vehicles/{id}', [VehicleController::class, 'update'])->name('api.v1.vehicles.update');
Route::delete('vehicles/{id}', [VehicleController::class, 'destroy'])->name('api.v1.vehicles.destroy');

//Rutas para Fines
Route::get('fines', [FinesController::class, 'index'])->name('api.v1.fines.index');
Route::post('fines', [FinesController::class, 'store'])->name('api.v1.fines.store');
Route::get('fines/{id}', [FinesController::class, 'show'])->name('api.v1.fines.show');
Route::put('fines/{id}', [FinesController::class, 'update'])->name('api.v1.fines.update');
Route::delete('fines/{id}', [FinesController::class, 'destroy'])->name('api.v1.fines.destroy');
