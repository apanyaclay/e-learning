<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Jawaban;
use App\Models\Kuis;
use App\Models\Nilai;
use App\Models\Pertemuan;
use App\Models\Siswa;
use App\Models\Soal;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KuisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;
        $siswa = Siswa::where('user_id', $id)->first();
        $kuis = DB::table('kuis')
        ->join('gurus', 'kuis.guru_nuptk', '=', 'gurus.nuptk')
        ->join('pertemuans', 'kuis.pertemuan_id', '=', 'pertemuans.id')
        ->join('jadwals', 'pertemuans.jadwal_id', '=', 'jadwals.id')
        ->join('materis', 'pertemuans.materi_id', '=', 'materis.id')
        ->join('kelas', 'jadwals.kelas_id', '=', 'kelas.id')
        ->join('jurusans', 'jadwals.jurusan_id', '=', 'jurusans.id')
        ->join('mata_pelajarans', 'jadwals.mata_pelajaran_id', '=', 'mata_pelajarans.id')
        ->where('kelas.id', $siswa->kelas_id)
        ->where('jurusans.id', $siswa->jurusan_id)
        ->select('kuis.*', 'gurus.nama as guru_nama', 'mata_pelajarans.nama as mapel', 'pertemuans.pertemuan as pertemuan_nama', 'materis.nama as materi_nama')->get();
        return view('siswa.kuis', [
            'title' => 'List Kuis',
            'kuis' => $kuis,
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
        $kuis = Kuis::find($id);
        $soal = Soal::where('kuis_id', $kuis->id)->count();
        $siswa = Siswa::where('user_id', Auth::id());
        $nilai = Nilai::where('siswa_nisn', $siswa->nisn)->where('kuis_id', $id)->first();
        return view('siswa.kuis-kerjakan', [
            'title'=> 'Kerjakan Kuis',
            'kuis'=> $kuis,
            'soal'=> $soal,
            'nilai'=> $nilai
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function soal($id)
    {
        $kuis = Kuis::find($id);
        $siswa = Siswa::where('user_id', Auth::id());
        $jawabanUser = DB::table('jawabans')
                    ->join('soals', 'jawabans.soal_id', '=', 'soals.id')
                    ->join('kuis', 'soals.kuis_id', '=', 'kuis.id')
                    ->where('siswa_nisn', $siswa->nisn)
                    ->where('kuis_id', $kuis->id)
                    ->select('jawabans.*')->get();
        if (!$jawabanUser->isEmpty()) {
            Toastr::error('Anda sudah menjawab kuis ini.', 'error');
            return redirect()->route('siswa/kuis/kerjakan', $id);
        }
        if (empty($kuis->mulai)) {
            $updateRecord = [
                'id'=> $id,
                'mulai'=> now(),
                'tenggat' => $kuis->tenggat,
            ];
            Kuis::where('id', $id)->update($updateRecord);
        }
        $soal = Soal::where('kuis_id', $kuis->id)->get();
        return view('siswa.kuis-soal', [
            'title'=> 'Soal Kuis',
            'kuis'=> $kuis,
            'soal'=> $soal,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function submit(Request $request, $id)
    {
        $kuis = Kuis::findOrFail($id);
        $soal = Soal::where('kuis_id', $kuis->id)->get();

        foreach ($soal as $singleSoal) {
            $jawaban = new Jawaban();
            $jawaban->user_id = Auth::id();
            $jawaban->soal_id = $singleSoal->id;
            $jawaban->jawaban = $request->input('soal.' . $singleSoal->id);
            $jawaban->save();
        }
        Toastr::success('Jawaban berhasil disimpan!', 'success');
        return redirect()->route('siswa/kuis/hasil', $kuis->id);
    }
    public function hasil($id)
    {
        $kuis = Kuis::findOrFail($id);
        $siswa = Siswa::where('user_id', Auth::id());
        $jawaban = Jawaban::where('siswa_nisn', $siswa->nisn)->whereIn('soal_id', Soal::where('kuis_id', $id)->pluck('id'))->get();
        $totalNilai = 0;
        foreach ($jawaban as $jawab) {
            $soal = Soal::findOrFail($jawab->soal_id);
            $jawab->benar = $jawab->jawaban == $soal->opsi_benar;
            $nilai = $jawab->benar ? $jawab->soal->bobot : 0;
            $totalNilai += $nilai;
        }
        DB::beginTransaction();
        try {
            if (!empty(Nilai::where('siswa_nisn', $siswa->nisn)->where('kuis_id', $id)->first())) {
                DB::commit();
            } else {
                Nilai::create([
                    'siswa_nisn'=> $siswa->nisn,
                    'nilai' => $totalNilai,
                    'kuis_id' => $id,
                ]);
                DB::commit();
            }
        } catch (\Throwable $th) {
                DB::rollBack();
        }
        return view('siswa.kuis-hasil', [
            'title'=> 'Hasil Kuis',
            'kuis' => $kuis,
            'jawaban' => $jawaban,
            'totalNilai'=> $totalNilai
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
