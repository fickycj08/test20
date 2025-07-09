<?php

use App\Http\Controllers\dashboardcontroller;
use App\Http\Controllers\datakendaraan;
use App\Http\Controllers\jadwalservis;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirestoreController;
use App\Http\Controllers\sparepart;
use App\Services\FirebaseService;

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/cek-firestore', function () {
    $firestore = new FirebaseService();
    return $firestore->testConnection();
});

Route::get('/firestore', [FirestoreController::class, 'index']);
// Dashboard route handled by controller with auth and verification
Route::get('/dashboard', [dashboardcontroller::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::get('/datakendaraan', [datakendaraan::class, 'index'])->name('datakendaraan.index');
Route::get('/jadwalservis', [jadwalservis::class, 'index'])->name('jadwalservis.index');
Route::get('/sparepart', [sparepart::class, 'index'])->name('sparepart.index');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
