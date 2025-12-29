@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('ui/pages/admin-alat.css') }}">
@endpush

@section('content')
<div class="container py-4">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h3 class="fw-800 mb-1">Kelola Alat</h3>
            <p class="text-muted mb-0">Daftar alat yang ada di inventaris.</p>
        </div>

        <a href="{{ route('admin.alat.create') }}"
           class="btn btn-primary rounded-pill px-4">
            <i class="bi bi-plus-circle me-1"></i> Tambah Alat
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nama Alat</th>
                        <th>Kode</th>
                        <th>Foto Alat</th>
                        <th>Dibuat</th>
                        <th class="text-end">Edit atau Hapus</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($alats as $alat)
                        <tr>
                            <td class="fw-bold">{{ $alat->nama_alat }}</td>

                            <td>
                                <span class="badge bg-light text-dark border">
                                    {{ $alat->kode_alat }}
                                </span>
                            </td>

                            <td>
                                <img src="{{ asset('storage/'.$alat->foto) }}"
                                     onerror="this.src='https://placehold.co/80x60'"
                                     style="width:80px;height:60px;object-fit:cover;border-radius:12px;">
                            </td>

                            <td class="text-muted">
                                {{ $alat->created_at?->format('d M Y') }}
                            </td>

                            <!-- ✅ EDIT + DELETE -->
                            <td class="text-end">
                                <a href="{{ route('admin.alat.edit', $alat->id) }}"
                                   class="btn btn-sm btn-outline-primary rounded-pill px-3 me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form action="{{ route('admin.alat.destroy', $alat->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus alat ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                Belum ada data alat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>
@endsection
