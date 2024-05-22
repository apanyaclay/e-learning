<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Pengajar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalMapelController extends Controller
{
    public function index()
    {
        $pengajar = Pengajar::where('user_id', Auth::user()->id)->first();
        $jadwals = Jadwal::where('pengajar_nuptk', $pengajar->nuptk)
                    ->orderBy('hari')
                    ->orderBy('jam_mulai')
                    ->get();
        $groupedJadwals = $jadwals->groupBy('hari');
        return view('pengajar.jadwal_mapel', [
            'title' => 'Jadwal Mapel',
            'groupedJadwals' => $groupedJadwals,
        ]);
    }
}
