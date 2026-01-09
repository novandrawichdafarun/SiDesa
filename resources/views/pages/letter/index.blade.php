@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Layanan Surat Menyurat</h1>
            @if (Auth::user()->role_id !== 1)
                <a href="/letters/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-plus fa-sm text-white-50"></i> Buat Permohonan Surat
                </a>
            @endif
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Permohonan Surat</h6>
            </div>
            <div class="card-body">
                <div>
                    <table class="table table-bordered table-responsive table-striped table-hover" id="dataTable"
                        width="100%" cellspacing="0">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                @if (Auth::user()->role_id == 3)
                                    <th>Nama Pemohon</th>
                                @endif
                                <th>Jenis Surat</th>
                                <th>Keperluan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($requests as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->created_at->format('d M Y') }}</td>
                                    @if (Auth::user()->role_id == 3)
                                        <td>{{ $item->user->name }}</td>
                                    @endif
                                    <td>{{ $item->letterType->name }}</td>
                                    <td>{{ $item->purpose }}</td>
                                    <td>
                                        @if ($item->status == 'pending')
                                            <span class="badge badge-warning">Menunggu</span>
                                        @elseif($item->status == 'approved')
                                            <span class="badge badge-success">Disetujui</span>
                                        @else
                                            <span class="badge badge-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if (Auth::user()->role_id == 3)
                                            @if ($item->status == 'pending')
                                                <div class="d-flex gap-2">
                                                    <button type="button" class="btn btn-success btn-sm mr-2"
                                                        data-toggle="modal" data-target="#modalApprove{{ $item->id }}">
                                                        Setuju
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#modalReject{{ $item->id }}">
                                                        Tolak
                                                    </button>
                                                </div>
                                            @endif
                                        @endif
                                        @include('pages.letter.confirmation-approve')
                                        @include('pages.letter.confirmation-reject')
                                        @include('pages.letter.detail-reject')
                                        @if ($item->status == 'approved')
                                            <a href="/letters/{{ $item->id }}/download" class="btn btn-primary btn-sm"
                                                target="_blank">
                                                <i class="fas fa-download"></i> Download PDF
                                            </a>
                                        @elseif($item->status == 'pending' && Auth::user()->id == $item->user_id)
                                            <a href="/letters/{{ $item->id }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="/letters/{{ $item->id }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Batalkan permohonan ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @elseif($item->status == 'rejected')
                                            <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal"
                                                title="Alasan Penolakan" data-target="#detailReject-{{ $item->id }}">
                                                <i class="fas fa-info-circle"></i> Info
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada data permohonan surat.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('[data-toggle="popover"]').popover()
        })
    </script>
@endpush

{{-- PUSH SCRIPTS & STYLES AGAR DATATABLES BERFUNGSI --}}
@push('styles')
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "columnDefs": [{
                        "orderable": false,
                        "targets": 1
                    } // Mematikan fitur sort di kolom Aksi
                ]
            });
        });
    </script>
@endpush
