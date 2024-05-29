<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Pertemuan;
use App\Models\Siswa;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.absensi.index', [
            'title' => 'List Absensi',
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

        $data =  DB::table('absensis')
        ->join('siswas', 'absensis.siswa_nisn', '=', 'siswas.nisn')
        ->join('pertemuans', 'absensis.pertemuan_id', '=', 'pertemuans.id')
        ->select('absensis.*', 'siswas.nama as siswa_nama', 'pertemuans.pertemuan as pertemuan');
        $totalRecords = $data->count();

        $totalRecordsWithFilter = $data->where(function ($query) use ($searchValue) {
            $query->where('absensis.id', 'like', '%' . $searchValue . '%');
            $query->where('absensis.status', 'like', '%' . $searchValue . '%');
            $query->where('absensis.tanggal', 'like', '%' . $searchValue . '%');
            $query->orWhere('siswas.nama', 'like', '%' . $searchValue . '%');
        })->count();

        $records = $data->orderBy($columnName, $columnSortOrder)
            ->where(function ($query) use ($searchValue) {
            $query->where('absensis.id', 'like', '%' . $searchValue . '%');
            $query->where('absensis.status', 'like', '%' . $searchValue . '%');
            $query->where('absensis.tanggal', 'like', '%' . $searchValue . '%');
            $query->orWhere('siswas.nama', 'like', '%' . $searchValue . '%');
            })
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];

        foreach ($records as $record) {

            $modify = '
                <td class="text-end">
                    <div class="actions">
                        <a href="'.url('admin/absensi/edit/'.$record->id).'" class="btn btn-sm bg-danger-light">
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
                "siswa_nama"       => $record->siswa_nama,
                "tanggal"       => $record->tanggal,
                "status"       => $record->status,
                "keterangan"       => $record->keterangan,
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
        $siswas = Siswa::all();
        $pertemuan = Pertemuan::all();
        return view('admin.absensi.add', [
            'title' => 'Tambah Absensi',
            'siswas' => $siswas,
            'pertemuan' => $pertemuan,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'=> 'required|string',
        ]);
        DB::beginTransaction();
        try {
            $absensi = Absensi::create([
                'nama'=> $request->nama,
            ]);
            $absensi->save();
            DB::commit();
            Toastr::success('Absensi berhasil ditambah', 'success');
            return redirect()->route('admin/absensi');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Absensi gagal ditambah', 'error');
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
        $absensi = Absensi::find($id);
        $siswas = Siswa::all();
        $pertemuan = Pertemuan::all();
        return view('admin.absensi.edit', [
            'title' => 'Tambah Absensi',
            'absensi' => $absensi,
            'siswas' => $siswas,
            'pertemuan' => $pertemuan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $absensi = Absensi::find($request->id);
            $absensi->nama = $request->nama;
            $absensi->save();
            DB::commit();
            Toastr::success('Absensi berhasil diubah','success');
            return redirect()->route('admin/absensi');
        } catch (\Exception $th) {
            DB::rollback();
            Toastr::error('Absensi gagal diubah','error');
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
            Absensi::destroy($request->id);
            DB::commit();
            Toastr::success('Kelas deleted successfully :)','Success');
            return redirect()->back();

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Kelas deleted fail :)','Error');
            return redirect()->back();
        }
    }
}
