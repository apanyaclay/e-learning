<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guru = Guru::where('user_id', Auth::id())->first();
        $mapel = MataPelajaran::where('guru_nuptk', $guru->nuptk)->first();
        $jadwal = Jadwal::where('mata_pelajaran_id', $mapel->id)
                    ->get();
        $groupedJadwal = $jadwal->groupBy(['kelas_id', 'jurusan_id']);
        return view('guru.kelas' ,[
            'title' => 'kelas',
            'jadwal'=> $groupedJadwal,
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
    public function show($kelas, $jurusan)
    {
        $siswa = Siswa::where('kelas_id', $kelas)->where('jurusan_id', $jurusan)->get();
        $kelas = Kelas::find($kelas);
        $jurusan = Jurusan::find($jurusan);
        return view('guru.siswa',[
            'title'=> 'List Siswa',
            'siswa'=> $siswa,
            'kelas'=> $kelas,
            'jurusan'=> $jurusan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function profile($id)
    {
        $siswa = Siswa::find($id);
        $user = User::find($siswa->user_id);
        return view('guru.siswa-profile',[
            'title'=> 'Profile Siswa',
            'siswa' => $siswa,
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
