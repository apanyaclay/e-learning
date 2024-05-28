<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Kuis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KuisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $guruNuptks = Guru::pluck('nuptk')->toArray();

        foreach ($this->getEbookData() as $index => $value) {
            Kuis::create(array_merge($value, ['guru_nuptk' => $guruNuptks[$index % count($guruNuptks)]]));
        }
    }

    private function getEbookData()
    {
        return [
            ['nama' => 'Kuis 1', 'tenggat'=> '2024-05-26 20:50:00', 'durasi' => '60', 'pertemuan_id' => '1'],
            ['nama' => 'Kuis 1', 'tenggat'=> '2024-05-26 20:51:00', 'durasi' => '60', 'pertemuan_id' => '2'],
            ['nama' => 'Kuis 1', 'tenggat'=> '2024-05-26 20:52:00', 'durasi' => '60', 'pertemuan_id' => '3'],
            ['nama' => 'Kuis 1', 'tenggat'=> '2024-05-26 20:53:00', 'durasi' => '60', 'pertemuan_id' => '4'],
        ];
    }
}
