@extends('layouts.app')
@section('title', 'Kelola Peminjaman')

@section('content')
<div class="card">
    <div class="card-header text-white"><i class="bi bi-clipboard-check"></i> Persetujuan Peminjaman</div>
    <div class="card-body">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Mahasiswa</th>
                    <th>Alat</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjamans as $p)
                <tr>
                    <td>{{ $p->user->name }}</td>
                    <td>{{ $p->alat->nama_alat }}</td>
                    <td>{{ $p->tgl_pinjam }} s/d {{ $p->tgl_kembali }}</td>
                    <td><span class="badge bg-warning">{{ $p->status }}</span></td>
                    <td>
                        @if($p->status == 'pending')
                        <form action="{{ route('peminjaman.status', $p->id) }}" method="POST" class="d-inline">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="disetujui">
                            <button class="btn btn-success btn-sm">Setujui</button>
                        </form>
                        <form action="{{ route('peminjaman.status', $p->id) }}" method="POST" class="d-inline">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="ditolak">
                            <button class="btn btn-danger btn-sm">Tolak</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
