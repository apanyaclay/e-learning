<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiswasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Siswa::create([
            "nisn"=> "123456789",
            "user_id"=> "20",
            "kelas_id"=> "1",
            "jurusan_id"=> "1",
            "nama"=> "Jane Smith",
            "alamat"=> "Jl. Thamrin 2",
            "jenis_kelamin"=> "P",
            "tempat_lahir"=> "Medan",
            "tanggal_lahir"=> "2024-05-01",
            "agama"=> "Islam",
            "tentang"=> "Saya adalah seorang siswa di sekolah E-Learning",
            "foto"=> "avatar-03.jpg",
        ]);
    }
}
