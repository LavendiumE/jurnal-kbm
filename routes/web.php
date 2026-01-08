<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JurnalController;

// ROOT → redirect ke jurnal
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('jurnals.index');
    }

    return redirect()->route('login');
});

// SEMUA FITUR DILINDUNGI LOGIN
Route::middleware(['auth'])->group(function () {

    // JURNAL
    Route::resource('jurnals', JurnalController::class);

    // EXPORT
    Route::get('/jurnals/export/all', [JurnalController::class, 'exportAll'])
        ->name('jurnals.export.all');

    Route::get('/jurnals/export/mine', [JurnalController::class, 'exportMine'])
        ->name('jurnals.export.mine');

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
