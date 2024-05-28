<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PertemuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pertemuan = DB::table('pertemuans')
        ->join('jadwals', 'pertemuans.jadwal_id', 'jadwals.id')
        ->join('materis', 'pertemuans.materi_id', 'materis.id')
        ->join('kelas', 'jadwals.kelas_id', 'kelas.id')
        ->join('jurusans', 'jadwals.jurusan_id', 'jurusans.id')
        ->join('mata_pelajarans', 'jadwals.mata_pelajaran_id', 'mata_pelajarans.id')
        ->join('gurus', 'mata_pelajarans.guru_nuptk', 'gurus.nuptk')
        ->select('pertemuans.*', 'gurus.nama as guru_nama', 'kelas.nama as kelas_nama', 'jurusans.nama as jurusan_nama', 'mata_pelajarans.nama as mapel_nama', 'materis.nama as materi_nama')->get();
        return view('siswa.pertemuan', [
            'title'=> 'List Pertemuan',
            'pertemuan'=> $pertemuan,
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
    public function show($id)
    {
        return view('siswa.pertemuan-view', [
            'title'=> 'Detail Pertemuan',
        ]);
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
