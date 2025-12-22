@php
    $menus = [
        1 => [
            (object) [
                'title' => 'Dashboard',
                'path' => 'dashboard',
                'icon' => 'fas fa-fw fa-tachometer-alt',
            ],
            (object) [
                'title' => 'Penduduk',
                'path' => 'resident',
                'icon' => 'fas fa-fw fa-table',
            ],
            (object) [
                'title' => 'Daftar Akun',
                'path' => 'account-list',
                'icon' => 'fas fa-fw fa-users',
            ],
            (object) [
                'title' => 'Permintaan Akun',
                'path' => 'account-request',
                'icon' => 'fas fa-fw fa-user-plus',
            ],
            (object) [
                'title' => 'Pengaduan',
                'path' => 'complaint',
                'icon' => 'fas fa-fw fa-scroll',
            ],
            (object) [
                'title' => 'Permohonan Surat',
                'path' => 'letters',
                'icon' => 'fas fa-fw fa-envelope',
            ],
        ],
        2 => [
            (object) [
                'title' => 'Dashboard',
                'path' => 'dashboard',
                'icon' => 'fas fa-fw fa-tachometer-alt',
            ],
            (object) [
                'title' => 'Pengaduan',
                'path' => 'complaint',
                'icon' => 'fas fa-fw fa-scroll',
            ],
            (object) [
                'title' => 'Permohonan Surat',
                'path' => 'letters',
                'icon' => 'fas fa-fw fa-envelope',
            ],
        ],
    ];
@endphp

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        {{-- <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div> --}}
        <div class="sidebar-brand-text mx-3">SiDesa</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    @foreach ($menus[auth()->user()->role_id] as $menu)
        <li class="nav-item my-0.5 {{ request()->is($menu->path . '*') ? 'active' : '' }}">
            <a class="nav-link" href="/{{ $menu->path }}">
                <i class="{{ $menu->icon }}"></i>
                <span>{{ $menu->title }}</span></a>
        </li>
    @endforeach

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
