<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="TelU Inventory - Sistem Logistik dan Peminjaman Alat Kampus Telkom University">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'TelU Inventory | Sistem Logistik Kampus')</title>

    {{-- VENDOR --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    {{-- UI GLOBAL (PUBLIC/UI) --}}
    <link rel="stylesheet" href="{{ asset('ui/base.css') }}">
    <link rel="stylesheet" href="{{ asset('ui/components.css') }}">

    {{-- UI PER PAGE --}}
    @stack('styles')
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top shadow-sm px-lg-5 bg-white">
        <div class="container-fluid">

            <a class="navbar-brand fw-800 d-flex align-items-center gap-2" href="{{ route('home') }}">
    <img src="{{ asset('images/logo-tekom.png') }}"
         alt="Telkom Logo"
         style="height:28px;width:auto">

    <span>
        <span style="color:#E30613;">Tel</span><span style="color:#555;">U Inventory</span>
    </span>
</a>



            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">

                    {{-- MENU AUTH --}}
                    @auth
                        {{-- DASHBOARD --}}
                        @if(\Illuminate\Support\Facades\Route::has('dashboard'))
                            <li class="nav-item">
                                <a class="nav-link fw-600 {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                                   href="{{ route('dashboard') }}">
                                    Dashboard
                                </a>
                            </li>
                        @endif

                        {{-- ADMIN MENU --}}
                        @can('admin')
                            @if(\Illuminate\Support\Facades\Route::has('admin.alat.index'))
                                <li class="nav-item">
                                    <a class="nav-link fw-600 {{ request()->routeIs('admin.alat.*') ? 'active' : '' }}"
                                       href="{{ route('admin.alat.index') }}">
                                        Kelola Alat
                                    </a>
                                </li>
                            @endif
                        @endcan
                    @endauth
                </ul>

                <div class="d-flex align-items-center gap-3">
                    @auth
                        <span class="fw-bold d-none d-lg-block text-muted small text-uppercase">
                            {{ auth()->user()->name }}
                        </span>

                        {{-- LOGOUT AMAN (cek route dulu biar gak error) --}}
                        @if(\Illuminate\Support\Facades\Route::has('logout'))
                            <form action="{{ route('logout') }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill fw-bold">
                                    Keluar
                                </button>
                            </form>
                        @else
                            <a href="{{ route('home') }}" class="btn btn-sm btn-outline-danger rounded-pill fw-bold">
                                Keluar
                            </a>
                        @endif

                    @else
                        {{-- LOGIN AMAN (cek route dulu biar gak error) --}}
                        @if(\Illuminate\Support\Facades\Route::has('login'))
                            <a href="{{ route('login') }}" class="btn btn-red btn-sm px-4">Masuk</a>
                        @else
                            <a href="{{ url('/login') }}" class="btn btn-red btn-sm px-4">Masuk</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="container py-4" style="padding-top: 84px;">
        {{-- ALERT GLOBAL --}}
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

        @yield('content')
    </main>

    {{-- Tempat modal per page biar rapi --}}
    @stack('modals')

    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    @stack('scripts')
</body>
</html>
