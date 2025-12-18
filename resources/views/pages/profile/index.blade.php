@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Profil</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            {{-- Alert Success --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('profile.update', Auth::user()->id) }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="/dashboard" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection
