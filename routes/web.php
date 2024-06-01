<?php

use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EbookController;
use App\Http\Controllers\Admin\GuruController as AdminGuruController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\KuisController;
use App\Http\Controllers\Admin\MataPelajaranController;
use App\Http\Controllers\Admin\MateriController;
use App\Http\Controllers\Admin\PertemuanController;
use App\Http\Controllers\Admin\SiswaController as AdminSiswaController;
use App\Http\Controllers\Admin\SoalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Guru\EBookController as GuruEBookController;
use App\Http\Controllers\Guru\GuruController;
use App\Http\Controllers\Guru\JadwalController as GuruJadwalController;
use App\Http\Controllers\Guru\KuisController as GuruKuisController;
use App\Http\Controllers\Guru\MateriController as GuruMateriController;
use App\Http\Controllers\Guru\PertemuanController as GuruPertemuanController;
use App\Http\Controllers\Guru\SiswaController as GuruSiswaController;
use App\Http\Controllers\Guru\SoalController as GuruSoalController;
use App\Http\Controllers\Siswa\AbsensiController as SiswaAbsensiController;
use App\Http\Controllers\Siswa\GuruController as SiswaGuruController;
use App\Http\Controllers\Siswa\JadwalController as SiswaJadwalController;
use App\Http\Controllers\Siswa\JurusanController as SiswaJurusanController;
use App\Http\Controllers\Siswa\KelasController as SiswaKelasController;
use App\Http\Controllers\Siswa\KuisController as SiswaKuisController;
use App\Http\Controllers\Siswa\MataPelajaranController as SiswaMataPelajaranController;
use App\Http\Controllers\Siswa\PertemuanController as SiswaPertemuanController;
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
            Route::get('kuis/view/{id}/soal/edit/{idk}', 'edit')->name('admin/soal/edit');
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
        Route::controller(JadwalController::class)->group(function(){
            Route::get('jadwal', 'index')->name('admin/jadwal');
            Route::get('jadwal/data', 'getData')->name('admin/jadwal/data');
            Route::get('jadwal/add', 'create')->name('admin/jadwal/add');
            Route::post('jadwal/add', 'store')->name('admin/jadwal/add_store');
            Route::get('jadwal/edit/{id}', 'edit')->name('admin/jadwal/edit');
            Route::post('jadwal/edit', 'update')->name('admin/jadwal/edit_update');
            Route::get('jadwal/profile/{id}', 'show')->name('admin/jadwal/profile');
            Route::post('jadwal/delete', 'destroy')->name('admin/jadwal/delete');
        });
        Route::controller(AbsensiController::class)->group(function(){
            Route::get('absensi', 'index')->name('admin/absensi');
            Route::get('absensi/data', 'getData')->name('admin/absensi/data');
            Route::get('absensi/add', 'create')->name('admin/absensi/add');
            Route::post('absensi/add', 'store')->name('admin/absensi/add_store');
            Route::get('absensi/edit/{id}', 'edit')->name('admin/absensi/edit');
            Route::post('absensi/edit', 'update')->name('admin/absensi/edit_update');
            Route::get('absensi/profile/{id}', 'show')->name('admin/absensi/profile');
            Route::post('absensi/delete', 'destroy')->name('admin/absensi/delete');
        });
    });

    Route::group(['prefix' => 'guru', 'middleware' => 'role:guru'], function(){
        Route::redirect('/', 'guru/dashboard');
        Route::controller(GuruController::class)->group(function(){
            Route::get('dashboard','index')->name('guru/dashboard');
            Route::get('profile','profile')->name('guru/profile');
            Route::post('/profile/edit', 'edit')->name('guru/profile/edit');
            Route::post('/profile/edit/tentang', 'update')->name('guru/profile/edit/tentang');
        });
        Route::controller(GuruJadwalController::class)->group(function(){
            Route::get('jadwal', 'index')->name('guru/jadwal');
        });
        Route::controller(GuruSiswaController::class)->group(function(){
            Route::get('kelas', 'index')->name('guru/kelas');
            Route::get('kelas/{kelas}/{jurusan}', 'show')->name('guru/siswa');
            Route::get('siswa/profile/{id}', 'profile')->name('guru/siswa/profile');
        });
        Route::controller(GuruMateriController::class)->group(function(){
            Route::get('materi', 'index')->name('guru/materi');
            Route::get('materi/data', 'getData')->name('guru/materi/data');
            Route::get('materi/add', 'create')->name('guru/materi/add');
            Route::post('materi/add', 'store')->name('guru/materi/add_store');
            Route::get('materi/edit/{id}', 'edit')->name('guru/materi/edit');
            Route::post('materi/edit', 'update')->name('guru/materi/edit_update');
            Route::get('materi/view/{id}', 'show')->name('guru/materi/view');
            Route::post('materi/delete', 'destroy')->name('guru/materi/delete');
        });
        Route::controller(GuruEBookController::class)->group(function(){
            Route::get('ebook', 'index')->name('guru/ebook');
            Route::get('ebook/data', 'getData')->name('guru/ebook/data');
            Route::get('ebook/add', 'create')->name('guru/ebook/add');
            Route::post('ebook/add', 'store')->name('guru/ebook/add_store');
            Route::get('ebook/edit/{id}', 'edit')->name('guru/ebook/edit');
            Route::post('ebook/edit', 'update')->name('guru/ebook/edit_update');
            Route::get('ebook/view/{id}', 'show')->name('guru/ebook/view');
            Route::post('ebook/delete', 'destroy')->name('guru/ebook/delete');
        });
        Route::controller(GuruKuisController::class)->group(function(){
            Route::get('kuis', 'index')->name('guru/kuis');
            Route::get('kuis/data', 'getData')->name('guru/kuis/data');
            Route::get('kuis/add', 'create')->name('guru/kuis/add');
            Route::post('kuis/add', 'store')->name('guru/kuis/add_store');
            Route::get('kuis/edit/{id}', 'edit')->name('guru/kuis/edit');
            Route::post('kuis/edit', 'update')->name('guru/kuis/edit_update');
            // Route::get('kuis/view/{id}/soal', 'show')->name('guru/kuis/view');
            Route::post('kuis/delete', 'destroy')->name('guru/kuis/delete');
        });
        Route::controller(GuruSoalController::class)->group(function(){
            Route::get('kuis/view/{id}/soal', 'index')->name('guru/soal');
            Route::get('soal/data', 'getData')->name('guru/soal/data');
            Route::get('kuis/view/{id}/soal/add', 'create')->name('guru/soal/add');
            Route::post('kuis/view/{id}/soal/add', 'store')->name('guru/soal/add_store');
            Route::get('kuis/view/{id}/soal/edit/{idk}', 'edit')->name('guru/soal/edit');
            Route::post('kuis/view/{id}/soal/edit', 'update')->name('guru/soal/edit_update');
            Route::post('kuis/view/{id}/soal/delete', 'destroy')->name('guru/soal/delete');
            Route::get('kuis/view/{id}/hasil/{nisn}', 'show')->name('guru/kuis/view/hasil');
        });
        Route::controller(GuruPertemuanController::class)->group(function(){
            Route::get('pertemuan', 'index')->name('guru/pertemuan');
            Route::get('pertemuan/data', 'getData')->name('guru/pertemuan/data');
            Route::get('pertemuan/add', 'create')->name('guru/pertemuan/add');
            Route::post('pertemuan/add', 'store')->name('guru/pertemuan/add_store');
            Route::get('pertemuan/edit/{id}', 'edit')->name('guru/pertemuan/edit');
            Route::post('pertemuan/edit', 'update')->name('guru/pertemuan/edit_update');
            Route::get('pertemuan/view/{id}', 'show')->name('guru/pertemuan/view');
            Route::post('pertemuan/view', 'show_store')->name('guru/pertemuan/view_store');
            Route::get('/pertemuan/{id}/posts', 'fetchPosts')->name('guru/pertemuan/fetchPosts');
            Route::post('pertemuan/delete', 'destroy')->name('guru/pertemuan/delete');
            Route::post('absensi/update', 'absen')->name('guru/absensi/update');
        });
    });

    Route::group(['prefix' => 'siswa', 'middleware' => 'role:siswa'], function(){
        Route::redirect('/', 'siswa/dashboard');
        Route::controller(SiswaController::class)->group(function(){
            Route::get('dashboard','index')->name('siswa/dashboard');
            Route::get('profile','profile')->name('siswa/profile');
            Route::post('/profile/edit', 'edit')->name('siswa/profile/edit');
            Route::post('/profile/edit/tentang', 'update')->name('siswa/profile/edit/tentang');
        });
        Route::controller(SiswaKelasController::class)->group(function(){
            Route::get('kelas', 'index')->name('siswa/kelas');
            Route::get('siswa/profile/{id}', 'show')->name('siswa/siswa/profile');
        });
        Route::controller(SiswaGuruController::class)->group(function(){
            Route::get('guru', 'index')->name('siswa/guru');
            Route::get('guru/data', 'getData')->name('siswa/guru/data');
            Route::get('guru/profile/{id}', 'show')->name('siswa/guru/profile');
        });
        Route::controller(SiswaJurusanController::class)->group(function(){
            Route::get('jurusan', 'index')->name('siswa/jurusan');
            Route::get('jurusan/data', 'getData')->name('siswa/jurusan/data');
        });
        Route::controller(SiswaKuisController::class)->group(function(){
            Route::get('kuis', 'index')->name('siswa/kuis');
            Route::get('kuis/kerjakan/{id}', 'show')->name('siswa/kuis/kerjakan');
            Route::get('kuis/kerjakan/{id}/soal', 'soal')->name('siswa/kuis/kerjakan/soal');
            Route::post('kuis/kerjakan/submit/{id}', 'submit')->name('siswa/kuis/kerjakan/submit');
            Route::get('kuis/hasil/{id}', 'hasil')->name('siswa/kuis/hasil');
        });
        Route::controller(SiswaMataPelajaranController::class)->group(function(){
            Route::get('mapel', 'index')->name('siswa/mapel');
            Route::get('mapel/data', 'getData')->name('siswa/mapel/data');
        });
        Route::controller(SiswaPertemuanController::class)->group(function(){
            Route::get('pertemuan', 'index')->name('siswa/pertemuan');
            Route::get('pertemuan/data', 'getData')->name('siswa/pertemuan/data');
            Route::get('pertemuan/view/{id}', 'show')->name('siswa/pertemuan/view');
            Route::post('pertemuan/view', 'show_store')->name('siswa/pertemuan/view_store');
            Route::get('pertemuan/{id}/posts', 'fetchPosts')->name('siswa/pertemuan/fetchPosts');
        });
        Route::controller(SiswaJadwalController::class)->group(function(){
            Route::get('jadwal', 'index')->name('siswa/jadwal');
            Route::get('jadwal/data', 'getData')->name('siswa/jadwal/data');
        });
        Route::controller(SiswaAbsensiController::class)->group(function(){
            Route::get('absensi', 'index')->name('siswa/absensi');
            Route::get('absensi/data', 'getData')->name('siswa/absensi/data');
        });
    });
});
