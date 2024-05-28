<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ebook;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Kuis;
use App\Models\MataPelajaran;
use App\Models\Materi;
use App\Models\Siswa;
use Illuminate\Http\Request;

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
