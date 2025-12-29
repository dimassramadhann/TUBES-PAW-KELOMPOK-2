@extends('layouts.app')

@section('title', 'Ajukan Peminjaman')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Ajukan Peminjaman Alat</h4>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('peminjaman.store') }}" enctype="multipart/form-data" id="peminjamanForm">
                    @csrf

                    <div class="mb-3">
                        <label for="alat_id" class="form-label"><i class="bi bi-tools me-1"></i>Pilih Alat</label>
                        <select class="form-select @error('alat_id') is-invalid @enderror"
                                id="alat_id" name="alat_id" required>
                            <option value="">-- Pilih Alat --</option>
                            @foreach($alats as $alat)
                                @if($alat->isTersedia(old('tanggal_pinjam', date('Y-m-d'))))
                                <option value="{{ $alat->id }}"
                                        data-kode="{{ $alat->kode }}"
                                        data-kondisi="{{ $alat->kondisi }}"
                                        {{ old('alat_id') == $alat->id ? 'selected' : '' }}>
                                    {{ $alat->nama_alat }} ({{ $alat->kode }})
                                </option>
                                @endif
                            @endforeach
                        </select>
                        <div class="form-text">Hanya alat dengan kondisi baik yang ditampilkan</div>
                        @error('alat_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_pinjam" class="form-label"><i class="bi bi-calendar-plus me-1"></i>Tanggal Pinjam</label>
                            <input type="date" class="form-control @error('tanggal_pinjam') is-invalid @enderror"
                                   id="tanggal_pinjam" name="tanggal_pinjam"
                                   value="{{ old('tanggal_pinjam', date('Y-m-d')) }}"
                                   min="{{ date('Y-m-d') }}" required>
                            @error('tanggal_pinjam')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tanggal_kembali" class="form-label"><i class="bi bi-calendar-check me-1"></i>Tanggal Kembali</label>
                            <input type="date" class="form-control @error('tanggal_kembali') is-invalid @enderror"
                                   id="tanggal_kembali" name="tanggal_kembali"
                                   value="{{ old('tanggal_kembali', date('Y-m-d', strtotime('+1 day'))) }}" required>
                            @error('tanggal_kembali')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alasan_peminjaman" class="form-label"><i class="bi bi-chat-text me-1"></i>Alasan Peminjaman</label>
                        <textarea class="form-control @error('alasan_peminjaman') is-invalid @enderror"
                                  id="alasan_peminjaman" name="alasan_peminjaman"
                                  rows="4" placeholder="Jelaskan alasan Anda meminjam alat ini..." required>{{ old('alasan_peminjaman') }}</textarea>
                        @error('alasan_peminjaman')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="bukti_peminjaman" class="form-label"><i class="bi bi-file-earmark-arrow-up me-1"></i>Bukti Peminjaman (Scan KTM/KTM Digital)</label>
                        <input type="file" class="form-control @error('bukti_peminjaman') is-invalid @enderror"
                               id="bukti_peminjaman" name="bukti_peminjaman" accept=".pdf,.jpg,.jpeg,.png" required>
                        @error('bukti_peminjaman')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Format yang diterima: PDF, JPG, PNG (maksimal 2MB)</div>
                    </div>

                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Informasi Penting:</strong>
                        <ul class="mb-0 mt-2">
                            <li>Maksimal peminjaman per alat: 5 kali</li>
                            <li>Alat tidak dapat dipinjam oleh lebih dari satu orang di tanggal yang sama</li>
                            <li>Peminjaman harus diajukan minimal 1 hari sebelum tanggal pinjam</li>
                        </ul>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('alat.daftar') }}" class="btn btn-secondary me-md-2">
                            <i class="bi bi-arrow-left me-1"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send me-1"></i>Ajukan Peminjaman
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tanggalPinjam = document.getElementById('tanggal_pinjam');
        const tanggalKembali = document.getElementById('tanggal_kembali');
        const alatSelect = document.getElementById('alat_id');

        // Set minimum tanggal kembali berdasarkan tanggal pinjam
        tanggalPinjam.addEventListener('change', function() {
            tanggalKembali.min = this.value;

            // Jika tanggal kembali sebelumnya lebih awal, reset
            if (tanggalKembali.value && new Date(tanggalKembali.value) < new Date(this.value)) {
                tanggalKembali.value = this.value;
            }

            // Cek ketersediaan alat
            checkAlatAvailability();
        });

        // Cek ketersediaan saat alat dipilih
        alatSelect.addEventListener('change', function() {
            checkAlatAvailability();
        });

        function checkAlatAvailability() {
            if (alatSelect.value && tanggalPinjam.value) {
                const selectedOption = alatSelect.options[alatSelect.selectedIndex];
                const alatId = selectedOption.value;
                const tanggal = tanggalPinjam.value;

                // Di sini bisa ditambahkan AJAX call untuk cek ketersediaan real-time
                // Untuk sekarang, kita hanya memberikan warning visual
                console.log(`Checking availability for alat ${alatId} on ${tanggal}`);
            }
        }

        // Validasi form sebelum submit
        document.getElementById('peminjamanForm').addEventListener('submit', function(e) {
            const today = new Date().toISOString().split('T')[0];
            const selectedDate = new Date(tanggalPinjam.value);
            const minDate = new Date(today);
            minDate.setDate(minDate.getDate() + 1); // Minimal 1 hari dari sekarang

            if (selectedDate < minDate) {
                e.preventDefault();
                alert('Peminjaman harus diajukan minimal 1 hari sebelum tanggal pinjam.');
                return false;
            }

            return true;
        });
    });
</script>
@endpush
