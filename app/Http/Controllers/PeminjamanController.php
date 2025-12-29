<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Storage;

class PeminjamanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'alat_id'     => ['required', 'exists:alats,id'],
            'tgl_pinjam'  => ['required', 'date'],
            'tgl_kembali' => ['required', 'date', 'after_or_equal:tgl_pinjam'],
            'keperluan'   => ['nullable', 'string', 'max:255'],
            'bukti_ktm'   => ['required', 'image', 'max:2048'],
        ]);

        $pathKtm = $request->file('bukti_ktm')->store('ktm', 'public');

        Peminjaman::create([
            'user_id'     => auth()->id(),
            'alat_id'     => $request->alat_id,
            'tgl_pinjam'  => $request->tgl_pinjam,
            'tgl_kembali' => $request->tgl_kembali,
            'keperluan'   => $request->keperluan,
            'bukti_ktm'   => $pathKtm,
            'status'      => 'pending',
        ]);

        return back()->with('success', 'Pengajuan peminjaman berhasil dikirim.');
    }

    // ✅ INI FIX: mahasiswa lain gak bisa kembalikan punya orang
    public function kembalikan(Request $request, $id)
    {
        $user = auth()->user();

        // Pastikan yang akses mahasiswa & peminjaman milik dia sendiri
        $peminjaman = Peminjaman::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        // Aturan: hanya boleh kembalikan kalau status disetujui
        if ($peminjaman->status !== 'disetujui') {
            return back()->with('error', 'Peminjaman ini tidak bisa dikembalikan (status tidak valid).');
        }

        $peminjaman->status = 'kembali';
        $peminjaman->save();

        return back()->with('success', 'Berhasil mengajukan pengembalian. Tunggu verifikasi admin.');
    }
}
