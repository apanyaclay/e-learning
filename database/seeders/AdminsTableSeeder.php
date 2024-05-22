<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            "nip"=> "123456789",
            "user_id"=> "1",
            "nama_admin"=> "Administrator",
            "alamat"=> "Jl. Thamrin 2",
            "no_hp"=> "08123456789",
            "jenis_kelamin"=> "L",
            "tempat_lahir"=> "Medan",
            "tanggal_lahir"=> "2024-05-01",
            "tentang"=> "Saya adalah seorang admin di sekolah E-Learning",
            "agama"=> "Islam",
            "foto"=> "196566296.jpg",
        ]);
    }
}
