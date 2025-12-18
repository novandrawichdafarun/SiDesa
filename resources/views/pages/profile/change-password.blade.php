@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah Password</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            {{-- Alert Success --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Alert Error --}}
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('change-password.update', Auth::user()->id) }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Password Lama</label>
                    <input type="password" class="form-control" name="old_password" required>
                </div>

                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" class="form-control" name="new_password" required minlength="8">
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="/dashboard" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection
