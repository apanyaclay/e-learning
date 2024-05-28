<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Soal;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $soal = Soal::where('kuis_id', $id)->get()->toArray();
        $totalBobot = Soal::where('kuis_id', $id)->sum('bobot');
        return view('admin.soal.index', [
            'title'=> 'Lihat Kuis',
            'soal'=> $soal,
            'bobot'=> $totalBobot,
            'id' => $id
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {

        return view('admin.soal.add', [
            'title'=> 'Tambah Soal',
            'id' => $id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            Soal::destroy($request->id);
            DB::commit();
            Toastr::success('Soal deleted successfully :)','Success');

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Soal deleted fail :)','Error');
        }
        return redirect()->back();
    }
}
