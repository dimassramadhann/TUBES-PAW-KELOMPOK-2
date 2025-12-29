<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            // taruh setelah tgl_kembali biar rapi
            if (!Schema::hasColumn('peminjamans', 'keperluan')) {
                $table->text('keperluan')->nullable()->after('tgl_kembali');
            }
        });
    }

    public function down(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            if (Schema::hasColumn('peminjamans', 'keperluan')) {
                $table->dropColumn('keperluan');
            }
        });
    }
};
