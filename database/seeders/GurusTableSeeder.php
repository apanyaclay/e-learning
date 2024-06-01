<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GurusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Guru::create([
            "nuptk"=> "123456789",
            "user_id"=> "2",
            "nama"=> "Guru",
            "alamat"=> "Jl. Thamrin 2",
            "no_hp"=> "08123456789",
            "jenis_kelamin"=> "L",
            "tempat_lahir"=> "Medan",
            "tanggal_lahir"=> "2024-05-01",
            "tentang"=> "Saya adalah seorang pengajar di sekolah E-Learning",
            "agama"=> "Islam",
            "foto"=> "avatar-03.jpg",
        ]);
    }
}
