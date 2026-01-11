@extends('layouts.auth')

@section('title', 'Daftar Akun Baru')

@section('content')
    <div class="row">
        <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
        <div class="col-lg-7">
            <div class="auth-form-container">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4 font-weight-bold">Buat Akun Baru</h1>
                    <p class="mb-4 text-muted small">Daftarkan diri Anda untuk kemudahan administrasi desa.</p>
                </div>

                <form class="user" action="/register" method="POST">
                    @csrf

                    {{-- Nama Lengkap --}}
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror"
                            id="name" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback ml-3">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-group">
                        <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                            id="email" name="email" placeholder="Alamat Email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback ml-3">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password Row --}}
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password"
                                class="form-control form-control-user @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Password" required>
                            @error('password')
                                <div class="invalid-feedback ml-3">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <input type="password" class="form-control form-control-user" id="password_confirmation"
                                name="password_confirmation" placeholder="Ulangi Password" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-user btn-block font-weight-bold shadow-sm">
                        <i class="fas fa-user-plus mr-2"></i> Daftar Akun
                    </button>
                </form>

                <hr class="my-4">

                <div class="text-center">
                    <a class="small font-weight-bold" href="/">Sudah punya akun? Masuk di sini!</a>
                </div>
            </div>
        </div>
    </div>
@endsection
