<?php

namespace Database\Seeders;

use App\Models\MataPelajaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MataPelajaransTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MataPelajaran::create([
            'nama' => 'Pendidikan Kewarganegaraan',
        ]);
        MataPelajaran::create([
            'nama' => 'Pendidikan Agama Islam',
        ]);
        MataPelajaran::create([
            'nama' => 'Pendidikan Agama Kristen',
        ]);
        MataPelajaran::create([
            'nama' => 'Pendidikan Agama Katolik',
        ]);
        MataPelajaran::create([
            'nama' => 'Pendidikan Agama Hindu',
        ]);
        MataPelajaran::create([
            'nama' => 'Pendidikan Agama Budha',
        ]);
        MataPelajaran::create([
            'nama' => 'Matematika',
        ]);
        MataPelajaran::create([
            'nama' => 'Bahasa Indonesia',
        ]);
        MataPelajaran::create([
            'nama' => 'Bahasa Inggris',
        ]);
        MataPelajaran::create([
            'nama' => 'Fisika',
        ]);
        MataPelajaran::create([
            'nama' => 'Biologi',
        ]);
        MataPelajaran::create([
            'nama' => 'Kimia',
        ]);
        MataPelajaran::create([
            'nama' => 'Sejarah',
        ]);
        MataPelajaran::create([
            'nama' => 'Sosiologi',
        ]);
        MataPelajaran::create([
            'nama' => 'Geografi',
        ]);
        MataPelajaran::create([
            'nama' => 'Ekonomi',
        ]);
        MataPelajaran::create([
            'nama' => 'Seni Budaya',
        ]);
        MataPelajaran::create([
            'nama' => 'Pendidikan Jasmani, Olahraga, dan Kesehatan',
        ]);
    }
}
