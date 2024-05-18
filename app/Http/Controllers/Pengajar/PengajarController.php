<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengajarController extends Controller
{
    public function dashboard()
    {
        return view('pengajar.dashboard', [
            'title' => 'Dashboard',
        ]);
    }
}
