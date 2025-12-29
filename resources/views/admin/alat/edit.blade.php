@extends('layouts.app')

@section('title', 'Edit Alat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="bi bi-pencil me-2"></i>Edit Alat: {{ $alat->nama_alat }}
                </h4>
            </div>

            <div class="card-body">
                <form method="POST"
                      action="{{ route('admin.alat.update', $alat->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

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
                                   value="{{ old('kode_alat', $alat->kode_alat) }}"
                                   required>
                            @error('kode_alat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
                                   value="{{ old('nama_alat', $alat->nama_alat) }}"
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
                                <option value="baik" {{ old('kondisi', $alat->kondisi) == 'baik' ? 'selected' : '' }}>Baik</option>
                                <option value="kurang baik" {{ old('kondisi', $alat->kondisi) == 'kurang baik' ? 'selected' : '' }}>Kurang Baik</option>

                            </select>
                            @error('kondisi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- FOTO -->
                    <div class="mb-3">
                        <label for="foto" class="form-label">
                            <i class="bi bi-image me-1"></i>Foto Alat
                        </label>

                        @if($alat->foto)
                            <div class="mb-2">
                                <img src="{{ Storage::url($alat->foto) }}"
                                     alt="{{ $alat->nama_alat }}"
                                     class="img-thumbnail mb-2"
                                     style="width:100px;height:100px;object-fit:cover;">

                            </div>
                        @endif

                        <input type="file"
                               class="form-control @error('foto') is-invalid @enderror"
                               id="foto"
                               name="foto"
                               accept=".jpg,.jpeg,.png">
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            Format: JPG, PNG (max: 2MB)<br>
                            Biarkan kosong jika tidak ingin mengubah foto</div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('admin.alat.index') }}"
                           class="btn btn-secondary me-md-2">
                            <i class="bi bi-arrow-left me-1"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i>Update Alat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
