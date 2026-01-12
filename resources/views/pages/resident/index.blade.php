@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-users text-primary mr-2"></i>Data Penduduk
            </h1>
            <a href="/resident/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                style="background: linear-gradient(135deg, #4e73df 0%, #2e59d9 100%); border: none;">
                <i class="fas fa-plus fa-sm text-white-50 mr-2"></i>Tambah Penduduk
            </a>
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
        <div class="card shadow-lg mb-4" style="border: none; border-radius: 0.75rem;">
            <div class="card-header py-3"
                style="background: linear-gradient(135deg, #4e73df 0%, #2e59d9 100%); border-bottom: none;">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-table mr-2"></i>Daftar Penduduk
                </h6>
            </div>
            <div class="card-body" style="padding: 1.5rem;">
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap" id="dataTable" width="100%" cellspacing="0"
                        style="border-collapse: separate; border-spacing: 0;">
                        <thead style="background-color: #f8f9fa; border-bottom: 2px solid #e3e6f0;">
                            <tr>
                                <th class="text-center align-middle font-weight-600 text-gray-800">No.</th>
                                <th class="text-center align-middle font-weight-600 text-gray-800">NIK</th>
                                <th class="text-center align-middle font-weight-600 text-gray-800">Nama</th>
                                <th class="text-center align-middle font-weight-600 text-gray-800">Jenis Kelamin</th>
                                <th class="text-center align-middle font-weight-600 text-gray-800">Tempat Tanggal Lahir</th>
                                <th class="text-center align-middle font-weight-600 text-gray-800">Alamat</th>
                                <th class="text-center align-middle font-weight-600 text-gray-800">RT/RW</th>
                                <th class="text-center align-middle font-weight-600 text-gray-800">Agama</th>
                                <th class="text-center align-middle font-weight-600 text-gray-800">Status Perkawinan</th>
                                <th class="text-center align-middle font-weight-600 text-gray-800">Pekerjaan</th>
                                <th class="text-center align-middle font-weight-600 text-gray-800">No. Telp</th>
                                <th class="text-center align-middle font-weight-600 text-gray-800">Status Penduduk</th>
                                <th class="text-center align-middle font-weight-600 text-gray-800">Aksi</th>
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
                                            <span class="badge"
                                                style="background-color: #4e73df; color: white; padding: 0.5rem 0.75rem; border-radius: 0.25rem;">Laki-laki</span>
                                        @else
                                            <span class="badge"
                                                style="background-color: #f6c23e; color: #333; padding: 0.5rem 0.75rem; border-radius: 0.25rem;">Perempuan</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">{{ $item->birth_place }},
                                        {{ date('d-m-Y', strtotime($item->birth_date)) }}</td>
                                    <td class="align-middle">{{ $item->address }}</td>
                                    <td class="align-middle">
                                        @if (isset($item->rt) && isset($item->rw))
                                            RT {{ $item->rt }} / RW {{ $item->rw }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="align-middle">{{ $item->religion }}</td>
                                    <td class="text-center align-middle">
                                        @if ($item->marital_status == 'single')
                                            <span class="badge"
                                                style="background-color: #4e73df; color: white; padding: 0.5rem 0.75rem; border-radius: 0.25rem;">Belum
                                                Menikah</span>
                                        @elseif ($item->marital_status == 'married')
                                            <span class="badge"
                                                style="background-color: #1cc88a; color: white; padding: 0.5rem 0.75rem; border-radius: 0.25rem;">Sudah
                                                Menikah</span>
                                        @elseif ($item->marital_status == 'divorced')
                                            <span class="badge"
                                                style="background-color: #f6c23e; color: #333; padding: 0.5rem 0.75rem; border-radius: 0.25rem;">Cerai</span>
                                        @else
                                            <span class="badge"
                                                style="background-color: #e74c3c; color: white; padding: 0.5rem 0.75rem; border-radius: 0.25rem;">Duda/Janda</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">{{ $item->occupation }}</td>
                                    <td class="align-middle">{{ $item->phone }}</td>
                                    <td class="text-center align-middle">
                                        @if ($item->status == 'active')
                                            <span class="badge"
                                                style="background-color: #1cc88a; color: white; padding: 0.5rem 0.75rem; border-radius: 0.25rem;">Hidup</span>
                                        @elseif ($item->status == 'moved')
                                            <span class="badge"
                                                style="background-color: #f6c23e; color: #333; padding: 0.5rem 0.75rem; border-radius: 0.25rem;">Pindah</span>
                                        @else
                                            <span class="badge"
                                                style="background-color: #e74c3c; color: white; padding: 0.5rem 0.75rem; border-radius: 0.25rem;">Almarhum</span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle text-nowrap">
                                        <a href="/resident/{{ $item->id }}" class="d-inline-block mr-2 btn btn-sm"
                                            style="background-color: #f6c23e; color: #333; border: none; border-radius: 0.25rem; padding: 0.5rem 0.75rem; transition: all 0.3s ease;"
                                            onmouseover="this.style.backgroundColor='#e0b323'"
                                            onmouseout="this.style.backgroundColor='#f6c23e'"><i
                                                class="fas fa-edit"></i></a>
                                        <button type="button" class="btn btn-sm mr-2"
                                            style="background-color: #e74c3c; color: white; border: none; border-radius: 0.25rem; padding: 0.5rem 0.75rem; transition: all 0.3s ease;"
                                            data-bs-toggle="modal" data-bs-target="#confirmationDelete-{{ $item->id }}"
                                            onmouseover="this.style.backgroundColor='#c0392b'"
                                            onmouseout="this.style.backgroundColor='#e74c3c'"><i
                                                class="fas fa-trash"></i></button>
                                        @if (!is_null($item->user_id))
                                            <button type="button" class="btn btn-sm"
                                                style="background-color: #3498db; color: white; border: none; border-radius: 0.25rem; padding: 0.5rem 0.75rem; transition: all 0.3s ease;"
                                                data-bs-toggle="modal" data-bs-target="#detailAccount-{{ $item->id }}"
                                                onmouseover="this.style.backgroundColor='#2980b9'"
                                                onmouseout="this.style.backgroundColor='#3498db'">
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
                                    <td colspan="12" class="text-center py-5">
                                        <i class="fas fa-inbox text-gray-300 mb-3"
                                            style="font-size: 3rem; display: block;"></i>
                                        <h6 class="text-gray-500 font-weight-500">Data penduduk belum tersedia.</h6>
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
