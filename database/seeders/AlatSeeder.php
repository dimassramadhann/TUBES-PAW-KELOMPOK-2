<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alat;

class AlatSeeder extends Seeder
{
    public function run(): void
    {
        $alats = [
            [
                'kode' => 'PROJ001',
                'nama_alat' => 'Proyektor Epson',
                'kondisi' => 'baik',
                'deskripsi' => 'Proyektor dengan resolusi HD, cocok untuk presentasi.',
            ],
            [
                'kode' => 'HDMI001',
                'nama_alat' => 'Kabel HDMI 5m',
                'kondisi' => 'baik',
                'deskripsi' => 'Kabel HDMI panjang 5 meter, kualitas tinggi.',
            ],
            [
                'kode' => 'SOUND001',
                'nama_alat' => 'Speaker Portable',
                'kondisi' => 'baik',
                'deskripsi' => 'Speaker bluetooth dengan baterai tahan lama.',
            ],
            [
                'kode' => 'LAPTOP001',
                'nama_alat' => 'Laptop Asus',
                'kondisi' => 'sedang_diperbaiki',
                'deskripsi' => 'Laptop untuk presentasi, sedang dalam perbaikan.',
            ],
        ];

        foreach ($alats as $alat) {
            Alat::create($alat);
        }
    }
}
