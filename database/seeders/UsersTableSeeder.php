<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'Admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role'=> 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        User::factory(18)->create()->each(function ($user) {
            Guru::factory()->create(['user_id' => $user->id]);
        });
        User::create([
            'username' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role'=> 'siswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
