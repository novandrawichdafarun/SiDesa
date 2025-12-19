@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Buat Aduan</h1>
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
            <form action="/complaint" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-4">
                            <label for="title">Judul</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" placeholder="Masukkan Judul Aduan" value="{{ old('title') }}">
                            @error('title')
                                <span class="invalid-feedback mt-2">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="content">Isi Aduan</label>
                            <textarea name="content" id="content" cols="10" rows="3"
                                class="form-control @error('content') is-invalid @enderror" placeholder="Masukkan Aduan">{{ old('content') }}</textarea>
                            @error('content')
                                <span class="invalid-feedback mt-2">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="photo_proof">Bukti foto</label>
                            <input type="file" class="form-control @error('photo_proof') is-invalid @enderror"
                                id="photo_proof" name="photo_proof" value="{{ old('photo_proof') }}">
                            @error('photo_proof')
                                <span class="invalid-feedback mt-2">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <a href="/complaint" class="btn btn-outline-secondary mr-3">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
