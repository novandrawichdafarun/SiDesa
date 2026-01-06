@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah Pengguna</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="mt-4">
                        <p>{{ $error }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col">
            <form action="/account-list/{{ $user->id }}" method="post">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-4">
                            <label for="name">Nama Pengguna</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="Nama" value="{{ old('name', $user->name) }}">
                            @error('name')
                                <span class="invalid-feedback mt-2">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="email">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" placeholder="Email" value="{{ old('email', $user->email) }}">
                            @error('email')
                                <span class="invalid-feedback mt-2">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="from-group mb-4">
                            <label for="password">Password</label>
                            <input type="text" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Massukkan Password Baru" autocomplete="off">
                            @error('password')
                                <span class="invalid-feedback mt-2">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <a href="/account-list" class="btn btn-outline-secondary mr-3">Kembali</a>
                            <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
