@extends('layouts.app')

@section('content')
<section class="page-section bg-light" style="min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card border-0 shadow-lg rounded-lg mt-5">
                    <div class="card-header bg-dark text-white text-center py-4">
                        <h4 class="mb-0 text-uppercase fw-bold">Daftar Akun Mahasiswa</h4>
                        <small>Silakan isi data diri Anda untuk meminjam alat</small>
                    </div>
                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="small mb-1 fw-bold">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
                                @error('name') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1 fw-bold">NIM (Nomor Induk Mahasiswa)</label>
                                <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" value="{{ old('nim') }}" required>
                                @error('nim') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1 fw-bold">Alamat Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                @error('email') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1 fw-bold">Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                                @error('password') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="small mb-1 fw-bold">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-warning w-100 fw-bold py-3 shadow-sm">DAFTAR SEKARANG</button>

                            <div class="text-center mt-4">
                                <span class="small text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="text-warning fw-bold">Login di sini</a></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
 