<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
use Brian2694\Toastr\Facades\Toastr;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.ta.index", [
            'title' => 'List Tahun Ajaran'
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

        $data =  DB::table('tahun_ajarans');
        $totalRecords = $data->count();

        $totalRecordsWithFilter = $data->where(function ($query) use ($searchValue) {
            $query->where('id', 'like', '%' . $searchValue . '%');
            $query->orWhere('semester', 'like', '%' . $searchValue . '%');
            $query->orWhere('tanggal_mulai', 'like', '%' . $searchValue . '%');
            $query->orWhere('tanggal_selesai', 'like', '%' . $searchValue . '%');
        })->count();

        $records = $data->orderBy($columnName, $columnSortOrder)
            ->where(function ($query) use ($searchValue) {
            $query->where('id', 'like', '%' . $searchValue . '%');
            $query->orWhere('semester', 'like', '%' . $searchValue . '%');
            $query->orWhere('tanggal_mulai', 'like', '%' . $searchValue . '%');
            $query->orWhere('tanggal_selesai', 'like', '%' . $searchValue . '%');
            })
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];

        foreach ($records as $record) {

            $modify = '
                <td class="text-end">
                    <div class="actions">
                        <a href="'.url('admin/ta/edit/'.$record->id).'" class="btn btn-sm bg-danger-light">
                            <i class="far fa-edit me-2"></i>
                        </a>
                        <a class="btn btn-sm bg-danger-light delete data_id" data-bs-toggle="modal" data-id="'.$record->id.'" data-bs-target="#delete">
                        <i class="fe fe-trash-2"></i>
                        </a>
                    </div>
                </td>
            ';

            $data_arr [] = [
                "id"                    => $record->id,
                "tahun_ajaran"          => $record->tahun_ajaran,
                "semester"              => $record->semester,
                "tanggal_mulai"         => $record->tanggal_mulai,
                "tanggal_selesai"       => $record->tanggal_selesai,
                "modify"                => $modify,
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
        return view('admin.ta.add', [
            'title'=> 'Tambah Tahun Ajaran',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tahun_ajaran'=> 'required|string',
            'semester'=> 'required|string',
            'tanggal_mulai'=> 'required|string',
            'tanggal_selesai'=> 'required|string',
        ]);
        DB::beginTransaction();
        try {
            $date1 = DateTime::createFromFormat('d-m-Y', $request->tanggal_mulai);
            $date2 = DateTime::createFromFormat('d-m-Y', $request->tanggal_selesai);
            $ta = TahunAjaran::create([
                'tahun_ajaran'=> $request->tahun_ajaran,
                'semester'=> $request->semester,
                'tanggal_mulai'=> $date1->format('Y-m-d'),
                'tanggal_selesai'=> $date2->format('Y-m-d'),
            ]);
            $ta->save();
            DB::commit();
            Toastr::success('Tahun Ajaran berhasil ditambah', 'success');
            return redirect()->route('admin/ta');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Tahun Ajaran gagal ditambah', 'error');
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
        $ta = TahunAjaran::find($id);
        return view('admin.ta.edit', [
            'title'=> 'Edit Tahun Ajaran',
            'ta'=> $ta
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $date1 = DateTime::createFromFormat('d-m-Y', $request->tanggal_mulai);
            $date2 = DateTime::createFromFormat('d-m-Y', $request->tanggal_selesai);
            $ta = TahunAjaran::find($request->id);
            $ta->tahun_ajaran = $request->tahun_ajaran;
            $ta->semester = $request->semester;
            $ta->tanggal_mulai = $date1->format('Y-m-d');
            $ta->tanggal_selesai = $date2->format('Y-m-d');
            $ta->save();
            DB::commit();
            Toastr::success('Tahun Ajaran berhasil diubah','success');
            return redirect()->route('admin/ta');
        } catch (\Exception $th) {
            DB::rollback();
            Toastr::error('Tahun Ajaran gagal diubah','error');
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
            TahunAjaran::destroy($request->id);
            DB::commit();
            Toastr::success('Tahun Ajaran deleted successfully :)','Success');
            return redirect()->back();

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Tahun Ajaran deleted fail :)','Error');
            return redirect()->back();
        }
    }
}
