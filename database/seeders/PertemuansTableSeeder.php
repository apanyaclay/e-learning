<?php

namespace Database\Seeders;

use App\Models\Pertemuan;
use Carbon\Carbon;
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
            "tanggal"=> Carbon::today(),
        ]);
        Pertemuan::create([
            "pertemuan"=> "1",
            "materi_id"=> "2",
            "jadwal_id"=> "2",
            "tanggal"=> Carbon::today(),
        ]);
        Pertemuan::create([
            "pertemuan"=> "1",
            "materi_id"=> "3",
            "jadwal_id"=> "3",
            "tanggal"=> Carbon::today(),
        ]);
        Pertemuan::create([
            "pertemuan"=> "1",
            "materi_id"=> "4",
            "jadwal_id"=> "4",
            "tanggal"=> Carbon::tomorrow(),
        ]);
        Pertemuan::create([
            "pertemuan"=> "1",
            "materi_id"=> "5",
            "jadwal_id"=> "5",
            "tanggal"=> Carbon::tomorrow(),
        ]);
        Pertemuan::create([
            "pertemuan"=> "1",
            "materi_id"=> "6",
            "jadwal_id"=> "6",
            "tanggal"=> Carbon::tomorrow(),
        ]);
    }
}
