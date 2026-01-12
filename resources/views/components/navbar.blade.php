<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow-sm border-bottom border-primary">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link btn-sm d-md-none rounded-circle mr-3">
        <i class="fa fa-bars fa-lg text-primary"></i>
    </button>

    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        @csrf
        <div class="input-group">
            {{-- ID ditambahkan di sini: id="navbar-search-input" --}}
            <input type="text" class="form-control bg-light border-0 small navbar-search-input"
                placeholder="Cari halaman, penduduk, berita..." aria-label="Search" aria-describedby="basic-addon2"
                id="navbar-search-input" autocomplete="off">

            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>

        {{-- Container untuk Hasil Search --}}
        <div id="search-results-container">
            {{-- Hasil akan muncul di sini via JS --}}
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

        /* Style untuk hasil pencarian real-time */
        #search-results-container {
            position: absolute;
            top: calc(100% + 5px);
            left: 0;
            right: 0;
            z-index: 9999;
            background: white;
            border: 1px solid #ddd;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.25);
            display: none;
            /* Sembunyikan default */
            max-height: 500px;
            overflow-y: auto;
            min-width: 300px;
        }

        .navbar-search {
            position: relative;
        }

        .search-result-item {
            padding: 12px 15px;
            border-bottom: 1px solid #eaecf4;
            display: block;
            color: #858796;
            text-decoration: none;
            transition: all 0.2s;
        }

        .search-result-item:last-child {
            border-bottom: none;
        }

        .search-result-item:hover {
            background-color: #f8f9fc;
            color: #4e73df;
            text-decoration: none;
            border-left: 3px solid #4e73df;
            padding-left: 12px;
        }

        .search-result-category {
            font-size: 0.7rem;
            font-weight: 700;
            color: #b7b9cc;
            text-transform: uppercase;
            margin-bottom: 2px;
        }
    </style>
</nav>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById('navbar-search-input');
        const resultsContainer = document.getElementById('search-results-container');
        let timeout = null; // Untuk debounce (mencegah request berlebihan)

        // Event saat mengetik
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                clearTimeout(timeout);
                const query = this.value.trim();

                // Kosongkan hasil jika input kosong
                if (query.length < 2) {
                    resultsContainer.style.display = 'none';
                    resultsContainer.innerHTML = '';
                    return;
                }

                // Tunggu 200ms setelah user berhenti mengetik baru kirim request
                timeout = setTimeout(function() {
                    console.log('Searching for:', query); // Debug log

                    const searchUrl = new URL('{{ route('global.ajax.search') }}', window
                        .location.origin);
                    searchUrl.searchParams.append('query', query);

                    fetch(searchUrl)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok: ' + response
                                    .status);
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Search results:', data); // Debug log
                            resultsContainer.innerHTML = ''; // Reset isi

                            if (data && data.length > 0) {
                                resultsContainer.style.display = 'block';

                                data.forEach(item => {
                                    const html = `
                                        <a href="${item.url}" class="search-result-item">
                                            <div class="d-flex align-items-center">
                                                <div class="mr-3">
                                                    <div class="icon-circle bg-primary text-white" style="width: 30px; height: 30px; display:flex; align-items:center; justify-content:center; border-radius:50%;">
                                                        <i class="${item.icon}"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="search-result-category">${item.category}</div>
                                                    <span class="font-weight-bold">${item.title}</span>
                                                </div>
                                            </div>
                                        </a>
                                    `;
                                    resultsContainer.insertAdjacentHTML('beforeend',
                                        html);
                                });
                            } else {
                                resultsContainer.style.display = 'block';
                                resultsContainer.innerHTML =
                                    '<div class="p-3 text-center text-muted small">Data tidak ditemukan</div>';
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching search results:', error);
                            resultsContainer.style.display = 'block';
                            resultsContainer.innerHTML =
                                '<div class="p-3 text-center text-danger small">Error loading results</div>';
                        });
                }, 200);
            });

            // Sembunyikan hasil saat klik di luar area search
            document.addEventListener('click', function(e) {
                if (searchInput && resultsContainer) {
                    if (!searchInput.contains(e.target) && !resultsContainer.contains(e.target)) {
                        resultsContainer.style.display = 'none';
                    }
                }
            });
        }
    });
</script>
