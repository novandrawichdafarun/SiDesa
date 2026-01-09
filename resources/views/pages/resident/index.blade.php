@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Penduduk</h1>
        <a href="/resident/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Tambah Penduduk</a>
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                title: "Berhasil",
                Text: "{{ session()->get('success') }}",
                icon: "success"
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                title: "Terjadi Kesalahan!",
                Text: "{{ session()->get('error') }}",
                icon: "error"
            });
        </script>
    @endif

    {{-- Tabel --}}
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div>
                    <table class="table table-bordered table-striped table-hover table-responsive text-nowrap" id="dataTable"
                        width="100%" cellspacing="0">
                        <thead class="text-center align-middle">
                            <tr>
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
                        <tbody>
                            @forelse($residents as $item)
                                <tr>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $item->nik }}</td>
                                    <td class="align-middle">
                                        <span class="font-weight-bold text-dark">{{ $item->name }}</span>
                                    </td>
                                    <td class="text-center align-middle">
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
                                    <td class="text-center align-middle">
                                        @if ($item->marital_status == 'single')
                                            <span class="badge badge-primary">Belum Menikah</span>
                                        @elseif ($item->marital_status == 'married')
                                            <span class="badge badge-success">Sudah Menikah</span>
                                        @elseif ($item->marital_status == 'divorced')
                                            <span class="badge badge-warning">Cerai</span>
                                        @else
                                            <span class="badge badge-danger">Duda/Janda</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">{{ $item->occupation }}</td>
                                    <td class="align-middle">{{ $item->phone }}</td>
                                    <td class="text-center align-middle">
                                        @if ($item->status == 'active')
                                            <span class="badge badge-success">Hidup</span>
                                        @elseif ($item->status == 'moved')
                                            <span class="badge badge-warning">Pindah</span>
                                        @else
                                            <span class="badge badge-danger">Almarhum</span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle text-nowrap">
                                        <a href="/resident/{{ $item->id }}"
                                            class="d-inline-block mr-1 btn btn-warning btn-circle btn-sm"><i
                                                class="fas fa-edit"></i></a>
                                        <button type="button" class="btn btn-danger mr-1 btn-circle btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#confirmationDelete-{{ $item->id }}"><i
                                                class="fas fa-trash"></i></button>
                                        @if (!is_null($item->user_id))
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#detailAccount-{{ $item->id }}">
                                                <i class="fas fa-user"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                                @if (!is_null($item->user_id))
                                    @include('pages.resident.detail-account')
                                @endif
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
                "columnDefs": [{
                        "orderable": false,
                        "targets": 1
                    } // Mematikan fitur sort di kolom Aksi
                ]
            });
        });
    </script>
@endpush
