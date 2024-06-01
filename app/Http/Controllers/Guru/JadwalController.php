<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guru = Guru::where('user_id', Auth::id())->first();
        $mapel = MataPelajaran::where('guru_nuptk', $guru->nuptk)->first();
        $jadwals = Jadwal::where('mata_pelajaran_id', $mapel->id)
                    ->orderBy('hari')
                    ->orderBy('jam_mulai')
                    ->get();
        $groupedJadwals = $jadwals->groupBy('hari');
        return view('guru.jadwal', [
            'title' => 'Jadwal Mapel',
            'groupedJadwals' => $groupedJadwals,
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
