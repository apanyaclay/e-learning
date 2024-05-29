<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Guru;
use App\Models\Siswa;
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
        User::factory(21)->create()->each(function ($user) {
            Guru::factory()->create(['user_id' => $user->id, 'nama' => $user->username]);
        });
        User::factory(50)->create()->each(function ($user) {
            Siswa::factory()->create(['user_id' => $user->id, 'nama' => $user->username]);
        });
        $this->updateUserRoles();
    }
    private function updateUserRoles(): void
    {
        // Ambil semua user
        $users = User::all();

        foreach ($users as $user) {
            if (Guru::where('user_id', $user->id)->exists()) {
                $user->role = 'guru';
            } elseif (Siswa::where('user_id', $user->id)->exists()) {
                $user->role = 'siswa';
            }
            $user->save();
        }
    }
}
