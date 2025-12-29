<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    /**
     * FIELD YANG BOLEH DIISI (MASS ASSIGNMENT)
     *
     * ⛔ TIDAK MENGHAPUS FIELD LAMA
     * ➕ MENAMBAHKAN: stok, deskripsi
     */
    protected $fillable = [
        'nama_alat',
        'kode_alat',
        'kondisi',
        'foto',
    ];

    /**
     * RELASI
     * Satu alat bisa memiliki banyak peminjaman
     */
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
