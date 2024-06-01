<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::where('user_id', Auth::id())->first();
        $jadwal = Jadwal::where('kelas_id', $siswa->kelas_id)
                ->where('jurusan_id', $siswa->jurusan_id)
                ->where('tahun_ajaran_id', '1')
                ->orderBy('hari')
                ->orderBy('jam_mulai')
                ->get();

        $jam = $jadwal->groupBy(function ($jadwal) {
            return $jadwal->jam_mulai . ' - ' . $jadwal->jam_selesai;
        });

        return view('siswa.jadwal', [
            'title' => 'Jadwal Mata Pelajaran',
            'jadwal' => $jadwal,
            'jam' => $jam,
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
    public function edit(string $id)
    {
        //
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
