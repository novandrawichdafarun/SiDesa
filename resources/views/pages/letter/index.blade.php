@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-envelope text-primary mr-2"></i>Layanan Surat Menyurat
            </h1>
            @if (Auth::user()->role_id !== 1)
                <a href="/letters/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                    style="background: linear-gradient(135deg, #4e73df 0%, #2e59d9 100%); border: none;">
                    <i class="fas fa-plus fa-sm text-white-50 mr-2"></i>Buat Permohonan Surat
                </a>
            @endif
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card shadow-lg mb-4" style="border: none; border-radius: 0.75rem;">
            <div class="card-header py-3"
                style="background: linear-gradient(135deg, #4e73df 0%, #2e59d9 100%); border-bottom: none;">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-list mr-2"></i>Daftar Permohonan Surat
                </h6>
            </div>
            <div class="card-body" style="padding: 1.5rem;">
                <div class="table-responsive">
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead style="background-color: #f8f9fa; border-bottom: 2px solid #e3e6f0;">
                            <tr>
                                <th class="text-center align-middle font-weight-600 text-gray-800">No</th>
                                <th class="text-center align-middle font-weight-600 text-gray-800">Tanggal</th>
                                @if (Auth::user()->role_id == 3)
                                    <th class="text-center align-middle font-weight-600 text-gray-800">Nama Pemohon</th>
                                @endif
                                <th class="text-center align-middle font-weight-600 text-gray-800">Jenis Surat</th>
                                <th class="text-center align-middle font-weight-600 text-gray-800">Keperluan</th>
                                <th class="text-center align-middle font-weight-600 text-gray-800">Status</th>
                                <th class="text-center align-middle font-weight-600 text-gray-800">Aksi</th>
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
                                    <td>{!! wordwrap($item->purpose, 70, '<br>') !!}</td>
                                    <td class="text-center align-middle">
                                        @if ($item->status == 'pending')
                                            <span class="badge"
                                                style="background-color: #4e73df; color: white; padding: 0.5rem 0.75rem; border-radius: 0.25rem;">Menunggu</span>
                                        @elseif($item->status == 'disetujui_rt_rw')
                                            <span class="badge"
                                                style="background-color: #1cc88a; color: white; padding: 0.5rem 0.75rem; border-radius: 0.25rem;">Disetujui
                                                RT/RW</span>
                                        @elseif ($item->status == 'disetujui_admin')
                                            <span class="badge"
                                                style="background-color: #f6c23e; color: #333; padding: 0.5rem 0.75rem; border-radius: 0.25rem;">Menunggu
                                                Tanda Tangan</span>
                                        @elseif ($item->status == 'selesai')
                                            <span class="badge"
                                                style="background-color: #1cc88a; color: white; padding: 0.5rem 0.75rem; border-radius: 0.25rem;">Selesai</span>
                                        @else
                                            <span class="badge"
                                                style="background-color: #e74c3c; color: white; padding: 0.5rem 0.75rem; border-radius: 0.25rem;">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="text-center text-nowrap align-middle">
                                        @if (Auth::user()->role_id == 4)
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
                                        @if (Auth::user()->role_id == 1)
                                            @if ($item->status == 'disetujui_rt_rw')
                                                <div class="d-flex gap-2">
                                                    <button type="button" class="btn btn-success btn-sm mr-2"
                                                        data-toggle="modal" data-target="#modalApprove{{ $item->id }}">
                                                        Verivikasi
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#modalReject{{ $item->id }}">
                                                        Tolak
                                                    </button>
                                                </div>
                                            @endif
                                        @endif
                                        @if (Auth::user()->role_id == 3)
                                            @if ($item->status == 'disetujui_admin')
                                                <div class="d-flex gap-2">
                                                    <button type="button" class="btn btn-success btn-sm mr-2"
                                                        data-toggle="modal" data-target="#modalApprove{{ $item->id }}">
                                                        Tanda Tangan
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
                                        @if ($item->status === 'selesai')
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
                                    <td colspan="7" class="text-center py-5">
                                        <i class="fas fa-inbox text-gray-300 mb-3"
                                            style="font-size: 3rem; display: block;"></i>
                                        <h6 class="text-gray-500 font-weight-500">Belum ada data permohonan surat.</h6>
                                    </td>
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
