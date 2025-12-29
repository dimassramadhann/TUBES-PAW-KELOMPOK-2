@extends('layouts.app')

@section('title', 'Daftar Alat Tersedia')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"><i class="bi bi-tools me-2"></i>Daftar Alat Tersedia</h4>
            </div>
            <div class="card-body">
                <p class="mb-0">Berikut adalah daftar alat-alat kampus yang dapat dipinjam. Pastikan untuk memeriksa ketersediaan alat pada tanggal yang diinginkan.</p>
            </div>
        </div>
    </div>
</div>

@if($alats->isEmpty())
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="bi bi-inbox display-1 text-muted mb-3"></i>
                <h4 class="text-muted">Belum ada alat yang tersedia</h4>
                <p class="text-muted">Silakan hubungi admin untuk informasi lebih lanjut.</p>
            </div>
        </div>
    </div>
</div>
@else
<div class="row">
    @foreach($alats as $alat)
    <div class="col-md-4 mb-4">
        <div class="card alat-card h-100">
            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px; overflow: hidden;">
                @if($alat->foto)
                    <img src="{{ Storage::url($alat->foto) }}" alt="{{ $alat->nama_alat }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <i class="bi bi-tools display-4 text-muted"></i>
                @endif
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $alat->nama_alat }}</h5>
                <p class="card-text">
                    <strong><i class="bi bi-tag me-1"></i>Kode:</strong> {{ $alat->kode }}<br>
                    <strong><i class="bi bi-clipboard-check me-1"></i>Kondisi:</strong>
                    <span class="badge bg-{{ $alat->kondisi == 'baik' ? 'success' : ($alat->kondisi == 'rusak' ? 'danger' : 'warning') }}">
                        {{ ucfirst(str_replace('_', ' ', $alat->kondisi)) }}
                    </span><br>
                    <strong><i class="bi bi-info-circle me-1"></i>Status:</strong>
                    <span class="badge bg-{{ $alat->status == 'Tersedia' ? 'success' : 'warning' }}">
                        {{ $alat->status }}
                    </span>
                </p>
                @if($alat->deskripsi)
                    <p class="card-text">{{ Str::limit($alat->deskripsi, 100) }}</p>
                @endif
            </div>
            <div class="card-footer bg-white border-top-0">
                <a href="{{ route('peminjaman.create') }}" class="btn btn-primary w-100">
                    <i class="bi bi-plus-circle me-1"></i>Pinjam Alat Ini
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection
