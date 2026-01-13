@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-wallet text-primary mr-2"></i>Transparansi Dana Desa
            </h1>
            <form action="{{ route('funds.index') }}" method="GET"
                class="d-none d-sm-inline-block form-inline ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <select name="year" class="form-control bg-light border-0 small mr-2" onchange="this.form.submit()">
                        @for ($y = date('Y'); $y >= 2020; $y--)
                            <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>Tahun Anggaran
                                {{ $y }}</option>
                        @endfor
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-calendar fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Pemasukan
                                    (Realisasi)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp
                                    {{ number_format($totalIncomeRealized, 0, ',', '.') }}</div>
                                <small class="text-gray-500">Target: Rp
                                    {{ number_format($totalIncomePlanned, 0, ',', '.') }}</small>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Pengeluaran
                                    (Realisasi)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp
                                    {{ number_format($totalExpenseRealized, 0, ',', '.') }}</div>
                                <small class="text-gray-500">Pagu: Rp
                                    {{ number_format($totalExpensePlanned, 0, ',', '.') }}</small>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Sisa Kas Desa</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    Rp {{ number_format($totalIncomeRealized - $totalExpenseRealized, 0, ',', '.') }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-wallet fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Rincian APBDes Tahun {{ $year }}</h6>

                @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 3)
                    <button class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addCategoryModal">
                        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Pos Anggaran
                    </button>
                @endif
            </div>
            <div class="card-body">
                @if ($categories->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Pos Anggaran</th>
                                    <th>Jenis</th>
                                    <th class="text-right">Pagu / Target</th>
                                    <th class="text-right">Realisasi</th>
                                    <th class="text-center" width="15%">Persentase</th>
                                    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 3)
                                        <th class="text-center">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    @php
                                        $percent =
                                            $category->budget_cap > 0
                                                ? ($category->realized_amount / $category->budget_cap) * 100
                                                : 0;
                                        $color = $category->type == 'income' ? 'success' : 'danger';
                                    @endphp
                                    <tr class="bg-light font-weight-bold" data-toggle="collapse"
                                        data-target="#collapse{{ $category->id }}" style="cursor: pointer;"
                                        title="Klik untuk lihat detail transaksi">
                                        <td>
                                            <i class="fas fa-caret-right mr-2"></i> {{ $category->name }}
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $color }}">
                                                {{ $category->type == 'income' ? 'Pemasukan' : 'Pengeluaran' }}
                                            </span>
                                        </td>
                                        <td class="text-right">Rp {{ number_format($category->budget_cap, 0, ',', '.') }}
                                        </td>
                                        <td class="text-right">Rp
                                            {{ number_format($category->realized_amount, 0, ',', '.') }}</td>
                                        <td class="align-middle">
                                            <div class="progress progress-sm mr-2">
                                                <div class="progress-bar bg-{{ $color }}" role="progressbar"
                                                    style="width: {{ $percent }}%"
                                                    aria-valuenow="{{ $percent }}" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                            <small>{{ number_format($percent, 1) }}%</small>
                                        </td>
                                        @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 3)
                                            <td class="text-center">
                                                <button class="btn btn-warning btn-sm btn-circle" data-toggle="modal"
                                                    data-target="#editCategoryModal{{ $category->id }}"
                                                    title="Edit Anggaran">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form action="{{ route('funds.category.destroy', $category->id) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus pos ini beserta seluruh transaksinya?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm btn-circle" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                                <button class="btn btn-success btn-sm btn-circle" data-toggle="modal"
                                                    data-target="#addTransactionModal{{ $category->id }}"
                                                    title="Catat Realisasi">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </td>
                                        @endif
                                    </tr>

                                    <tr>
                                        <td colspan="6" class="p-0">
                                            <div id="collapse{{ $category->id }}" class="collapse">
                                                <div class="p-3 bg-white border-left-{{ $color }}">
                                                    <h6 class="font-weight-bold text-gray-700">Riwayat Transaksi:
                                                        {{ $category->name }}</h6>
                                                    <table class="table table-sm table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Tanggal</th>
                                                                <th>Uraian</th>
                                                                <th class="text-right">Jumlah</th>
                                                                <th class="text-center">Bukti</th>
                                                                @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 3)
                                                                    <th class="text-center">Hapus</th>
                                                                @endif
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse($category->transactions as $transaction)
                                                                <tr>
                                                                    <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y') }}
                                                                    </td>
                                                                    <td>{{ $transaction->title }}</td>
                                                                    <td class="text-right">Rp
                                                                        {{ number_format($transaction->amount, 0, ',', '.') }}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        @if ($transaction->proof_file)
                                                                            <button
                                                                                class="btn btn-info btn-sm btn-icon-split"
                                                                                onclick="showProof('{{ asset('storage/' . $transaction->proof_file) }}', '{{ $transaction->title }}')">
                                                                                <span class="icon text-white-50"><i
                                                                                        class="fas fa-image"></i></span>
                                                                                <span class="text">Lihat</span>
                                                                            </button>
                                                                        @else
                                                                            <span class="text-muted small">-</span>
                                                                        @endif
                                                                    </td>
                                                                    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 3)
                                                                        <td class="text-center">
                                                                            <form
                                                                                action="{{ route('funds.transaction.destroy', $transaction->id) }}"
                                                                                method="POST"
                                                                                onsubmit="return confirm('Hapus transaksi ini?')">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button
                                                                                    class="btn btn-danger btn-sm px-2 py-0"><i
                                                                                        class="fas fa-times"></i></button>
                                                                            </form>
                                                                        </td>
                                                                    @endif
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="5"
                                                                        class="text-center text-muted font-italic">Belum
                                                                        ada realisasi dana.</td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <img src="{{ asset('template/img/undraw_posting_photo.svg') }}" style="width: 200px"
                            class="mb-3 opacity-50">
                        <p class="text-gray-500 mb-0">Belum ada data anggaran untuk tahun {{ $year }}.</p>
                    </div>
                @endif
            </div>
        </div>

    </div>
    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 3)
        @foreach ($categories as $category)
            <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form class="modal-content" action="{{ route('funds.category.update', $category->id) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Pos Anggaran</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Pos</label>
                                <input type="text" name="name" class="form-control" value="{{ $category->name }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Pagu Anggaran (Rp)</label>
                                <input type="number" name="budget_cap" class="form-control"
                                    value="{{ $category->budget_cap }}" required>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="description" class="form-control">{{ $category->description }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan
                                Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal fade" id="addTransactionModal{{ $category->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form class="modal-content" action="/funds/transaction" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="fund_category_id" value="{{ $category->id }}">
                        <div class="modal-header">
                            <h5 class="modal-title">Catat Realisasi: {{ $category->name }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal"
                                aria-label="Close">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Tanggal Transaksi</label>
                                <input type="date" name="transaction_date" class="form-control"
                                    value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="form-group">
                                <label>Uraian / Judul</label>
                                <input type="text" name="title" class="form-control"
                                    placeholder="Contoh: Pembelian Semen 50 Sak" required>
                            </div>
                            <div class="form-group">
                                <label>Nominal (Rp)</label>
                                <input type="number" name="amount" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Bukti (Foto/Nota)</label>
                                <input type="file" name="proof_file" class="form-control-file"
                                    accept="image/*,application/pdf">
                                <small class="text-muted">Opsional. Format: JPG, PNG. Max
                                    2MB.</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan
                                Transaksi</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    @endif

    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 3)
        <div class="modal fade" id="addCategoryModal" tabindex="-1">
            <div class="modal-dialog">
                <form class="modal-content" action="/funds/category" method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Pos Anggaran Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal"
                            aria-label="Close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tahun Anggaran</label>
                            <input type="number" name="fiscal_year" class="form-control" value="{{ date('Y') }}"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label>Nama Pos Anggaran</label>
                            <input type="text" name="name" class="form-control"
                                placeholder="Contoh: Dana Desa Tahap 1" required>
                        </div>
                        <div class="form-group">
                            <label>Jenis</label>
                            <select name="type" class="form-control">
                                <option value="income">Pemasukan (Pendapatan)</option>
                                <option value="expense">Pengeluaran (Belanja)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Pagu / Target (Rp)</label>
                            <input type="number" name="budget_cap" class="form-control" placeholder="0" required>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="description" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <div class="modal fade" id="proofModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="proofModalTitle">Bukti Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal"
                        aria-label="Close">&times;</button>
                </div>
                <div class="modal-body text-center bg-dark">
                    <img id="proofImage" src="" class="img-fluid" alt="Bukti Transaksi">
                </div>
            </div>
        </div>
    </div>

    <script>
        // Script sederhana untuk menampilkan gambar di modal
        function showProof(url, title) {
            document.getElementById('proofImage').src = url;
            document.getElementById('proofModalTitle').innerText = 'Bukti: ' + title;
            $('#proofModal').modal('show');
        }
    </script>

@endsection
