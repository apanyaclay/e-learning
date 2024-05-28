<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ebook;
use App\Models\Guru;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.ebook.index',[
            'title' => 'List E-Book'
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

        $data =  DB::table('e-books')
                ->join('gurus', 'e-books.guru_nuptk', '=', 'gurus.nuptk')
                ->select('e-books.*', 'gurus.nama as guru_nama');
        $totalRecords = $data->count();

        $totalRecordsWithFilter = $data->where(function ($query) use ($searchValue) {
            $query->where('e-books.id', 'like', '%' . $searchValue . '%');
            $query->orWhere('e-books.judul', 'like', '%' . $searchValue . '%');
            $query->orWhere('gurus.nama', 'like', '%' . $searchValue . '%');
        })->count();

        $records = $data->orderBy($columnName, $columnSortOrder)
            ->where(function ($query) use ($searchValue) {
            $query->where('e-books.id', 'like', '%' . $searchValue . '%');
            $query->orWhere('e-books.judul', 'like', '%' . $searchValue . '%');
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
                        <a href="'.url('admin/ebook/edit/'.$record->id).'" class="btn btn-sm bg-danger-light">
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
                "judul"       => $record->judul,
                "guru"       => $record->guru_nama,
                "file"       => $record->file,
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
        $guru = Guru::all();
        return view('admin.ebook.add', [
            'title'=> 'Tambah E-Book',
            'guru'=> $guru
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'             => 'required',
            'guru_nuptk'        => 'required',
            'upload'            => 'required',
        ]);

        DB::beginTransaction();
        try {
            $upload_file = rand() . '_' . $request->upload->extension();
            $request->upload->move(storage_path('app/public/ebook/'), $upload_file);
            if (!empty($upload_file)) {
                Ebook::create([
                    'judul'              => $request->judul,
                    'guru_nuptk'         => $request->guru_nuptk,
                    'file'               => $upload_file,
                ]);
                Toastr::success('Ebook berhasil ditambahkan :)','Success');
                DB::commit();
                return redirect()->route('admin/ebook');
            } else {
                Toastr::error('Tidak ada foto  :)','Error');
                return redirect()->back();
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Ebook gagal ditambahkan','Error');
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
        $guru = Guru::all();
        $ebook = Ebook::find($id);
        return view('admin.ebook.edit', [
            'title'=> 'Edit E-Book',
            'guru'=> $guru,
            'ebook'=> $ebook
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
                $request->upload->move(storage_path('app/public/ebook/'), $upload_file);
            } else {
                $upload_file = $request->upload_hidden;
            }
            $updateRecord = [
                'judul'             => $request->judul,
                'guru_nuptk'        => $request->guru_nuptk,
                'file'              => $upload_file,
            ];
            Ebook::where('id',$request->id)->update($updateRecord);

            Toastr::success('Ebook berhasil diedit :)','Success');
            DB::commit();
            return redirect()->route('admin/ebook');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Ebook gagal diedit','Error');
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
            Ebook::destroy($request->id);
            DB::commit();
            Toastr::success('E-Book deleted successfully :)','Success');
            return redirect()->back();

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('E-Book deleted fail :)','Error');
            return redirect()->back();
        }
    }
}
