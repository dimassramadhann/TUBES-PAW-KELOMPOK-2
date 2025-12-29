<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk menambah opsi 'selesai' pada kolom status.
     */
    public function up(): void
    {
        // Menggunakan Raw SQL karena mengubah tipe ENUM lebih aman dilakukan langsung ke database
        DB::statement("ALTER TABLE peminjamans MODIFY COLUMN status ENUM('pending', 'disetujui', 'ditolak', 'kembali', 'selesai') NOT NULL DEFAULT 'pending'");
    }

    /**
     * Kembalikan perubahan jika migration di-rollback.
     */
    public function down(): void
    {
        // Kembalikan ke opsi awal tanpa 'selesai'
        DB::statement("ALTER TABLE peminjamans MODIFY COLUMN status ENUM('pending', 'disetujui', 'ditolak', 'kembali') NOT NULL DEFAULT 'pending'");
    }
};
