<footer class="sticky-footer bg-gradient-dark text-white-50 py-4 mt-5">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('img/Logo.png') }}" alt="Desa Logo" style="height: 50px;" class="mr-2">
                    <div>
                        <h6 class="font-weight-bold text-white mb-0">Sistem Informasi Desa</h6>
                        <small class="text-muted">Desa Nyeni</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-md-right">
                <small class="d-block mb-2">Follow us on social media</small>
                <a href="#" class="text-white-50 mr-3" title="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="text-white-50 mr-3" title="Twitter">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="text-white-50" title="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>
        <hr class="border-secondary my-2">
        <div class="row text-center text-md-left small">
            <div class="col-md-6">
                <p class="mb-0">
                    &copy; {{ date('Y') }} <strong>SiDesa</strong> - Sistem Informasi Desa. All rights reserved.
                </p>
            </div>
            <div class="col-md-6 text-md-right">
                <a href="#" class="text-white-50 mr-3">Privacy Policy</a>
                <a href="#" class="text-white-50">Terms of Service</a>
            </div>
        </div>
    </div>

    <style>
        .bg-gradient-dark {
            background: linear-gradient(135deg, #2c3e50 0%, #1a252f 100%);
        }

        footer {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        footer a {
            text-decoration: none;
            transition: color 0.2s ease;
        }

        footer a:hover {
            color: #4e73df !important;
        }

        .text-white-50 {
            color: rgba(255, 255, 255, 0.5);
        }
    </style>
</footer>
