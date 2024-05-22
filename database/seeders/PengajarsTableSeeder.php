<?php

namespace Database\Seeders;

use App\Models\Pengajar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengajarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pengajar::create([
            "nuptk"=> "123456789",
            "user_id"=> "2",
            "mata_pelajaran_id"=> "1",
            "nama_pengajar"=> "John Doe",
            "alamat"=> "Jl. Thamrin 2",
            "no_hp"=> "08123456789",
            "jenis_kelamin"=> "L",
            "tempat_lahir"=> "Medan",
            "tanggal_lahir"=> "2024-05-01",
            "tentang"=> "Saya adalah seorang pengajar di sekolah E-Learning",
            "agama"=> "Islam",
            "foto"=> "196566296.jpg",
        ]);
    }
}
