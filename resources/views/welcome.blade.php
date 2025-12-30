@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('ui/pages/home.css') }}">
@endpush

@section('content')
<div class="home-hero card border-0 shadow-sm rounded-4 p-5 mt-4">
    <h1 class="display-5 fw-800 mb-3">
    <span class="text-danger">Tel</span><span class="text-secondary">U</span>
    <span class="text-secondary">Inventory</span>
</h1>

<p class="text-muted mb-4">
    Selamat Datang di TelU Inventory (Sistem Peminjaman Alat Kampus).
    Silakan login untuk mengecek ketersediaan alat.
</p>


    @auth
        <a href="{{ route('dashboard') }}" class="btn btn-success rounded-pill px-4 w-100">
            <i class="bi bi-speedometer2 me-2"></i>Masuk Dashboard
        </a>
    @else
        <a href="{{ route('login') }}" class="btn btn-danger rounded-pill px-4 w-100">
            <i class="bi bi-box-arrow-in-right me-2"></i>Login
        </a>
    @endauth
</div>
@endsection
