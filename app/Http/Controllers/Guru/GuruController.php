<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::where('user_id', Auth::id())->first();
        $pertemuan =  DB::table('pertemuans')
                ->join('materis', 'pertemuans.materi_id', '=', 'materis.id')
                ->join('jadwals', 'pertemuans.jadwal_id', '=', 'jadwals.id')
                ->join('kelas', 'jadwals.kelas_id', '=', 'kelas.id')
                ->join('jurusans', 'jadwals.jurusan_id', '=', 'jurusans.id')
                ->join('e-books', 'materis.ebook_id', '=', 'e-books.id')
                ->join('gurus', 'e-books.guru_nuptk', '=', 'gurus.nuptk')
                ->where('gurus.nuptk', $guru->nuptk)
                ->select('pertemuans.*', 'gurus.nama as guru_nama', 'kelas.nama as kelas_nama', 'jurusans.nama as jurusan_nama', 'materis.nama as materi_nama', 'jadwals.jam_mulai as jam_mulai', 'jadwals.jam_selesai as jam_selesai')->get();
        $besok = DB::table('pertemuans')
                ->join('materis', 'pertemuans.materi_id', '=', 'materis.id')
                ->join('jadwals', 'pertemuans.jadwal_id', '=', 'jadwals.id')
                ->join('kelas', 'jadwals.kelas_id', '=', 'kelas.id')
                ->join('jurusans', 'jadwals.jurusan_id', '=', 'jurusans.id')
                ->join('e-books', 'materis.ebook_id', '=', 'e-books.id')
                ->join('gurus', 'e-books.guru_nuptk', '=', 'gurus.nuptk')
                ->where('gurus.nuptk', $guru->nuptk)
                ->where('pertemuans.tanggal', Carbon::tomorrow())
                ->select('pertemuans.*', 'gurus.nama as guru_nama', 'kelas.nama as kelas_nama', 'jurusans.nama as jurusan_nama', 'materis.nama as materi_nama', 'jadwals.jam_mulai as jam_mulai', 'jadwals.jam_selesai as jam_selesai')->get();

        $lusa = DB::table('pertemuans')
            ->join('jadwals', 'pertemuans.jadwal_id', 'jadwals.id')
            ->join('materis', 'pertemuans.materi_id', 'materis.id')
            ->join('kelas', 'jadwals.kelas_id', 'kelas.id')
            ->join('jurusans', 'jadwals.jurusan_id', 'jurusans.id')
            ->join('mata_pelajarans', 'jadwals.mata_pelajaran_id', 'mata_pelajarans.id')
            ->join('gurus', 'mata_pelajarans.guru_nuptk', 'gurus.nuptk')
            ->where('gurus.nuptk', $guru->nuptk)
            ->where('pertemuans.tanggal', Carbon::now()->addDays(2)->format('Y-m-d'))
            ->select('pertemuans.*', 'gurus.nama as guru_nama', 'kelas.nama as kelas_nama', 'jurusans.nama as jurusan_nama', 'materis.nama as materi_nama', 'jadwals.jam_mulai as jam_mulai', 'jadwals.jam_selesai as jam_selesai')->get();
        $tanggalBesok = Carbon::tomorrow()->format('d M');
        $tanggalLusa = Carbon::now()->addDays(2)->format('d M');

        $mapel = MataPelajaran::where('guru_nuptk', $guru->nuptk)->first();
        $jadwal = Jadwal::where('mata_pelajaran_id', $mapel->id)
                    ->get()->groupBy(['kelas_id', 'jurusan_id']);
        $kelas_id = [];
        $jurusan_id = [];

        foreach ($jadwal as $kelas => $jurusans) {
            $kelas_id[] = $kelas;
            foreach ($jurusans as $jurusan => $jadwals) {
                $jurusan_id[] = $jurusan;
            }
        }

        $kelas_id = array_unique($kelas_id);
        $jurusan_id = array_unique($jurusan_id);

        $siswa = Siswa::whereIn('kelas_id', $kelas_id)->whereIn('jurusan_id', $jurusan_id)->get();

        $mapel = MataPelajaran::where('guru_nuptk', $guru->nuptk)->first();
        $jadwals = Jadwal::where('mata_pelajaran_id', $mapel->id)
                    ->orderBy('hari')
                    ->orderBy('jam_mulai')
                    ->get();

        $materi = DB::table('materis')
                ->join('e-books', 'materis.ebook_id', '=', 'e-books.id')
                ->where('e-books.guru_nuptk', $guru->nuptk)
                ->select('materis.*', 'e-books.file as file', 'e-books.judul as judul')->get();

        $ebook = DB::table('e-books')
                ->join('gurus', 'e-books.guru_nuptk', '=', 'gurus.nuptk')
                ->where('gurus.nuptk', $guru->nuptk)
                ->select('e-books.*', 'gurus.nama as guru_nama')->get();

        $kuis = DB::table('kuis')
            ->join('pertemuans', 'kuis.pertemuan_id', '=', 'pertemuans.id')
            ->join('gurus', 'kuis.guru_nuptk', '=', 'gurus.nuptk')
            ->join('jadwals', 'pertemuans.jadwal_id', '=', 'jadwals.id')
            ->join('kelas', 'jadwals.kelas_id', '=', 'kelas.id')
            ->join('jurusans', 'jadwals.jurusan_id', '=', 'jurusans.id')
            ->where('gurus.nuptk', $guru->nuptk)
            ->select('kuis.*', 'pertemuans.pertemuan as pertemuan', 'gurus.nama as guru_nama', 'kelas.nama as kelas_nama', 'jurusans.nama as jurusan_nama')->get();

        $tugas =  DB::table('tugas')
            ->join('pertemuans', 'tugas.pertemuan_id', '=', 'pertemuans.id')
            ->join('gurus', 'tugas.guru_nuptk', '=', 'gurus.nuptk')
            ->join('jadwals', 'pertemuans.jadwal_id', '=', 'jadwals.id')
            ->join('kelas', 'jadwals.kelas_id', '=', 'kelas.id')
            ->join('jurusans', 'jadwals.jurusan_id', '=', 'jurusans.id')
            ->join('mata_pelajarans', 'jadwals.mata_pelajaran_id', '=', 'mata_pelajarans.id')
            ->where('gurus.nuptk', $guru->nuptk)
            ->select('tugas.*', 'pertemuans.pertemuan as pertemuan', 'gurus.nama as guru_nama', 'kelas.nama as kelas_nama', 'jurusans.nama as jurusan_nama', 'mata_pelajarans.nama as mapel')->get();

        $hariini = DB::table('pertemuans')
            ->join('materis', 'pertemuans.materi_id', '=', 'materis.id')
            ->join('jadwals', 'pertemuans.jadwal_id', '=', 'jadwals.id')
            ->join('kelas', 'jadwals.kelas_id', '=', 'kelas.id')
            ->join('jurusans', 'jadwals.jurusan_id', '=', 'jurusans.id')
            ->join('e-books', 'materis.ebook_id', '=', 'e-books.id')
            ->join('gurus', 'e-books.guru_nuptk', '=', 'gurus.nuptk')
            ->where('gurus.nuptk', $guru->nuptk)
            ->where('pertemuans.tanggal', Carbon::today())
            ->select('pertemuans.*', 'gurus.nama as guru_nama', 'kelas.nama as kelas_nama', 'jurusans.nama as jurusan_nama', 'materis.nama as materi_nama', 'jadwals.jam_mulai as jam_mulai', 'jadwals.jam_selesai as jam_selesai')->get();
        return view("guru.dashboard", [
            'title' => 'Dashboard Guru',
            'besok' => $besok,
            'lusa' => $lusa,
            'tanggalBesok'=> $tanggalBesok,
            'tanggalLusa'=> $tanggalLusa,
            'pertemuan'=> $pertemuan,
            'siswa'=> $siswa,
            'jadwal'=> $jadwal,
            'jadwals'=> $jadwals,
            'materi'=> $materi,
            'ebook'=> $ebook,
            'kuis'=> $kuis,
            'tugas'=> $tugas,
            'hariini'=> $hariini,
        ]);
    }

    public function profile()
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();
        return view('guru.profile', [
            'title' => 'Profile Guru',
            'user' => $user,
            'guru' => $guru,
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
            $guru = Guru::where('user_id', Auth::user()->id)->first();
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
            $guru = Guru::where('user_id', Auth::user()->id)->first();
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
