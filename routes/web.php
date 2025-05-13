<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function(){
    return redirect()->route('login');
});


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () { 
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employee.view');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employee.store');
    Route::post('/employees/delete',  [EmployeeController::class, 'destroy'])->name('employee.destroy');
    Route::get('/employees/form', [EmployeeController::class, 'create'])->name('employee.form');
    Route::get('/employees/{id}', [EmployeeController::class, 'show']);
    Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employee.update');

    Route::get('/branches', [BranchController::class, 'index'])->name('branch.index');
    Route::get('/branches/form', [BranchController::class, 'create'])->name('branch.form');
    Route::post('/branches',[BranchController::class, 'store'])->name('branch.store');
    Route::put('/branches/{branch}', [BranchController::class, 'update'])->name('branch.update');
    Route::post('/branches/delete',  [BranchController::class, 'destroy'])->name('branch.destroy');
    Route::get('/branches/names', [BranchController::class, 'getBranchNames']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');    
});


require __DIR__.'/auth.php';
