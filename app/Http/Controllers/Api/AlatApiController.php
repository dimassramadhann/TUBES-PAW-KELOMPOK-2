<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use Illuminate\Http\Request;

class AlatApiController extends Controller
{
    /**
     * Menampilkan daftar semua alat.
     */
    public function index()
    {
        $alats = Alat::all();

        return response()->json([
            'status'  => 'success',
            'message' => 'Berhasil mengambil daftar alat',
            'count'   => $alats->count(),
            'data'    => $alats
        ], 200);
    }

    /**
     * Menampilkan detail satu alat berdasarkan ID.
     */
    public function show($id)
    {
        $alat = Alat::find($id);

        if (!$alat) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Alat tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Detail Alat: ' . $alat->nama_alat,
            'data'    => $alat
        ], 200);
    }
}
