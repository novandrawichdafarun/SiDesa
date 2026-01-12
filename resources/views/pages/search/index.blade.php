@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-4 text-gray-800">Hasil Pencarian: "{{ $keyword }}"</h1>

        @if (
            $results['residents']->isEmpty() &&
                $results['news']->isEmpty() &&
                $results['complaints']->isEmpty() &&
                $results['letters']->isEmpty())
            <div class="alert alert-warning">Tidak ditemukan data yang cocok dengan kata kunci tersebut.</div>
        @endif

        <div class="row">

            {{-- Hasil: Penduduk (Khusus Admin/Pejabat) --}}
            @if ($results['residents']->count() > 0)
                <div class="col-lg-12 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-users"></i> Data Penduduk Ditemukan
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($results['residents'] as $resident)
                                            <tr>
                                                <td>{{ $resident->nik }}</td>
                                                <td>{{ $resident->user->name ?? $resident->name }}</td>
                                                <td>{{ $resident->address }}</td>
                                                <td>
                                                    <a href="{{ route('residents.edit', $resident->id) }}"
                                                        class="btn btn-sm btn-info">Detail</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Hasil: Berita --}}
            @if ($results['news']->count() > 0)
                <div class="col-lg-6 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-newspaper"></i> Berita &
                                Pengumuman</h6>
                        </div>
                        <div class="list-group list-group-flush">
                            @foreach ($results['news'] as $news)
                                <a href="{{ route('news.show', $news->id) }}"
                                    class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1 font-weight-bold">{{ $news->title }}</h6>
                                        <small>{{ $news->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-1 small text-muted">{{ Str::limit(strip_tags($news->content), 80) }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            {{-- Hasil: Aduan (Admin) --}}
            @if ($results['complaints']->count() > 0)
                <div class="col-lg-6 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger"><i class="fas fa-bullhorn"></i> Data Pengaduan</h6>
                        </div>
                        <div class="list-group list-group-flush">
                            @foreach ($results['complaints'] as $complaint)
                                <a href="{{ route('complaint.index') }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1 font-weight-bold">{{ $complaint->title }}</h6>
                                        <small class="badge badge-secondary">{{ $complaint->status }}</small>
                                    </div>
                                    <small class="text-muted">Oleh: {{ $complaint->user->name }}</small>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            {{-- Hasil: Surat Saya (Penduduk) --}}
            @if ($results['letters']->count() > 0)
                <div class="col-lg-6 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-info"><i class="fas fa-envelope"></i> Riwayat Surat Anda
                            </h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($results['letters'] as $letter)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $letter->letterType->name }}
                                    <span class="badge badge-primary badge-pill">{{ $letter->status }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
