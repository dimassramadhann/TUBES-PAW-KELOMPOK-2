<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $alats = Alat::with('peminjamans')->latest()->get();

        // Mahasiswa: riwayat hanya milik sendiri
        if ($user->role === 'mahasiswa') {
            $riwayat = Peminjaman::with(['alat'])
                ->where('user_id', $user->id)
                ->latest()
                ->get();

            $stats = []; // mahasiswa gak butuh statistik admin

        } else {
            // Admin: bisa lihat semua
            $riwayat = Peminjaman::with(['alat', 'user'])
                ->latest()
                ->get();

            $stats = [
                'total'   => Peminjaman::count(),
                'pending' => Peminjaman::where('status', 'pending')->count(),
                // AKTIF = disetujui + kembali (sesuai style kamu)
                'aktif'   => Peminjaman::whereIn('status', ['disetujui', 'kembali'])->count(),
                'kembali' => Peminjaman::where('status', 'kembali')->count(),
            ];
        }

        return view('dashboard', compact('alats', 'riwayat', 'stats'));
    }
}
