@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-bell text-primary mr-2"></i>Semua Notifikasi
        </h1>
    </div>

    <div class="card shadow-lg mb-4" style="border: none; border-radius: 0.75rem;">
        <div class="card-header py-3"
            style="background: linear-gradient(135deg, #4e73df 0%, #2e59d9 100%); border-bottom: none;">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-inbox mr-2"></i>Notifikasi Terbaru
            </h6>
        </div>
        <div class="list-group list-group-flush">
            @forelse (auth()->user()->notifications as $notification)
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-4"
                    style="border-bottom: 1px solid #e3e6f0; background-color: {{ $notification->read_at ? '#f8f9fa' : '#ffffff' }}; transition: all 0.3s ease;"
                    onmouseover="this.style.backgroundColor='#f8f9fa'"
                    onmouseout="this.style.backgroundColor='{{ $notification->read_at ? '#f8f9fa' : '#ffffff' }}'">
                    <div class="mr-3 flex-grow-1">
                        <div class="mb-2 text-gray-800 font-weight-500">
                            {{ $notification->data['message'] }}
                        </div>
                        <small class="text-muted">
                            <i class="fas fa-clock mr-1"></i>{{ $notification->created_at->diffForHumans() }}
                        </small>
                    </div>

                    @if (is_null($notification->read_at))
                        <form action="/notification/{{ $notification->id }}/read" method="POST" class="m-0 ml-3">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-sm"
                                style="background: linear-gradient(135deg, #4e73df 0%, #2e59d9 100%); color: white; border: none; border-radius: 0.25rem; padding: 0.5rem 1rem; transition: all 0.3s ease;"
                                onmouseover="this.style.boxShadow='0 5px 15px rgba(78, 115, 223, 0.4)'"
                                onmouseout="this.style.boxShadow='none'">
                                Tandai Baca
                            </button>
                        </form>
                    @else
                        <span class="badge"
                            style="background-color: #858796; color: white; padding: 0.5rem 0.75rem; border-radius: 1rem;">Sudah
                            dibaca</span>
                    @endif
                </div>
            @empty
                <div class="p-5 text-center text-muted">
                    <i class="fas fa-inbox text-gray-300 mb-3" style="font-size: 2.5rem; display: block;"></i>
                    <p class="font-weight-500">Tidak ada notifikasi baru.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
