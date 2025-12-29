@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card border-0 shadow-sm rounded-4 p-4">
            <h4 class="fw-bold mb-3">Masuk</h4>

            @if ($errors->any())
                <div class="alert alert-danger rounded-3">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>

                <button class="btn btn-danger w-100 rounded-pill fw-bold">Login</button>

                <div class="text-center mt-4">
    <span class="small text-muted">
        Belum punya akun?
        <a href="{{ route('register') }}" class="fw-bold text-danger">
            Daftar di sini
        </a>
    </span>
</div>

            </form>
        </div>
    </div>
</div>
@endsection
