<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlatController extends Controller
{
    
    public function index()
    {
        $alats = Alat::latest()->get();
        return view('admin.alat.index', compact('alats'));
    }

    
    public function create()
    {
        return view('admin.alat.create');
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kode_alat' => 'required|string|max:100',
            'kondisi'   => 'required|string',
            'foto'      => 'nullable|image|max:2048',
        ]);

        $pathFoto = null;

        // ✅ SIMPAN FOTO (INI YANG SEBELUMNYA KURANG)
        if ($request->hasFile('foto')) {
            $pathFoto = $request->file('foto')->store('alat', 'public');
        }

        Alat::create([
            'nama_alat' => $request->nama_alat,
            'kode_alat' => $request->kode_alat,
            'kondisi'   => $request->kondisi,
            'foto'      => $pathFoto,
        ]);

        return redirect()
            ->route('admin.alat.index')
            ->with('success', 'Alat berhasil ditambahkan');
    }

    
    public function edit($id)
    {
        $alat = Alat::findOrFail($id);
        return view('admin.alat.edit', compact('alat'));
    }
public function destroy($id)
{
    $alat = Alat::findOrFail($id);

    if ($alat->foto && Storage::disk('public')->exists($alat->foto)) {
        Storage::disk('public')->delete($alat->foto);
    }

    $alat->delete();

    return redirect()
        ->route('admin.alat.index')
        ->with('success', 'Alat berhasil dihapus');
}

    
    public function update(Request $request, $id)
    {
        $alat = Alat::findOrFail($id);

        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kode_alat' => 'required|string|max:100',
            'kondisi'   => 'required|string',
            'foto'      => 'nullable|image|max:2048',
        ]);

        // default: pakai foto lama
        $pathFoto = $alat->foto;

        // kalau upload foto baru
        if ($request->hasFile('foto')) {
            // hapus foto lama (jika ada)
            if ($alat->foto && Storage::disk('public')->exists($alat->foto)) {
                Storage::disk('public')->delete($alat->foto);
            }

            $pathFoto = $request->file('foto')->store('alat', 'public');
        }

        $alat->update([
            'nama_alat' => $request->nama_alat,
            'kode_alat' => $request->kode_alat,
            'kondisi'   => $request->kondisi,
            'foto'      => $pathFoto,
        ]);

        return redirect()
            ->route('admin.alat.index')
            ->with('success', 'Alat berhasil diperbarui');
    }
}
