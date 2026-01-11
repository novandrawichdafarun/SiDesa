<div class="alert alert-primary shadow-sm border-0 mb-4" role="alert" style="border-radius: 0.5rem;">
    <div class="d-flex align-items-start">
        <div>
            <h5 class="alert-heading mb-2">
                <i class="fas fa-smile-beam text-primary mr-2"></i>Selamat Datang, {{ Auth::user()->name }}!
            </h5>
            <p class="mb-0 text-muted">Selamat datang di Sistem Informasi Desa (Desa Nyeni). Gunakan platform ini untuk
                mengurus surat menyurat dan memantau informasi desa dengan mudah.</p>
        </div>
    </div>
    @if (!$isProfileComplete)
        <hr class="my-2">
        <div class="alert-danger rounded p-3 mt-3">
            <p class="mb-0 text-danger">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <strong>Data kependudukan Anda belum lengkap.</strong> Silakan <a href="/profile"
                    class="font-weight-bold">lengkapi profil Anda</a> agar dapat mengajukan surat.
            </p>
        </div>
    @endif
</div>

<!-- Action Buttons -->
<div class="row mb-4">
    <div class="col-lg-6 mb-2">
        <a href="/letters/create" class="btn btn-primary btn-lg w-100 d-flex align-items-center justify-content-center"
            style="height: 60px;">
            <i class="fas fa-file-alt mr-2 fa-lg"></i>
            <span>Ajukan Surat Baru</span>
        </a>
    </div>
    <div class="col-lg-6 mb-2">
        <a href="/complaints/create"
            class="btn btn-danger btn-lg w-100 d-flex align-items-center justify-content-center" style="height: 60px;">
            <i class="fas fa-bullhorn mr-2 fa-lg"></i>
            <span>Buat Laporan / Aduan</span>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-gradient-primary py-3">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-file-alt mr-2"></i>Riwayat Surat Saya
                </h6>
            </div>
            <div class="card-body p-0">
                @if (isset($myLetters) && count($myLetters) > 0)
                    <ul class="list-group list-group-flush">
                        @forelse($myLetters as $letter)
                            <li class="list-group-item border-bottom">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <p class="small text-muted mb-1">
                                            <i class="far fa-calendar"></i> {{ $letter->created_at->diffForHumans() }}
                                        </p>
                                        <h6 class="font-weight-bold text-gray-800">
                                            {{ Str::limit($letter->purpose ?? 'Surat', 40) }}</h6>
                                    </div>
                                    <span
                                        class="badge badge-{{ $letter->status == 'pending' ? 'warning' : 'success' }} ml-2">
                                        {{ ucfirst($letter->status) }}
                                    </span>
                                </div>
                            </li>
                        @empty
                        @endforelse
                    </ul>
                @endif
                @if (!isset($myLetters) || count($myLetters) == 0)
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-inbox fa-2x mb-3 d-block text-gray-300"></i>
                        <p class="mb-0">Belum ada pengajuan surat.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-gradient-danger py-3">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-bullhorn mr-2"></i>Aduan Saya
                </h6>
            </div>
            <div class="card-body p-0">
                @if (isset($myComplaints) && count($myComplaints) > 0)
                    <ul class="list-group list-group-flush">
                        @forelse($myComplaints as $complaint)
                            <li class="list-group-item border-bottom">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <h6 class="font-weight-bold text-gray-800 mb-1">
                                            {{ Str::limit($complaint->title ?? 'Aduan', 40) }}
                                        </h6>
                                        <p class="small text-muted mb-2">
                                            {{ Str::limit(strip_tags($complaint->content), 50) }}
                                        </p>
                                        <small class="text-muted">
                                            <i class="far fa-clock"></i> {{ $complaint->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                    <span
                                        class="badge badge-{{ $complaint->status == 'new' ? 'primary' : ($complaint->status == 'processing' ? 'warning' : 'success') }} ml-2">
                                        {{ ucfirst($complaint->status) }}
                                    </span>
                                </div>
                            </li>
                        @empty
                        @endforelse
                    </ul>
                @endif
                @if (!isset($myComplaints) || count($myComplaints) == 0)
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-comment-slash fa-2x mb-3 d-block text-gray-300"></i>
                        <p class="mb-0">Belum ada aduan yang dibuat.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-lg-12">
        <div class="d-flex align-items-center mb-4">
            <h5 class="text-gray-800 mb-0 font-weight-bold">
                <i class="fas fa-newspaper text-primary mr-2"></i>Berita & Pengumuman Desa Terbaru
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

    .bg-gradient-danger {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
    }

    /* List Group */
    .list-group-item {
        border-left: 0;
        border-right: 0;
        padding: 1rem;
    }

    .list-group-item:last-child {
        border-bottom: 0;
    }

    /* Badge */
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
