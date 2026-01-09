<?php

use App\Http\Controllers\DepartementController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeavesController;
use App\Http\Controllers\LeavesTypesController;
use App\Http\Controllers\PointageController;
use App\Http\Controllers\ProfileController;
use App\Models\Pointage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/departement', function () {
//     return view('departement.index');
// })->middleware(['auth', 'verified'])->name('departement');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // departement
    Route::get('/departement', [DepartementController::class, 'index'])->name('departement');
    Route::post('/departementstore', [DepartementController::class, 'store'])->name('departement.store');
    Route::delete('/departementdestroy/{id}', [DepartementController::class, 'destroy'])->name('departement.destroy');
     Route::put('/departementeupdate/{id}', [DepartementController::class, 'update'])->name('departement.update');


    // employe
    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee');
    Route::post('/employeestore', [EmployeeController::class, 'store'])->name('employee.store');
    Route::put('/employeeupdate/{id}', [EmployeeController::class, 'update'])->name('employee.mod');
    Route::delete('/employeedestroy/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
 

     // typeconge
    Route::get('/conge', [LeavesTypesController::class, 'index'])->name('conge');
    Route::post('/congeestore', [LeavesTypesController::class, 'store'])->name('conge.store');
    Route::put('/congeeupdate/{id}', [LeavesTypesController::class, 'update'])->name('congee.mod');
    Route::delete('/congeedestroy/{id}', [LeavesTypesController::class, 'destroy'])->name('congee.destroy');

    // moduleconge
    Route::get('/moduleconge', [LeavesController::class, 'index'])->name('moduleconge');
    Route::post('/moduleeinsert', [LeavesController::class, 'store'])->name('module.store');
    Route::put('/leaves/{id}/status', [LeavesController::class, 'update'])->name('status.valid');
    // Route::delete('/modulecongedestroy/{id}', [LeavesTypesController::class, 'destroy'])->name('modulecongee.destroy');

         // pointage
    Route::get('/pointage', [PointageController::class, 'index'])->name('pointage.index');
    Route::post('/pointagestore', [PointageController::class, 'store'])->name('pointage.store');
    Route::put('/pointage/{id}/checkout', [PointageController::class, 'checkout'])->name('pointage.checkout');
    Route::get('/pointage/date', [PointageController::class, 'byDate'])
    ->name('pointage.byDate');

    // Route::delete('/congeedestroy/{id}', [LeavesTypesController::class, 'destroy'])->name('congee.destroy');



});

require __DIR__.'/auth.php';
