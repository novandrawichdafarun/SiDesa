@extends('layouts.app');

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> generate Repoert</a> --}}
        </div>
        {{-- ======================= TAMPILAN ADMIN ======================= --}}
        @if (auth()->user()->role_id == 1)
            <div class="row">
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Permohonan Surat (Pending)</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pending_letters'] }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-envelope fa-2x text-gray-300"></i>
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
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Aduan Belum Diproses</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pending_complaints'] }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-bullhorn fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Penduduk</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['residents'] }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Permohonan Surat Terbaru</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Pemohon</th>
                                            <th>Jenis Surat</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentLetters as $letter)
                                            <tr>
                                                <td>{{ $letter->user->name ?? 'Warga' }}</td>
                                                <td>{{ $letter->letter_type ?? 'Surat Keterangan' }}</td>
                                                <td>{{ $letter->created_at->format('d M Y') }}</td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $letter->status == 'pending' ? 'warning' : ($letter->status == 'approved' ? 'success' : 'danger') }}">
                                                        {{ ucfirst($letter->status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Belum ada permohonan surat.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <a href="/letters" class="btn btn-sm btn-primary mt-2">Lihat Semua
                                &rarr;</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Demografi Gender</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="myPieChart"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <span class="mr-2">
                                    <i class="fas fa-circle text-primary"></i> Laki-laki
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-success"></i> Perempuan
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            {{-- ======================= TAMPILAN WARGA (USER) ======================= --}}
            @if (!$isProfileComplete)
                <div class="alert alert-warning border-left-warning" role="alert">
                    <h4 class="alert-heading">Profil Belum Lengkap!</h4>
                    <p>Halo, {{ auth()->user()->name }}. Agar kami dapat memproses surat Anda dengan cepat, mohon lengkapi
                        biodata kependudukan Anda.</p>
                    <hr>
                    <a href="/profile" class="btn btn-warning btn-sm">Lengkapi Biodata Sekarang</a>
                </div>
            @endif

            <div class="row mb-4">
                <div class="col-lg-6 mb-2">
                    <a href="/letters/create" class="btn btn-primary btn-icon-split btn-lg w-100">
                        <span class="icon text-white-50">
                            <i class="fas fa-file-alt"></i>
                        </span>
                        <span class="text w-100">Ajukan Surat Baru</span>
                    </a>
                </div>
                <div class="col-lg-6 mb-2">
                    <a href="/complaints/create" class="btn btn-danger btn-icon-split btn-lg w-100">
                        <span class="icon text-white-50">
                            <i class="fas fa-bullhorn"></i>
                        </span>
                        <span class="text w-100">Buat Laporan / Aduan</span>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Riwayat Surat Saya</h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @if (isset($myLetters))
                                    @forelse($myLetters as $letter)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <p>
                                                    <small class="text-muted">
                                                        {{ $letter->created_at->diffForHumans() }}
                                                    </small>
                                                </p>

                                                <p class="mt-4 text-nowrap">
                                                    <strong>{{ Str::limit($letter->purpose, 30) }}</strong>
                                                </p>
                                            </div>
                                            <span
                                                class="badge badge-{{ $letter->status == 'pending' ? 'warning' : 'success' }} badge-pill mt-3">
                                                {{ ucfirst($letter->status) }}
                                            </span>
                                        </li>
                                    @empty
                                        <li class="list-group-item text-center text-muted">Belum ada pengajuan surat.</li>
                                    @endforelse
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-danger">Aduan Saya</h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @if (isset($myComplaints))
                                    @forelse($myComplaints as $complaint)
                                        <li class="list-group-item">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-3 font-weight-bold text-truncate" style="max-width: 200px;">
                                                    {{ $complaint->title ?? 'Aduan' }}</h6>
                                                <small>{{ $complaint->created_at->diffForHumans() }}</small>
                                            </div>
                                            <p class="mb-3 text-muted small">{{ Str::limit($complaint->content, 50) }}
                                            </p>
                                            <span
                                                class="badge badge-{{ $complaint->status_label == 'Baru' ? 'primary' : ($complaint->status_label == 'Sedang Diproses' ? 'secondary' : 'success') }}">
                                                {{ ucfirst($complaint->status) }}
                                            </span>
                                        </li>
                                    @empty
                                        <li class="list-group-item text-center text-muted">Belum ada aduan yang dibuat.
                                        </li>
                                    @endforelse
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

{{-- Script Khusus unutk Admin Chart --}}
@if (auth()->user()->role_id == 1)
    @push('scripts')
        <script src="{{ asset('template/vendor/chart.js/Chart.min.js') }}"></script>
        <script>
            // Set default font family and color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = 'Nunito',
                '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#858796';

            // Data dari Controller
            var genderData = @json($genderData); // Output: {"L": 10, "P": 5}
            var maleCount = genderData['L'] || 0;
            var femaleCount = genderData['P'] || 0;

            // Pie Chart Example
            var ctx = document.getElementById("myPieChart");
            var myPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ["Laki-laki", "Perempuan"],
                    datasets: [{
                        data: [maleCount, femaleCount],
                        backgroundColor: ['#4e73df', '#1cc88a'],
                        hoverBackgroundColor: ['#2e59d9', '#17a673'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                    },
                    legend: {
                        display: false
                    },
                    cutoutPercentage: 80,
                },
            });
        </script>
    @endpush
@endif
