<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\MataPelajaran;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.mapel.index', [
            'title' => 'List Mata Pelajaran'
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

        $data =  DB::table('mata_pelajarans')
                    ->leftJoin('gurus', 'mata_pelajarans.guru_nuptk', '=', 'gurus.nuptk')
                    ->select('mata_pelajarans.*', 'gurus.nama as guru_nama');
        $totalRecords = $data->count();

        $totalRecordsWithFilter = $data->where(function ($query) use ($searchValue) {
            $query->where('mata_pelajarans.id', 'like', '%' . $searchValue . '%');
            $query->orWhere('mata_pelajarans.nama', 'like', '%' . $searchValue . '%');
            $query->orWhere('gurus.nama', 'like', '%' . $searchValue . '%');
        })->count();

        $records = $data->orderBy($columnName, $columnSortOrder)
            ->where(function ($query) use ($searchValue) {
                $query->where('mata_pelajarans.id', 'like', '%' . $searchValue . '%');
                $query->orWhere('mata_pelajarans.nama', 'like', '%' . $searchValue . '%');
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
                        <a href="'.url('admin/mapel/edit/'.$record->id).'" class="btn btn-sm bg-danger-light">
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
                "nama"              => $record->nama,
                "kkm"               => $record->kkm,
                "guru_nuptk"        => $record->guru_nama,
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
        $guru = Guru::all();
        return view('admin.mapel.add', [
            'title'=> 'Tambah Mata Pelajaran',
            'guru'=> $guru
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'=> 'required|string',
            'kkm'=> 'required',
            'guru_nuptk'=> 'required',
        ]);
        DB::beginTransaction();
        try {
            $mapel = MataPelajaran::create([
                'nama'=> $request->nama,
                'kkm'=> $request->kkm,
                'guru_nuptk'=> $request->guru_nuptk,
            ]);
            $mapel->save();
            DB::commit();
            Toastr::success('Mapel berhasil ditambah', 'success');
            return redirect()->route('admin/mapel');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Mapel gagal ditambah', 'error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mapel = MataPelajaran::find($id);
        $guru = Guru::all();
        return view('admin.mapel.edit', [
            'title'=> 'Edit Mata Pelajaran',
            'mapel'=> $mapel,
            'guru'=> $guru
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $mapel = MataPelajaran::find($request->id);
            $mapel->nama = $request->nama;
            $mapel->kkm = $request->kkm;
            $mapel->guru_nuptk = $request->guru_nuptk;
            $mapel->save();
            DB::commit();
            Toastr::success('Mapel berhasil diubah','success');
            return redirect()->route('admin/mapel');
        } catch (\Exception $th) {
            DB::rollback();
            Toastr::error('Mapel gagal diubah','error');
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
            MataPelajaran::destroy($request->id);
            DB::commit();
            Toastr::success('Mapel deleted successfully :)','Success');
            return redirect()->back();

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Mapel deleted fail :)','Error');
            return redirect()->back();
        }
    }
}
