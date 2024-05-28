<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nisn"=> $this->faker->numerify('#########'),
            "user_id"=> User::factory(),
            "kelas_id"=> $this->faker->randomElement(['1', '2', '3']),
            "jurusan_id"=> $this->faker->randomElement(['1', '2', '3', '4', '5', '6']),
            "nama"=> User::factory(),
            "alamat"=> $this->faker->address,
            "jenis_kelamin"=> $this->faker->randomElement(['P', 'L']),
            "tempat_lahir"=> $this->faker->city,
            "tanggal_lahir"=> $this->faker->date($format = 'Y-m-d', $max = 'now'),
            "agama"=> $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha']),
            "tentang"=> $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            "foto"=> $this->faker->randomElement(['avatar-01.jpg', 'avatar-02.jpg', 'avatar-04.jpg', 'avatar-05.jpg', 'avatar-06.jpg', 'avatar-07.jpg', 'avatar-08.jpg', 'avatar-09.jpg', 'avatar-10.jpg', 'avatar-11.jpg', 'avatar-12.jpg', 'avatar-13.jpg', 'avatar-14.jpg', 'avatar-15.jpg', 'avatar-16.jpg']),
        ];
    }
}
