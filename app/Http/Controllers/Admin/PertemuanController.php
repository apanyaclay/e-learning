<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Materi;
use App\Models\Pertemuan;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
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
                ->join('gurus', 'e-books.guru_nuptk', '=', 'gurus.nuptk')
                ->select('pertemuans.*', 'materis.nama as materi_nama', 'kelas.nama as kelas_nama', 'jurusans.nama as jurusan_nama', 'gurus.nama as guru_nama');
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
                "kelas"             => $record->kelas_nama,
                "jurusan"           => $record->jurusan_nama,
                "materi"            => $record->materi_nama,
                "guru"              => $record->guru_nama,
                "created_at"        => $record->created_at,
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
        ]);
        DB::beginTransaction();
        try {
            Pertemuan::create([
                'pertemuan'=> $request->pertemuan,
                'materi_id'=> $request->materi_id,
                'jadwal_id'=> $request->jadwal_id,
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
    public function show(string $id)
    {
        //
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
            ];
            Pertemuan::where('id', $request->id)->update($updateRecord);
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
     * Remove the specified resource from storage.
     */
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
