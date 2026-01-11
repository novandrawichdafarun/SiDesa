@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-user-circle text-primary mr-2"></i>Detail Profil
        </h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-lg mb-4" style="border: none; border-radius: 0.75rem;">
                <div class="card-header py-3"
                    style="background: linear-gradient(135deg, #4e73df 0%, #2e59d9 100%); border-bottom: none;">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-edit mr-2"></i>Ubah Informasi Profil
                    </h6>
                </div>
                <div class="card-body" style="padding: 2rem;">
                    {{-- Alert Success --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert"
                            style="border-radius: 0.25rem; border: 1px solid #1cc88a;">
                            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{-- Alert Error --}}
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert"
                            style="border-radius: 0.25rem; border: 1px solid #e74c3c;">
                            <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('profile.update', Auth::user()->id) }}" method="POST">
                        @csrf

                        <div class="form-group mb-4">
                            <label class="font-weight-600 text-gray-800 mb-2">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ Auth::user()->name }}" placeholder="Masukkan nama lengkap" required
                                style="border-radius: 0.25rem; border: 1px solid #e3e6f0; padding: 0.75rem;">
                            @error('name')
                                <span class="invalid-feedback d-block mt-1 font-weight-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-600 text-gray-800 mb-2">Email</label>
                            <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly
                                style="background-color: #f8f9fa; border: 1px solid #e3e6f0; border-radius: 0.25rem; padding: 0.75rem;">
                            <small class="text-muted d-block mt-1"><i class="fas fa-lock-alt mr-1"></i>Email tidak dapat
                                diubah</small>
                        </div>

                        <button type="submit" class="btn btn-block"
                            style="background: linear-gradient(135deg, #4e73df 0%, #2e59d9 100%); color: white; border: none; border-radius: 0.25rem; padding: 0.75rem; font-weight: 600; transition: all 0.3s ease;"
                            onmouseover="this.style.boxShadow='0 5px 20px rgba(78, 115, 223, 0.4)'"
                            onmouseout="this.style.boxShadow='none'">
                            <i class="fas fa-save mr-2"></i>Simpan Perubahan
                        </button>
                        <a href="/dashboard" class="btn btn-block btn-secondary mt-2"
                            style="border-radius: 0.25rem; padding: 0.75rem;">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </a>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-lg mb-4"
                style="border: none; border-radius: 0.75rem; background: linear-gradient(135deg, rgba(78, 115, 223, 0.05) 0%, rgba(46, 89, 217, 0.05) 100%);">
                <div class="card-body py-5">
                    <div class="text-center mb-4">
                        <i class="fas fa-shield-alt" style="font-size: 3rem; color: #4e73df;"></i>
                    </div>
                    <h5 class="text-center font-weight-bold text-gray-800 mb-3">Keamanan Akun</h5>
                    <p class="text-center text-gray-600 mb-4">Perbarui password Anda secara berkala untuk menjaga keamanan
                        akun.</p>
                    <a href="/change-password" class="btn btn-block"
                        style="background: linear-gradient(135deg, #4e73df 0%, #2e59d9 100%); color: white; border: none; border-radius: 0.25rem; padding: 0.75rem; font-weight: 600; transition: all 0.3s ease;"
                        onmouseover="this.style.boxShadow='0 5px 20px rgba(78, 115, 223, 0.4)'"
                        onmouseout="this.style.boxShadow='none'">
                        <i class="fas fa-lock mr-2"></i>Ubah Password
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
