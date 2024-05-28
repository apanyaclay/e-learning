<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.jurusan.index', [
            'title' => 'List Jurusan'
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

        $data =  DB::table('jurusans');
        $totalRecords = $data->count();

        $totalRecordsWithFilter = $data->where(function ($query) use ($searchValue) {
            $query->where('id', 'like', '%' . $searchValue . '%');
            $query->orWhere('nama', 'like', '%' . $searchValue . '%');
        })->count();

        $records = $data->orderBy($columnName, $columnSortOrder)
            ->where(function ($query) use ($searchValue) {
                $query->where('id', 'like', '%' . $searchValue . '%');
                $query->orWhere('nama', 'like', '%' . $searchValue . '%');
            })
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];

        foreach ($records as $record) {

            $modify = '
                <td class="text-end">
                    <div class="actions">
                        <a href="'.url('admin/jurusan/edit/'.$record->id).'" class="btn btn-sm bg-danger-light">
                            <i class="far fa-edit me-2"></i>
                        </a>
                        <a class="btn btn-sm bg-danger-light delete data_id" data-bs-toggle="modal" data-id="'.$record->id.'" data-bs-target="#delete">
                        <i class="fe fe-trash-2"></i>
                        </a>
                    </div>
                </td>
            ';

            $data_arr [] = [
                "id"         => $record->id,
                "nama"       => $record->nama,
                "modify"     => $modify,
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
        return view('admin.jurusan.add', [
            'title'=> 'Tambah Jurusan',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'=> 'required',
        ]);
        DB::beginTransaction();
        try {
            $jurusan = Jurusan::create([
                'nama'=> $request->nama,
            ]);
            $jurusan->save();
            DB::commit();
            Toastr::success('Jurusan berhasil ditambah', 'success');
            return redirect()->route('admin/jurusan');
        } catch (\Exception $th) {
            //throw $th;
            DB::rollback();
            Toastr::error('Jurusan gagal ditambah', 'error');
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
        $jurusan = Jurusan::find($id);
        return view('admin.jurusan.edit', [
            'title'=> 'Edit Jurusan',
            'jurusan'=> $jurusan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            //code...
            $jurusan = Jurusan::find($request->id);
            $jurusan->nama = $request->nama;
            $jurusan->save();
            DB::commit();
            Toastr::success('Jurusan berhasil diedit', 'success');
            return redirect()->route('admin/jurusan');
        } catch (\Exception $th) {
            //throw $th;
            DB::rollback();
            Toastr::error('Jurusan gagal diedit', 'error');
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
            Jurusan::destroy($request->id);
            DB::commit();
            Toastr::success('Jurusan deleted successfully :)','Success');
            return redirect()->back();

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Jurusan deleted fail :)','Error');
            return redirect()->back();
        }
    }
}
