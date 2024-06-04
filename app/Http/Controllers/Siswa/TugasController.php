<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\JawabanTugas;
use App\Models\NilaiTugas;
use App\Models\Siswa;
use App\Models\Tugas;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::where('user_id', Auth::id())->first();
        $tugas = DB::table('tugas')
            ->join('gurus', 'tugas.guru_nuptk', '=', 'gurus.nuptk')
            ->join('pertemuans', 'tugas.pertemuan_id', '=', 'pertemuans.id')
            ->join('jadwals', 'pertemuans.jadwal_id', '=', 'jadwals.id')
            ->join('materis', 'pertemuans.materi_id', '=', 'materis.id')
            ->join('kelas', 'jadwals.kelas_id', '=', 'kelas.id')
            ->join('jurusans', 'jadwals.jurusan_id', '=', 'jurusans.id')
            ->join('mata_pelajarans', 'jadwals.mata_pelajaran_id', '=', 'mata_pelajarans.id')
            ->where('kelas.id', $siswa->kelas_id)
            ->where('jurusans.id', $siswa->jurusan_id)
            ->select('tugas.*', 'gurus.nama as guru_nama', 'mata_pelajarans.nama as mapel', 'pertemuans.pertemuan as pertemuan_nama', 'materis.nama as materi_nama')->get();
        return view('siswa.tugas', [
            'title' => 'List Tugas',
            'tugas'=> $tugas
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
        $tugas = Tugas::find($id);
        $siswa = Siswa::where('user_id', Auth::id())->first();
        $jawaban = JawabanTugas::where(['tugas_id'=> $id, 'siswa_nisn'=> $siswa->nisn])->first();
        $nilai = NilaiTugas::where(['tugas_id'=> $id, 'siswa_nisn'=> $siswa->nisn])->first();
        return view('siswa.tugas-kerjakan', [
            'title'=> 'Kerjakan Tugas',
            'tugas'=> $tugas,
            'jawaban'=> $jawaban,
            'nilai'=> $nilai
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
    public function update(Request $request)
    {
        $request->validate([
            'jawaban'          => 'required',
        ]);
        DB::beginTransaction();
        try {
            if (!empty($request->jawaban)) {
                $siswa = Siswa::where('user_id', Auth::id())->first();
                $upload_file = rand() . '.' . $request->jawaban->extension();
                $request->jawaban->move(storage_path('app/public/tugas/'), $upload_file);
                JawabanTugas::create([
                    'tugas_id' => $request->id,
                    'siswa_nisn' => $siswa->nisn,
                    'jawaban'=> $upload_file,
                ]);
                DB::commit();
                Toastr::success('Jawaban berhasil dikirim','success');
                return redirect()->back();
            }
        } catch (\Exception $th) {
            DB::rollBack();
            Toastr::error('Jawaban gagal dikirim','error');
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
