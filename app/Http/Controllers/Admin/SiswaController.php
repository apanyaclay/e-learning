<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.siswa.index', [
            'title' => 'List Siswa'
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

        $data =  DB::table('siswas')
                ->leftJoin('kelas', 'siswas.kelas_id', '=', 'kelas.id')
                ->leftJoin('jurusans', 'siswas.jurusan_id', '=', 'jurusans.id')
                ->select('siswas.*', 'kelas.nama as kelas_nama', 'jurusans.nama as jurusan_nama');
        $totalRecords = $data->count();

        $totalRecordsWithFilter = $data->where(function ($query) use ($searchValue) {
            $query->where('siswas.nisn', 'like', '%' . $searchValue . '%');
            $query->orWhere('siswas.nama', 'like', '%' . $searchValue . '%');
            $query->orWhere('kelas.nama', 'like', '%' . $searchValue . '%');
            $query->orWhere('jurusans.nama', 'like', '%' . $searchValue . '%');
            $query->orWhere('alamat', 'like', '%' . $searchValue . '%');
        })->count();

        $records = $data->orderBy($columnName, $columnSortOrder)
            ->where(function ($query) use ($searchValue) {
            $query->where('siswas.nisn', 'like', '%' . $searchValue . '%');
            $query->orWhere('siswas.nama', 'like', '%' . $searchValue . '%');
            $query->orWhere('kelas.nama', 'like', '%' . $searchValue . '%');
            $query->orWhere('jurusans.nama', 'like', '%' . $searchValue . '%');
            $query->orWhere('alamat', 'like', '%' . $searchValue . '%');
            })
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];

        foreach ($records as $record) {

            $nama = '
                <td>
                    <h2 class="table-avatar">
                        <a href="'.url('admin/siswa/profile/'.$record->nisn).'" class="avatar-sm me-2">
                            <img class="avatar-img rounded-circle avatar" src="' . Storage::url('foto/' . $record->foto) . '" alt="">
                        </a>
                        <a href="'.url('admin/siswa/profile/'.$record->nisn).'">' . $record->nama . '</a>
                    </h2>
                </td>
            ';

            $modify = '
                <td class="text-end">
                    <div class="actions">
                        <a href="'.url('admin/siswa/edit/'.$record->nisn).'" class="btn btn-sm bg-danger-light">
                            <i class="far fa-edit me-2"></i>
                        </a>
                        <a class="btn btn-sm bg-danger-light delete data_id" data-bs-toggle="modal" data-id="'.$record->nisn.'" data-bs-target="#delete">
                        <i class="fe fe-trash-2"></i>
                        </a>
                    </div>
                </td>
            ';

            $data_arr [] = [
                "nisn"         => $record->nisn,
                "nama"       => $nama,
                "kelas_id"       => $record->kelas_nama,
                "jurusan_id"       => $record->jurusan_nama,
                "jenis_kelamin"       => $record->jenis_kelamin,
                "tanggal_lahir"       => Carbon::parse($record->tanggal_lahir)->format('d-M-Y'),
                "tempat_lahir"       => $record->tempat_lahir,
                "agama"       => $record->agama,
                "alamat"       => $record->alamat,
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
        return view('admin.siswa.add', [
            'title' => 'Tambah Siswa',
            'kelas'=> $kelas,
            'jurusan'=> $jurusan,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nisn'              => 'required|string',
            'nama_siswa'        => 'required|string',
            'jenis_kelamin'     => 'required|not_in:0',
            'tanggal_lahir'     => 'required|string',
            'tempat_lahir'      => 'required|string',
            'agama'             => 'required|string',
            'email'             => 'required|email',
            'kelas_id'          => 'required',
            'jurusan_id'        => 'required',
            'alamat'            => 'required|string',
            'upload'            => 'required|image',
        ]);

        DB::beginTransaction();
        try {
            $upload_file = rand() . '.' . $request->upload->extension();
            $request->upload->move(storage_path('app/public/foto/'), $upload_file);
            if (!empty($upload_file)) {
                $date = DateTime::createFromFormat('d-m-Y', $request->tanggal_lahir);
                $formattedDate = $date->format('Y-m-d');
                $user = User::create([
                    'username'=> $request->nama_siswa,
                    'email'=> $request->email,
                    'password'=> Hash::make('siswa123'),
                    'role'=> 'siswa',
                ]);
                Siswa::create([
                    'nisn'              => $request->nisn,
                    'user_id'           => $user->id,
                    'kelas_id'          => $request->kelas_id,
                    'jurusan_id'        => $request->jurusan_id,
                    'nama'              => $request->nama_siswa,
                    'alamat'            => $request->alamat,
                    'jenis_kelamin'     => $request->jenis_kelamin,
                    'tempat_lahir'      => $request->tempat_lahir,
                    'agama'             => $request->agama,
                    'tanggal_lahir'     => $formattedDate,
                    'foto'              => $upload_file,
                ]);
                Toastr::success('Siswa berhasil ditambahkan :)','Success');
                DB::commit();
                return redirect()->route('admin/siswa');
            } else {
                Toastr::error('Tidak ada foto  :)','Error');
                return redirect()->back();
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Siswa gagal ditambahkan','Error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $siswa = Siswa::find($id);
        $user = User::find($siswa->user_id);
        return view('admin.siswa.profile', [
            'title' => 'Detail Siswa',
            'siswa'=> $siswa,
            'user'=> $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = Siswa::find($id);
        $jurusan = Jurusan::all();
        $kelas = Kelas::all();
        return view('admin.siswa.edit', [
            'title'=> 'Edit Siswa',
            'student'=> $student,
            'jurusans'=> $jurusan,
            'kelass'=> $kelas
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            if (!empty($request->upload)) {
                // unlink(storage_path('app/public/foto/'.$request->image_hidden));
                $upload_file = rand() . '.' . $request->upload->extension();
                $request->upload->move(storage_path('app/public/foto/'), $upload_file);
            } else {
                $upload_file = $request->image_hidden;
            }
            $date = DateTime::createFromFormat('d-m-Y', $request->tanggal_lahir);
            $formattedDate = $date->format('Y-m-d');
            $updateRecord = [
                'nisn'              => $request->nisn,
                'kelas_id'          => $request->kelas_id,
                'jurusan_id'        => $request->jurusan_id,
                'nama'              => $request->nama,
                'alamat'            => $request->alamat,
                'jenis_kelamin'     => $request->jenis_kelamin,
                'tempat_lahir'      => $request->tempat_lahir,
                'agama'             => $request->agama,
                'tanggal_lahir'     => $formattedDate,
                'foto'              => $upload_file,
            ];
            Siswa::where('nisn',$request->nisn)->update($updateRecord);

            Toastr::success('Siswa berhasil diedit :)','Success');
            DB::commit();
            return redirect()->route('admin/siswa');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Siswa gagal diedit','Error');
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
            Siswa::destroy($request->id);
            DB::commit();
            Toastr::success('Siswa deleted successfully :)','Success');
            return redirect()->back();

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Siswa deleted fail :)','Error');
            return redirect()->back();
        }
    }
}
