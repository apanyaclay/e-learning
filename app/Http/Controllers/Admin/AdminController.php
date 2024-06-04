<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
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
use App\Models\Setting;
use App\Models\Siswa;
use App\Models\Tugas;
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
        $absensi = Absensi::all()->count();
        $tugas = Tugas::all()->count();

        return view("admin.dashboard", [
            'title' => 'Dashboard Admin',
            'siswa' => $siswa,
            'kelas' => $kelas,
            'jurusan' => $jurusan,
            'guru' => $guru,
            'mapel'=> $mapel,
            'kuis'=> $kuis,
            'materi'=> $materi,
            'ebook'=> $ebook,
            'pertemuan'=> $pertemuan,
            'jadwal'=> $jadwal,
            'absensi'=> $absensi,
            'tugas'=> $tugas,
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
    public function setting()
    {
        $settings = Setting::all()->keyBy('key');
        return view('admin.setting', [
            'title'=> 'Setting',
            'settings'=> $settings
        ]);
    }
    public function setting_update(Request $request)
    {
        $request->validate([
            'website_name' => 'required|string',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'image|mimes:png,ico|max:1024',
            // Add other validations as necessary
        ]);

        $settings = $request->only([
            'website_name',
            'logo',
            'favicon',
            // Add other settings keys here
        ]);

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('public/logo');
            Setting::updateOrCreate(['key' => 'logo'], ['value' => $logoPath]);
        }

        if ($request->hasFile('favicon')) {
            $faviconPath = $request->file('favicon')->store('public/favicon');
            Setting::updateOrCreate(['key' => 'favicon'], ['value' => $faviconPath]);
        }
        Toastr::success('Settings updated successfully!','success');
        return redirect()->back();
    }
}
