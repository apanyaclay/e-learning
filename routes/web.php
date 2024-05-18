<?php

use App\Http\Controllers\Pengajar\PengajarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Siswa\SiswaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return view('welcome');
    })->middleware('checkrole')->name('dashboard');
    Route::prefix('pengajar')->group(function () {
        Route::get('/dashboard', [PengajarController::class, 'dashboard'])->name('pengajar/dashboard');
    })->middleware(['verified', 'role:pengajar']);
    Route::prefix('siswa')->group(function () {
        Route::get('/dashboard', [SiswaController::class, 'dashboard'])->name('siswa/dashboard');
    })->middleware(['verified', 'role:siswa']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
