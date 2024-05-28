<?php

namespace Database\Factories;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guru>
 */
class GuruFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Guru::class;
    public function definition(): array
    {
        return [
            'nuptk' => $this->faker->numerify('#########'),
            'user_id' => User::factory(), // Relasi ke User
            'nama' => User::factory(),
            "alamat"=> $this->faker->address,
            "no_hp"=> $this->faker->phoneNumber,
            "jenis_kelamin"=> $this->faker->randomElement(['P', 'L']),
            "tempat_lahir"=> $this->faker->city,
            "tanggal_lahir"=> $this->faker->date($format = 'Y-m-d', $max = 'now'),
            "tentang"=> $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            "agama"=> $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha']),
            "foto"=> $this->faker->randomElement(['avatar-01.jpg', 'avatar-02.jpg', 'avatar-04.jpg', 'avatar-05.jpg', 'avatar-06.jpg', 'avatar-07.jpg', 'avatar-08.jpg', 'avatar-09.jpg', 'avatar-10.jpg', 'avatar-11.jpg', 'avatar-12.jpg', 'avatar-13.jpg', 'avatar-14.jpg', 'avatar-15.jpg', 'avatar-16.jpg']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
