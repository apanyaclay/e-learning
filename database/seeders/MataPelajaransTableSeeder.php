<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\MataPelajaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MataPelajaransTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $guruNuptks = Guru::pluck('nuptk')->toArray();

        foreach ($this->getMataPelajaranData() as $index => $mataPelajaran) {
            MataPelajaran::create(array_merge($mataPelajaran, ['guru_nuptk' => $guruNuptks[$index % count($guruNuptks)]]));
        }
    }

    private function getMataPelajaranData()
    {
        return [
            ['nama' => 'Pendidikan Kewarganegaraan', 'kkm'=> '70'],
            ['nama' => 'Pendidikan Agama dan Budi Pekerti', 'kkm'=> '70'],
            ['nama' => 'Matematika Wajib', 'kkm'=> '70'],
            ['nama' => 'Matematika Peminatan', 'kkm'=> '70'],
            ['nama' => 'Bahasa Indonesia', 'kkm'=> '70'],
            ['nama' => 'Bahasa Inggris', 'kkm'=> '70'],
            ['nama' => 'Fisika', 'kkm'=> '70'],
            ['nama' => 'Biologi', 'kkm'=> '70'],
            ['nama' => 'Kimia', 'kkm'=> '70'],
            ['nama' => 'Sejarah Indonesia', 'kkm'=> '70'],
            ['nama' => 'Sejarah Peminatan', 'kkm'=> '70'],
            ['nama' => 'Sosiologi', 'kkm'=> '70'],
            ['nama' => 'Geografi', 'kkm'=> '70'],
            ['nama' => 'Ekonomi', 'kkm'=> '70'],
            ['nama' => 'Seni Budaya', 'kkm'=> '70'],
            ['nama' => 'Pendidikan Jasmani, Olahraga, dan Kesehatan', 'kkm'=> '70'],
            ['nama' => 'Teknologi Informasi dan Komunikasi', 'kkm'=> '70'],
            ['nama' => 'Bahasa dan Sastra Indonesia', 'kkm'=> '70'],
            ['nama' => 'Bahasa dan Sastra Inggris', 'kkm'=> '70'],
            ['nama' => 'Bahasa Jerman', 'kkm'=> '70'],
            ['nama' => 'Antropologi', 'kkm'=> '70'],
        ];
    }
}
