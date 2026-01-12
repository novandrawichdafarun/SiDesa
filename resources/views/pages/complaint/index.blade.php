@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i
                    class="fas fa-exclamation-circle text-primary mr-2"></i>{{ auth()->user()->role_id == 3 ? 'Aduan Warga' : 'Aduan' }}
            </h1>
            @if (isset(auth()->user()->resident))
                <a href="/complaint/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                    style="background: linear-gradient(135deg, #4e73df 0%, #2e59d9 100%); border: none;">
                    <i class="fas fa-plus fa-sm text-white-50 mr-2"></i>Buat Aduan
                </a>
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
        <div class="card shadow-lg mb-4" style="border: none; border-radius: 0.75rem;">
            <div class="card-header py-3"
                style="background: linear-gradient(135deg, #4e73df 0%, #2e59d9 100%); border-bottom: none;">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-list mr-2"></i>Daftar Aduan
                </h6>
            </div>
            <div class="card-body" style="padding: 1.5rem;">
                <div class="table-responsive">
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead style="background-color: #f8f9fa; border-bottom: 2px solid #e3e6f0;">
                            <tr>
                                <th class="text-center align-middle font-weight-600 text-gray-800">No.</th>
                                @if (auth()->user()->role_id != 2)
                                    <th class="text-center align-middle font-weight-600 text-gray-800">Nama Penduduk</th>
                                @endif
                                <th class="text-center align-middle font-weight-600 text-gray-800">Judul</th>
                                <th class="text-center align-middle font-weight-600 text-gray-800">Isi Aduan</th>
                                <th class="text-center align-middle font-weight-600 text-gray-800">Status</th>
                                <th class="text-center align-middle font-weight-600 text-gray-800">Foto Bukti</th>
                                <th class="text-center align-middle font-weight-600 text-gray-800">Tanggal Laporan</th>
                                @if (auth()->user()->role_id != 2)
                                    <th class="text-center align-middle font-weight-600 text-gray-800">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($complaints as $item)
                                <tr>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    @if (auth()->user()->role_id != 2)
                                        <td class="align-middle">{{ $item->resident->name }}</td>
                                    @endif
                                    <td class="align-middle">
                                        <span class="font-weight-bold text-dark">{{ $item->title }}</span>
                                    </td>
                                    <td class="align-middle">{!! wordwrap($item->content, 70, '<br>') !!}</td>
                                    <td class="text-center align-middle">
                                        @if ($item->status_label == 'Baru')
                                            <span class="badge"
                                                style="background-color: #4e73df; color: white; padding: 0.5rem 0.75rem; border-radius: 0.25rem;">{{ $item->status_label }}</span>
                                        @elseif ($item->status_label == 'Sedang Diproses')
                                            <span class="badge"
                                                style="background-color: #f6c23e; color: #333; padding: 0.5rem 0.75rem; border-radius: 0.25rem;">{{ $item->status_label }}</span>
                                        @else
                                            <span class="badge"
                                                style="background-color: #1cc88a; color: white; padding: 0.5rem 0.75rem; border-radius: 0.25rem;">{{ $item->status_label }}</span>
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
                                        @if (auth()->user()->role_id != 2 && isset(auth()->user()->resident) && $item->status == 'new')
                                            <div class="d-flex align-items-center justify-content-center gap-2">
                                                <a href="/complaint/{{ $item->id }}" class="btn btn-sm"
                                                    style="background-color: #f6c23e; color: #333; border: none; border-radius: 0.25rem; padding: 0.5rem 0.75rem; transition: all 0.3s ease;"
                                                    onmouseover="this.style.backgroundColor='#e0b323'"
                                                    onmouseout="this.style.backgroundColor='#f6c23e'"><i
                                                        class="fas fa-edit"></i></a>
                                                <button type="button" class="btn btn-sm"
                                                    style="background-color: #e74c3c; color: white; border: none; border-radius: 0.25rem; padding: 0.5rem 0.75rem; transition: all 0.3s ease;"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#confirmationDelete-{{ $item->id }}"
                                                    onmouseover="this.style.backgroundColor='#c0392b'"
                                                    onmouseout="this.style.backgroundColor='#e74c3c'"><i
                                                        class="fas fa-trash"></i></button>
                                            </div>
                                        @elseif (auth()->user()->role_id != 2)
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
                                    <td colspan="{{ auth()->user()->role_id != 2 ? '8' : '6' }}" class="text-center py-5">
                                        <i class="fas fa-inbox text-gray-300 mb-3"
                                            style="font-size: 3rem; display: block;"></i>
                                        <h6 class="text-gray-500 font-weight-500">Data aduan belum tersedia.</h6>
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
