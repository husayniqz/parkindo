<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () { return view('welcome'); });

Auth::routes();

// Group Route Owner
Route::middleware(['auth', 'role:owner'])->prefix('owner')->group(function () {
    Route::get('/dashboard', [OwnerController::class, 'dashboard'])->name('owner.dashboard');
    Route::get('/export', [OwnerController::class, 'exportCSV'])->name('owner.export');
});

// Group Route Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.user.store');
    Route::put('/rates/{id}', [AdminController::class, 'updateRate'])->name('admin.rate.update');
});

// Group Route Petugas
Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->group(function () {
    Route::get('/dashboard', [PetugasController::class, 'dashboard'])->name('petugas.dashboard');
    Route::post('/masuk', [PetugasController::class, 'parkirMasuk'])->name('petugas.masuk');
    Route::post('/keluar/{id}', [PetugasController::class, 'parkirKeluar'])->name('petugas.keluar');
});