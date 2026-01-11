@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-lock text-primary mr-2"></i>Ubah Password
        </h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-lg mb-4" style="border: none; border-radius: 0.75rem;">
                <div class="card-header py-3"
                    style="background: linear-gradient(135deg, #4e73df 0%, #2e59d9 100%); border-bottom: none;">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-key mr-2"></i>Perbarui Password
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

                    <form action="/change-password/{{ auth()->user()->id }}" method="POST">
                        @csrf

                        <div class="form-group mb-4">
                            <label class="font-weight-600 text-gray-800 mb-2">Password Lama</label>
                            <input type="password" class="form-control @error('old_password') is-invalid @enderror"
                                name="old_password" placeholder="Masukkan password lama" required
                                style="border-radius: 0.25rem; border: 1px solid #e3e6f0; padding: 0.75rem;">
                            @error('old_password')
                                <span class="invalid-feedback d-block mt-1 font-weight-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-600 text-gray-800 mb-2">Password Baru</label>
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                name="new_password" placeholder="Masukkan password baru" required minlength="8"
                                style="border-radius: 0.25rem; border: 1px solid #e3e6f0; padding: 0.75rem;">
                            <small class="text-muted d-block mt-1"><i class="fas fa-info-circle mr-1"></i>Minimal 8
                                karakter</small>
                            @error('new_password')
                                <span class="invalid-feedback d-block mt-1 font-weight-500">{{ $message }}</span>
                            @enderror
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
    </div>
@endsection
