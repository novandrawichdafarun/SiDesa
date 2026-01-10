@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Buat Berita</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        <p>{{ $error }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col">
            <form action="/news" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-4">
                            <label for="image">Foto Berita</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                                name="image" value="{{ old('image') }}">
                            @error('image')
                                <span class="invalid-feedback mt-2">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="title">Judul</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" placeholder="Masukkan Judul Berita" value="{{ old('title') }}">
                            @error('title')
                                <span class="invalid-feedback mt-2">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="content">Isi Berita</label>
                            <textarea name="content" id="content" cols="10" rows="3"
                                class="form-control @error('content') is-invalid @enderror" placeholder="Masukkan Isi Berita">{{ old('content') }}</textarea>
                            @error('content')
                                <span class="invalid-feedback mt-2">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="category">Kategori Berita</label>
                            <select name="category" id="category"
                                class="form-control @error('category') is-invalid @enderror">
                                @foreach ([
            (object)
    [
                'label' => 'Berita',
                'value' => 'berita',
            ],
            (object) [
                'label' => 'Pengumuman',
                'value' => 'pengumuman',
            ],
            (object) [
                'label' => 'kegiatan',
                'value' => 'kegiatan',
            ],
        ] as $item)
                                    <option value="{{ $item->value }}" @selected(old('category') == $item->value)>
                                        {{ $item->label }}</option>
                                @endforeach
                            </select>
                            @error('category')
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
