<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kuis;
use App\Models\Pertemuan;
use App\Models\Soal;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KuisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("guru.kuis", [
            'title' => 'List Kuis',
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
        $guru = Guru::where('user_id', Auth::id())->first();
        $data =  DB::table('kuis')
                ->join('pertemuans', 'kuis.pertemuan_id', '=', 'pertemuans.id')
                ->join('gurus', 'kuis.guru_nuptk', '=', 'gurus.nuptk')
                ->join('jadwals', 'pertemuans.jadwal_id', '=', 'jadwals.id')
                ->join('kelas', 'jadwals.kelas_id', '=', 'kelas.id')
                ->join('jurusans', 'jadwals.jurusan_id', '=', 'jurusans.id')
                ->where('gurus.nuptk', $guru->nuptk)
                ->select('kuis.*', 'pertemuans.pertemuan as pertemuan', 'gurus.nama as guru_nama', 'kelas.nama as kelas_nama', 'jurusans.nama as jurusan_nama');
        $totalRecords = $data->count();

        $totalRecordsWithFilter = $data->where(function ($query) use ($searchValue) {
            $query->where('kuis.id', 'like', '%' . $searchValue . '%');
            $query->orWhere('kuis.nama', 'like', '%' . $searchValue . '%');
            $query->orWhere('kuis.tenggat', 'like', '%' . $searchValue . '%');
            $query->orWhere('kuis.durasi', 'like', '%' . $searchValue . '%');
            $query->orWhere('gurus.nama', 'like', '%' . $searchValue . '%');
        })->count();

        $records = $data->orderBy($columnName, $columnSortOrder)
            ->where(function ($query) use ($searchValue) {
            $query->where('kuis.id', 'like', '%' . $searchValue . '%');
            $query->orWhere('kuis.nama', 'like', '%' . $searchValue . '%');
            $query->orWhere('kuis.tenggat', 'like', '%' . $searchValue . '%');
            $query->orWhere('kuis.durasi', 'like', '%' . $searchValue . '%');
            $query->orWhere('gurus.nama', 'like', '%' . $searchValue . '%');
            })
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];

        foreach ($records as $record) {

            $modify = '
                <td class="text-end">
                    <div class="actions">
                        <a href="'.url('guru/kuis/view/'.$record->id).'/soal'.'" class="btn btn-sm bg-success-light me-2">
                            <i class="feather-eye"></i>
                        </a>
                        <a href="'.url('guru/kuis/edit/'.$record->id).'" class="btn btn-sm bg-danger-light">
                            <i class="far fa-edit me-2"></i>
                        </a>
                        <a class="btn btn-sm bg-danger-light delete data_id" data-bs-toggle="modal" data-id="'.$record->id.'" data-bs-target="#delete">
                        <i class="fe fe-trash-2"></i>
                        </a>
                    </div>
                </td>
            ';

            $data_arr [] = [
                "id"            => $record->id,
                "nama"          => $record->nama,
                "tenggat"       => $record->tenggat,
                "durasi"        => $record->durasi,
                "pertemuan"     => $record->pertemuan,
                "kelas"         => $record->kelas_nama,
                "jurusan"         => $record->jurusan_nama,
                "modify"        => $modify,
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
        $guru = Guru::where('user_id', Auth::id())->first();
        $pertemuan = DB::table('pertemuans')
            ->join('materis', 'pertemuans.materi_id', '=', 'materis.id')
            ->join('jadwals', 'pertemuans.jadwal_id', '=', 'jadwals.id')
            ->join('kelas', 'jadwals.kelas_id', '=', 'kelas.id')
            ->join('jurusans', 'jadwals.jurusan_id', '=', 'jurusans.id')
            ->join('e-books', 'materis.ebook_id', '=', 'e-books.id')
            ->join('gurus', 'e-books.guru_nuptk', '=', 'gurus.nuptk')
            ->where('gurus.nuptk', $guru->nuptk)
            ->select('pertemuans.*', 'materis.nama as materi_nama', 'kelas.nama as kelas_nama', 'jurusans.nama as jurusan_nama', 'gurus.nama as guru_nama')->get();
        return view('guru.kuis-add', [
            'title'=> 'Tambah Kuis',
            'pertemuan'=> $pertemuan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required',
            'tenggat'       => 'required',
            'durasi'        => 'required',
            'pertemuan_id'  => 'required',
        ]);
        DB::beginTransaction();
        try {
            $guru = Guru::where('user_id', Auth::id())->first();
            $kelas = Kuis::create([
                'nama'          => $request->nama,
                'tenggat'       => $request->tenggat,
                'durasi'        => $request->durasi,
                'pertemuan_id'  => $request->pertemuan_id,
                'guru_nuptk'    => $guru->nuptk,
            ]);
            $kelas->save();
            DB::commit();
            Toastr::success('Kuis berhasil ditambah', 'success');
            return redirect()->route('guru/kuis');
        } catch (\Exception $th) {
            DB::rollback();
            Toastr::error('Kuis gagal ditambah', 'error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $guru = Guru::where('user_id', Auth::id())->first();
        $pertemuan = DB::table('pertemuans')
            ->join('materis', 'pertemuans.materi_id', '=', 'materis.id')
            ->join('jadwals', 'pertemuans.jadwal_id', '=', 'jadwals.id')
            ->join('kelas', 'jadwals.kelas_id', '=', 'kelas.id')
            ->join('jurusans', 'jadwals.jurusan_id', '=', 'jurusans.id')
            ->join('e-books', 'materis.ebook_id', '=', 'e-books.id')
            ->join('gurus', 'e-books.guru_nuptk', '=', 'gurus.nuptk')
            ->where('gurus.nuptk', $guru->nuptk)
            ->select('pertemuans.*', 'materis.nama as materi_nama', 'kelas.nama as kelas_nama', 'jurusans.nama as jurusan_nama', 'gurus.nama as guru_nama')->get();
        $kuis = Kuis::find($id);
        return view('guru.kuis-edit', [
            'title'=> 'Edit Kuis',
            'guru'=> $guru,
            'pertemuan'=> $pertemuan,
            'kuis'=> $kuis
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $guru = Guru::where('user_id', Auth::id())->first();
            $kuis = Kuis::find($request->id);
            $kuis->nama = $request->nama;
            $kuis->tenggat = $request->tenggat;
            $kuis->durasi = $request->durasi;
            $kuis->guru_nuptk = $guru->nuptk;
            $kuis->pertemuan_id = $request->pertemuan_id;
            $kuis->save();
            DB::commit();
            Toastr::success('Kuis berhasil diubah','success');
            return redirect()->route('guru/kuis');
        } catch (\Exception $th) {
            DB::rollback();
            Toastr::error('Kuis gagal diubah','error');
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
            Kuis::destroy($request->id);
            DB::commit();
            Toastr::success('Kuis deleted successfully :)','Success');

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Kuis deleted fail :)','Error');
        }
        return redirect()->back();
    }
}
