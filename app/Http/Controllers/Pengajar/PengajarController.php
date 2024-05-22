<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Pengajar;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengajarController extends Controller
{
    public function index()
    {
        return view("pengajar.dashboard", [
            'title' => 'Dashboard Pengajar',
        ]);
    }

    public function profile()
    {
        $user = Auth::user();
        $pengajar = Pengajar::where('user_id', $user->id)->first();
        $matapelajarans = MataPelajaran::all();
        return view('pengajar.profile', [
            'title' => 'Profile Pengajar',
            'user' => $user,
            'pengajar' => $pengajar,
            'matapelajarans' => $matapelajarans,
        ]);
    }

    public function edit(Request $request)
    {

        DB::beginTransaction();
        try {
            if (!empty($request->foto)) {
                unlink(storage_path('app/public/foto-pengajar/'.$request->image_hidden));
                $upload_file = rand() . '.' . $request->foto->extension();
                $request->foto->move(storage_path('app/public/foto-pengajar/'), $upload_file);
            } else {
                $upload_file = $request->image_hidden;
            }
            $updateRecord = [
                'nama_pengajar' => $request->nama_pengajar,
                'mata_pelajaran_id'=> $request->mata_pelajaran,
                'agama'=> $request->agama,
                'tanggal_lahir'=> $request->tanggal_lahir,
                'tempat_lahir'=> $request->tempat_lahir,
                'jenis_kelamin'=> $request->jenis_kelamin,
                'no_hp'=> $request->no_hp,
                'alamat'=> $request->alamat,
                'foto'=> $upload_file,
            ];
            $pengajar = Pengajar::where('user_id', Auth::user()->id)->first();
            $pengajar->update($updateRecord);
            $updateRe = [
                'username'=> $request->username,
                'email'=> $request->email,
            ];
            $user = User::where('id', Auth::user()->id)->first();
            $user->update($updateRe);
            Toastr::success('Has been update successfully :)','Success');
            DB::commit();
            return redirect()->route('pengajar/profile');
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('fail, update student  :)','Error');
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
            $pengajar = Pengajar::where('user_id', Auth::user()->id)->first();
            $pengajar->update($updateRecord);
            Toastr::success('Has been update successfully :)','Success');
            DB::commit();
            return redirect()->route('pengajar/profile');
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('fail, update student  :)','Error');
            return redirect()->back();
        }

    }
}
