<?php

namespace Database\Seeders;

use App\Models\Ebook;
use App\Models\Guru;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EbooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $guruNuptks = Guru::pluck('nuptk')->toArray();

        foreach ($this->getEbookData() as $index => $value) {
            Ebook::create(array_merge($value, ['guru_nuptk' => $guruNuptks[$index % count($guruNuptks)]]));
        }
    }

    private function getEbookData()
    {
        return [
            ['judul' => 'Pertemuan 1', 'file'=> 'pertemuan1.pdf'],
            ['judul' => 'Pertemuan 1', 'file'=> 'pertemuan1.pdf'],
            ['judul' => 'Pertemuan 1', 'file'=> 'pertemuan1.pdf'],
            ['judul' => 'Pertemuan 1', 'file'=> 'pertemuan1.pdf'],
            ['judul' => 'Pertemuan 1', 'file'=> 'pertemuan1.pdf'],
            ['judul' => 'Pertemuan 1', 'file'=> 'pertemuan1.pdf'],
            ['judul' => 'Pertemuan 1', 'file'=> 'pertemuan1.pdf'],
            ['judul' => 'Pertemuan 1', 'file'=> 'pertemuan1.pdf'],
            ['judul' => 'Pertemuan 1', 'file'=> 'pertemuan1.pdf'],
            ['judul' => 'Pertemuan 1', 'file'=> 'pertemuan1.pdf'],
            ['judul' => 'Pertemuan 1', 'file'=> 'pertemuan1.pdf'],
            ['judul' => 'Pertemuan 1', 'file'=> 'pertemuan1.pdf'],
            ['judul' => 'Pertemuan 1', 'file'=> 'pertemuan1.pdf'],
            ['judul' => 'Pertemuan 1', 'file'=> 'pertemuan1.pdf'],
            ['judul' => 'Pertemuan 1', 'file'=> 'pertemuan1.pdf'],
            ['judul' => 'Pertemuan 1', 'file'=> 'pertemuan1.pdf'],
            ['judul' => 'Pertemuan 1', 'file'=> 'pertemuan1.pdf'],
            ['judul' => 'Pertemuan 1', 'file'=> 'pertemuan1.pdf'],
        ];
    }
}
