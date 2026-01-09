@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Akun Penduduk</h1>
    </div>

    {{-- ... card body ... --}}
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center text-middle">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status</th> {{-- Tambah Lajur Status --}}
                            <th>Aktivasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center align-middle">
                        @forelse ($users as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    @if ($item->status == 'approved')
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        @if ($item->status == 'rejected')
                                            {{-- Butang Aktifkan (Jika rejected) --}}
                                            <button type="button" class="btn btn-outline-success btn-sm mr-2"
                                                data-toggle="modal" data-target="#modalApprove{{ $item->id }}">
                                                Aktifkan Akun
                                            </button>
                                        @else
                                            {{-- Butang Nyahaktifkan (Jika approved) --}}
                                            <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                                data-target="#modalReject{{ $item->id }}">
                                                Non-Aktifkan Akun
                                            </button>
                                        @endif
                                    </div>
                                    {{-- Include Modals --}}
                                    @include('pages.account-list.confirmation-approve')
                                    @include('pages.account-list.confirmation-reject')
                                </td>
                                <td class="text-center align-middle">
                                    <a href="/account-list/{{ $item->id }}"
                                        class="d-inline-block mr-2 btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger mr-2 btn-circle btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#confirmationDelete-{{ $item->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @include('pages.account-list.confirmation-delete')
                        @empty
                            <tr>
                                <td colspan="12" class="text-center">
                                    <img src="{{ asset('template/img/undraw_posting_photo.svg') }}" alt="No Data"
                                        style="height: 100px;" class="mb-3 d-block mx-auto">
                                    <h6 class="text-gray-500">Data akun penduduk belum tersedia.</h6>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

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
