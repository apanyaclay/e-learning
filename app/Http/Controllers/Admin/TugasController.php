<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\JawabanTugas;
use App\Models\NilaiTugas;
use App\Models\Pertemuan;
use App\Models\Siswa;
use App\Models\Tugas;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.tugas.index', [
            'title' => 'List Tugas',
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

        $data =  DB::table('tugas')
            ->join('pertemuans', 'tugas.pertemuan_id', '=', 'pertemuans.id')
            ->join('gurus', 'tugas.guru_nuptk', '=', 'gurus.nuptk')
            ->join('jadwals', 'pertemuans.jadwal_id', '=', 'jadwals.id')
            ->join('kelas', 'jadwals.kelas_id', '=', 'kelas.id')
            ->join('jurusans', 'jadwals.jurusan_id', '=', 'jurusans.id')
            ->join('mata_pelajarans', 'jadwals.mata_pelajaran_id', '=', 'mata_pelajarans.id')
            ->select('tugas.*', 'pertemuans.pertemuan as pertemuan', 'gurus.nama as guru_nama', 'kelas.nama as kelas_nama', 'jurusans.nama as jurusan_nama', 'mata_pelajarans.nama as mapel');
        $totalRecords = $data->count();

        $totalRecordsWithFilter = $data->where(function ($query) use ($searchValue) {
            $query->where('tugas.id', 'like', '%' . $searchValue . '%');
            $query->orWhere('tugas.nama', 'like', '%' . $searchValue . '%');
            $query->orWhere('gurus.nama', 'like', '%' . $searchValue . '%');
            $query->orWhere('pertemuans.pertemuan', 'like', '%' . $searchValue . '%');
        })->count();

        $records = $data->orderBy($columnName, $columnSortOrder)
            ->where(function ($query) use ($searchValue) {
            $query->where('tugas.id', 'like', '%' . $searchValue . '%');
            $query->orWhere('tugas.nama', 'like', '%' . $searchValue . '%');
            $query->orWhere('gurus.nama', 'like', '%' . $searchValue . '%');
            $query->orWhere('pertemuans.pertemuan', 'like', '%' . $searchValue . '%');
            })
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];

        foreach ($records as $record) {

            $modify = '
                <td class="text-end">
                    <div class="actions">
                        <a href="'.url('admin/tugas/view/'.$record->id).'" class="btn btn-sm bg-success-light me-2">
                            <i class="fe fe-eye"></i>
                        </a>
                        <a href="'.url('admin/tugas/edit/'.$record->id).'" class="btn btn-sm bg-danger-light">
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
                "guru"          => $record->guru_nama,
                "mapel"         => $record->mapel,
                "pertemuan"     => $record->pertemuan,
                "kelas"         => $record->kelas_nama.'-'.$record->jurusan_nama,
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
        $pertemuan = Pertemuan::all();
        return view('admin.tugas.add', [
            'title'=> 'Tambah Tugas',
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
            'pertemuan_id'  => 'required',
            'detail'    => 'required',
        ]);
        DB::beginTransaction();
        try {
            $pertemuan = Pertemuan::find($request->pertemuan_id);
            $kelas = Tugas::create([
                'nama'          => $request->nama,
                'tenggat'       => $request->tenggat,
                'pertemuan_id'  => $request->pertemuan_id,
                'guru_nuptk'    => $pertemuan->jadwal->mataPelajaran->guru_nuptk,
                'detail'        => $request->detail,
            ]);
            $kelas->save();
            DB::commit();
            Toastr::success('Tugas berhasil ditambah', 'success');
            return redirect()->route('admin/tugas');
        } catch (\Exception $th) {
            DB::rollback();
            Toastr::error('Tugas gagal ditambah', 'error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tugas = Tugas::findOrFail($id);
        $pertemuan = Pertemuan::find($tugas->pertemuan_id);
        $siswa = Siswa::where('kelas_id', $pertemuan->jadwal->kelas_id)->where('jurusan_id', $pertemuan->jadwal->jurusan_id)->get();
        $jawaban = JawabanTugas::where('tugas_id', $id)->get()->keyBy('siswa_nisn');
        $nilai = NilaiTugas::where('tugas_id', $id)->get()->keyBy('siswa_nisn');
        $jumlahSudahMengerjakan = $nilai->count();
        return view('admin.tugas.view', [
            'title'=> 'Detail Tugas',
            'tugas'=> $tugas,
            'siswa' => $siswa,
            'jawaban'=> $jawaban,
            'nilai'=> $nilai,
            'jumlahSudahMengerjakan'=> $jumlahSudahMengerjakan,
            'id' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pertemuan = Pertemuan::all();
        $tugas = Tugas::find($id);
        return view('admin.tugas.edit', [
            'title'=> 'Edit Tugas',
            'pertemuan'=> $pertemuan,
            'tugas'=> $tugas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $pertemuan = Pertemuan::find($request->pertemuan_id);
            $tugas = Tugas::find($request->id);
            $tugas->nama = $request->nama;
            $tugas->tenggat = $request->tenggat;
            $tugas->guru_nuptk = $pertemuan->jadwal->mataPelajaran->guru_nuptk;
            $tugas->pertemuan_id = $request->pertemuan_id;
            $tugas->detail = $request->detail;
            $tugas->save();
            DB::commit();
            Toastr::success('Tugas berhasil diubah','success');
            return redirect()->route('admin/tugas');
        } catch (\Exception $th) {
            DB::rollback();
            Toastr::error('Tugas gagal diubah','error');
            return redirect()->back();
        }
    }

    public function nilai($id, $nisn)
    {
        $nilai = NilaiTugas::where('tugas_id', $id)->where('siswa_nisn', $nisn)->first();
        $nilais = 0;
        $komentars = '';
        if ($nilai) {
            $nilais += $nilai->nilai;
            $komentars = $nilai->komentar;
        } else {
            $nilais = 0;
            $komentars = '';
        }
        return view('admin.tugas.view-edit', [
            'title'=> 'Edit Nilai',
            'id'=> $id,
            'nilai'=> $nilais,
            'nisn'=> $nisn,
            'komentar'=> $komentars,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function nilai_store(Request $request, $nisn)
    {
        DB::beginTransaction();
        try {
            $nilai = NilaiTugas::where('tugas_id', $request->id)->where('siswa_nisn', $nisn)->first();
            if ($nilai) {
                $record = [
                    'nilai'=> $request->nilai,
                    'tugas_id'=> $request->id,
                    'siswa_nisn'=> $nisn,
                    'komentar'=> $request->komentar,
                ];
                $nilai->update($record);
            } else {
                NilaiTugas::create([
                    'nilai'=> $request->nilai,
                    'tugas_id'=> $request->id,
                    'siswa_nisn'=> $nisn,
                    'komentar'=> $request->komentar,
                ]);
            }
            DB::commit();
            Toastr::success('Nilai berhasil diubah','success');
            return redirect()->route('admin/tugas/view', ['id' => $request->id]);
        } catch (\Exception $th) {
            DB::rollback();
            Toastr::error('Nilai gagal diubah','error');
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
            Tugas::destroy($request->id);
            DB::commit();
            Toastr::success('Tugas deleted successfully :)','Success');
            return redirect()->back();

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Tugas deleted fail','Error');
            return redirect()->back();
        }
    }
}
