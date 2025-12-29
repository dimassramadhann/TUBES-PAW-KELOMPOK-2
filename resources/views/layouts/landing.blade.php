<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Sistem Peminjaman Alat - Telkom University Surabaya')">

    <title>@yield('title', 'Telkom University - Peminjaman Alat')</title>

    {{-- VENDOR --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    {{-- UI GLOBAL (optional; kalau gak dipakai landing, boleh hapus) --}}
    <link rel="stylesheet" href="{{ asset('ui/base.css') }}">

    {{-- PAGE CSS --}}
    @stack('styles')
</head>
<body>

    {{-- Navbar khusus landing --}}
    <nav class="navbar navbar-expand-lg navbar-telkom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-university me-2"></i>Telkom University
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#home">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#catalog">Katalog Alat</a></li>
                    <li class="nav-item"><a class="nav-link" href="#borrow">Peminjaman</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">Tentang</a></li>

                    {{-- contoh menu user (opsional) --}}
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-telkom btn-sm" href="{{ route('login') }}">
                            <i class="fas fa-right-to-bracket me-1"></i>Masuk
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    @yield('content')

    {{-- Vendor JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Page JS --}}
    @stack('scripts')
</body>
</html>
