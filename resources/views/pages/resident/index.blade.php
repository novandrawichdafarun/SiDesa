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
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
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
                            @if (count($residents) > 0)
                                @foreach ($residents as $item)
                                    <tr>
                                        <td>{{ $item->nik }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->gender }}</td>
                                        <td>{{ $item->birth_place }}, {{ $item->birth_date }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>{{ $item->religion }}</td>
                                        <td>{{ $item->marital_status }}</td>
                                        <td>{{ $item->occupation }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="/resident/{{ $item->id }}"
                                                    class="d-inline-block mr-2 btn btn-warning"><i
                                                        class="fas fa-edit"></i></a>
                                                <a href="/resident/{{ $item->id }}" class="btn btn-danger"><i
                                                        class="fas fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="11" class="text-center">Data Kosong</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
