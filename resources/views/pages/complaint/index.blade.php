@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ auth()->user()->role_id == 1 ? 'Aduan Warga' : 'Aduan' }}</h1>
        @if (isset(auth()->user()->resident))
            <a href="/complaint/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Buat Aduan</a>
        @endif
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
            <div class="card-body d-block">
                <div>
                    <table class="table table-bordered table-striped table-hover table-responsive text-nowrap" id="dataTable"
                        width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Judul</th>
                                <th>Isi Aduan</th>
                                <th>Status</th>
                                <th>Foto Bukti</th>
                                <th>Tangal Laporan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($complaints as $item)
                                <tr>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">
                                        <span class="font-weight-bold text-dark">{{ $item->title }}</span>
                                    </td>
                                    <td class="align-middle">{{ $item->content }}</td>
                                    <td class="align-middle">
                                        @if ($item->status_label == 'Baru')
                                            <span class="badge badge-primary">{{ $item->status_label }}</span>
                                        @elseif ($item->status_label == 'Sedang Diproses')
                                            <span class="badge badge-warning">{{ $item->status_label }}</span>
                                        @else
                                            <span class="badge badge-success">{{ $item->status_label }}</span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        @if (isset($item->photo_proof))
                                            @php
                                                $filePath = 'storage/' . $item->photo_proof;
                                            @endphp
                                            <a href="{{ $filePath }}" target="_blank" rel="noopener noreferrer">
                                                <img src="{{ $filePath }}" alt="Foto Bukti" style="max-width: 300px">
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        {{ $item->report_date_label }}
                                    </td>
                                    <td class="text-center align-middle">
                                        @if (auth()->user()->role_id == 2 && isset(auth()->user()->resident) && $item->status == 'new')
                                            <div class="d-flex align-items-center">
                                                <a href="/complaint/{{ $item->id }}"
                                                    class="d-inline-block btn btn-warning btn-circle btn-sm"><i
                                                        class="fas fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-circle btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#confirmationDelete-{{ $item->id }}"><i
                                                        class="fas fa-trash"></i></button>
                                            </div>
                                        @elseif (auth()->user()->role_id == 1)
                                            <div class="">
                                                <form id="formChangeStatus-{{ $item->id }}"
                                                    action="/complaint/update-status/{{ $item->id }}" method="post">
                                                    @csrf
                                                    @method('POST')
                                                    <div class="form-group">
                                                        <select name="status" id="status" class="form-control"
                                                            style="min-width: 150px"
                                                            oninput="document.getElementById('formChangeStatus-{{ $item->id }}').submit()">
                                                            @foreach ([
            (object)
    [
                'label' => 'Baru',
                'value' => 'new',
            ],
            (object) [
                'label' => 'Sedang Diproses',
                'value' => 'processing',
            ],
            (object) [
                'label' => 'Selesai',
                'value' => 'completed',
            ],
        ] as $status)
                                                                <option value="{{ $status->value }}"
                                                                    @selected($item->status == $status->value)>{{ $status->label }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                @if (!is_null($item->user_id))
                                    @include('pages.complaint.detail-account')
                                @endif
                                @include('pages.complaint.confirmation-delete')
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <img src="{{ asset('template/img/undraw_posting_photo.svg') }}" alt="No Data"
                                            style="height: 100px;" class="mb-3 d-block mx-auto">
                                        <h6 class="text-gray-500">Data aduan belum tersedia.</h6>
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
                        "targets": 5
                    } // Mematikan fitur sort di kolom Aksi
                ]
            });
        });
    </script>
@endpush
