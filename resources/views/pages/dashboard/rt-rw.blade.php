{{-- TAMPILAN UNTUK RT/RW (Role 4) --}}
<div class="row">
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                    Surat Perlu Verifikasi RT/RW</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pending_letters'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Penduduk RT/RW</div>
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
