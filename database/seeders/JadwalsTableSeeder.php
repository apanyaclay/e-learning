<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jadwal::create([
            "kelas_id"=> "1",
            "jurusan_id"=> "1",
            "mata_pelajaran_id"=> "1",
            "hari"=> "Senin",
            "jam_mulai"=> "08:00",
            "jam_selesai"=> "09:00",
        ]);
        Jadwal::create([
            "kelas_id"=> "2",
            "jurusan_id"=> "2",
            "mata_pelajaran_id"=> "2",
            "hari"=> "Selasa",
            "jam_mulai"=> "08:00",
            "jam_selesai"=> "09:00",
        ]);
        Jadwal::create([
            "kelas_id"=> "3",
            "jurusan_id"=> "4",
            "mata_pelajaran_id"=> "3",
            "hari"=> "Senin",
            "jam_mulai"=> "07:00",
            "jam_selesai"=> "08:00",
        ]);
        Jadwal::create([
            "kelas_id"=> "1",
            "jurusan_id"=> "4",
            "mata_pelajaran_id"=> "4",
            "hari"=> "Senin",
            "jam_mulai"=> "07:00",
            "jam_selesai"=> "08:00",
        ]);
        Jadwal::create([
            "kelas_id"=> "2",
            "jurusan_id"=> "4",
            "mata_pelajaran_id"=> "5",
            "hari"=> "Senin",
            "jam_mulai"=> "07:00",
            "jam_selesai"=> "08:00",
        ]);
        Jadwal::create([
            "kelas_id"=> "3",
            "jurusan_id"=> "4",
            "mata_pelajaran_id"=> "6",
            "hari"=> "Senin",
            "jam_mulai"=> "07:00",
            "jam_selesai"=> "08:00",
        ]);
    }
}
