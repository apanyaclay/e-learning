<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Materi;
use App\Models\Pertemuan;
use App\Models\Post;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
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
        return view('admin.pertemuan.index', [
            'title' => 'List Pertemuan'
        ]);
    }

    public function getData(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $search_arr      = $request->get('search');

        $columnIndex     = $columnIndex_arr[0]['column'];
        $columnName      = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir'];
        $searchValue     = $search_arr['value'];

        $data =  DB::table('pertemuans')
                ->join('materis', 'pertemuans.materi_id', '=', 'materis.id')
                ->join('jadwals', 'pertemuans.jadwal_id', '=', 'jadwals.id')
                ->join('kelas', 'jadwals.kelas_id', '=', 'kelas.id')
                ->join('jurusans', 'jadwals.jurusan_id', '=', 'jurusans.id')
                ->join('e-books', 'materis.ebook_id', '=', 'e-books.id')
                ->join('mata_pelajarans', 'jadwals.mata_pelajaran_id', '=', 'mata_pelajarans.id')
                ->join('gurus', 'e-books.guru_nuptk', '=', 'gurus.nuptk')
                ->select('pertemuans.*', 'materis.nama as materi_nama', 'kelas.nama as kelas_nama', 'jurusans.nama as jurusan_nama', 'gurus.nama as guru_nama', 'mata_pelajarans.nama as mapel');
        $totalRecords = $data->count();

        $totalRecordsWithFilter = $data->where(function ($query) use ($searchValue) {
            $query->where('pertemuans.id', 'like', '%' . $searchValue . '%');
            $query->orWhere('pertemuans.pertemuan', 'like', '%' . $searchValue . '%');
            $query->orWhere('kelas.nama', 'like', '%' . $searchValue . '%');
            $query->orWhere('jurusans.nama', 'like', '%' . $searchValue . '%');
            $query->orWhere('materis.nama', 'like', '%' . $searchValue . '%');
        })->count();

        $records = $data->orderBy($columnName, $columnSortOrder)
            ->where(function ($query) use ($searchValue) {
            $query->where('pertemuans.id', 'like', '%' . $searchValue . '%');
            $query->orWhere('pertemuans.pertemuan', 'like', '%' . $searchValue . '%');
            $query->orWhere('kelas.nama', 'like', '%' . $searchValue . '%');
            $query->orWhere('jurusans.nama', 'like', '%' . $searchValue . '%');
            $query->orWhere('materis.nama', 'like', '%' . $searchValue . '%');
            })
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];

        foreach ($records as $record) {

            $modify = '
                <td class="text-end">
                    <div class="actions">
                    <a href="'.url('admin/pertemuan/view/'.$record->id).'" class="btn btn-sm bg-success-light me-2">
                            <i class="fe fe-eye"></i>
                        </a>
                        <a href="'.url('admin/pertemuan/edit/'.$record->id).'" class="btn btn-sm bg-danger-light">
                            <i class="far fa-edit me-2"></i>
                        </a>
                        <a class="btn btn-sm bg-danger-light delete data_id" data-bs-toggle="modal" data-id="'.$record->id.'" data-bs-target="#delete">
                        <i class="fe fe-trash-2"></i>
                        </a>
                    </div>
                </td>
            ';

            $data_arr [] = [
                "id"                => $record->id,
                "pertemuan"         => $record->pertemuan,
                "kelas"             => $record->kelas_nama.'-'.$record->jurusan_nama,
                "materi"            => $record->materi_nama,
                "guru"              => $record->guru_nama,
                "mapel"             => $record->mapel,
                "tanggal"           => Carbon::parse($record->tanggal)->format('d m Y'),
                "modify"            => $modify,
            ];
        }

        $response = [
            "draw"                 => intval($draw),
            "iTotalRecords"        => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordsWithFilter,
            "aaData"               => $data_arr
        ];
        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $materi = Materi::all();
        $jadwal = Jadwal::all();
        return view('admin.pertemuan.add', [
            'title' => 'Tambah Pertemuan',
            'materi'=> $materi,
            'jadwal'=> $jadwal
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pertemuan'=> 'required',
            'materi_id'=> 'required',
            'jadwal_id'=> 'required',
            'tanggal'=> 'required',
        ]);
        DB::beginTransaction();
        try {
            Pertemuan::create([
                'pertemuan'=> $request->pertemuan,
                'materi_id'=> $request->materi_id,
                'jadwal_id'=> $request->jadwal_id,
                'tanggal'=> $request->tanggal,
            ]);
            DB::commit();
            Toastr::success('Pertemuan berhasil ditambahkan :)','Success');
            return redirect()->route('admin/pertemuan');
        } catch (\Throwable $th) {
            DB::rollBack();
            Toastr::error('Pertemuan gagal ditambahkan :(', 'Error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pertemuan = Pertemuan::find($id);
        $materi = Materi::find($pertemuan->materi_id);
        $absensi = Absensi::where('pertemuan_id', $id)->get();
        $posts = Post::where('pertemuan_id', $id)->orderBy('created_at', 'desc')->get();
        return view('admin.pertemuan.view', [
            'title'=> 'Detail Pertemuan',
            'pertemuan'=> $pertemuan,
            'posts' => $posts,
            'absensi'=> $absensi,
            'materi'=> $materi
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
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->leftJoin('siswas', 'users.id', '=', 'siswas.user_id')
            ->leftJoin('gurus', 'users.id', '=', 'gurus.user_id')
            ->leftJoin('admins', 'users.id', '=', 'admins.user_id')
            ->where('posts.pertemuan_id', $pertemuan_id)
            ->select('posts.*', 'users.username as username', 'admins.foto as admin_foto', 'siswas.foto as siswa_foto', 'gurus.foto as guru_foto', 'users.role as user_type')
            ->get();
        return response()->json($posts);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $materi = Materi::all();
        $jadwal = Jadwal::all();
        $pertemuan = Pertemuan::findOrFail($id);
        return view('admin.pertemuan.edit', [
            'title' => 'Edit Pertemuan',
            'materi'=> $materi,
            'jadwal'=> $jadwal,
            'pertemuan'=> $pertemuan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $updateRecord = [
                'pertemuan'=> $request->pertemuan,
                'materi_id'=> $request->materi_id,
                'jadwal_id'=> $request->jadwal_id,
                'tanggal'=> $request->tanggal,
            ];
            Pertemuan::where('id', $request->id)->update($updateRecord);
            DB::commit();
            Toastr::success('Pertemuan berhasil diedit :)','Success');
            return redirect()->route('admin/pertemuan');
        } catch (\Throwable $th) {
            DB::rollBack();
            Toastr::error('Pertemuan gagal diedit :(', 'Error');
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            Pertemuan::destroy($request->id);
            DB::commit();
            Toastr::success('Pertemuan deleted successfully :)','Success');
            return redirect()->back();

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Pertemuan deleted fail :)','Error');
            return redirect()->back();
        }
    }
}
