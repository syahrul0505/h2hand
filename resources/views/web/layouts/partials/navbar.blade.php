<style>
    /* CSS LAMA ANDA UNTUK CAROUSEL, JANGAN DIHAPUS */
    .swiper-hero .swiper-slide {
        background-size: cover;
        background-position: center;
        color: white;
    }

    /* ---- PERBAIKAN NAVBARR ---- */
    header {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 100;
    }

    /* Navbar transparan dengan gradasi yang lebih halus */
    header nav.navbar.transparent.navbar-light {
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(10px); /* Efek blur yang lebih kuat untuk kejelasan */
        -webkit-backdrop-filter: blur(10px);
        transition: background-color 0.3s ease-in-out;
    }

    /* Gaya link navbar */
    header .navbar.transparent .nav-link {
        color: #cf2e2e !important;
        font-weight: 500;
        transition: color 0.3s ease-in-out;
    }

    header .navbar.transparent .nav-link:hover {
        color: #cf2e2e !important;
    }

    /* Override visited link colors dan link di offcanvas untuk menghilangkan warna ungu */
    header .navbar.transparent .nav-link:link,
    header .navbar.transparent .nav-link:visited {
        color: #cf2e2e !important;
    }
    header .offcanvas-body a,
    header .offcanvas-body a:visited {
        color: #cf2e2e !important;
    }

    /* Gaya tombol Login (outline) */
    header .navbar.transparent .btn-outline-primary {
        color: #ffffff !important;
        border-color: #ffffff !important;
        transition: all 0.3s ease-in-out;
    }

    header .navbar.transparent .btn-outline-primary:hover {
        background-color: #ffffff !important;
        color: #333333 !important;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    }

    /* Gaya tombol Sign Up (solid) */
    header .navbar.transparent .btn-primary {
        background-color: #cf2e2e ;
        color: #ffffff !important;
        border-color: #cf2e2e;
        transition: background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    header .navbar.transparent .btn-primary:hover {
        background-color: #d91717ff!important;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    }

    header h1, header h2, header h3, header h4, header h5, header h6 {
        color: #cf2e2e !important;
    }
    header .btn {
        background-color: #cf2e2e !important;
        border-color: #cf2e2e !important;
    }
    header .btn:hover {
        background-color: #d91717 !important;
        border-color: #d91717 !important;
    }
</style>

<header>
    <div class="gradient-5 text-white fw-bold fs-15 position-relative" style="z-index: 1;">
      
    </div>
    <nav class="navbar navbar-expand-lg center-nav transparent navbar-light">
        <div class="container flex-lg-row flex-nowrap align-items-center">
            <div class="navbar-brand w-100">
                {{-- Penambahan Logo di sini --}}
                <a href="{{ route('homepage') }}">
                    <img src="{{ asset('assets/images/navbar/logorajendra.png') }}" alt="Logo Rajendra Project" style="height: 40px;">
                </a>
            </div>
            <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
                <div class="offcanvas-header d-lg-none">
                    <h3 class="text-white fs-30 mb-0">Rajendra Project</h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body ms-lg-auto d-flex flex-column h-100">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('homepage') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tentang-kami') }}">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('kontak') }}">Kontak</a>
                        </li>
                    </ul>
                    <div class="offcanvas-footer d-lg-none">
                        <div>
                            <a href="mailto:info@jooal.id" class="link-inverse">info@jooal.id</a>
                            <br /> +62 123 4567 890 <br />
                            <nav class="nav social social-white mt-4">
                                <a href="#"><i class="uil uil-twitter"></i></a>
                                <a href="#"><i class="uil uil-facebook-f"></i></a>
                                <a href="#"><i class="uil uil-instagram"></i></a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar-other w-100 d-flex ms-auto">
                <ul class="navbar-nav flex-row align-items-center ms-auto">
                    <li class="nav-item d-none d-md-block">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-xl">
                            <i class="uil uil-user me-1"></i> Login
                        </a>
                    </li>
                    <li class="nav-item d-none d-md-block ms-2">
                        <a href="{{ route('register') }}" class="btn btn-primary rounded-xl">Sign Up</a>
                    </li>
                    <li class="nav-item d-lg-none">
                        <button class="hamburger offcanvas-nav-btn"><span></span></button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="offcanvasMenu" class="offcanvas offcanvas-start" tabindex="-1" aria-labelledby="offcanvasMenuLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasMenuLabel" class="text-white fw-bold">Rajendra Project</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ route('homepage') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('tentang-kami') }}">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('kontak') }}">Kontak</a></li>
            </ul>
        </div>
    </div>
</header>