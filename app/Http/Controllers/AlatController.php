<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlatController extends Controller
{
    public function index()
    {
        $alats = Alat::all();
        return view('admin.alat.index', compact('alats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required',
            'kode_alat' => 'required|unique:alats',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('foto')->store('alat', 'public');

        Alat::create([
            'nama_alat' => $request->nama_alat,
            'kode_alat' => $request->kode_alat,
            'foto' => $path,
            'kondisi' => 'baik',
        ]);

        return redirect()->route('admin.alat.index')->with('success', 'Alat berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $alat = Alat::findOrFail($id);
        Storage::disk('public')->delete($alat->foto);
        $alat->delete();

        return redirect()->route('admin.alat.index')->with('success', 'Alat berhasil dihapus!');
    }
}

