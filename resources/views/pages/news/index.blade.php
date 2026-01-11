@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Portal Berita Desa</h1>
            @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 3)
                <a href="/news/create" class="btn btn-primary shadow-sm">
                    <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Berita
                </a>
            @endif
        </div>

        @if ($news->count() > 0)
            <div class="row">
                @foreach ($news as $item)
                    <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                        <div class="card shadow-sm border-0 h-100 transition" style="transition: all 0.3s ease;">
                            <!-- News Image -->
                            <div style="position: relative; height: 200px; overflow: hidden; background: #e9ecef;">
                                <img src="{{ $item->image ? asset('storage/' . $item->image) : 'https://via.placeholder.com/400x200?text=No+Image' }}"
                                    class="card-img-top w-100 h-100" alt="{{ $item->title }}"
                                    style="object-fit: cover; transition: transform 0.3s ease;">

                                <!-- Category Badge -->
                                <span class="badge position-absolute top-2 start-2"
                                    style="background-color: {{ $item->category == 'pengumuman' ? '#dc3545' : ($item->category == 'kegiatan' ? '#ffc107' : '#17a2b8') }};">
                                    {{ ucfirst($item->category) }}
                                </span>

                                @if ($item->is_pinned)
                                    <span class="badge bg-danger position-absolute top-2 end-2">
                                        <i class="fas fa-thumbtack"></i> Penting
                                    </span>
                                @endif
                            </div>

                            <!-- Card Body -->
                            <div class="card-body d-flex flex-column">
                                <!-- Meta Info -->
                                <small class="text-muted d-block mb-2">
                                    <i class="far fa-calendar"></i> {{ $item->created_at->format('d M Y') }}
                                    <span class="ms-2">
                                        <i class="far fa-clock"></i> {{ $item->created_at->diffForHumans() }}
                                    </span>
                                </small>

                                <!-- Title -->
                                <h5 class="card-title font-weight-bold text-gray-800 mb-3" style="line-height: 1.4;">
                                    {{ $item->title }}
                                </h5>

                                <!-- Excerpt -->
                                <p class="card-text text-gray-600 flex-grow-1" style="font-size: 0.95rem;">
                                    {{ Str::limit(strip_tags($item->content), 100) }}
                                </p>

                                <!-- Footer Actions -->
                                <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                    <a href="{{ route('news.show', $item->slug) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-arrow-right"></i> Selengkapnya
                                    </a>
                                    @if (auth()->user()->role_id == 1)
                                        <form action="{{ route('news.destroy', $item->id) }}" method="POST" class="ms-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Hapus berita ini?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-center py-5" role="alert">
                <i class="fas fa-newspaper fa-3x mb-3 d-block text-muted"></i>
                <h5>Belum ada berita</h5>
                <p class="text-muted">Tidak ada berita yang tersedia saat ini.</p>
                @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 3)
                    <a href="/news/create" class="btn btn-primary mt-2">
                        <i class="fas fa-plus"></i> Buat Berita Pertama
                    </a>
                @endif
            </div>
        @endif
    </div>

    <style>
        .card {
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .card:hover {
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.15) !important;
            transform: translateY(-5px);
        }

        .card img:hover {
            transform: scale(1.05);
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.4rem 0.6rem;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }
    </style>
@endsection
