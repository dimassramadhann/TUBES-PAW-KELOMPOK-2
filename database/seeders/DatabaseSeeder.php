<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Alat;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat admin
        User::create([
            'name' => 'Admin TU',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Buat mahasiswa
        User::create([
            'name' => 'Mahasiswa 1',
            'email' => 'mahasiswa1@example.com',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
            'nim' => '12345678',
        ]);

        User::create([
            'name' => 'Mahasiswa 2',
            'email' => 'mahasiswa2@example.com',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
            'nim' => '87654321',
        ]);

        // Buat data alat
        $alats = [
            [
                'kode' => 'PROJ001',
                'nama_alat' => 'Proyektor Epson',
                'kondisi' => 'baik',
                'deskripsi' => 'Proyektor dengan resolusi HD 1080p, cocok untuk presentasi kelas besar.',
            ],
            [
                'kode' => 'HDMI001',
                'nama_alat' => 'Kabel HDMI 5m',
                'kondisi' => 'baik',
                'deskripsi' => 'Kabel HDMI panjang 5 meter, kualitas tinggi untuk presentasi.',
            ],
            [
                'kode' => 'SOUND001',
                'nama_alat' => 'Speaker Portable',
                'kondisi' => 'baik',
                'deskripsi' => 'Speaker bluetooth dengan baterai tahan lama hingga 8 jam.',
            ],
            [
                'kode' => 'LAPTOP001',
                'nama_alat' => 'Laptop Asus',
                'kondisi' => 'sedang_diperbaiki',
                'deskripsi' => 'Laptop untuk presentasi, sedang dalam perbaikan keyboard.',
            ],
            [
                'kode' => 'MIC001',
                'nama_alat' => 'Microphone Wireless',
                'kondisi' => 'baik',
                'deskripsi' => 'Microphone wireless dengan jangkauan 50 meter.',
            ],
            [
                'kode' => 'TRIPOD001',
                'nama_alat' => 'Tripod Kamera',
                'kondisi' => 'rusak',
                'deskripsi' => 'Tripod untuk kamera, salah satu kakinya patah.',
            ],
        ];

        foreach ($alats as $alat) {
            Alat::create($alat);
        }

        // Buat beberapa data peminjaman untuk testing
        $peminjaman = [
            [
                'user_id' => 2, // Mahasiswa 1
                'alat_id' => 1, // Proyektor
                'tanggal_pinjam' => now()->addDays(2)->format('Y-m-d'),
                'tanggal_kembali' => now()->addDays(5)->format('Y-m-d'),
                'status' => 'menunggu',
                'alasan_peminjaman' => 'Untuk presentasi tugas akhir di ruang seminar.',
                'bukti_peminjaman' => null,
            ],
            [
                'user_id' => 3, // Mahasiswa 2
                'alat_id' => 2, // Kabel HDMI
                'tanggal_pinjam' => now()->addDays(3)->format('Y-m-d'),
                'tanggal_kembali' => now()->addDays(4)->format('Y-m-d'),
                'status' => 'disetujui',
                'alasan_peminjaman' => 'Untuk presentasi mata kuliah multimedia.',
                'bukti_peminjaman' => null,
            ],
        ];

        foreach ($peminjaman as $data) {
            \App\Models\Peminjaman::create($data);
        }
    }
}
