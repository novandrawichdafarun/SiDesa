@extends('layouts.app')

@section('content')
    {{-- Tabel --}}
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-user-check text-primary mr-2"></i>Permintaan Akun
            </h1>
        </div>

        {{-- ... card body ... --}}
        <div class="card shadow-lg mb-4" style="border: none; border-radius: 0.75rem;">
            <div class="card-header py-3"
                style="background: linear-gradient(135deg, #4e73df 0%, #2e59d9 100%); border-bottom: none;">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-list mr-2"></i>Daftar Permintaan Akun
                </h6>
            </div>
            <div class="card-body" style="padding: 1.5rem;">
                <div class="table-responsive">
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead style="background-color: #f8f9fa; border-bottom: 2px solid #e3e6f0;">
                            <tr>
                                <th class="text-center align-middle font-weight-600 text-gray-800">No</th>
                                <th class="text-center align-middle font-weight-600 text-gray-800">Nama</th>
                                <th class="text-center align-middle font-weight-600 text-gray-800">Email</th>
                                <th class="text-center align-middle font-weight-600 text-gray-800">Status</th>
                                <th class="text-center align-middle font-weight-600 text-gray-800">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $index => $item)
                                <tr>
                                    <td class="text-center align-middle">{{ $index + 1 }}</td>
                                    <td class="align-middle">{{ $item->name }}</td>
                                    <td class="align-middle">{{ $item->email }}</td>
                                    <td class="text-center align-middle">
                                        <span class="badge"
                                            style="background-color: #f6c23e; color: #333; padding: 0.5rem 0.75rem; border-radius: 0.25rem;">{{ $item->status == 'submitted' ? 'Menunggu' : 'Diterima' }}</span>
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="btn btn-sm mr-2"
                                                style="background-color: #1cc88a; color: white; border: none; border-radius: 0.25rem; padding: 0.5rem 0.75rem; transition: all 0.3s ease;"
                                                data-toggle="modal" data-target="#modalApprove{{ $item->id }}"
                                                onmouseover="this.style.backgroundColor='#15a26e'"
                                                onmouseout="this.style.backgroundColor='#1cc88a'">
                                                Setuju
                                            </button>
                                            <button type="button" class="btn btn-sm"
                                                style="background-color: #e74c3c; color: white; border: none; border-radius: 0.25rem; padding: 0.5rem 0.75rem; transition: all 0.3s ease;"
                                                data-toggle="modal" data-target="#modalReject{{ $item->id }}"
                                                onmouseover="this.style.backgroundColor='#c0392b'"
                                                onmouseout="this.style.backgroundColor='#e74c3c'">
                                                Tolak
                                            </button>
                                        </div>

                                        @include('pages.account-request.confirmation-approve')
                                        @include('pages.account-request.confirmation-reject')
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <i class="fas fa-inbox text-gray-300 mb-3"
                                            style="font-size: 3rem; display: block;"></i>
                                        <h6 class="text-gray-500 font-weight-500">Belum ada permintaan</h6>
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
