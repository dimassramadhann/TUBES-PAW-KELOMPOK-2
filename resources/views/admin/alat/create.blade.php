@extends('layouts.app')

@section('title', 'Tambah Alat Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Alat Baru
                </h4>
            </div>

            <div class="card-body">
                <form method="POST"
                      action="{{ route('admin.alat.store') }}"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <!-- KODE ALAT -->
                        <div class="col-md-6 mb-3">
                            <label for="kode_alat" class="form-label">
                                <i class="bi bi-tag me-1"></i>Kode Alat
                            </label>
                            <input type="text"
                                   class="form-control @error('kode_alat') is-invalid @enderror"
                                   id="kode_alat"
                                   name="kode_alat"
                                   value="{{ old('kode_alat') }}"
                                   placeholder="Contoh: PROJ001"
                                   required>
                            @error('kode_alat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Kode unik untuk alat</div>
                        </div>

                        <!-- NAMA ALAT -->
                        <div class="col-md-6 mb-3">
                            <label for="nama_alat" class="form-label">
                                <i class="bi bi-tools me-1"></i>Nama Alat
                            </label>
                            <input type="text"
                                   class="form-control @error('nama_alat') is-invalid @enderror"
                                   id="nama_alat"
                                   name="nama_alat"
                                   value="{{ old('nama_alat') }}"
                                   placeholder="Contoh: Proyektor Epson"
                                   required>
                            @error('nama_alat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- KONDISI -->
                        <div class="col-md-6 mb-3">
                            <label for="kondisi" class="form-label">
                                <i class="bi bi-clipboard-check me-1"></i>Kondisi
                            </label>
                            <select class="form-select @error('kondisi') is-invalid @enderror"
                                    id="kondisi"
                                    name="kondisi"
                                    required>
                                <option value="">-- Pilih Kondisi --</option>
                                <option value="baik" {{ old('kondisi') == 'baik' ? 'selected' : '' }}>Baik</option>
                                <option value="kurang baik" {{ old('kondisi') == 'kurang baik' ? 'selected' : '' }}>Kurang Baik</option>

                            </select>
                            @error('kondisi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- FOTO -->
                    <div class="mb-3">
                        <label for="foto" class="form-label">
                            <i class="bi bi-image me-1"></i>Foto Alat (Opsional)
                        </label>
                        <input type="file"
                               class="form-control @error('foto') is-invalid @enderror"
                               id="foto"
                               name="foto"
                               accept=".jpg,.jpeg,.png">
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Format: JPG, PNG (max: 2MB)</div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('admin.alat.index') }}"
                           class="btn btn-secondary me-md-2">
                            <i class="bi bi-arrow-left me-1"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i>Simpan Alat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
