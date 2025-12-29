<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('alat_id')->constrained('alats')->cascadeOnDelete();

            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');

            $table->string('status')->default('pending');
            // opsi status: pending, disetujui, ditolak, kembali, selesai

            $table->text('keperluan')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('ktm_path')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
