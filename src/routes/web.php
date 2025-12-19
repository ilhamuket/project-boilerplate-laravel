<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

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

    Route::get('/export/users', function () {
        return Excel::download(new UsersExport(), 'users.xlsx');
    });

    Route::get('/test-activity', function () {
        activity()
            ->causedBy(auth()->user()) // kalau belum login, bisa null
            ->withProperties(['ip' => request()->ip(), 'ua' => request()->userAgent()])
            ->log('Test activity log works');

        return 'logged';
    });
});

require __DIR__.'/auth.php';
