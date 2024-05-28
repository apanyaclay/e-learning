<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nip' => $this->faker->numerify('#########'),
            'user_id' => User::factory(), // Relasi ke User
            'nama' => 'Administrator',
            "alamat"=> "Jl. Thamrin 2",
            "no_hp"=> "08123456789",
            "jenis_kelamin"=> "L",
            "tempat_lahir"=> "Medan",
            "tanggal_lahir"=> "2024-05-01",
            "tentang"=> "Saya adalah seorang admin di sekolah E-Learning",
            "agama"=> "Islam",
            "foto"=> "avatar-03.jpg",
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
