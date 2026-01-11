@extends('layouts.auth')

@section('title', 'Masuk')

@section('content')
    <div class="row">
        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
        <div class="col-lg-6">
            <div class="auth-form-container">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4 font-weight-bold">Selamat Datang Kembali!</h1>
                    <p class="mb-4 text-muted small">Silakan masuk untuk mengakses layanan desa.</p>
                </div>

                <form class="user" action="/login" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                            id="email" name="email" aria-describedby="emailHelp"
                            placeholder="Masukkan Alamat Email..." value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="invalid-feedback ml-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password"
                            class="form-control form-control-user @error('password') is-invalid @enderror" id="password"
                            name="password" placeholder="Password" required>
                        @error('password')
                            <div class="invalid-feedback ml-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                            <input type="checkbox" class="custom-control-input" id="customCheck" name="remember">
                            <label class="custom-control-label" for="customCheck">Ingat Saya</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block font-weight-bold shadow-sm">
                        <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                    </button>
                </form>

                <hr class="my-4">

                {{-- Jika ada fitur lupa password --}}
                {{-- <div class="text-center">
                <a class="small" href="{{ route('password.request') }}">Lupa Password?</a>
            </div> --}}
                <div class="text-center">
                    <a class="small font-weight-bold" href="/register">Belum punya akun? Daftar Sekarang!</a>
                </div>
            </div>
        </div>
    </div>
@endsection
