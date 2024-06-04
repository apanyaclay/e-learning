<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.guru.index', [
            'title' => 'List Guru'
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

        $data =  DB::table('gurus');
        $totalRecords = $data->count();

        $totalRecordsWithFilter = $data->where(function ($query) use ($searchValue) {
                $query->where('nuptk', 'like', '%' . $searchValue . '%');
                $query->orWhere('nama', 'like', '%' . $searchValue . '%');
                $query->orWhere('alamat', 'like', '%' . $searchValue . '%');
                $query->orWhere('tempat_lahir', 'like', '%' . $searchValue . '%');
        })->count();

        $records = $data->orderBy($columnName, $columnSortOrder)
            ->where(function ($query) use ($searchValue) {
                $query->where('nuptk', 'like', '%' . $searchValue . '%');
                $query->orWhere('nama', 'like', '%' . $searchValue . '%');
                $query->orWhere('alamat', 'like', '%' . $searchValue . '%');
                $query->orWhere('tempat_lahir', 'like', '%' . $searchValue . '%');
            })
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];

        foreach ($records as $record) {

            $nama = '
                <td>
                    <h2 class="table-avatar">
                        <a href="'.url('admin/guru/profile/'.$record->nuptk).'" class="avatar-sm me-2">
                            <img class="avatar-img rounded-circle avatar" src="' . Storage::url('foto/' . $record->foto) . '" alt="">
                        </a>
                        <a href="'.url('admin/guru/profile/'.$record->nuptk).'">' . $record->nama . '</a>
                    </h2>
                </td>
            ';

            $modify = '
                <td class="text-end">
                    <div class="actions">
                        <a href="'.url('admin/guru/edit/'.$record->nuptk).'" class="btn btn-sm bg-danger-light">
                            <i class="far fa-edit me-2"></i>
                        </a>
                        <a class="btn btn-sm bg-danger-light delete data_id" data-bs-toggle="modal" data-id="'.$record->nuptk.'" data-bs-target="#delete">
                        <i class="fe fe-trash-2"></i>
                        </a>
                    </div>
                </td>
            ';

            $data_arr [] = [
                "nuptk"             => $record->nuptk,
                "nama"              => $nama,
                "alamat"            => $record->alamat,
                "no_hp"             => $record->no_hp,
                "jenis_kelamin"     => $record->jenis_kelamin,
                "tempat_lahir"      => $record->tempat_lahir,
                "agama"             => $record->agama,
                "tanggal_lahir"     => Carbon::parse($record->tanggal_lahir)->format('d-M-Y'),
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
        return view('admin.guru.add', [
            'title'=> 'Tambah Guru',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nuptk'             => 'required|string',
            'nama'              => 'required|string',
            'jenis_kelamin'     => 'required|not_in:0',
            'tanggal_lahir'     => 'required|string',
            'tempat_lahir'      => 'required|string',
            'agama'             => 'required|string',
            'email'             => 'required|email',
            'alamat'            => 'required|string',
            'no_hp'             => 'required',
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
                    'username'=> $request->nama,
                    'email'=> $request->email,
                    'password'=> Hash::make('guru123'),
                    'role'=> 'siswa',
                ]);
                Guru::create([
                    'nuptk'             => $request->nuptk,
                    'user_id'           => $user->id,
                    'no_hp'             => $request->no_hp,
                    'nama'              => $request->nama,
                    'alamat'            => $request->alamat,
                    'jenis_kelamin'     => $request->jenis_kelamin,
                    'tempat_lahir'      => $request->tempat_lahir,
                    'agama'             => $request->agama,
                    'tanggal_lahir'     => $formattedDate,
                    'foto'              => $upload_file,
                ]);
                Toastr::success('Guru berhasil ditambahkan :)','Success');
                DB::commit();
                return redirect()->route('admin/guru');
            } else {
                Toastr::error('Tidak ada foto  :)','Error');
                return redirect()->back();
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Guru gagal ditambahkan','Error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $guru = Guru::find($id);
        $user = User::find($guru->user_id);
        return view('admin.guru.profile',[
            'title' => 'Detail Guru',
            'guru'=> $guru,
            'user'=> $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $guru = Guru::find($id);
        return view('admin.guru.edit',[
            'title'=> 'Edit Guru',
            'guru'=> $guru,
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
                'nuptk'              => $request->nuptk,
                'nama'              => $request->nama,
                'alamat'            => $request->alamat,
                'jenis_kelamin'     => $request->jenis_kelamin,
                'tempat_lahir'      => $request->tempat_lahir,
                'agama'             => $request->agama,
                'no_hp'             => $request->no_hp,
                'tanggal_lahir'     => $formattedDate,
                'foto'              => $upload_file,
            ];
            Guru::where('nuptk',$request->nuptk)->update($updateRecord);

            Toastr::success('Guru berhasil diedit :)','Success');
            DB::commit();
            return redirect()->route('admin/guru');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Guru gagal diedit','Error');
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
            Guru::destroy($request->id);
            DB::commit();
            Toastr::success('Guru deleted successfully :)','Success');
            return redirect()->back();

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Guru deleted fail :)','Error');
            return redirect()->back();
        }
    }
}
