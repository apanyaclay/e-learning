<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $mapel = MataPelajaran::all();
        return view('siswa.mata_pelajaran', [
            'title' => 'Mata Pelajaran',
            'mapel' => $mapel,
        ]);
    }
}
