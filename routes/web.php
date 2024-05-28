<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EbookController;
use App\Http\Controllers\Admin\GuruController as AdminGuruController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\KuisController;
use App\Http\Controllers\Admin\MataPelajaranController;
use App\Http\Controllers\Admin\MateriController;
use App\Http\Controllers\Admin\PertemuanController;
use App\Http\Controllers\Admin\SiswaController as AdminSiswaController;
use App\Http\Controllers\Admin\SoalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Guru\GuruController;
use App\Http\Controllers\Siswa\SiswaController;
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
}

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
    Route::group(['prefix' => 'admin', 'middleware' => 'role:admin'], function(){
        Route::redirect('/', 'dashboard');
        Route::controller(AdminController::class)->group(function(){
            Route::get('/dashboard', 'index')->name('admin/dashboard');
            Route::get('/profile', 'profile')->name('admin/profile');
            Route::post('/profile/edit', 'edit')->name('admin/profile/edit');
            Route::post('/profile/edit/tentang', 'update')->name('admin/profile/edit/tentang');
        });
        Route::controller(AdminGuruController::class)->group(function(){
            Route::get('guru', 'index')->name('admin/guru');
            Route::get('guru/data', 'getData')->name('admin/guru/data');
            Route::get('guru/add', 'create')->name('admin/guru/add');
            Route::post('guru/add', 'store')->name('admin/guru/add_store');
            Route::get('guru/edit/{id}', 'edit')->name('admin/guru/edit');
            Route::post('guru/edit', 'update')->name('admin/guru/edit_update');
            Route::get('guru/profile/{id}', 'show')->name('admin/guru/profile');
            Route::post('guru/delete', 'destroy')->name('admin/guru/delete');
        });
        Route::controller(AdminSiswaController::class)->group(function(){
            Route::get('siswa', 'index')->name('admin/siswa');
            Route::get('siswa/data', 'getData')->name('admin/siswa/data');
            Route::get('siswa/add', 'create')->name('admin/siswa/add');
            Route::post('siswa/add', 'store')->name('admin/siswa/add_store');
            Route::get('siswa/edit/{id}', 'edit')->name('admin/siswa/edit');
            Route::post('siswa/edit', 'update')->name('admin/siswa/edit_update');
            Route::get('siswa/profile/{id}', 'show')->name('admin/siswa/profile');
            Route::post('siswa/delete', 'destroy')->name('admin/siswa/delete');
        });
        Route::controller(KelasController::class)->group(function(){
            Route::get('kelas', 'index')->name('admin/kelas');
            Route::get('kelas/data', 'getData')->name('admin/kelas/data');
            Route::get('kelas/add', 'create')->name('admin/kelas/add');
            Route::post('kelas/add', 'store')->name('admin/kelas/add_store');
            Route::get('kelas/edit/{id}', 'edit')->name('admin/kelas/edit');
            Route::post('kelas/edit', 'update')->name('admin/kelas/edit_update');
            Route::post('kelas/delete', 'destroy')->name('admin/kelas/delete');
        });
        Route::controller(JurusanController::class)->group(function(){
            Route::get('jurusan', 'index')->name('admin/jurusan');
            Route::get('jurusan/data', 'getData')->name('admin/jurusan/data');
            Route::get('jurusan/add', 'create')->name('admin/jurusan/add');
            Route::post('jurusan/add', 'store')->name('admin/jurusan/add_store');
            Route::get('jurusan/edit/{id}', 'edit')->name('admin/jurusan/edit');
            Route::post('jurusan/edit', 'update')->name('admin/jurusan/edit_update');
            Route::post('jurusan/delete', 'destroy')->name('admin/jurusan/delete');
        });
        Route::controller(MataPelajaranController::class)->group(function(){
            Route::get('mapel', 'index')->name('admin/mapel');
            Route::get('mapel/data', 'getData')->name('admin/mapel/data');
            Route::get('mapel/add', 'create')->name('admin/mapel/add');
            Route::post('mapel/add', 'store')->name('admin/mapel/add_store');
            Route::get('mapel/edit/{id}', 'edit')->name('admin/mapel/edit');
            Route::post('mapel/edit', 'update')->name('admin/mapel/edit_update');
            Route::post('mapel/delete', 'destroy')->name('admin/mapel/delete');
        });
        Route::controller(KuisController::class)->group(function(){
            Route::get('kuis', 'index')->name('admin/kuis');
            Route::get('kuis/data', 'getData')->name('admin/kuis/data');
            Route::get('kuis/add', 'create')->name('admin/kuis/add');
            Route::post('kuis/add', 'store')->name('admin/kuis/add_store');
            Route::get('kuis/edit/{id}', 'edit')->name('admin/kuis/edit');
            Route::post('kuis/edit', 'update')->name('admin/kuis/edit_update');
            // Route::get('kuis/view/{id}/soal', 'show')->name('admin/kuis/view');
            Route::post('kuis/delete', 'destroy')->name('admin/kuis/delete');
        });
        Route::controller(SoalController::class)->group(function(){
            Route::get('kuis/view/{id}/soal', 'index')->name('admin/soal');
            Route::get('soal/data', 'getData')->name('admin/soal/data');
            Route::get('kuis/view/{id}/soal/add', 'create')->name('admin/soal/add');
            Route::post('kuis/view/{id}/soal/add', 'store')->name('admin/soal/add_store');
            Route::get('kuis/view/{id}/soal/edit/{id}', 'edit')->name('admin/soal/edit');
            Route::post('kuis/view/{id}/soal/edit', 'update')->name('admin/soal/edit_update');
            Route::post('kuis/view/{id}/soal/delete', 'destroy')->name('admin/soal/delete');
        });
        Route::controller(MateriController::class)->group(function(){
            Route::get('materi', 'index')->name('admin/materi');
            Route::get('materi/data', 'getData')->name('admin/materi/data');
            Route::get('materi/add', 'create')->name('admin/materi/add');
            Route::post('materi/add', 'store')->name('admin/materi/add_store');
            Route::get('materi/edit/{id}', 'edit')->name('admin/materi/edit');
            Route::post('materi/edit', 'update')->name('admin/materi/edit_update');
            Route::get('materi/view/{id}', 'show')->name('admin/materi/view');
            Route::post('materi/delete', 'destroy')->name('admin/materi/delete');
        });
        Route::controller(EbookController::class)->group(function(){
            Route::get('ebook', 'index')->name('admin/ebook');
            Route::get('ebook/data', 'getData')->name('admin/ebook/data');
            Route::get('ebook/add', 'create')->name('admin/ebook/add');
            Route::post('ebook/add', 'store')->name('admin/ebook/add_store');
            Route::get('ebook/edit/{id}', 'edit')->name('admin/ebook/edit');
            Route::post('ebook/edit', 'update')->name('admin/ebook/edit_update');
            Route::get('ebook/view/{id}', 'show')->name('admin/ebook/view');
            Route::post('ebook/delete', 'destroy')->name('admin/ebook/delete');
        });
        Route::controller(PertemuanController::class)->group(function(){
            Route::get('pertemuan', 'index')->name('admin/pertemuan');
            Route::get('pertemuan/data', 'getData')->name('admin/pertemuan/data');
            Route::get('pertemuan/add', 'create')->name('admin/pertemuan/add');
            Route::post('pertemuan/add', 'store')->name('admin/pertemuan/add_store');
            Route::get('pertemuan/edit/{id}', 'edit')->name('admin/pertemuan/edit');
            Route::post('pertemuan/edit', 'update')->name('admin/pertemuan/edit_update');
            Route::get('pertemuan/view/{id}', 'show')->name('admin/pertemuan/view');
            Route::post('pertemuan/delete', 'destroy')->name('admin/pertemuan/delete');
        });

    });

    Route::group(['prefix' => 'guru', 'middleware' => 'role:guru'], function(){
        Route::redirect('/', 'guru/dashboard');
        Route::controller(GuruController::class)->group(function(){

        });
    });

    Route::group(['prefix' => 'siswa', 'middleware' => 'role:siswa'], function(){
        Route::redirect('/', 'siswa/dashboard');
        Route::controller(SiswaController::class)->group(function(){

        });
    });
});
