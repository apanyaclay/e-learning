<?php

namespace Database\Seeders;

use App\Models\Pertemuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PertemuansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pertemuan::create([
            "pertemuan"=> "1",
            "materi_id"=> "1",
            "jadwal_id"=> "1",
        ]);
        Pertemuan::create([
            "pertemuan"=> "1",
            "materi_id"=> "2",
            "jadwal_id"=> "3",
        ]);
        Pertemuan::create([
            "pertemuan"=> "1",
            "materi_id"=> "3",
            "jadwal_id"=> "1",
        ]);
        Pertemuan::create([
            "pertemuan"=> "1",
            "materi_id"=> "4",
            "jadwal_id"=> "1",
        ]);
        Pertemuan::create([
            "pertemuan"=> "1",
            "materi_id"=> "5",
            "jadwal_id"=> "1",
        ]);
        Pertemuan::create([
            "pertemuan"=> "1",
            "materi_id"=> "6",
            "jadwal_id"=> "1",
        ]);
    }
}
