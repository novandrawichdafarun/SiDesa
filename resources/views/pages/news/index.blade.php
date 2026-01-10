@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Portal Berita Desa</h1>
            @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 3)
                <a href="/news/create" class="btn btn-primary shadow-sm"> <i class="fas fa-plus fa-sm text-white-50"></i>
                    Tambah Berita </a>
            @endif
        </div>

        <div class="row">
            @foreach ($news as $item)
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card shadow h-100">
                        <img src="{{ $item->image ? asset('storage/' . $item->image) : '[https://via.placeholder.com/400x200](https://via.placeholder.com/400x200)' }}"
                            class="card-img-top" alt="news image" style="height: 200px. object-fit: cover.">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                {{ $item->category }} . {{ $item->created_at->diffForHumans() }}
                            </div>
                            <h5 class="font-weight-bold text-gray-800">{{ $item->title }}</h5>
                            <p>{{ Str::limit(strip_tags($item->content), 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('news.show', $item->slug) }}" class="btn btn-sm btn-primary">Baca
                                    Selengkapnya</a>
                                @if (auth()->user()->role_id == 1)
                                    <form action="{{ route('news.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Hapus berita?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $news->links() }}
    </div>
@endsection
