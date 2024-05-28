<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Ebook;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Kuis;
use App\Models\MataPelajaran;
use App\Models\Materi;
use App\Models\Pertemuan;
use App\Models\Siswa;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::all()->count();
        $kelas = Kelas::all()->count();
        $jurusan = Jurusan::all()->count();
        $guru = Guru::all()->count();
        $mapel = MataPelajaran::all()->count();
        $kuis = Kuis::all()->count();
        $materi = Materi::all()->count();
        $ebook = Ebook::all()->count();
        $pertemuan = Pertemuan::all()->count();
        $jadwal = Jadwal::all()->count();

        $boysData = [420, 532, 516, 575, 519, 517, 454, 392, 262, 383, 446, 551];
        $girlsData = [336, 612, 344, 647, 345, 563, 256, 344, 323, 300, 455, 456];
        $years = [2013, 2014, 2015, 2016, 2017, 2018, 2019, 2020, 2021, 2022, 2023, 2024];

        return view("admin.dashboard", [
            'title' => 'Dashboard Admin',
            'siswa' => $siswa,
            'kelas' => $kelas,
            'jurusan' => $jurusan,
            'guru' => $guru,
            'boysData' => $boysData,
            'girlsData' => $girlsData,
            'years' => $years,
            'mapel'=> $mapel,
            'kuis'=> $kuis,
            'materi'=> $materi,
            'ebook'=> $ebook,
            'pertemuan'=> $pertemuan,
            'jadwal'=> $jadwal,
        ]);
    }

    public function profile()
    {
        $user = Auth::user();
        $admin = Admin::where('user_id', $user->id)->first();
        return view('admin.profile', [
            'title' => 'Profile Admin',
            'user' => $user,
            'admin' => $admin,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        DB::beginTransaction();
        try {
            if (!empty($request->foto)) {
                // unlink(storage_path('app/public/foto/'.$request->image_hidden));
                $upload_file = rand() . '.' . $request->foto->extension();
                $request->foto->move(storage_path('app/public/foto/'), $upload_file);
            } else {
                $upload_file = $request->image_hidden;
            }
            $updateRecord = [
                'nama' => $request->nama,
                'agama'=> $request->agama,
                'tanggal_lahir'=> $request->tanggal_lahir,
                'tempat_lahir'=> $request->tempat_lahir,
                'jenis_kelamin'=> $request->jenis_kelamin,
                'no_hp'=> $request->no_hp,
                'alamat'=> $request->alamat,
                'foto'=> $upload_file,
            ];
            $admin = Admin::where('user_id', Auth::user()->id)->first();
            $admin->update($updateRecord);
            $updateRe = [
                'username'=> $request->username,
                'email'=> $request->email,
            ];
            $user = User::where('id', Auth::user()->id)->first();
            $user->update($updateRe);
            Toastr::success('Data Pengguna telah berhasil diperbarui :)','Success');
            DB::commit();
            return redirect()->route('admin/profile');
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Data Pengguna gagal diperbarui','Error');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $updateRecord = [
                'tentang' => $request->tentang,
            ];
            $admin = Admin::where('user_id', Auth::user()->id)->first();
            $admin->update($updateRecord);
            Toastr::success('Data Pengguna telah berhasil diperbarui :)','Success');
            DB::commit();
            return redirect()->route('admin/profile');
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Data Pengguna gagal diperbarui','Error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
