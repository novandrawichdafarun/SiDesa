<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow-sm border-bottom border-primary">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link btn-sm d-md-none rounded-circle mr-3">
        <i class="fa fa-bars fa-lg text-primary"></i>
    </button>

    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-primary border-1 small rounded-pill"
                placeholder="Cari sesuatu..." aria-label="Search" aria-describedby="basic-addon2"
                style="max-width: 300px;">
            <div class="input-group-append">
                <button class="btn btn-primary btn-sm rounded-right" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw text-primary"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Cari sesuatu..."
                            aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle position-relative" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw text-primary fa-lg"></i>
                <!-- Counter - Alerts -->
                @if (auth()->user()->notifications->whereNull('read_at')->count() > 0)
                    <span class="badge badge-danger badge-counter position-absolute" style="top: -5px; right: -5px;">
                        {{ auth()->user()->notifications->whereNull('read_at')->count() }}
                    </span>
                @endif
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow-lg animated--grow-in border-0"
                aria-labelledby="alertsDropdown" style="min-width: 350px;">
                <h6 class="dropdown-header bg-light font-weight-bold text-primary py-3">
                    <i class="fas fa-bell mr-2"></i>Notifikasi
                </h6>
                @forelse (auth()->user()->notifications->take(5) as $notification)
                    @if (is_null($notification->read_at))
                        <form id="formNotification-{{ $notification->id }}"
                            action="/notification/{{ $notification->id }}/read" method="post">
                            <div class="dropdown-item d-flex align-items-center border-bottom py-3"
                                style="cursor: pointer; background-color: rgba(78, 115, 223, 0.08);"
                                onclick="document.getElementById('formNotification-{{ $notification->id }}').submit()">
                                @csrf
                                @method('POST')
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="small text-gray-500">{{ $notification->created_at->diffForHumans() }}
                                    </div>
                                    <span
                                        class="font-weight-bold text-dark">{{ $notification->data['message'] ?? 'Notifikasi' }}</span>
                                </div>
                                <div class="ml-2">
                                    <i class="fas fa-chevron-right text-primary small"></i>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="dropdown-item d-flex align-items-center border-bottom py-3">
                            <div class="mr-3">
                                <div class="icon-circle bg-secondary">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="small text-gray-500">{{ $notification->created_at->diffForHumans() }}</div>
                                <span
                                    class="font-weight-bold text-gray-600">{{ $notification->data['message'] ?? 'Notifikasi' }}</span>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="dropdown-item text-center py-5">
                        <i class="fas fa-inbox fa-2x text-gray-300 mb-2 d-block"></i>
                        <span class="font-weight-bold text-gray-600">Tidak ada notifikasi baru</span>
                    </div>
                @endforelse
                <a class="dropdown-item text-center small text-primary font-weight-bold py-3 border-top"
                    href="/notification">
                    <i class="fas fa-eye mr-2"></i>Lihat Semua Notifikasi
                </a>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        @auth
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span
                        class="mr-2 d-none d-lg-inline text-gray-700 small font-weight-bold">{{ Auth::user()->name }}</span>
                    <img class="img-profile rounded-circle" src="{{ asset('template/img/undraw_profile.svg') }}"
                        style="width: 35px; height: 35px;">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow-lg animated--grow-in border-0"
                    aria-labelledby="userDropdown">
                    <div class="dropdown-header bg-light py-3">
                        <h6 class="m-0 font-weight-bold text-primary">User Menu</h6>
                    </div>
                    <a class="dropdown-item d-flex align-items-center border-bottom py-2" href="/profile">
                        <i class="fas fa-user fa-sm fa-fw mr-3 text-primary"></i>
                        <span class="text-gray-700">Profile</span>
                    </a>
                    <a class="dropdown-item d-flex align-items-center py-2" href="#" data-toggle="modal"
                        data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-3 text-danger"></i>
                        <span class="text-gray-700">Logout</span>
                    </a>
                </div>
            </li>
        @endauth

    </ul>

    <style>
        .navbar-search .input-group {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .navbar-search .form-control {
            transition: all 0.3s ease;
        }

        .navbar-search .form-control:focus {
            box-shadow: 0 2px 8px rgba(78, 115, 223, 0.2);
            border-color: #4e73df !important;
        }

        .dropdown-list {
            max-height: 500px;
            overflow-y: auto;
        }

        .icon-circle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .badge-counter {
            padding: 0.25rem 0.4rem;
            font-size: 0.65rem;
            font-weight: bold;
        }
    </style>
</nav>
