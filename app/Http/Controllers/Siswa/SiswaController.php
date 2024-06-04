<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Jurusan;
use App\Models\Kuis;
use App\Models\Pertemuan;
use App\Models\Siswa;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::where('user_id', Auth::id())->first();
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
        ->select('kuis.*', 'gurus.nama as guru_nama', 'mata_pelajarans.nama as mapel', 'pertemuans.pertemuan as pertemuan_nama', 'materis.nama as materi_nama')->get()->count();
        $jadwal = Jadwal::where('kelas_id', $siswa->kelas_id)
            ->where('jurusan_id', $siswa->jurusan_id)->get()->count();

        $mapel = Jadwal::where('kelas_id', $siswa->kelas_id)
        ->where('jurusan_id', $siswa->jurusan_id)->get()->groupBy('mata_pelajaran_id')->count();
        $kelas = Siswa::where('kelas_id', $siswa->kelas_id)->get()->count();
        $jurusan = Jurusan::all()->count();
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
            ->select('tugas.*', 'gurus.nama as guru_nama', 'mata_pelajarans.nama as mapel', 'pertemuans.pertemuan as pertemuan_nama', 'materis.nama as materi_nama')->get()->count();
        $pertemuan = DB::table('pertemuans')
            ->join('jadwals', 'pertemuans.jadwal_id', 'jadwals.id')
            ->join('materis', 'pertemuans.materi_id', 'materis.id')
            ->join('kelas', 'jadwals.kelas_id', 'kelas.id')
            ->join('jurusans', 'jadwals.jurusan_id', 'jurusans.id')
            ->join('mata_pelajarans', 'jadwals.mata_pelajaran_id', 'mata_pelajarans.id')
            ->join('gurus', 'mata_pelajarans.guru_nuptk', 'gurus.nuptk')
            ->where('kelas.id', $siswa->kelas_id)
            ->where('jurusans.id', $siswa->jurusan_id)
            ->select('pertemuans.*', 'gurus.nama as guru_nama', 'kelas.nama as kelas_nama', 'jurusans.nama as jurusan_nama', 'mata_pelajarans.nama as mapel_nama', 'materis.nama as materi_nama', 'jadwals.jam_mulai as jam_mulai', 'jadwals.jam_selesai as jam_selesai')->get();

        $hariIni = DB::table('pertemuans')
            ->join('jadwals', 'pertemuans.jadwal_id', 'jadwals.id')
            ->join('materis', 'pertemuans.materi_id', 'materis.id')
            ->join('kelas', 'jadwals.kelas_id', 'kelas.id')
            ->join('jurusans', 'jadwals.jurusan_id', 'jurusans.id')
            ->join('mata_pelajarans', 'jadwals.mata_pelajaran_id', 'mata_pelajarans.id')
            ->join('gurus', 'mata_pelajarans.guru_nuptk', 'gurus.nuptk')
            ->where('kelas.id', $siswa->kelas_id)
            ->where('jurusans.id', $siswa->jurusan_id)
            ->where('pertemuans.tanggal', Carbon::today())
            ->select('pertemuans.*', 'gurus.nama as guru_nama', 'kelas.nama as kelas_nama', 'jurusans.nama as jurusan_nama', 'mata_pelajarans.nama as mapel_nama', 'materis.nama as materi_nama', 'jadwals.jam_mulai as jam_mulai', 'jadwals.jam_selesai as jam_selesai')->get()->sortBy('jam_mulai');

        $besok = DB::table('pertemuans')
            ->join('jadwals', 'pertemuans.jadwal_id', 'jadwals.id')
            ->join('materis', 'pertemuans.materi_id', 'materis.id')
            ->join('kelas', 'jadwals.kelas_id', 'kelas.id')
            ->join('jurusans', 'jadwals.jurusan_id', 'jurusans.id')
            ->join('mata_pelajarans', 'jadwals.mata_pelajaran_id', 'mata_pelajarans.id')
            ->join('gurus', 'mata_pelajarans.guru_nuptk', 'gurus.nuptk')
            ->where('kelas.id', $siswa->kelas_id)
            ->where('jurusans.id', $siswa->jurusan_id)
            ->where('pertemuans.tanggal', Carbon::tomorrow())
            ->select('pertemuans.*', 'gurus.nama as guru_nama', 'kelas.nama as kelas_nama', 'jurusans.nama as jurusan_nama', 'mata_pelajarans.nama as mapel_nama', 'materis.nama as materi_nama', 'jadwals.jam_mulai as jam_mulai', 'jadwals.jam_selesai as jam_selesai')->get();

        $lusa = DB::table('pertemuans')
            ->join('jadwals', 'pertemuans.jadwal_id', 'jadwals.id')
            ->join('materis', 'pertemuans.materi_id', 'materis.id')
            ->join('kelas', 'jadwals.kelas_id', 'kelas.id')
            ->join('jurusans', 'jadwals.jurusan_id', 'jurusans.id')
            ->join('mata_pelajarans', 'jadwals.mata_pelajaran_id', 'mata_pelajarans.id')
            ->join('gurus', 'mata_pelajarans.guru_nuptk', 'gurus.nuptk')
            ->where('kelas.id', $siswa->kelas_id)
            ->where('jurusans.id', $siswa->jurusan_id)
            ->where('pertemuans.tanggal', Carbon::now()->addDays(2)->format('Y-m-d'))
            ->select('pertemuans.*', 'gurus.nama as guru_nama', 'kelas.nama as kelas_nama', 'jurusans.nama as jurusan_nama', 'mata_pelajarans.nama as mapel_nama', 'materis.nama as materi_nama', 'jadwals.jam_mulai as jam_mulai', 'jadwals.jam_selesai as jam_selesai')->get();
        $tanggalBesok = Carbon::tomorrow()->format('d M');
        $tanggalLusa = Carbon::now()->addDays(2)->format('d M');
        $absensi = Absensi::all()->keyBy(function ($item) {
            return $item['siswa_nisn'] . '-' . $item['pertemuan_id'];
        });
        $absen = Absensi::where('siswa_nisn', $siswa->nisn)->get()->count();


        $kusin = DB::table('kuis')
            ->join('gurus', 'kuis.guru_nuptk', '=', 'gurus.nuptk')
            ->join('pertemuans', 'kuis.pertemuan_id', '=', 'pertemuans.id')
            ->join('jadwals', 'pertemuans.jadwal_id', '=', 'jadwals.id')
            ->join('materis', 'pertemuans.materi_id', '=', 'materis.id')
            ->join('kelas', 'jadwals.kelas_id', '=', 'kelas.id')
            ->join('jurusans', 'jadwals.jurusan_id', '=', 'jurusans.id')
            ->join('mata_pelajarans', 'jadwals.mata_pelajaran_id', '=', 'mata_pelajarans.id')
            ->where('kelas.id', $siswa->kelas_id)
            ->where('jurusans.id', $siswa->jurusan_id)
            ->where('kuis.tenggat', '>=',Carbon::now())
            ->select('kuis.*', 'gurus.nama as guru_nama', 'mata_pelajarans.nama as mapel', 'pertemuans.pertemuan as pertemuan_nama', 'materis.nama as materi_nama')->get();

        $tugasin = DB::table('tugas')
            ->join('gurus', 'tugas.guru_nuptk', '=', 'gurus.nuptk')
            ->join('pertemuans', 'tugas.pertemuan_id', '=', 'pertemuans.id')
            ->join('jadwals', 'pertemuans.jadwal_id', '=', 'jadwals.id')
            ->join('materis', 'pertemuans.materi_id', '=', 'materis.id')
            ->join('kelas', 'jadwals.kelas_id', '=', 'kelas.id')
            ->join('jurusans', 'jadwals.jurusan_id', '=', 'jurusans.id')
            ->join('mata_pelajarans', 'jadwals.mata_pelajaran_id', '=', 'mata_pelajarans.id')
            ->where('kelas.id', $siswa->kelas_id)
            ->where('jurusans.id', $siswa->jurusan_id)
            ->where('tugas.tenggat', '>=',Carbon::now())
            ->select('tugas.*', 'gurus.nama as guru_nama', 'mata_pelajarans.nama as mapel', 'pertemuans.pertemuan as pertemuan_nama', 'materis.nama as materi_nama')->get();
        return view("siswa.dashboard", [
            'title' => 'Dashboard Siswa',
            'jadwal' => $jadwal,
            'kuis' => $kuis,
            'pertemuan' => $pertemuan,
            'datahariIni' => $hariIni,
            'besok' => $besok,
            'lusa' => $lusa,
            'siswa' => $siswa,
            'tanggalBesok' => $tanggalBesok,
            'tanggalLusa' => $tanggalLusa,
            'absensi'=> $absensi,
            'mapel' => $mapel,
            'kelas' => $kelas,
            'jurusan'=> $jurusan,
            'absen'=> $absen,
            'tugas'=> $tugas,
            'kusin'=> $kusin,
            'tugasin'=> $tugasin,
        ]);
    }

    public function profile()
    {
        $user = Auth::user();
        $siswa = Siswa::where('user_id', $user->id)->first();
        return view('siswa.profile', [
            'title' => 'Profile Siswa',
            'user' => $user,
            'siswa' => $siswa,
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
    public function edit(Request $request)
    {
        DB::beginTransaction();
        try {
            if (!empty($request->foto)) {
                // unlink(storage_path('app/public/foto/'.$request->image_hidden));
                $upload_file = rand() . '.' . $request->foto->extension();
                $request->foto->move(storage_path('app/public/foto/'), $upload_file);
            } else {
                $upload_file = $request->image_hidden;
            }
            $updateRecord = [
                'nama' => $request->nama,
                'agama'=> $request->agama,
                'tanggal_lahir'=> $request->tanggal_lahir,
                'tempat_lahir'=> $request->tempat_lahir,
                'jenis_kelamin'=> $request->jenis_kelamin,
                'no_hp'=> $request->no_hp,
                'alamat'=> $request->alamat,
                'foto'=> $upload_file,
            ];
            $guru = Siswa::where('user_id', Auth::user()->id)->first();
            $guru->update($updateRecord);
            $updateRe = [
                'username'=> $request->username,
                'email'=> $request->email,
            ];
            $user = User::where('id', Auth::user()->id)->first();
            $user->update($updateRe);
            Toastr::success('Data Pengguna telah berhasil diperbarui :)','Success');
            DB::commit();
            return redirect()->route('guru/profile');
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Data Pengguna gagal diperbarui','Error');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $updateRecord = [
                'tentang' => $request->tentang,
            ];
            $guru = Siswa::where('user_id', Auth::user()->id)->first();
            $guru->update($updateRecord);
            Toastr::success('Data Pengguna telah berhasil diperbarui :)','Success');
            DB::commit();
            return redirect()->route('guru/profile');
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Data Pengguna gagal diperbarui','Error');
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
