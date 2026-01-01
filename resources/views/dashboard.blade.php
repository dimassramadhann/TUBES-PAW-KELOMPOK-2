@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('ui/pages/dashboard.css') }}">
@endpush

@section('content')
<div class="animate__animated animate__fadeIn">

    <div class="row mb-5 align-items-center">
        <div class="col-md-8">
            <h2 class="dashboard-title">
    <span style="color:#E63946;font-weight:800;">Tel</span><span style="color:#6c757d;font-weight:800;">U</span>
    <span style="color:#6c757d;font-weight:800;">Inventory</span>
    <span style="color:#000;font-weight:800;">Dashboard</span>
</h2>
            <p class="dashboard-subtitle">
    Halo
    <span style="color:#000;font-weight:800;">
        {{ auth()->user()->name }}
    </span>,
    @if(auth()->user()->role === 'admin')
        selamat mengelola dan memverifikasi inventaris.
    @else
        lagi mau pinjam alat apa?
    @endif
</p>


        </div>
    </div>

    {{-- ERROR VALIDATION (BIAR KEBACA DI ATAS) --}}
    @if($errors->any())
        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
            <b>Terjadi kesalahan:</b>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
            {{ session('error') }}
        </div>
    @endif

    @can('admin')
        <div class="row g-4 mb-5 text-white text-center dashboard-stats">
            <div class="col-md-3">
                <div class="stat-card stat-primary">
                    <h6>REQ</h6>
                    <h2>{{ $stats['total'] ?? 0 }}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card stat-warning text-dark">
                    <h6>PENDING</h6>
                    <h2>{{ $stats['pending'] ?? 0 }}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card stat-success">
                    <h6>AKTIF</h6>
                    <h2>{{ $stats['aktif'] ?? 0 }}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card stat-info">
                    <h6>KEMBALI</h6>
                    <h2>{{ $stats['kembali'] ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <div class="card dashboard-card border-0 shadow-sm rounded-4 mb-5 overflow-hidden">
            <div class="dashboard-card-header">
                <i class="bi bi-shield-check me-2 text-warning"></i> Antrean Verifikasi Admin
            </div>

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
    <tr>
        <th>Mahasiswa</th>
        <th>Alat</th>
        <th>Durasi Peminjaman</th>
        <th>Bukti KTM</th>
        <th>Keperluan</th>
        <th>Verifikasi</th>
    </tr>
</thead>



                    <tbody>
                        @forelse(($riwayat ?? collect())->whereIn('status', ['pending', 'kembali']) as $r)
                            <tr>
                                <td class="fw-bold">{{ $r->user->name ?? '-' }}</td>
                                <td>
    <span class="badge bg-light text-danger border">
        {{ $r->alat->nama_alat }}
    </span>

    <div class="text-muted fw-semibold mt-1"
         style="font-size: 0.75rem;">
        ID: {{ $r->alat->kode_alat }}
    </div>
</td>
                                <td>
                                    <small class="fw-bold">
                                        {{ optional($r->tgl_pinjam)->format('d M') ?? '-' }}
                                        —
                                        {{ optional($r->tgl_kembali)->format('d M Y') ?? '-' }}
                                    </small>
                                </td>

                                <td>
    @if($r->bukti_ktm)
        <a href="{{ asset('storage/'.$r->bukti_ktm) }}"
           target="_blank"
           class="btn btn-sm btn-outline-primary rounded-pill">
            <i class="bi bi-card-image me-1"></i> Lihat KTM
        </a>
    @else
        <span class="text-muted">Tidak ada</span>
    @endif
</td>
{{-- KEPELUAN --}}
<td style="max-width:260px;">
    <span class="fw-bold text-dark small">
        {{ $r->keperluan ?? '-' }}
    </span>
</td>
                                <td>
                                    @if($r->status == 'pending')
                                        <div class="d-flex gap-2">
                                            <form action="{{ route('admin.peminjaman.status', $r->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="disetujui">
                                                <button class="btn btn-sm btn-success rounded-pill px-3 shadow-sm">SETUJU</button>
                                            </form>

                                            <form action="{{ route('admin.peminjaman.status', $r->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="ditolak">
                                                <button class="btn btn-sm btn-outline-danger rounded-pill px-3">TOLAK</button>
                                            </form>
                                        </div>
                                    @elseif($r->status == 'kembali')
                                        <form action="{{ route('admin.peminjaman.status', $r->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="selesai">
                                            <button class="btn btn-sm btn-primary rounded-pill px-4 shadow-sm">SELESAIKAN</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
<tr>
    <td colspan="6" class="text-center py-5 text-muted fw-semibold">
        Tidak ada pengajuan baru.
    </td>
</tr>
@endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endcan

    <div class="row g-4">
        <div class="col-lg-8">
            <h4 class="fw-800 mb-4">
                <i class="bi bi-box-seam me-2 text-danger"></i> Katalog Inventaris
            </h4>

            <div class="row g-4 mb-5">
                @foreach($alats as $alat)
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-4 h-100 p-3 d-flex flex-column inventory-card">
                            <div class="inventory-thumb position-relative">
                                <img
                                    src="{{ asset('storage/'.$alat->foto) }}"
                                    class="inventory-image"
                                    onerror="this.src='https://placehold.co/400'">
                                <span
    class="position-absolute bottom-0 start-0 m-2 px-2 py-1 rounded-pill text-white fw-semibold
        {{ $alat->kondisi === 'baik' ? 'bg-success' : 'bg-danger' }}"
    style="font-size: 0.7rem;">
    Kondisi Alat :
    {{ $alat->kondisi === 'baik' ? 'Baik' : 'Kurang Baik' }}
</span>
                                @php
                                    $isUsed = $alat->peminjamans
                                        ->whereIn('status', ['pending','disetujui','kembali'])
                                        ->count() > 0;
                                @endphp


                            </div>

                            <h5 class="fw-bold mb-1">{{ $alat->nama_alat }}</h5>
                            <small class="text-muted mb-3">ID: {{ $alat->kode_alat }}</small>

                            @if(Auth::user()->role == 'mahasiswa')
                                <button class="btn btn-red w-100 mt-auto py-2 shadow-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modal{{$alat->id}}">
                                    <i class="bi bi-calendar-plus me-2"></i> Ajukan Pinjam
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @if(Auth::user()->role == 'mahasiswa')
            <div class="col-lg-4">
                <h4 class="fw-800 mb-4 text-primary">
                    <i class="bi bi-clock-history me-2"></i> Aktivitas Saya
                </h4>

                @forelse($riwayat ?? [] as $r)
                    @php
                        $statusColor = $r->status == 'pending' ? 'warning' : ($r->status == 'selesai' ? 'dark' : 'success');
                    @endphp

                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-3 border-start border-5 border-{{ $statusColor }}
                        animate__animated animate__fadeInUp">
                        <div class="d-flex justify-content-between align-items-start mb-2">
    <div>
        <h6 class="fw-800 m-0 text-dark">
            {{ $r->alat->nama_alat ?? '-' }}
        </h6>

        <small class="text-muted fw-semibold" style="font-size:0.75rem;">
            ID: {{ $r->alat->kode_alat ?? '-' }}
        </small>
    </div>

    <span class="badge bg-{{ $statusColor }} rounded-pill">
        {{ strtoupper($r->status) }}
    </span>
</div>

                        <small class="text-muted d-block mb-3">
                            <i class="bi bi-calendar2-week me-1"></i>
                            {{ optional($r->tgl_pinjam)->format('d M') ?? '-' }}
                            —
                            {{ optional($r->tgl_kembali)->format('d M Y') ?? '-' }}
                        </small>

                        {{-- tombol kembalikan hanya tampil kalau route ada --}}
                        @if($r->status == 'disetujui' && \Illuminate\Support\Facades\Route::has('peminjaman.kembalikan'))
                            <form action="{{ route('peminjaman.kembalikan', $r->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-outline-primary w-100 rounded-pill fw-bold shadow-sm py-2">
                                    Kembalikan Sekarang
                                </button>
                            </form>
                        @endif
                    </div>
                @empty
                    <div class="text-center py-5 text-muted border border-dashed rounded-4">
                        Belum ada riwayat.
                    </div>
                @endforelse
            </div>
        @endif
    </div>
</div>

{{-- MODAL PINJAM --}}
@foreach($alats as $alat)
<div class="modal fade" id="modal{{$alat->id}}" tabindex="-1" aria-hidden="true" data-bs-backdrop="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('pinjam.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="alat_id" value="{{$alat->id}}">

            <div class="modal-content rounded-5 border-0 shadow-lg">
                <div class="modal-header border-0 pb-0 pt-4 px-4">
                    <h5 class="fw-800 text-dark">Booking: {{ $alat->nama_alat }}</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-4 pt-2">
                    <div class="mb-4">
                        <label class="fw-bold small text-muted text-uppercase mb-2">Rentang Tanggal Pinjam</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0">
                                <i class="bi bi-calendar-event text-danger"></i>
                            </span>
                            <input type="text"
                                   id="range_{{$alat->id}}"
                                   class="form-control bg-light border-0 p-3 shadow-none ui-date-range"
                                   placeholder="Pilih tanggal di kalender..."
                                   required readonly>
                        </div>
                        <input type="hidden" name="tgl_pinjam" id="start_{{$alat->id}}">
                        <input type="hidden" name="tgl_kembali" id="end_{{$alat->id}}">
                    </div>

                    {{-- WAJIB: KEPERLUAN --}}
                    <div class="mb-4">
                        <label class="fw-bold small text-muted text-uppercase mb-2">Keperluan</label>
                        <textarea name="keperluan" class="form-control rounded-4 p-3 bg-light border-0 shadow-none"
                                  rows="3" placeholder="Contoh: Presentasi mata kuliah / Kegiatan UKM / dll" required></textarea>
                    </div>

                    {{-- FILE KTM (kalau controller + DB sudah support) --}}
                    <div class="mb-4">
                        <label class="fw-bold small text-muted text-uppercase mb-2">Unggah Foto KTM (Maks 2MB)</label>
                        <input type="file" name="bukti_ktm" class="form-control rounded-4 p-3 bg-light border-0 shadow-none" required>
                        <small class="text-muted d-block mt-2">Format: JPG/PNG/PDF</small>
                    </div>

                    <button type="submit" class="btn btn-red w-100 py-3 rounded-4 shadow-lg">
                        KIRIM PENGAJUAN PINJAM
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach

@push('scripts')
<script>
$(document).ready(function() {
    @foreach($alats as $alat)
    flatpickr("#range_{{$alat->id}}", {
        mode: "range",
        minDate: "today",
        dateFormat: "Y-m-d",
        static: true,
        disable: [
            @foreach($alat->peminjamans->whereIn('status',['pending','disetujui','kembali']) as $p)
                { from: "{{$p->tgl_pinjam->format('Y-m-d')}}", to: "{{$p->tgl_kembali->format('Y-m-d')}}" },
            @endforeach
        ],
        onChange: function(dates, str, instance) {
            if (dates.length === 2) {
                $("#start_{{$alat->id}}").val(instance.formatDate(dates[0], "Y-m-d"));
                $("#end_{{$alat->id}}").val(instance.formatDate(dates[1], "Y-m-d"));
            }
        }
    });
    @endforeach
});
</script>
@endpush

@endsection
