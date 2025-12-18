@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Akun Penduduk</h1>
    </div>

    {{-- ... card body ... --}}

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Status</th> {{-- Tambah Lajur Status --}}
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $item)
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
                                <button type="button" class="btn btn-outline-success btn-sm mr-2" data-toggle="modal"
                                    data-target="#modalApprove{{ $item->id }}">
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
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
