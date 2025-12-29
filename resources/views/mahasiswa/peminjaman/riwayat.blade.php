@extends('layouts.app')

@section('title', 'Riwayat Peminjaman')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"><i class="bi bi-clock-history me-2"></i>Riwayat Peminjaman Saya</h4>
            </div>
            <div class="card-body">
                <p class="mb-0">Berikut adalah riwayat peminjaman alat yang telah Anda ajukan.</p>
            </div>
        </div>
    </div>
</div>

@if($peminjaman->isEmpty())
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="bi bi-inbox display-1 text-muted mb-3"></i>
                <h4 class="text-muted">Belum ada riwayat peminjaman</h4>
                <p class="text-muted">Ajukan peminjaman pertama Anda sekarang.</p>
                <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i>Ajukan Peminjaman
                </a>
            </div>
        </div>
    </div>
</div>
@else
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Alat</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                                <th>Waktu Pengajuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peminjaman as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $item->alat->nama_alat }}</strong><br>
                                    <small class="text-muted">Kode: {{ $item->alat->kode }}</small>
                                </td>
                                <td>{{ $item->tanggal_pinjam->format('d/m/Y') }}</td>
                                <td>{{ $item->tanggal_kembali->format('d/m/Y') }}</td>
                                <td>
                                    @php
                                        $badge = [
                                            'menunggu' => 'warning',
                                            'disetujui' => 'success',
                                            'ditolak' => 'danger',
                                            'dikembalikan' => 'info'
                                        ][$item->status];
                                        $icon = [
                                            'menunggu' => 'bi-clock',
                                            'disetujui' => 'bi-check-circle',
                                            'ditolak' => 'bi-x-circle',
                                            'dikembalikan' => 'bi-arrow-return-left'
                                        ][$item->status];
                                    @endphp
                                    <span class="badge bg-{{ $badge }}">
                                        <i class="bi {{ $icon }} me-1"></i>{{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    @if($item->bukti_peminjaman)
                                    <a href="{{ Storage::url($item->bukti_peminjaman) }}"
                                       target="_blank"
                                       class="btn btn-sm btn-outline-primary"
                                       title="Lihat Bukti">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    <div class="alert alert-light border">
                        <h6><i class="bi bi-info-circle me-2"></i>Keterangan Status:</h6>
                        <div class="d-flex flex-wrap gap-2 mt-2">
                            <span class="badge bg-warning"><i class="bi bi-clock me-1"></i>Menunggu</span>
                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Disetujui</span>
                            <span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>Ditolak</span>
                            <span class="badge bg-info"><i class="bi bi-arrow-return-left me-1"></i>Dikembalikan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
