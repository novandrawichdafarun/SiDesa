<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-tachometer-alt text-primary mr-2"></i>Dashboard Admin
    </h1>
</div>

<!-- Stat Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-3">
        <a href="/resident" class="text-decoration-none">
            <div class="card border-0 shadow-sm stat-card h-100 bg-gradient-primary">
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
        </a>
    </div>

    <div class="col-xl-3 col-md-6 mb-3">
        <a href="/letters" class="text-decoration-none">
            <div class="card border-0 shadow-sm stat-card h-100 bg-gradient-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-white-50 small font-weight-bold text-uppercase">Surat (Pending)</div>
                            <h3 class="text-white font-weight-bold mt-2">{{ $stats['pending_letters'] ?? 0 }}</h3>
                            <p class="text-white-50 small mb-0">Menunggu</p>
                        </div>
                        <div class="stat-icon-lg">
                            <i class="fas fa-envelope-open-text"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6 mb-3">
        <a href="/account-request" class="text-decoration-none">
            <div class="card border-0 shadow-sm stat-card h-100 bg-gradient-info">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-white-50 small font-weight-bold text-uppercase">Akun Baru</div>
                            <h3 class="text-white font-weight-bold mt-2">{{ $stats['pending_accounts'] ?? 0 }}</h3>
                            <p class="text-white-50 small mb-0">Verifikasi</p>
                        </div>
                        <div class="stat-icon-lg">
                            <i class="fas fa-user-clock"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6 mb-3">
        <a href="/complaint" class="text-decoration-none">
            <div class="card border-0 shadow-sm stat-card h-100 bg-gradient-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-white-50 small font-weight-bold text-uppercase">Pengaduan</div>
                            <h3 class="text-white font-weight-bold mt-2">{{ $stats['pending_complaints'] ?? 0 }}</h3>
                            <p class="text-white-50 small mb-0">Total</p>
                        </div>
                        <div class="stat-icon-lg">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-gradient-primary py-3 d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-list mr-2"></i>Permohonan Surat Terbaru
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
                        <p class="mb-0">Tidak ada surat yang perlu disetujui saat ini.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-gradient-primary py-3">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-chart-pie mr-2"></i>Demografi Gender
                </h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart" height="240"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-3">
                        <i class="fas fa-circle text-primary"></i>
                        <strong>Laki-laki</strong>
                    </span>
                    <span>
                        <i class="fas fa-circle text-success"></i>
                        <strong>Perempuan</strong>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-gradient-primary py-3">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-chart-bar mr-2"></i>Statistik Pekerjaan Penduduk
                </h6>
            </div>
            <div class="card-body">
                <div class="chart-bar">
                    <canvas id="myBarChart" height="80"></canvas>
                </div>
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

    .bg-gradient-warning {
        background: linear-gradient(135deg, #f6c23e 0%, #dda15e 100%);
    }

    .bg-gradient-info {
        background: linear-gradient(135deg, #36b9cc 0%, #258391 100%);
    }

    .bg-gradient-danger {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
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
    <script src="{{ asset('template/vendor/chart.js/Chart.min.js') }}"></script>
    <script>
        // Konfigurasi Font & Warna agar sesuai tema
        Chart.defaults.global.defaultFontFamily = 'Nunito',
            '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        // Fungsi format angka (opsional, untuk mempercantik tooltip)
        function number_format(number, decimals, dec_point, thousands_sep) {
            // ... (kode number_format standar SB Admin 2, bisa disalin dari file demo jika perlu)
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

        // Ambil Data dari Controller
        var labels = @json($jobLabels);
        var data = @json($jobData);

        // Inisialisasi Bar Chart
        var ctx = document.getElementById("myBarChart");
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: "Jumlah",
                    backgroundColor: "#4e73df", // Satu warna dominan lebih rapi untuk bar chart
                    hoverBackgroundColor: "#2e59d9",
                    borderColor: "#4e73df",
                    data: data,
                    barPercentage: 0.5, // Mengatur ketebalan batang
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
                        time: {
                            unit: 'occupation'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 20 // Batasi jumlah label sumbu X agar tidak bertumpuk
                        },
                        maxBarThickness: 50,
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            padding: 10,
                            // Pastikan sumbu Y menampilkan angka bulat (jumlah orang tidak mungkin desimal)
                            callback: function(value, index, values) {
                                if (Math.floor(value) === value) {
                                    return number_format(value);
                                }
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
                    display: false // Sembunyikan legenda jika hanya ada 1 dataset
                },
                tooltips: {
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + ' Orang';
                        }
                    }
                },
            }
        });
    </script>
    <script>
        // Set default font family and color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito',
            '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        // Data dari Controller
        var genderData = @json($genderData); // Output: {"male": 10, "female": 5}
        var maleCount = genderData['male'] || 0;
        var femaleCount = genderData['female'] || 0;

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
