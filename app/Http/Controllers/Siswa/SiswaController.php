<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    public function index()
    {
        return view("siswa.dashboard", [
            'title' => 'Dashboard Siswa',
        ]);
    }

    public function profile()
    {
        $user = Auth::user();
        $siswa = Siswa::where('user_id', $user->id)->first();
        $jurusan = Jurusan::all();
        $kelas = Kelas::all();
        return view('siswa.profile', [
            'title' => 'Profile Siswa',
            'user' => $user,
            'siswa' => $siswa,
            'jurusans' => $jurusan,
            'kelass'=> $kelas,
        ]);
    }

    public function edit(Request $request)
    {

        DB::beginTransaction();
        try {
            if (!empty($request->foto)) {
                unlink(storage_path('app/public/foto-siswa/'.$request->image_hidden));
                $upload_file = rand() . '.' . $request->foto->extension();
                $request->foto->move(storage_path('app/public/foto-siswa/'), $upload_file);
            } else {
                $upload_file = $request->image_hidden;
            }
            $updateRecord = [
                'nama_siswa' => $request->nama_siswa,
                'kelas_id'=> $request->kelas,
                'jurusan_id'=> $request->jurusan,
                'agama'=> $request->agama,
                'tanggal_lahir'=> $request->tanggal_lahir,
                'tempat_lahir'=> $request->tempat_lahir,
                'jenis_kelamin'=> $request->jenis_kelamin,
                'alamat'=> $request->alamat,
                'foto'=> $upload_file,
            ];
            $siswa = Siswa::where('user_id', Auth::user()->id)->first();
            $siswa->update($updateRecord);
            $updateRe = [
                'username'=> $request->username,
                'email'=> $request->email,
            ];
            $user = User::where('id', Auth::user()->id)->first();
            $user->update($updateRe);
            Toastr::success('Personal Detail Telah berhasil diperbarui :)','Success');
            DB::commit();
            return redirect()->route('siswa/profile');
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Personal Detail gagal diperbarui','Error');
            return redirect()->back();
        }

    }

    public function update(Request $request)
    {

        DB::beginTransaction();
        try {
            $updateRecord = [
                'tentang' => $request->tentang,
            ];
            $siswa = Siswa::where('user_id', Auth::user()->id)->first();
            $siswa->update($updateRecord);
            Toastr::success('Tentang Saya telah berhasil diperbarui :)','Success');
            DB::commit();
            return redirect()->route('siswa/profile');
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Tentang Saya gagal diperbarui','Error');
            return redirect()->back();
        }

    }
}
