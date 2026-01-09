@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Permintaan Akun</h1>
    </div>

    {{-- Tabel --}}
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    <span class="badge badge-warning">{{ $item->status }}</span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-success btn-sm mr-2" data-toggle="modal"
                                            data-target="#modalApprove{{ $item->id }}">
                                            Setuju
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#modalReject{{ $item->id }}">
                                            Tolak
                                        </button>
                                    </div>

                                    @include('pages.account-request.confirmation-approve')
                                    @include('pages.account-request.confirmation-reject')
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center">
                                    <img src="{{ asset('template/img/undraw_posting_photo.svg') }}" alt="No Data"
                                        style="height: 100px;" class="mb-3 d-block mx-auto">
                                    <h6 class="text-gray-500">Belum ada permintaan</h6>
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
