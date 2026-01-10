<div class="row">
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                    Surat Menunggu Tanda Tangan</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['waiting_signature'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-md-6 mb-4">
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
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tren Pengaduan Warga (Tahun Ini)</h6>
            </div>
            <div class="card-body">
                <div class="chart-area my-3">
                    <canvas id="complaintChart"></canvas>
                </div>
                <small>Grafik ini membantu mendeteksi lonjakan masalah (misal: banjir di bulan hujan).</small>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Struktur Populasi</h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="demographyChart"></canvas>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4 border-left-success">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Rata-rata Kecepatan Layanan Surat</div>
                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                            {{ $servicePerformance ?? '0' }} Jam</div>
                        <small>Target: < 24 Jam</small>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-stopwatch fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Antrean Pengajuan Surat Terbaru</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Warga</th>
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
                                            class="badge badge-{{ $letter->status == 'disetujui_rt_rw' ? 'warning' : ($letter->status == 'disetujui_admin' ? 'success' : 'danger') }}">
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
</div>
<div class="row">
    <div class="col-12 mb-4">
        <h5 class="font-weight-bold text-primary">Kabar Desa Terbaru</h5>
        <div class="row">
            @foreach ($newsFeed as $item)
                <div class="col-md-4 mb-3">
                    <div class="card shadow border-0">
                        @if ($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top"
                                style="height: 180px, object-fit: cover,">
                        @endif
                        <div class="card-body">
                            <span
                                class="badge {{ $item->category == 'berita' ? 'badge-primary' : 'badge-danger' }} mb-2">
                                {{ ucfirst($item->category) }} </span>
                            <h6 class="font-weight-bold text-dark">{{ $item->title }}</h6>
                            <p class="text-muted small">{{ Str::limit(strip_tags($item->content), 80) }}</p>
                            <a href="#" class="btn btn-sm btn-outline-primary btn-block">Baca
                                Selengkapnya</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="mb-4">
    <button class="btn btn-primary shadow-sm" data-toggle="modal" data-target="#addNewsModal">
        <i class="fas fa-plus fa-sm text-white-50"></i> Unggah Info Baru
    </button>
</div>

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
