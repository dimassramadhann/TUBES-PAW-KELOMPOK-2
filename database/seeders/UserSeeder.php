<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Akun Admin
        User::create([
            'name'     => 'Admin TU',
            'email'    => 'admin@example.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
            'nim'      => null, // Admin tidak punya NIM
        ]);

        // Buat Akun Mahasiswa 1
        User::create([
            'name'     => 'Mahasiswa 1',
            'email'    => 'mahasiswa1@example.com',
            'password' => Hash::make('password'),
            'role'     => 'mahasiswa',
            'nim'      => '12345678',
        ]);

        // Buat Akun Mahasiswa 2
        User::create([
            'name'     => 'Mahasiswa 2',
            'email'    => 'mahasiswa2@example.com',
            'password' => Hash::make('password'),
            'role'     => 'mahasiswa',
            'nim'      => '87654321',
        ]);
    }
}
