@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Penduduk</h1>
        <a href="/resident/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Tambah Penduduk</a>
    </div>

    {{-- Tabel --}}
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div>
                    <table class="table table-bordered table-striped table-hover table-responsive text-nowrap" id="dataTable"
                        width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>Agama</th>
                                <th>Status Perkawinan</th>
                                <th>Pekerjaan</th>
                                <th>No. Telp</th>
                                <th>Status Penduduk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse($residents as $item)
                                <tr>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $item->nik }}</td>
                                    <td class="align-middle">
                                        <span class="font-weight-bold text-dark">{{ $item->name }}</span>
                                    </td>
                                    <td class="align-middle">
                                        @if ($item->gender == 'male')
                                            <span class="badge badge-primary">Laki-laki</span>
                                        @else
                                            <span class="badge badge-warning">Perempuan</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">{{ $item->birth_place }},
                                        {{ date('d-m-Y', strtotime($item->birth_date)) }}</td>
                                    <td class="align-middle">{{ $item->address }}</td>
                                    <td class="align-middle">{{ $item->religion }}</td>
                                    <td class="align-middle">
                                        {{ $item->marital_status }}
                                    </td>
                                    <td class="align-middle">{{ $item->occupation }}</td>
                                    <td class="align-middle">{{ $item->phone }}</td>
                                    <td class="align-middle">
                                        {{ $item->status }}
                                    </td>
                                    <td class="text-center align-middle">
                                        <a href="/resident/{{ $item->id }}"
                                            class="d-inline-block mr-2 btn btn-warning btn-circle btn-sm"><i
                                                class="fas fa-edit"></i></a>
                                        <button type="button" class="btn btn-danger btn-circle btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#confirmationDelete-{{ $item->id }}"><i
                                                class="fas fa-trash"></i></button>
                                        @if (!is_null($item->user_id))
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#detailAccount{{ $item->id }}">
                                                <i class="fas fa-user"></i>
                                            </button>

                                            @include('pages.resident.detail-account')
                                        @endif
                                    </td>
                                </tr>
                                @include('pages.resident.confirmation-delete')
                            @empty
                                <tr>
                                    <td colspan="12" class="text-center">
                                        <img src="{{ asset('template/img/undraw_posting_photo.svg') }}" alt="No Data"
                                            style="height: 100px;" class="mb-3 d-block mx-auto">
                                        <h6 class="text-gray-500">Data penduduk belum tersedia.</h6>
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
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json" // Mengubah bahasa ke Indonesia
                },
                "columnDefs": [{
                        "orderable": false,
                        "targets": 5
                    } // Mematikan fitur sort di kolom Aksi
                ]
            });
        });
    </script>
@endpush
