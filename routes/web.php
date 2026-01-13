<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| ACCESS GATE (SEBELUM LOGIN / REGISTER)
|--------------------------------------------------------------------------
*/

Route::get('/', [AccessController::class, 'index'])->name('access.index');
Route::get('/access', [AccessController::class, 'index'])->name('access.index');
Route::post('/access', [AccessController::class, 'check'])->name('access.check');

/*
|--------------------------------------------------------------------------
| GUEST (LOGIN & REGISTER) – HARUS LEWAT ACCESS GATE
|--------------------------------------------------------------------------
*/

Route::middleware(['guest', 'access'])->group(function () {

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store']);
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard / Redirect utama
    Route::get('/dashboard', function () {
        return redirect()->route('jurnals.index');
    })->name('dashboard');

    // JURNAL (FULL CRUD)
    Route::resource('jurnals', JurnalController::class);

    // Profile (jika dipakai Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
    
    Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return redirect()->route('jurnals.index');
    })->name('dashboard');

    // JURNAL CRUD
    Route::resource('jurnals', JurnalController::class);

    // EXPORT JURNAL
    Route::get('/jurnals/export/mine', [JurnalController::class, 'exportMine'])
        ->name('jurnals.export.mine');

    Route::get('/jurnals/export/all', [JurnalController::class, 'exportAll'])
        ->name('jurnals.export.all');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
    });

});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (LOGOUT, dll)
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
