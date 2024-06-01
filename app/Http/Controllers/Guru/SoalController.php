<?php

namespace App\Http\Controllers\Guru;

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
use Illuminate\Support\Facades\DB;

class SoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $soal = Soal::where('kuis_id', $id)->get()->toArray();
        $totalBobot = Soal::where('kuis_id', $id)->sum('bobot');
        $kuis = Kuis::find($id);
        $pertemuan = Pertemuan::find($kuis->pertemuan_id);
        $jadwal = Jadwal::find($pertemuan->jadwal_id);
        $siswa = Siswa::where('kelas_id', $jadwal->kelas_id)->where('jurusan_id', $jadwal->jurusan_id)->get();
        $nilai = Nilai::where('kuis_id', $id)->get()->keyBy('siswa_nisn');
        $jumlahSudahMengerjakan = $nilai->count();
        return view('guru.soal', [
            'title'=> 'Lihat Kuis',
            'soal'=> $soal,
            'bobot'=> $totalBobot,
            'id' => $id,
            'siswa'=> $siswa,
            'nilai'=> $nilai,
            'jumlahSudahMengerjakan' => $jumlahSudahMengerjakan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        return view('guru.soal-add', [
            'title'=> 'Tambah Soal',
            'id' => $id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'pertanyaan'=> 'required',
            'pilihanA'=> 'required',
            'pilihanB'=> 'required',
            'kunciJawaban'=> 'required',
        ]);
        DB::beginTransaction();
        try {
            if (!empty($request->fileInput)) {
                $upload_file = rand() . '.' . $request->fileInput->extension();
                $request->fileInput->move(storage_path('app/public/soal/'), $upload_file);
                Soal::create([
                    'kuis_id' => $id,
                    'pertanyaan'=> $request->pertanyaan,
                    'opsi_a'=> $request->pilihanA,
                    'opsi_b'=> $request->pilihanB,
                    'opsi_c'=> $request->pilihanC,
                    'opsi_d'=> $request->pilihanD,
                    'opsi_e'=> $request->pilihanE,
                    'opsi_benar'=> $request->kunciJawaban,
                    'bobot'=> $request->bobot,
                    'foto'=> $upload_file,
                ]);
                Toastr::success('Soal berhasil ditambahkan :)','Success');
                DB::commit();
                return redirect()->route('guru/soal',['id' => $id]);
            } else {
                Soal::create([
                    'kuis_id' => $id,
                    'pertanyaan'=> $request->pertanyaan,
                    'opsi_a'=> $request->pilihanA,
                    'opsi_b'=> $request->pilihanB,
                    'opsi_c'=> $request->pilihanC,
                    'opsi_d'=> $request->pilihanD,
                    'opsi_e'=> $request->pilihanE,
                    'opsi_benar'=> $request->kunciJawaban,
                    'bobot'=> $request->bobot,
                ]);
                Toastr::success('Soal berhasil ditambahkan :)','Success');
                DB::commit();
                return redirect()->route('guru/soal',['id' => $id]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            Toastr::error('Soal gagal ditambahkan','Error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id, $nisn)
    {
        $kuis = Kuis::findOrFail($id);
        $siswa = Siswa::where('user_id', $nisn)->first();
        $jawaban = Jawaban::where('siswa_nisn', $nisn)->whereIn('soal_id', Soal::where('kuis_id', $id)->pluck('id'))->get();
        foreach ($jawaban as $jawab) {
            $soal = Soal::findOrFail($jawab->soal_id);
            $jawab->benar = $jawab->jawaban == $soal->opsi_benar;
            $nilai = $jawab->benar ? $jawab->soal->bobot : 0;
        }
        $nilai = Nilai::where('kuis_id', $id)->where('siswa_nisn', $nisn)->firstOrFail();
        return view('guru.kuis-hasil', [
            'title'=> 'Hasil Kuis',
            'kuis' => $kuis,
            'jawaban' => $jawaban,
            'totalNilai'=> $nilai->nilai
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, $idk)
    {
        $soal = Soal::where('kuis_id', $id)->where('id', $idk)->firstOrFail();
        return view('guru.soal-edit', [
            'title' => 'Edit Soal',
            'soal'=> $soal,
            'id'=> $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $soal = Soal::findOrFail($request->id);
        $request->validate([
            'pertanyaan'=> 'required',
            'pilihanA'=> 'required',
            'pilihanB'=> 'required',
            'pilihanC'=> 'nullable',
            'pilihanD'=> 'nullable',
            'pilihanE'=> 'nullable',
            'kunciJawaban'=> 'required',
            'bobot'=> 'required',
        ]);
        if (empty($request->pilihanC) && $request->kunciJawaban == 'C' || empty($request->pilihanC) && $request->kunciJawaban == 'D' || empty($request->pilihanC) && $request->kunciJawaban == 'E') {
            return back()->withErrors(['kunciJawaban' => 'Tidak bisa memilih Kunci Jawaban C, D atau E']);
        }
        if (empty($request->pilihanD) && $request->kunciJawaban == 'D' || empty($request->pilihanD) && $request->kunciJawaban == 'E') {
            return back()->withErrors(['kunciJawaban' => 'Tidak bisa memilih Kunci Jawaban D atau E']);
        }
        if (empty($request->pilihanE) && $request->kunciJawaban == 'E' ) {
            return back()->withErrors(['kunciJawaban' => 'Tidak bisa memilih Kunci Jawaban E']);
        }
        DB::beginTransaction();
        try {
            if (!empty($request->fileInput)) {
                $upload_file = rand() . '.' . $request->fileInput->extension();
                $request->fileInput->move(storage_path('app/public/soal/'), $upload_file);
                $updateRecord = [
                    'pertanyaan'=> $request->pertanyaan,
                    'opsi_a'=> $request->pilihanA,
                    'opsi_b'=> $request->pilihanB,
                    'opsi_c'=> $request->pilihanC,
                    'opsi_d'=> $request->pilihanD,
                    'opsi_e'=> $request->pilihanE,
                    'opsi_benar'=> $request->kunciJawaban,
                    'foto'=> $upload_file,
                    'bobot'=> $request->bobot,
                ];
                Soal::where('id', $request->id)->update($updateRecord);
            } else {
                $updateRecord = [
                    'pertanyaan'=> $request->pertanyaan,
                    'opsi_a'=> $request->pilihanA,
                    'opsi_b'=> $request->pilihanB,
                    'opsi_c'=> $request->pilihanC,
                    'opsi_d'=> $request->pilihanD,
                    'opsi_e'=> $request->pilihanE,
                    'foto'=> $request->fileInput_hidden,
                    'opsi_benar'=> $request->kunciJawaban,
                    'bobot'=> $request->bobot,
                ];
                Soal::where('id', $request->id)->update($updateRecord);
            }
            Toastr::success('Soal berhasil diedit :)','Success');
            DB::commit();
            return redirect()->route('guru/soal',['id' => $id]);
        } catch (\Exception $th) {
            DB::rollBack();
            Toastr::error('Soal gagal diedit','Error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            Soal::destroy($request->id);
            DB::commit();
            Toastr::success('Soal deleted successfully :)','Success');

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Soal deleted fail :)','Error');
        }
        return redirect()->back();
    }
}
