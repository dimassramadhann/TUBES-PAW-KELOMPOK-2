<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;

class PeminjamanAdminController extends Controller
{
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', 'in:disetujui,ditolak,kembali,selesai,pending'],
        ]);

        $p = Peminjaman::findOrFail($id);
        $p->status = $request->status;
        $p->save();

        return back()->with('success', 'Status peminjaman berhasil diupdate.');
    }
}
