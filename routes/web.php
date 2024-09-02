<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('/employee/add', [EmployeeController::class, 'add'])->name('employee.add');
    Route::post('/employee/update/{id} ', [EmployeeController::class, 'update'])->name('employee.update');
    Route::post('/employee/save', [EmployeeController::class, 'save'])->name('employee.save');
    Route::delete('/employee/delete/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
    
    
    
});

require __DIR__.'/auth.php';
