<?php

namespace Database\Seeders;

use App\Models\Soal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SoalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Soal::create([
            "kuis_id"=> "1",
            "pertanyaan"=> "pertanyaan pertama",
            "opsi_a"=> "AA",
            "opsi_b"=> "BB",
            "opsi_c"=> "CC",
            "opsi_d"=> "DD",
            "opsi_benar"=> "A",
            "bobot"=> "10",
        ]);
        Soal::create([
            "kuis_id"=> "1",
            "pertanyaan"=> "pertanyaan kedua",
            "opsi_a"=> "AA",
            "opsi_b"=> "BB",
            "opsi_c"=> "CC",
            "opsi_d"=> "DD",
            "opsi_benar"=> "D",
            "bobot"=> "10",
        ]);
        Soal::create([
            "kuis_id"=> "1",
            "pertanyaan"=> "pertanyaan ketiga",
            "opsi_a"=> "AA",
            "opsi_b"=> "BB",
            "opsi_c"=> "CC",
            "opsi_d"=> "DD",
            "opsi_benar"=> "D",
            "bobot"=> "10",
        ]);
        Soal::create([
            "kuis_id"=> "1",
            "pertanyaan"=> "pertanyaan keempat",
            "opsi_a"=> "AA",
            "opsi_b"=> "BB",
            "opsi_c"=> "CC",
            "opsi_d"=> "DD",
            "opsi_benar"=> "A",
            "bobot"=> "10",
        ]);
        Soal::create([
            "kuis_id"=> "1",
            "pertanyaan"=> "pertanyaan kelima",
            "opsi_a"=> "AA",
            "opsi_b"=> "BB",
            "opsi_c"=> "CC",
            "opsi_d"=> "DD",
            "opsi_benar"=> "C",
            "bobot"=> "10",
        ]);
        Soal::create([
            "kuis_id"=> "1",
            "pertanyaan"=> "pertanyaan keenam",
            "opsi_a"=> "AA",
            "opsi_b"=> "BB",
            "opsi_c"=> "CC",
            "opsi_d"=> "DD",
            "opsi_benar"=> "B",
            "bobot"=> "10",
        ]);
        Soal::create([
            "kuis_id"=> "1",
            "pertanyaan"=> "pertanyaan ketujuh",
            "opsi_a"=> "AA",
            "opsi_b"=> "BB",
            "opsi_c"=> "CC",
            "opsi_d"=> "DD",
            "opsi_benar"=> "A",
            "bobot"=> "10",
        ]);
        Soal::create([
            "kuis_id"=> "1",
            "pertanyaan"=> "pertanyaan kedelapan",
            "opsi_a"=> "AA",
            "opsi_b"=> "BB",
            "opsi_c"=> "CC",
            "opsi_d"=> "DD",
            "opsi_benar"=> "C",
            "bobot"=> "10",
        ]);
        Soal::create([
            "kuis_id"=> "1",
            "pertanyaan"=> "pertanyaan kesembilan",
            "opsi_a"=> "AA",
            "opsi_b"=> "BB",
            "opsi_c"=> "CC",
            "opsi_d"=> "DD",
            "opsi_benar"=> "B",
            "bobot"=> "10",
        ]);
        Soal::create([
            "kuis_id"=> "1",
            "pertanyaan"=> "pertanyaan kesepuluh",
            "opsi_a"=> "AA",
            "opsi_b"=> "BB",
            "opsi_c"=> "CC",
            "opsi_d"=> "DD",
            "opsi_benar"=> "D",
            "bobot"=> "10",
        ]);
    }
}
