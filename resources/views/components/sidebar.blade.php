@php
    $menus = [
        1 => [
            (object) [
                'title' => 'Dashboard',
                'path' => 'dashboard',
                'icon' => 'fas fa-fw fa-chart-line',
            ],
            (object) [
                'title' => 'Penduduk',
                'path' => 'resident',
                'icon' => 'fas fa-fw fa-users',
            ],
            (object) [
                'title' => 'Permohonan Surat',
                'path' => 'letters',
                'icon' => 'fas fa-fw fa-envelope',
            ],
            (object) [
                'title' => 'Daftar Akun',
                'path' => 'account-list',
                'icon' => 'fas fa-fw fa-id-card',
            ],
            (object) [
                'title' => 'Permintaan Akun',
                'path' => 'account-request',
                'icon' => 'fas fa-fw fa-user-plus',
            ],
            (object) [
                'title' => 'Portal Berita',
                'path' => 'news',
                'icon' => 'fas fa-fw fa-newspaper',
            ],
        ],
        2 => [
            (object) [
                'title' => 'Dashboard',
                'path' => 'dashboard',
                'icon' => 'fas fa-fw fa-chart-line',
            ],
            (object) [
                'title' => 'Pengaduan',
                'path' => 'complaint',
                'icon' => 'fas fa-fw fa-comments',
            ],
            (object) [
                'title' => 'Permohonan Surat',
                'path' => 'letters',
                'icon' => 'fas fa-fw fa-envelope',
            ],
            (object) [
                'title' => 'Portal Berita',
                'path' => 'news',
                'icon' => 'fas fa-fw fa-newspaper',
            ],
        ],
        3 => [
            (object) [
                'title' => 'Dashboard',
                'path' => 'dashboard',
                'icon' => 'fas fa-fw fa-chart-line',
            ],
            (object) [
                'title' => 'Pengaduan',
                'path' => 'complaint',
                'icon' => 'fas fa-fw fa-comments',
            ],
            (object) [
                'title' => 'Permohonan Surat',
                'path' => 'letters',
                'icon' => 'fas fa-fw fa-envelope',
            ],
            (object) [
                'title' => 'Portal Berita',
                'path' => 'news',
                'icon' => 'fas fa-fw fa-newspaper',
            ],
        ],
        4 => [
            (object) [
                'title' => 'Dashboard',
                'path' => 'dashboard',
                'icon' => 'fas fa-fw fa-chart-line',
            ],
            (object) [
                'title' => 'Permohonan Surat',
                'path' => 'letters',
                'icon' => 'fas fa-fw fa-envelope',
            ],
            (object) [
                'title' => 'Portal Berita',
                'path' => 'news',
                'icon' => 'fas fa-fw fa-newspaper',
            ],
        ],
    ];
@endphp

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        <div class="sidebar-brand-icon mx-3">
            <i class="fas fa-building text-warning"></i>
        </div>
        <div class="sidebar-brand-text mx-2">
            <span class="font-weight-bold">SiDesa</span>
            <small class="d-block text-white-50 font-weight-normal">Sistem Informasi Desa</small>
        </div>
    </a>

    <!-- Divider -->
    <li class="nav-item">
        <hr class="sidebar-divider my-2">
    </li>

    <!-- User Info Card -->
    <li class="nav-item mb-3 px-3">
        <div class="text-white-50 small">
            <div class="mb-2">
                <i class="fas fa-user-circle fa-2x text-white"></i>
            </div>
            <h6 class="font-weight-bold text-white mb-1">{{ Auth::user()->name }}</h6>
            <span class="badge badge-light">{{ auth()->user()->role->name ?? 'User' }}</span>
        </div>
    </li>

    <!-- Divider -->
    <li class="nav-item">
        <hr class="sidebar-divider my-2">
    </li>

    <!-- Nav Items -->
    @foreach ($menus[auth()->user()->role_id] as $menu)
        <li class="nav-item {{ request()->is($menu->path . '*') ? 'active' : '' }}">
            <a class="nav-link d-flex align-items-center" href="/{{ $menu->path }}">
                <i class="{{ $menu->icon }} fa-lg mr-3"></i>
                <span class="font-weight-500">{{ $menu->title }}</span>
                @if (request()->is($menu->path . '*'))
                    <span class="ml-auto">
                        <i class="fas fa-chevron-right fa-sm"></i>
                    </span>
                @endif
            </a>
        </li>
    @endforeach

    <!-- Divider -->
    <li class="nav-item">
        <hr class="sidebar-divider d-none d-md-block my-2">
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline my-2">
        <button class="rounded-circle border-0 bg-light" id="sidebarToggle" title="Toggle Sidebar"></button>
    </div>

</ul>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #4e73df 0%, #2e59d9 100%);
    }

    .sidebar-dark .nav-item.active .nav-link {
        background: rgba(255, 255, 255, 0.2);
        border-left: 4px solid #fff;
        padding-left: calc(1.5rem - 4px);
    }

    .sidebar-dark .nav-link {
        padding: 1rem;
        transition: all 0.3s ease;
        color: rgba(255, 255, 255, 0.8);
    }

    .sidebar-dark .nav-link:hover {
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
    }

    .sidebar-dark .sidebar-brand {
        padding: 1.5rem 0;
        background: rgba(0, 0, 0, 0.2);
    }

    .sidebar-brand-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 0.5rem;
    }

    .sidebar-dark .text-white-50 {
        color: rgba(255, 255, 255, 0.7);
    }

    .badge {
        padding: 0.35rem 0.65rem;
        font-size: 0.75rem;
        font-weight: 500;
    }

    #sidebarToggle {
        width: 35px;
        height: 35px;
        background-color: rgba(255, 255, 255, 0.2) !important;
        border: 2px solid rgba(255, 255, 255, 0.3) !important;
        transition: all 0.3s ease;
    }

    #sidebarToggle:hover {
        background-color: rgba(255, 255, 255, 0.3) !important;
    }
</style>
