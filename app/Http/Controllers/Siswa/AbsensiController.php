<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Siswa;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::where('user_id', Auth::id())->first();
        $absensi = Absensi::where('siswa_nisn', $siswa->nisn)->get();
        return view('siswa.absensi', [
            'title' => 'Absensi',
            'absensi' => $absensi,
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
    public function edit($id, $nisn)
    {
        DB::beginTransaction();
        try {
            Absensi::updateOrCreate(['siswa_nisn' => $nisn, 'pertemuan_id' => $id],[
                'siswa_nisn' => $nisn,
                'pertemuan_id' => $id,
                'status' => 'Hadir',
            ]);
            DB::commit();
            Toastr::success('Anda berhasil melakukan absensi','success');
           return redirect()->back();
        } catch (\Exception $th) {
           DB::rollBack();
           Toastr::error('Anda gagal melakukan absensi','error');
           return redirect()->back();
        }

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
