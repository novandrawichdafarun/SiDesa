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
    <div class="col-lg-8 mb-4 row-auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Permohonan Surat Terbaru</h6>
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

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Statistik Pekerjaan Penduduk</h6>
            </div>
            <div class="card-body">
                <div class="chart-bar">
                    <canvas id="myBarChart"></canvas>
                </div>
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
