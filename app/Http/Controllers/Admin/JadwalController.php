<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\TahunAjaran;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.jadwal.index', [
            'title' => 'List Jadwal',
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

        $data =  DB::table('jadwals')
        ->join('kelas','jadwals.kelas_id','=','kelas.id')
        ->join('jurusans','jadwals.jurusan_id','=','jurusans.id')
        ->join('mata_pelajarans','jadwals.mata_pelajaran_id','=','mata_pelajarans.id')
        ->join('gurus','mata_pelajarans.guru_nuptk','=','gurus.nuptk')
        ->join('tahun_ajarans','jadwals.tahun_ajaran_id','=','tahun_ajarans.id')
        ->select('jadwals.*', 'gurus.nama as guru_nama', 'kelas.nama as kelas', 'jurusans.nama as jurusan', 'mata_pelajarans.nama as mapel', 'tahun_ajarans.tahun_ajaran as tahun_ajaran', 'tahun_ajarans.semester as semester');
        $totalRecords = $data->count();

        $totalRecordsWithFilter = $data->where(function ($query) use ($searchValue) {
            $query->where('jadwals.id', 'like', '%' . $searchValue . '%');
            $query->orWhere('jadwals.jam_mulai', 'like', '%' . $searchValue . '%');
            $query->orWhere('jadwals.jam_selesai', 'like', '%' . $searchValue . '%');
            $query->orWhere('kelas.nama', 'like', '%' . $searchValue . '%');
            $query->orWhere('jurusans.nama', 'like', '%' . $searchValue . '%');
            $query->orWhere('mata_pelajarans.nama', 'like', '%' . $searchValue . '%');
            $query->orWhere('gurus.nama', 'like', '%' . $searchValue . '%');
        })->count();

        $records = $data->orderBy($columnName, $columnSortOrder)
            ->where(function ($query) use ($searchValue) {
            $query->where('jadwals.id', 'like', '%' . $searchValue . '%');
            $query->orWhere('jadwals.jam_mulai', 'like', '%' . $searchValue . '%');
            $query->orWhere('jadwals.jam_selesai', 'like', '%' . $searchValue . '%');
            $query->orWhere('kelas.nama', 'like', '%' . $searchValue . '%');
            $query->orWhere('jurusans.nama', 'like', '%' . $searchValue . '%');
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
                        <a href="'.url('admin/jadwal/edit/'.$record->id).'" class="btn btn-sm bg-danger-light">
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
                "kelas"         => $record->kelas,
                "jurusan"         => $record->jurusan,
                "mapel"         => $record->mapel,
                "guru"         => $record->guru_nama,
                "hari"         => $record->hari,
                "jam_mulai"       => $record->jam_mulai,
                "jam_selesai"       => $record->jam_selesai,
                "tahun_ajaran"       => $record->tahun_ajaran,
                "semester"       => $record->semester,
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
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $mapel = MataPelajaran::all();
        $ta = TahunAjaran::all();
        return view('admin.jadwal.add', [
            'title' => 'Tambah Jadwal',
            'kelas' => $kelas,
            'jurusan' => $jurusan,
            'mapel'=> $mapel,
            'ta'=> $ta
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kelas'=> 'required',
            'jurusan'=> 'required',
            'mapel'=> 'required',
            'hari'=> 'required',
            'jam_mulai'=> 'required',
            'jam_selesai'=> 'required',
            'tahun_ajaran'=> 'required',
        ]);
        DB::beginTransaction();
        try {
            $jadwal = Jadwal::create([
                'kelas_id'=> $request->kelas,
                'jurusan_id'=> $request->jurusan,
                'mata_pelajaran_id'=> $request->mapel,
                'hari'=> $request->hari,
                'jam_mulai'=> $request->jam_mulai,
                'jam_selesai'=> $request->jam_selesai,
                'tahun_ajaran_id'=> $request->tahun_ajaran,
            ]);
            $jadwal->save();
            DB::commit();
            Toastr::success('Jadwal berhasil ditambah', 'success');
            return redirect()->route('admin/jadwal');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Jadwal gagal ditambah', 'error');
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
    public function edit(string $id)
    {
        $jadwal = Jadwal::find($id);
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $mapel = MataPelajaran::all();
        $ta = TahunAjaran::all();
        return view('admin.jadwal.edit', [
            'title' => 'Edit Jadwal',
            'jadwal' => $jadwal,
            'kelas' => $kelas,
            'jurusan' => $jurusan,
            'mapel' => $mapel,
            'ta' => $ta,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $jadwal = Jadwal::find($request->id);
            $jadwal->kelas_id = $request->kelas;
            $jadwal->jurusan_id = $request->jurusan;
            $jadwal->mata_pelajaran_id = $request->mapel;
            $jadwal->hari = $request->hari;
            $jadwal->jam_mulai = $request->jam_mulai;
            $jadwal->jam_selesai = $request->jam_selesai;
            $jadwal->tahun_ajaran_id = $request->tahun_ajaran;
            $jadwal->save();
            DB::commit();
            Toastr::success('Jadwal berhasil diubah','success');
            return redirect()->route('admin/jadwal');
        } catch (\Exception $th) {
            DB::rollback();
            Toastr::error('Jadwal gagal diubah','error');
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
            Jadwal::destroy($request->id);
            DB::commit();
            Toastr::success('Jadwal deleted successfully :)','Success');
            return redirect()->back();

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Jadwal deleted fail :)','Error');
            return redirect()->back();
        }
    }
}
