@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('news.index') }}">Berita</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $item->title }}</li>
            </ol>
        </nav>

        <div class="card shadow mb-4">
            <div class="card-body p-5">
                <h1 class="h2 font-weight-bold text-gray-800 mb-3">{{ $item->title }}</h1>
                <div class="text-muted mb-4">
                    Oleh: {{ $item->user->name }} . Kategori: {{ ucfirst($item->category) }} .
                    {{ $item->created_at->format('d M Y') }}
                </div>

                @if ($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" class="img-fluid rounded mb-4 w-100"
                        style="max-height: 500px. object-fit: cover.">
                @endif

                <div class="text-gray-900 leading-relaxed">
                    {!! nl2br(e($item->content)) !!}
                </div>

                <hr class="my-4">
                <a href="{{ route('news.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Berita
                </a>
            </div>
        </div>
    </div>
@endsection
