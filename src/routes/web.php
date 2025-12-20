<?php

use App\Exports\UsersExport;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Pdf\SuratController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
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
        return Excel::download(new UsersExport, 'users.xlsx');
    });

    Route::get('/test-activity', function () {
        activity()
            ->causedBy(auth()->user()) // kalau belum login, bisa null
            ->withProperties(['ip' => request()->ip(), 'ua' => request()->userAgent()])
            ->log('Test activity log works');

        return 'logged';
    });

    Route::get('/pdf/surat-keterangan', [SuratController::class, 'suratKeterangan']);
});

Route::middleware(['auth', 'role:super-admin'])->prefix('admin')->group(function () {
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('admin.activity-logs.index');
});

Route::get('/health', function () {
    return response()->json([
        'ok' => true,
        'app' => config('app.name'),
        'time' => now()->toISOString(),
    ]);
});

require __DIR__.'/auth.php';
