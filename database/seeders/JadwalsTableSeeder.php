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
            "jam_mulai"=> "07:15",
            "jam_selesai"=> "09:15",
            "tahun_ajaran_id"=> "1",
        ]);
        Jadwal::create([
            "kelas_id"=> "1",
            "jurusan_id"=> "1",
            "mata_pelajaran_id"=> "2",
            "hari"=> "Senin",
            "jam_mulai"=> "09:30",
            "jam_selesai"=> "11:30",
            "tahun_ajaran_id"=> "1",
        ]);
        Jadwal::create([
            "kelas_id"=> "1",
            "jurusan_id"=> "1",
            "mata_pelajaran_id"=> "3",
            "hari"=> "Senin",
            "jam_mulai"=> "11:45",
            "jam_selesai"=> "13:45",
            "tahun_ajaran_id"=> "1",
        ]);
        Jadwal::create([
            "kelas_id"=> "1",
            "jurusan_id"=> "1",
            "mata_pelajaran_id"=> "4",
            "hari"=> "Selasa",
            "jam_mulai"=> "07:15",
            "jam_selesai"=> "09:15",
            "tahun_ajaran_id"=> "1",
        ]);
        Jadwal::create([
            "kelas_id"=> "1",
            "jurusan_id"=> "1",
            "mata_pelajaran_id"=> "5",
            "hari"=> "Selasa",
            "jam_mulai"=> "09:30",
            "jam_selesai"=> "11:30",
            "tahun_ajaran_id"=> "1",
        ]);
        Jadwal::create([
            "kelas_id"=> "1",
            "jurusan_id"=> "1",
            "mata_pelajaran_id"=> "6",
            "hari"=> "Selasa",
            "jam_mulai"=> "11:45",
            "jam_selesai"=> "13:45",
            "tahun_ajaran_id"=> "1",
        ]);
        Jadwal::create([
            "kelas_id"=> "1",
            "jurusan_id"=> "1",
            "mata_pelajaran_id"=> "7",
            "hari"=> "Rabu",
            "jam_mulai"=> "07:15",
            "jam_selesai"=> "09:15",
            "tahun_ajaran_id"=> "1",
        ]);
        Jadwal::create([
            "kelas_id"=> "1",
            "jurusan_id"=> "1",
            "mata_pelajaran_id"=> "8",
            "hari"=> "Rabu",
            "jam_mulai"=> "09:30",
            "jam_selesai"=> "11:30",
            "tahun_ajaran_id"=> "1",
        ]);
        Jadwal::create([
            "kelas_id"=> "1",
            "jurusan_id"=> "1",
            "mata_pelajaran_id"=> "9",
            "hari"=> "Rabu",
            "jam_mulai"=> "11:45",
            "jam_selesai"=> "13:45",
            "tahun_ajaran_id"=> "1",
        ]);
        Jadwal::create([
            "kelas_id"=> "1",
            "jurusan_id"=> "1",
            "mata_pelajaran_id"=> "10",
            "hari"=> "Kamis",
            "jam_mulai"=> "07:15",
            "jam_selesai"=> "09:15",
            "tahun_ajaran_id"=> "1",
        ]);
        Jadwal::create([
            "kelas_id"=> "1",
            "jurusan_id"=> "1",
            "mata_pelajaran_id"=> "15",
            "hari"=> "Kamis",
            "jam_mulai"=> "09:30",
            "jam_selesai"=> "11:30",
            "tahun_ajaran_id"=> "1",
        ]);
        Jadwal::create([
            "kelas_id"=> "1",
            "jurusan_id"=> "1",
            "mata_pelajaran_id"=> "16",
            "hari"=> "Kamis",
            "jam_mulai"=> "11:45",
            "jam_selesai"=> "13:45",
            "tahun_ajaran_id"=> "1",
        ]);
        Jadwal::create([
            "kelas_id"=> "1",
            "jurusan_id"=> "1",
            "mata_pelajaran_id"=> "17",
            "hari"=> "Jumat",
            "jam_mulai"=> "07:15",
            "jam_selesai"=> "09:15",
            "tahun_ajaran_id"=> "1",
        ]);
        Jadwal::create([
            "kelas_id"=> "1",
            "jurusan_id"=> "1",
            "mata_pelajaran_id"=> "3",
            "hari"=> "Jumat",
            "jam_mulai"=> "09:30",
            "jam_selesai"=> "11:30",
            "tahun_ajaran_id"=> "1",
        ]);
        Jadwal::create([
            "kelas_id"=> "1",
            "jurusan_id"=> "1",
            "mata_pelajaran_id"=> "5",
            "hari"=> "Sabtu",
            "jam_mulai"=> "07:15",
            "jam_selesai"=> "09:15",
            "tahun_ajaran_id"=> "1",
        ]);
        Jadwal::create([
            "kelas_id"=> "1",
            "jurusan_id"=> "1",
            "mata_pelajaran_id"=> "7",
            "hari"=> "Sabtu",
            "jam_mulai"=> "09:30",
            "jam_selesai"=> "11:30",
            "tahun_ajaran_id"=> "1",
        ]);
        Jadwal::create([
            "kelas_id"=> "1",
            "jurusan_id"=> "1",
            "mata_pelajaran_id"=> "8",
            "hari"=> "Sabtu",
            "jam_mulai"=> "11:45",
            "jam_selesai"=> "13:45",
            "tahun_ajaran_id"=> "1",
        ]);
    }
}
