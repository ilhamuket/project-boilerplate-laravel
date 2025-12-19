<?php

use App\Http\Controllers\ProfileController;
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

     Route::get('/only-admin', function () {
        return 'OK ADMIN';
    })->middleware('role:super-admin');

    Route::get('/only-budget-view', function () {
        return 'OK BUDGET VIEW';
    })->middleware('permission:budget.view');
});

require __DIR__.'/auth.php';
