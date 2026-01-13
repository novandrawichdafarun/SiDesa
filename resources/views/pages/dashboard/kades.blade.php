<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-user-tie text-primary mr-2"></i>Dashboard Kepala Desa
    </h1>
</div>

<!-- Stat Cards -->
<div class="row mb-4">
    <div class="col-xl-4 col-md-6 mb-3">
        <div class="card border-0 shadow-sm stat-card h-100 bg-gradient-success">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-white-50 small font-weight-bold text-uppercase">Perlu Tanda Tangan</div>
                        <h3 class="text-white font-weight-bold mt-2">{{ $stats['waiting_signature'] ?? 0 }}</h3>
                        <p class="text-white-50 small mb-0">Surat</p>
                    </div>
                    <div class="stat-icon-lg">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-3">
        <div class="card border-0 shadow-sm stat-card h-100 bg-gradient-primary">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-white-50 small font-weight-bold text-uppercase">Hari Ini</div>
                        <h3 class="text-white font-weight-bold mt-2">{{ $stats['today_letters'] ?? 0 }}</h3>
                        <p class="text-white-50 small mb-0">Permohonan</p>
                    </div>
                    <div class="stat-icon-lg">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-3">
        <div class="card border-0 shadow-sm stat-card h-100 bg-gradient-info">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-white-50 small font-weight-bold text-uppercase">Total Penduduk</div>
                        <h3 class="text-white font-weight-bold mt-2">{{ $stats['residents'] ?? 0 }}</h3>
                        <p class="text-white-50 small mb-0">Orang</p>
                    </div>
                    <div class="stat-icon-lg">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-xl-8 col-lg-7 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-gradient-primary py-3">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-chart-line mr-2"></i>Tren Pengaduan Warga (Tahun Ini)
                </h6>
            </div>
            <div class="card-body">
                <div class="chart-area my-3">
                    <canvas id="complaintChart" height="80"></canvas>
                </div>
                <small class="text-muted">📊 Grafik ini membantu mendeteksi lonjakan masalah (misal: banjir di bulan
                    hujan).</small>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-5 mb-4">
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-header bg-gradient-primary py-3">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-chart-pie mr-2"></i>Struktur Populasi
                </h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="demographyChart" height="240"></canvas>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 bg-gradient-success">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="text-white">
                        <small class="text-white-50 font-weight-bold">RATA-RATA KECEPATAN LAYANAN</small>
                        <h4 class="font-weight-bold mt-2">{{ $servicePerformance ?? '0' }} Jam</h4>
                        <small class="text-white-50">Target: &lt; 24 Jam</small>
                    </div>
                    <div class="stat-icon-lg text-white" style="opacity: 0.3;">
                        <i class="fas fa-stopwatch"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-7 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-gradient-primary py-3">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-list mr-2"></i>Antrean Pengajuan Surat Terbaru
                </h6>
            </div>
            <div class="card-body p-0">
                @if (isset($recentLetters) && count($recentLetters) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0">Tanggal</th>
                                    <th class="border-0">Pengaju</th>
                                    <th class="border-0">Jenis Surat</th>
                                    <th class="border-0">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentLetters as $letter)
                                    <tr>
                                        <td class="small text-muted">{{ $letter->created_at->format('d M Y') }}</td>
                                        <td class="font-weight-600">{{ $letter->user->name }}</td>
                                        <td>{{ $letter->letterType->name ?? 'Surat Keterangan' }}</td>
                                        <td>
                                            <span
                                                class="badge badge-{{ $letter->status == 'disetujui_rt_rw' ? 'warning' : ($letter->status == 'disetujui_admin' ? 'success' : 'danger') }}">
                                                {{ ucfirst($letter->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white border-top">
                        <a href="/letters" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye mr-1"></i>Lihat Semua
                        </a>
                    </div>
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-inbox fa-3x mb-3 d-block text-gray-300"></i>
                        <p class="mb-0">Tidak ada surat yang perlu di tanda tangani saat ini.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- News Feed Section -->
<div class="row mt-4">
    <div class="col-lg-12">
        <div class="d-flex align-items-center mb-4">
            <h5 class="text-gray-800 mb-0 font-weight-bold">
                <i class="fas fa-newspaper text-primary mr-2"></i>Berita & Pengumuman Terbaru
            </h5>
        </div>
    </div>

    @if (isset($newsFeed) && count($newsFeed) > 0)
        @foreach ($newsFeed as $news)
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm border-0 h-100 news-card">
                    <div style="position: relative; height: 200px; overflow: hidden; background: #e9ecef;">
                        <img src="{{ asset('storage/' . $news->image) }}" class="card-img-top w-100 h-100"
                            alt="{{ $news->title }}" style="object-fit: cover; transition: transform 0.3s ease;">
                        <span class="badge bg-primary position-absolute top-2 start-2">
                            {{ ucfirst($news->category) }}
                        </span>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <small class="text-muted d-block mb-2">
                            <i class="far fa-clock"></i> {{ $news->created_at->diffForHumans() }}
                        </small>
                        <h6 class="card-title font-weight-bold text-gray-800 flex-grow-1">{{ $news->title }}</h6>
                        <p class="card-text text-muted small mb-3">
                            {{ Str::limit($news->content ?? 'Tidak ada deskripsi.', 80) }}
                        </p>
                        <a href="/news/{{ $news->slug }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-arrow-right mr-1"></i>Baca
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="col-12">
            <div class="card shadow-sm border-0 py-5 text-center">
                <i class="fas fa-newspaper fa-3x mb-3 d-block text-gray-300"></i>
                <p class="text-muted mb-0">Belum ada berita terbaru.</p>
            </div>
        </div>
    @endif
</div>

<style>
    /* Gradient Backgrounds */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #4e73df 0%, #2e59d9 100%);
    }

    .bg-gradient-success {
        background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
    }

    .bg-gradient-info {
        background: linear-gradient(135deg, #36b9cc 0%, #258391 100%);
    }

    /* Stat Cards */
    .stat-card {
        border-radius: 0.75rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.15) !important;
    }

    .stat-icon-lg {
        font-size: 2.5rem;
        opacity: 0.2;
        text-align: right;
    }

    /* Table Styles */
    .table-hover tbody tr:hover {
        background-color: rgba(78, 115, 223, 0.05);
    }

    .badge {
        padding: 0.5rem 0.75rem;
        border-radius: 0.375rem;
        font-weight: 500;
    }

    /* News Cards */
    .news-card {
        border-radius: 0.5rem;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .news-card:hover {
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.15) !important;
        transform: translateY(-5px);
    }

    .news-card img:hover {
        transform: scale(1.05);
    }
</style>

@push('scripts')
    <script>
        // --- Chart Tren Pengaduan (Line Chart) ---
        var ctxComplaint = document.getElementById("complaintChart");
        var complaintChart = new Chart(ctxComplaint, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"],
                datasets: [{
                    label: "Jumlah Pengaduan",
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: @json($complaintData ?? []), // Data dari Controller
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            callback: function(value) {
                                return number_format(value);
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
            }
        });

        // --- Chart Demografi (Doughnut Chart) ---
        var ctxDemo = document.getElementById("demographyChart");
        var demoChart = new Chart(ctxDemo, {
            type: 'doughnut',
            data: {
                labels: @json($demographyLabels ?? []),
                datasets: [{
                    data: @json($demographyData ?? []),
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
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
                    display: true,
                    position: 'bottom'
                },
                cutoutPercentage: 70,
            },
        });
    </script>
@endpush
