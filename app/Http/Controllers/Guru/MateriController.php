<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Ebook;
use App\Models\Guru;
use App\Models\Materi;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('guru.materi', [
            'title' => 'List Materi'
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
        $guru = Guru::where('user_id', Auth::id())->first();
        $data =  DB::table('materis')
                ->join('e-books', 'materis.ebook_id', '=', 'e-books.id')
                ->where('e-books.guru_nuptk', $guru->nuptk)
                ->select('materis.*', 'e-books.file as file', 'e-books.judul as judul');
        $totalRecords = $data->count();

        $totalRecordsWithFilter = $data->where(function ($query) use ($searchValue) {
            $query->where('materis.id', 'like', '%' . $searchValue . '%');
            $query->orWhere('materis.nama', 'like', '%' . $searchValue . '%');
        })->count();

        $records = $data->orderBy($columnName, $columnSortOrder)
            ->where(function ($query) use ($searchValue) {
            $query->where('materis.id', 'like', '%' . $searchValue . '%');
            $query->orWhere('materis.nama', 'like', '%' . $searchValue . '%');
            })
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];

        foreach ($records as $record) {
            $extension = pathinfo($record->file, PATHINFO_EXTENSION);
            $filenameWithExtension = $record->judul . '.' . $extension;
            $files = '
            <td>
                <a href="'.Storage::url('ebook/'.$record->file).'" download="'.$filenameWithExtension.'" target="_blank" class="btn
                    btn-primary btn-sm">Download</a>
            </td>
            ';
            $modify = '
                <td class="text-end">
                    <div class="actions">
                        <a href="'.url('guru/materi/edit/'.$record->id).'" class="btn btn-sm bg-danger-light">
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
                "description"       => $record->description,
                "judul"             => $record->judul,
                "file"              => $files,
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
        $guru = Guru::where('user_id', Auth::id())->first();
        $ebook = Ebook::where('guru_nuptk', $guru->nuptk)->get();
        return view('guru.materi-add', [
            'title'=> 'Tambah Materi',
            'ebook'=> $ebook
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'             => 'required',
            'ebooks_id'        => 'required',
            'description'      => 'required',
        ]);

        DB::beginTransaction();
        try {
            Materi::create([
                'nama'              => $request->nama,
                'ebook_id'          => $request->ebooks_id,
                'description'       => $request->description,
            ]);
            Toastr::success('Materi berhasil ditambahkan :)','Success');
            DB::commit();
            return redirect()->route('guru/materi');
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Materi gagal ditambahkan','Error');
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
        $guru = Guru::where('user_id', Auth::id())->first();
        $ebook = Ebook::where('guru_nuptk', $guru->nuptk)->get();
        $materi = Materi::find($id);
        return view('guru.materi-edit', [
            'title'=> 'Edit Materi',
            'ebook'=> $ebook,
            'materi'=> $materi
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
                'nama'             => $request->nama,
                'description'      => $request->description,
                'ebook_id'          => $request->ebooks_id,
            ];
            Materi::where('id',$request->id)->update($updateRecord);
            Toastr::success('Materi berhasil diedit :)','Success');
            DB::commit();
            return redirect()->route('guru/materi');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Materi gagal diedit','Error');
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
            Materi::destroy($request->id);
            DB::commit();
            Toastr::success('Materi deleted successfully :)','Success');
            return redirect()->back();

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Materi deleted fail :)','Error');
            return redirect()->back();
        }
    }
}
