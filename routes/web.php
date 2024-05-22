<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Pengajar\JadwalMapelController;
use App\Http\Controllers\Pengajar\PengajarController;
use App\Http\Controllers\Pengajar\SiswaController as PengajarSiswaController;
use App\Http\Controllers\Siswa\MataPelajaranController;
use App\Http\Controllers\Siswa\SiswaController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Request;
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

function set_active( $route ) {
    if( is_array( $route ) ){
        return in_array(Request::path(), $route) ? 'active' : '';
    }
    return Request::path() == $route ? 'active' : '';
};
Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'login_form'])->name('login_form');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'register_form'])->name('register_form');

});
Route::middleware(['auth'])->group(function () {
    Route::get('/home')->name('home')->middleware('checkrole');
    Route::get('logout', [AuthController::class,'logout'])->name('logout');
    Route::post('change/password', [AuthController::class,'changePassword'])->name('change/password');
    Route::group(['prefix' => 'admin', 'middleware' => 'role:admin'], function () {
        Route::redirect('/home', '/admin/dashboard');
        Route::controller(UserController::class)->group(function(){
            Route::get('/users', 'index')->name('admin/users/list');
            Route::get('/user/edit/{$id}', '')->name('admin/user/edit/');
            Route::post('/user/delete', 'userDelete')->name('admin/user/delete');
            Route::get('get-users-data', 'getUsersData')->name('get-users-data');
        });
        Route::controller(PengajarController::class)->group(function(){
            Route::get('dashboard', 'index')->name('admin/dashboard');
            Route::get('profile','profile')->name('admin/profile');
            Route::post('profile/edit', 'edit')->name('admin/profile/edit');
            Route::post('profile/edit/tentang', 'update')->name('admin/profile/edit/tentang');
        });
        Route::controller(PengajarSiswaController::class)->group(function(){
            Route::get('siswa', 'index')->name('admin/siswa/list');
            Route::get('siswa/add', 'create')->name('admin/siswa/add');
            Route::post('siswa/add', 'store')->name('admin/siswa/add_form');
            Route::get('siswa/edit/{nisn}', 'edit')->name('admin/siswa/edit');
            Route::post('siswa/edit', 'update')->name('admin/siswa/edit_form');
            Route::get('siswa/show/{nisn}', 'show')->name('admin/siswa/show');
            Route::get('siswa/delete/{nisn}', 'destroy')->name('admin/siswa/delete');
        });
        Route::controller(JadwalMapelController::class)->group(function(){
            Route::get('jadwal', 'index')->name('admin/jadwal/list');
        });
    });
    Route::group(['prefix' => 'pengajar', 'middleware' => 'role:pengajar'], function () {
        Route::redirect('/home', '/pengajar/dashboard');
        Route::controller(PengajarController::class)->group(function(){
            Route::get('dashboard', 'index')->name('pengajar/dashboard');
            Route::get('profile','profile')->name('pengajar/profile');
            Route::post('profile/edit', 'edit')->name('pengajar/profile/edit');
            Route::post('profile/edit/tentang', 'update')->name('pengajar/profile/edit/tentang');
        });
        Route::controller(PengajarSiswaController::class)->group(function(){
            Route::get('siswa', 'index')->name('pengajar/siswa/list');
            Route::get('siswa/add', 'create')->name('pengajar/siswa/add');
            Route::post('siswa/add', 'store')->name('pengajar/siswa/add_form');
            Route::get('siswa/edit/{nisn}', 'edit')->name('pengajar/siswa/edit');
            Route::post('siswa/edit', 'update')->name('pengajar/siswa/edit_form');
            Route::get('siswa/show/{nisn}', 'show')->name('pengajar/siswa/show');
            Route::get('siswa/delete/{nisn}', 'destroy')->name('pengajar/siswa/delete');
        });
        Route::controller(JadwalMapelController::class)->group(function(){
            Route::get('jadwal', 'index')->name('pengajar/jadwal/list');
        });
    });
    Route::group(['prefix' => 'siswa', 'middleware' => 'role:siswa'], function () {
        Route::redirect('/home', '/siswa/dashboard');
        Route::controller(SiswaController::class)->group(function(){
            Route::get('dashboard','index')->name('siswa/dashboard');
            Route::get('profile', 'profile')->name('siswa/profile');
            Route::post('profile/edit', 'edit')->name('siswa/profile/edit');
            Route::post('profile/edit/tentang', 'update')->name('siswa/profile/edit/tentang');
        });
        Route::controller(MataPelajaranController::class)->group(function(){
            Route::get('mapel', 'index')->name('siswa/mapel/list');
        });
    });
    Route::get('setting/page', function () {

    })->name('setting/page');
});
