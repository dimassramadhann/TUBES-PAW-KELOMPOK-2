@extends('layouts.landing')

@section('title', 'Telkom University - Peminjaman Alat')

@push('styles')
<link rel="stylesheet" href="{{ asset('ui/pages/landing.css') }}">
@endpush

@section('content')
<div class="landing">

    <!-- Hero Section -->
    <section class="hero-section animate__animated animate__fadeIn" id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1 class="hero-title animate__animated animate__fadeInUp">
                        Sistem Peminjaman Alat Kampus
                    </h1>
                    <p class="hero-subtitle animate__animated animate__fadeInUp animate__delay-1s">
                        Pinjam peralatan akademik dengan mudah dan cepat. Proyektor, sound system, kabel HDMI, dan berbagai alat pendukung pembelajaran lainnya tersedia untuk mahasiswa dan dosen Telkom University Surabaya.
                    </p>
                    <div class="animate__animated animate__fadeInUp animate__delay-2s">
                        <a href="#catalog" class="btn btn-telkom btn-lg me-3 pulse">
                            <i class="fas fa-search me-2"></i>Lihat Katalog
                        </a>
                        <a href="#borrow" class="btn btn-outline-telkom btn-lg">
                            <i class="fas fa-hand-holding me-2"></i>Ajukan Peminjaman
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="text-center">
                        <img src="https://images.unsplash.com/photo-1589998059171-988d887df646?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80"
                             alt="Telkom University Campus" class="img-fluid rounded-3 shadow landing-hero-img">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Equipment Catalog -->
    <section class="container py-5" id="catalog">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="mb-3">Katalog Alat Tersedia</h2>
                <p class="text-muted">Pilih peralatan yang Anda butuhkan untuk aktivitas akademik</p>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section animate-fade-in">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h5 class="mb-3">Kategori Alat:</h5>
                    <div>
                        <span class="category-badge active">Semua</span>
                        <span class="category-badge">Proyektor</span>
                        <span class="category-badge">Audio</span>
                        <span class="category-badge">Kabel & Adapter</span>
                        <span class="category-badge">Lainnya</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" placeholder="Cari alat (nama atau kode)">
                        <button class="btn btn-telkom">Cari</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Equipment Grid -->
        <div class="row" id="equipmentGrid">
            <div class="col-md-6 col-lg-4">
                <div class="card equipment-card">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1563291074-2bf8677ac0e5?auto=format&fit=crop&w=1000&q=80"
                             class="card-img-top" alt="Proyektor HD">
                        <span class="status-badge status-available">Tersedia</span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Proyektor HD Epson</h5>
                        <p class="card-text text-muted">Kode: PROJ-001</p>
                        <p class="card-text">Proyektor resolusi tinggi 1080p, 3200 lumen. Cocok untuk presentasi kelas besar.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-light text-dark">
                                <i class="fas fa-check-circle text-success me-1"></i> Kondisi: Baik
                            </span>
                            <button class="btn btn-telkom btn-sm" data-bs-toggle="modal" data-bs-target="#borrowModal">
                                <i class="fas fa-hand-holding me-1"></i>Pinjam
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tambah card lain kalau mau --}}
        </div>

        <div class="text-center mt-5">
            <a href="#" class="btn btn-outline-telkom">
                <i class="fas fa-list me-2"></i>Lihat Semua Alat
            </a>
        </div>
    </section>

    <!-- Borrowing Process -->
    <section class="container py-5 bg-light rounded-3 my-5" id="borrow">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2>Cara Meminjam Alat</h2>
                <p class="text-muted">Proses peminjaman alat di Telkom University Surabaya</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="text-center p-4 bg-white rounded-3 shadow-sm h-100">
                    <div class="step-icon"><i class="fas fa-search"></i></div>
                    <h5>1. Cari Alat</h5>
                    <p class="text-muted">Telusuri katalog alat yang tersedia dan pilih yang Anda butuhkan</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="text-center p-4 bg-white rounded-3 shadow-sm h-100">
                    <div class="step-icon"><i class="fas fa-calendar-check"></i></div>
                    <h5>2. Ajukan Peminjaman</h5>
                    <p class="text-muted">Isi formulir peminjaman dengan tanggal dan keperluan</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="text-center p-4 bg-white rounded-3 shadow-sm h-100">
                    <div class="step-icon"><i class="fas fa-user-check"></i></div>
                    <h5>3. Konfirmasi Admin</h5>
                    <p class="text-muted">Tunggu konfirmasi dari admin TU/lab (maksimal 1x24 jam)</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="text-center p-4 bg-white rounded-3 shadow-sm h-100">
                    <div class="step-icon"><i class="fas fa-box-open"></i></div>
                    <h5>4. Ambil & Kembalikan</h5>
                    <p class="text-muted">Ambil alat di lokasi yang ditentukan dan kembalikan tepat waktu</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Borrow Modal -->
    <div class="modal fade" id="borrowModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header landing-modal-header">
                    <h5 class="modal-title">Formulir Peminjaman Alat</h5>
                    <button type="button" class="close-btn" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="borrowForm">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6>Informasi Alat</h6>
                                <div class="d-flex align-items-center">
                                    <img src="https://images.unsplash.com/photo-1563291074-2bf8677ac0e5?auto=format&fit=crop&w=200&q=80"
                                         class="rounded me-3 borrow-thumb" alt="thumb">
                                    <div>
                                        <strong>Proyektor HD Epson</strong>
                                        <p class="text-muted mb-0">Kode: PROJ-001</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="alert alert-info">
                                    <small>
                                        <i class="fas fa-info-circle me-2"></i>
                                        Pastikan alat tersedia pada tanggal yang Anda pilih. Peminjaman maksimal 7 hari.
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="borrowDate" class="form-label">Tanggal Pinjam</label>
                                <input type="date" class="form-control" id="borrowDate" required>
                            </div>
                            <div class="col-md-6">
                                <label for="returnDate" class="form-label">Tanggal Kembali</label>
                                <input type="date" class="form-control" id="returnDate" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="purpose" class="form-label">Tujuan Peminjaman</label>
                            <textarea class="form-control" id="purpose" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Lokasi Penggunaan</label>
                            <select class="form-select" id="location" required>
                                <option value="">Pilih lokasi...</option>
                                <option value="gedung_d">Gedung D - Ruang Kelas</option>
                                <option value="gedung_f">Gedung F - Lab Multimedia</option>
                                <option value="auditorium">Auditorium Kampus</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="ktmUpload" class="form-label">Upload Scan KTM</label>
                            <input type="file" class="form-control" id="ktmUpload" accept="image/*,.pdf">
                            <div class="form-text">Upload scan KTM yang masih berlaku (format JPG/PNG/PDF, maks 2MB)</div>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                            <label class="form-check-label" for="agreeTerms">
                                Saya menyetujui <a href="#">Syarat & Ketentuan</a> peminjaman alat.
                            </label>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" form="borrowForm" class="btn btn-telkom">
                        <i class="fas fa-paper-plane me-2"></i>Ajukan Peminjaman
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer-telkom" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h4 class="mb-3"><i class="fas fa-university me-2"></i>Telkom University</h4>
                    <p>Sistem Peminjaman Alat Kampus Telkom University Surabaya.</p>
                    <div class="mt-3">
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube fa-lg"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5 class="mb-3">Tautan Cepat</h5>
                    <div class="footer-links">
                        <p><a href="#catalog">Katalog Alat</a></p>
                        <p><a href="#borrow">Ajukan Peminjaman</a></p>
                        <p><a href="#">Syarat & Ketentuan</a></p>
                        <p><a href="#">FAQ</a></p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="mb-3">Kontak</h5>
                    <div class="footer-links">
                        <p><i class="fas fa-map-marker-alt me-2"></i>Jl. Ketintang No.156, Surabaya</p>
                        <p><i class="fas fa-phone me-2"></i>(031) 1234 5678</p>
                        <p><i class="fas fa-envelope me-2"></i>peminjaman@telkomuniversity.ac.id</p>
                        <p><i class="fas fa-clock me-2"></i>Senin - Jumat, 08:00 - 16:00 WIB</p>
                    </div>
                </div>

                <div class="col-lg-3">
                    <h5 class="mb-3">Statistik Sistem</h5>
                    <div class="footer-links">
                        <p>Total Alat: <strong>37</strong></p>
                        <p>Peminjaman Aktif: <strong>12</strong></p>
                        <p>Pengguna Terdaftar: <strong>1,245</strong></p>
                        <p>Rating Kepuasan: <strong>4.8/5.0</strong></p>
                    </div>
                </div>
            </div>

            <hr class="mt-4 mb-3 footer-divider">

            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2023 Telkom University Surabaya. Hak Cipta Dilindungi.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">Sistem Peminjaman Alat v2.1</p>
                </div>
            </div>
        </div>
    </footer>

</div>
@endsection

@push('scripts')
<script src="{{ asset('ui/pages/landing.js') }}"></script>
@endpush
