<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
                ->select('pertemuans.*', 'materis.nama as materi_nama', 'kelas.nama as kelas_nama', 'jurusans.nama as jurusan_nama');
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
                "created_at"            => $record->created_at,
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
