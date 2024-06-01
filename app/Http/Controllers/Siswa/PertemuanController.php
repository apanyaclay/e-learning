<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Pertemuan;
use App\Models\Post;
use App\Models\Siswa;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PertemuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::where('user_id', Auth::id())->first();
        $pertemuan = DB::table('pertemuans')
        ->join('jadwals', 'pertemuans.jadwal_id', 'jadwals.id')
        ->join('materis', 'pertemuans.materi_id', 'materis.id')
        ->join('kelas', 'jadwals.kelas_id', 'kelas.id')
        ->join('jurusans', 'jadwals.jurusan_id', 'jurusans.id')
        ->join('mata_pelajarans', 'jadwals.mata_pelajaran_id', 'mata_pelajarans.id')
        ->join('gurus', 'mata_pelajarans.guru_nuptk', 'gurus.nuptk')
        ->where('kelas.id', $siswa->kelas_id)
        ->where('jurusans.id', $siswa->jurusan_id)
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
        $pertemuan = Pertemuan::find($id);
        $absensi = Absensi::where('pertemuan_id', $id)->get();
        return view('siswa.pertemuan-view', [
            'title'=> 'Detail Pertemuan',
            'pertemuan'=> $pertemuan,
            'absensi'=> $absensi
        ]);
    }

    public function show_store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
            'pertemuan_id' => 'required|exists:pertemuans,id',
        ]);

        Post::create([
            'user_id' => Auth::id(),
            'pertemuan_id' => $request->pertemuan_id,
            'message' => $request->message,
        ]);
        Toastr::success('Message sent successfully!','success');
        return redirect()->back();
    }

    public function fetchPosts($pertemuan_id)
    {
        $posts = DB::table('posts')
            ->join('users','posts.user_id','=','users.id')
            ->where('posts.pertemuan_id', $pertemuan_id)
            ->select('posts.*', 'users.username as username')->get();
        // $posts = Post::where('pertemuan_id', $pertemuan_id)->get();
        return response()->json($posts);
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
