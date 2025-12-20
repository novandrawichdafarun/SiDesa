@extends('layouts.app');

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Semua Notifikasi</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Notifikasi Terbaru</h6>
        </div>
        <div class="list-group list-group-flush">
            @forelse (auth()->user()->notifications as $notification)
                <div
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ $notification->read_at ? 'bg-light' : 'bg-white font-weight-bold' }} py-3">
                    <div class="mr-3">
                        <div class="mb-4 text-gray-800">
                            {{ $notification->data['message'] }}
                        </div>
                        <small class="text-muted">
                            {{ $notification->created_at->diffForHumans() }}
                        </small>
                    </div>

                    @if (is_null($notification->read_at))
                        <form action="/notification/{{ $notification->id }}/read" method="POST" class="m-0">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-sm btn-primary shadow-sm">
                                Tandai Baca
                            </button>
                        </form>
                    @else
                        <span class="badge badge-secondary badge-pill">Sudah dibaca</span>
                    @endif

                </div>
            @empty
                <div class="p-4 text-center text-muted">
                    Tidak ada notifikasi baru.
                </div>
            @endforelse
        </div>
    </div>
@endsection
