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
<div class="row">
    <div class="col-12 mb-4">
        <h5 class="font-weight-bold text-primary">Kabar Desa Terbaru</h5>
        <div class="row">
            @foreach ($newsFeed as $item)
                <div class="col-md-4 mb-3">
                    <div class="card shadow border-0">
                        @if ($item->image)
                            <img src="{{ asset('storage/ ' . $item->image) }}" class="card-img-top"
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
{{-- Tampilan Tombol Buat Berita (Untuk Admin)  --}}
@if (auth()->user()->role_id == 1)
    <div class="mb-4"> <button class="btn btn-primary shadow-sm" data-toggle="modal" data-target="#addNewsModal"> <i
                class="fas fa-plus fa-sm text-white-50"></i> Unggah Info Baru
        </button> </div>
@endif
