<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H2Hand - Solusi Lengkap ATK & Aksesoris Gadget</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2196F3;
            --secondary-color: #1976D2;
            --accent-color: #FF6B6B;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 100px 0 80px;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
            background-size: cover;
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
        }
        
        .brand-logo {
            max-width: 200px;
            margin-bottom: 30px;
            filter: brightness(0) invert(1);
        }
        
        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }
        
        .hero-subtitle {
            font-size: 1.3rem;
            margin-bottom: 40px;
            opacity: 0.95;
        }
        
        .cta-button {
            padding: 15px 40px;
            font-size: 1.1rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .cta-primary {
            background: white;
            color: var(--primary-color);
            border: none;
        }
        
        .cta-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            background: #f8f9fa;
        }
        
        .category-section {
            padding: 80px 0;
            background: #f8f9fa;
        }
        
        .category-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            height: 100%;
        }
        
        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }
        
        .category-icon {
            font-size: 3.5rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }
        
        .category-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: #333;
        }
        
        .brands-section {
            padding: 80px 0;
            background: white;
        }
        
        .brand-item {
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            background: #f8f9fa;
            border-radius: 10px;
            height: 120px;
        }
        
        .brand-item:hover {
            transform: scale(1.05);
            background: white;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .brand-item img {
            max-width: 150px;
            max-height: 80px;
            transition: all 0.3s ease;
        }
        
        .brand-item:hover img {
            filter: grayscale(0%);
        }
        
        .marketplace-section {
            padding: 80px 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .marketplace-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .marketplace-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
        }
        
        .marketplace-icon {
            font-size: 3rem;
            margin-bottom: 20px;
        }
        
        .marketplace-name {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: #333;
        }
        
        .marketplace-btn {
            background: var(--primary-color);
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            font-weight: 600;
        }
        
        .marketplace-btn:hover {
            background: var(--secondary-color);
            color: white;
            transform: scale(1.05);
        }
        
        .products-section {
            padding: 80px 0;
            background: white;
        }
        
        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            height: 100%;
            position: relative;
            display: flex;
            flex-direction: column;
        }
        
        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }
        
        .product-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--primary-color);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            z-index: 2;
            text-transform: uppercase;
        }
        
        .product-image {
            background: #f8f9fa;
            padding: 0;
            text-align: center;
            position: relative;
            min-height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        .product-image img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .product-card:hover .product-image img {
            transform: scale(1.05);
        }
        
        .product-content {
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        
        .product-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 12px;
            color: #333;
            height: 48px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.5;
        }
        
        .product-rating {
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 2px;
        }
        
        .product-rating i {
            color: #FFC107;
            font-size: 0.85rem;
        }
        
        .rating-text {
            color: #666;
            font-size: 0.85rem;
            margin-left: 8px;
        }
        
        .product-price {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        
        .price-discount {
            text-decoration: line-through;
            color: #999;
            font-size: 0.85rem;
        }
        
        .price-main {
            color: var(--accent-color);
            font-size: 1.25rem;
            font-weight: 700;
        }
        
        .product-btn {
            background: var(--primary-color);
            color: white;
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            margin-top: auto;
            font-size: 0.9rem;
        }
        
        .product-btn:hover {
            background: var(--secondary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(33, 150, 243, 0.3);
        }
        
        .features-section {
            padding: 80px 0;
            background: #f8f9fa;
        }
        
        .feature-box {
            text-align: center;
            padding: 30px;
        }
        
        .feature-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }
        
        .feature-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: #333;
        }
        
        .section-subtitle {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 50px;
        }
        
        .footer {
            background: #2c3e50;
            color: white;
            padding: 40px 0 20px;
        }
        
        .social-icon {
            font-size: 1.5rem;
            color: white;
            margin: 0 10px;
            transition: all 0.3s ease;
        }
        
        .social-icon:hover {
            color: var(--primary-color);
            transform: translateY(-3px);
        }
        
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }
            
            .hero-subtitle {
                font-size: 1rem;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
        }


        .text-shadow {
            text-shadow: 2px 2px 10px rgba(0,0,0,0.7);
        }

        .text-shadow-sm {
            text-shadow: 1px 1px 6px rgba(0,0,0,0.5);
        }

        .hero-slide h1 {
            animation: fadeInDown 1s ease-in-out;
        }

        .hero-slide p {
            animation: fadeInUp 1.2s ease-in-out;
        }

        .hero-slide a {
            animation: fadeIn 1.5s ease-in-out;
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Navbar */
        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }
        
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color) !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .navbar-brand i {
            font-size: 1.8rem;
        }
        
        .navbar-nav .nav-link {
            color: #333;
            font-weight: 500;
            padding: 8px 20px;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .navbar-nav .nav-link:hover {
            color: var(--primary-color);
        }
        
        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        .navbar-nav .nav-link:hover::after {
            width: 80%;
        }
        
        .navbar-nav .nav-link.active {
            color: var(--primary-color);
        }
        
        .navbar-toggler {
            border: none;
            padding: 5px;
        }
        
        .navbar-toggler:focus {
            box-shadow: none;
        }
        
        .navbar-scrolled {
            padding: 10px 0;
            box-shadow: 0 2px 20px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#home">
                <i class="fas fa-handshake"></i>
                H2Hand
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">
                            <i class="fas fa-home me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sejarah">
                            <i class="fas fa-info-circle me-1"></i>Tentang Kami
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#product">
                            <i class="fas fa-envelope me-1"></i>Product
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#maps">
                            <i class="fas fa-map-marker-alt me-1"></i>Maps
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Carousel -->
    <section id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

            <!-- Slide 1 -->
            <div class="carousel-item active">
                <div class="hero-slide d-flex align-items-center justify-content-center"
                    style="background: url({{ asset('images/home/slide1.jpg') }}) center/cover no-repeat; height: 70vh;">
                    <div class="text-center text-white px-4">
                        <h1 class="display-3 fw-bold text-shadow mb-3">
                            <span class="text-primary">H2Hand</span> Accessories <br> &amp; Gadget
                        </h1>
                        <p class="lead fw-light mb-4 text-shadow-sm">
                            Temukan koleksi lengkap aksesoris gadget, perlengkapan kantor, dan produk teknologi 
                            <span class="fw-bold text-warning">berkualitas</span> untuk mendukung aktivitas sehari-hari Anda.
                        </p>
                        <a href="#marketplace" class="btn btn-lg btn-primary shadow-lg px-4 py-2">
                            <i class="fas fa-shopping-cart me-2"></i> Belanja Sekarang
                        </a>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item">
                <div class="hero-slide d-flex align-items-center justify-content-center"
                    style="background: url({{ asset('images/home/slide4.jpeg') }}) center/cover no-repeat; height: 70vh;">
                    <div class="text-center text-white px-4">
                        <h1 class="display-3 fw-bold text-shadow mb-3">
                            <span class="text-primary">H2Hand</span> Accessories <br> &amp; Gadget
                        </h1>
                        <p class="lead fw-light mb-4 text-shadow-sm">
                            Temukan koleksi lengkap aksesoris gadget, perlengkapan kantor, dan produk teknologi 
                            <span class="fw-bold text-warning">berkualitas</span> untuk mendukung aktivitas sehari-hari Anda.
                        </p>
                        <a href="#marketplace" class="btn btn-lg btn-primary shadow-lg px-4 py-2">
                            <i class="fas fa-shopping-cart me-2"></i> Belanja Sekarang
                        </a>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item">
                <div class="hero-slide d-flex align-items-center justify-content-center"
                    style="background: url({{ asset('images/home/slide4.jpeg') }}) center/cover no-repeat; height: 70vh;">
                    <div class="text-center text-white px-4">
                        <h1 class="display-3 fw-bold text-shadow mb-3">
                            <span class="text-primary">H2Hand</span> Accessories <br> &amp; Gadget
                        </h1>
                        <p class="lead fw-light mb-4 text-shadow-sm">
                            Temukan koleksi lengkap aksesoris gadget, perlengkapan kantor, dan produk teknologi 
                            <span class="fw-bold text-warning">berkualitas</span> untuk mendukung aktivitas sehari-hari Anda.
                        </p>
                        <a href="#marketplace" class="btn btn-lg btn-primary shadow-lg px-4 py-2">
                            <i class="fas fa-shopping-cart me-2"></i> Belanja Sekarang
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </section>


    {{-- Sejarah --}}
    <section id="sejarah" class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">

            <!-- Gambar Sejarah -->
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{ asset('images/home/sejarah.jpg') }}" 
                    alt="Sejarah H2Hand" 
                    class="img-fluid rounded shadow">
            </div>

            <!-- Konten Sejarah -->
            <div class="col-lg-6">
                <h2 class="fw-bold mb-3">Sejarah H2Hand</h2>
                <p class="text-muted fst-italic">Bermula dari Ketidakpastian, Berkembang dengan Semangat Baru</p>

                <p>
                Di tengah gelombang ketidakpastian yang dibawa oleh pandemi COVID-19 di tahun 2020, 
                kami justru melihat sebuah peluang untuk tetap produktif dan membantu. 
                Banyak orang harus beradaptasi, termasuk kami. Dengan segala keterbatasan gerak, 
                kami memutuskan untuk memulai perjalanan kecil ini: <strong>H2Hand</strong>.
                </p>

                <p>
                Awalnya, produk-produk yang kami pasarkan adalah speaker bluetooth premium second hand 
                seperti <strong>Harman Kardon, Bose, JBL</strong>, dan lainnya. 
                Karena itu kami mengambil nama <strong>H2Hand</strong> (Hoby second hand – kata <em>hoby</em> 
                dari hobi kami bermusik, sedangkan <em>2 hand</em> dari speaker bluetooth second hand 
                yang kami pasarkan). 
                </p>

                <p>
                Ini hanyalah upaya untuk mengisi waktu dan menjalankan hobi: mendengarkan musik dari 
                audio berkualitas, mengusir rasa sepi dan suntuk saat lockdown di rumah, serta tetap 
                terhubung dengan komunitas.
                </p>

                <p>
                Namun, kami segera menyadari bahwa kehadiran sebuah toko online bukan hanya tentang 
                menjual produk, tetapi juga tentang memberikan kemudahan, keamanan berbelanja dari rumah, 
                dan sedikit cahaya di masa yang menantang.
                </p>

                <p>
                Dari pesanan pertama yang begitu membahagiakan hingga testimoni pelanggan yang terus 
                memotivasi, kami tumbuh. Setiap klik, setiap pesanan, dan setiap ucapan terima kasih 
                adalah bahan bakar semangat kami. Seiring berjalannya waktu, kami ingin lebih serius 
                menyediakan kemudahan, kecepatan, keamanan belanja dari rumah, dan masuk ke dalam ranah 
                baru produk yang kami pasarkan: <strong>stationery</strong> (peralatan tulis kantor & sekolah), 
                <strong>gadget accessories</strong>, dan <strong>peripheral equipment</strong>.
                </p>

                <p>
                Nama <strong>H2Hand</strong> kami maknai secara baru yaitu 
                <em>Helping with 2 Hand</em> — yang artinya semangat kami membantu memenuhi kebutuhan 
                setiap pelanggan secara mudah dan cepat, dilambangkan dengan dua tangan yang saling berjabatan.
                </p>

                <p class="fw-bold text-primary">
                Hari ini, H2Hand hadir tidak hanya sebagai respons terhadap pandemi, 
                tetapi sebagai komitmen untuk terus melayani Anda dengan produk berkualitas, 
                layanan terpercaya, dan semangat ketahanan yang lahir di masa sulit.
                </p>

                <p class="mb-0"><em>Terima kasih telah menjadi bagian dari cerita kami.</em></p>
            </div>

            </div>
        </div>
        </section>


    <!-- Categories Section -->
    <section class="category-section" id="product">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Kategori Produk Kami</h2>
                <p class="section-subtitle">Berbagai pilihan produk berkualitas untuk kebutuhan Anda</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="fas fa-pen-fancy"></i>
                        </div>
                        <h3 class="category-title">ATK</h3>
                        <p>Alat tulis kantor lengkap untuk produktivitas maksimal</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="fas fa-keyboard"></i>
                        </div>
                        <h3 class="category-title">Peripheral Equipment</h3>
                        <p>Mouse, keyboard, dan perangkat pendukung berkualitas</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h3 class="category-title">Gadget Accessories</h3>
                        <p>Aksesoris gadget terlengkap untuk gaya hidup digital</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="fas fa-volume-up"></i>
                        </div>
                        <h3 class="category-title">Bluetooth Speaker</h3>
                        <p>Speaker berkualitas untuk pengalaman audio terbaik</p>
                    </div>
                </div>
            </div>
            <div class="row g-4 mt-3">
                <div class="col-md-4">
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="fas fa-ethernet"></i>
                        </div>
                        <h3 class="category-title">Kabel LAN</h3>
                        <p>Kabel jaringan berkualitas untuk koneksi stabil</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="fas fa-tv"></i>
                        </div>
                        <h3 class="category-title">Kabel HDMI</h3>
                        <p>Kabel HDMI untuk kualitas gambar maksimal</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="fas fa-plug"></i>
                        </div>
                        <h3 class="category-title">Kabel DisplayPort</h3>
                        <p>Solusi koneksi display resolusi tinggi</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Brands Section -->
    <section class="brands-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Brand Partner Kami</h2>
                <p class="section-subtitle">Produk original dari brand terpercaya</p>
            </div>
            <div class="row g-4 align-items-center">
                <div class="col-6 col-md-4">
                    <div class="brand-item">
                        <img src="{{ asset('images/acmic.jpg') }}" alt="acmic" class="img-fluid">
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="brand-item">
                        <img src="{{ asset('images/anker.jpg') }}" alt="Anker" class="img-fluid">
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="brand-item">
                        <img src="{{ asset('images/cableime.jpg') }}" alt="cableime" class="img-fluid">
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="brand-item">
                        <img src="{{ asset('images/vention.jpg') }}" alt="vention" class="img-fluid">
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="brand-item">
                        <img src="{{ asset('images/fantech.jpg') }}" alt="Anfantechker" class="img-fluid">
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="brand-item">
                        <img src="{{ asset('images/jisulife.jpg') }}" alt="jisulife" class="img-fluid">
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="brand-item">
                        <img src="{{ asset('images/soundcore.jpg') }}" alt="soundcore" class="img-fluid">
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="brand-item">
                        <img src="{{ asset('images/ugreen.jpg') }}" alt="ugreen" class="img-fluid">
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="brand-item">
                        <img src="{{ asset('images/vention.jpg') }}" alt="vention" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="products-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Produk Pilihan</h2>
                <p class="section-subtitle">Produk terlaris dan rekomendasi terbaik untuk Anda</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="product-card">
                        <div class="product-badge">Best Seller</div>
                        <div class="product-image">
                            <img src="{{ asset('images/1.jpg') }}" class="img-fluid" alt="Logitech M190 Wireless Mouse">
                        </div>
                        <div class="product-content">
                            <h4 class="product-title">Anker PowerCore 10000mAh</h4>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span class="rating-text">(4.5)</span>
                            </div>
                            <div class="product-price">
                                <span class="price-discount">Rp 150.000</span>
                                <span class="price-main">Rp 129.000</span>
                            </div>
                            <a href="https://www.tokopedia.com/h2hand-stationery" class="btn product-btn">
                                <i class="fas fa-shopping-cart me-2"></i>Lihat Produk
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="product-card">
                        <div class="product-badge" style="background: #FF6B6B;">Hot</div>
                        <div class="product-image">
                            <img src="{{ asset('images/2.jpeg') }}" class="img-fluid" alt="Charger 30 W">
                        </div>
                        <div class="product-content">
                            <h4 class="product-title">Charger 30 W</h4>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <span class="rating-text">(5.0)</span>
                            </div>
                            <div class="product-price">
                                <span class="price-discount">Rp 450.000</span>
                                <span class="price-main">Rp 389.000</span>
                            </div>
                            <a href="https://www.tokopedia.com/h2hand-stationery" class="btn product-btn">
                                <i class="fas fa-shopping-cart me-2"></i>Lihat Produk
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="product-card">
                        <div class="product-badge" style="background: #4CAF50;">New</div>
                        <div class="product-image">
                            <img src="{{ asset('images/3.jpeg') }}" class="img-fluid" alt="Jisulife">
                        </div>
                        <div class="product-content">
                            <h4 class="product-title">Jisulife</h4>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <span class="rating-text">(4.0)</span>
                            </div>
                            <div class="product-price">
                                <span class="price-main">Rp 45.000</span>
                            </div>
                            <a href="https://www.tokopedia.com/h2hand-stationery" class="btn product-btn">
                                <i class="fas fa-shopping-cart me-2"></i>Lihat Produk
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{ asset('images/4.jpeg') }}" class="img-fluid" alt="8 in 1 hub with table stand">
                        </div>
                        <div class="product-content">
                            <h4 class="product-title">8 in 1 hub with table stand</h4>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span class="rating-text">(4.5)</span>
                            </div>
                            <div class="product-price">
                                <span class="price-discount">Rp 85.000</span>
                                <span class="price-main">Rp 69.000</span>
                            </div>
                            <a href="https://www.tokopedia.com/h2hand-stationery" class="btn product-btn">
                                <i class="fas fa-shopping-cart me-2"></i>Lihat Produk
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{ asset('images/5.jpeg') }}" class="img-fluid" alt=" 4 In 1 HDMI Switcher">
                        </div>
                        <div class="product-content">
                            <h4 class="product-title"> 4 In 1 HDMI Switcher</h4>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <span class="rating-text">(5.0)</span>
                            </div>
                            <div class="product-price">
                                <span class="price-discount">Rp 450.000</span>
                                <span class="price-main">Rp 399.000</span>
                            </div>
                            <a href="https://www.tokopedia.com/h2hand-stationery" class="btn product-btn">
                                <i class="fas fa-shopping-cart me-2"></i>Lihat Produk
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="product-card">
                        <div class="product-badge" style="background: #FF6B6B;">Hot</div>
                        <div class="product-image">
                            <img src="{{ asset('images/6.jpeg') }}" class="img-fluid" alt="Anker PowerCore 10000mAh">
                        </div>
                        <div class="product-content">
                            <h4 class="product-title">Logitech M190 Wireless Mouse</h4>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span class="rating-text">(4.5)</span>
                            </div>
                            <div class="product-price">
                                <span class="price-discount">Rp 350.000</span>
                                <span class="price-main">Rp 299.000</span>
                            </div>
                            <a href="https://www.tokopedia.com/h2hand-stationery" class="btn product-btn">
                                <i class="fas fa-shopping-cart me-2"></i>Lihat Produk
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{ asset('images/7.jpeg') }}" class="img-fluid" alt="Audio Receiver bluetooth 5.0">
                        </div>
                        <div class="product-content">
                            <h4 class="product-title">Audio Receiver bluetooth 5.0</h4>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <span class="rating-text">(4.0)</span>
                            </div>
                            <div class="product-price">
                                <span class="price-main">Rp 25.000</span>
                            </div>
                            <a href="https://www.tokopedia.com/h2hand-stationery" class="btn product-btn">
                                <i class="fas fa-shopping-cart me-2"></i>Lihat Produk
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="product-card">
                        <div class="product-badge">Best Seller</div>
                        <div class="product-image">
                            <img src="{{ asset('images/8.jpeg') }}" class="img-fluid" alt="Vention DisplayPort Cable 2M">
                        </div>
                        <div class="product-content">
                            <h4 class="product-title">Vention DisplayPort Cable 2M</h4>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <span class="rating-text">(5.0)</span>
                            </div>
                            <div class="product-price">
                                <span class="price-discount">Rp 120.000</span>
                                <span class="price-main">Rp 99.000</span>
                            </div>
                            <a href="https://www.tokopedia.com/h2hand-stationery" class="btn product-btn">
                                <i class="fas fa-shopping-cart me-2"></i>Lihat Produk
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="product-card">
                        <div class="product-badge">Best Seller</div>
                        <div class="product-image">
                            <img src="{{ asset('images/9.jpeg') }}" class="img-fluid" alt="Vention DisplayPort Cable 2M">
                        </div>
                        <div class="product-content">
                            <h4 class="product-title">Vention DisplayPort Cable 2M</h4>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <span class="rating-text">(5.0)</span>
                            </div>
                            <div class="product-price">
                                <span class="price-discount">Rp 120.000</span>
                                <span class="price-main">Rp 99.000</span>
                            </div>
                            <a href="https://www.tokopedia.com/h2hand-stationery" class="btn product-btn">
                                <i class="fas fa-shopping-cart me-2"></i>Lihat Produk
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="product-card">
                        <div class="product-badge">Best Seller</div>
                        <div class="product-image">
                            <img src="{{ asset('images/10.jpeg') }}" class="img-fluid" alt="Vention DisplayPort Cable 2M">
                        </div>
                        <div class="product-content">
                            <h4 class="product-title">Vention DisplayPort Cable 2M</h4>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <span class="rating-text">(5.0)</span>
                            </div>
                            <div class="product-price">
                                <span class="price-discount">Rp 120.000</span>
                                <span class="price-main">Rp 99.000</span>
                            </div>
                            <a href="https://www.tokopedia.com/h2hand-stationery" class="btn product-btn">
                                <i class="fas fa-shopping-cart me-2"></i>Lihat Produk
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="https://www.tokopedia.com/h2hand-stationery" class="btn cta-button" style="background: var(--primary-color); color: white; border: none;">
                    Lihat Semua Produk <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <section class="marketplace-section" id="marketplace">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title text-white">Kunjungi Toko Kami</h2>
                <p class="section-subtitle text-white">Belanja mudah di marketplace favorit Anda</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4 mx-auto">
                    <div class="marketplace-card">
                        <div class="marketplace-icon" style="color: #00AA5B;">
                            <img src="tokopedia-logo.png" alt="Tokopedia" style="width:60px;">
                        </div>
                        <h3 class="marketplace-name">Tokopedia</h3>
                        <p>Mulai dari sini</p>
                        <a href="https://www.tokopedia.com/h2hand-stationery" class="marketplace-btn">
                            <i class="fas fa-external-link-alt me-2"></i>Kunjungi Toko
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Maps -->
    <section class="maps-section" id="maps">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="section-title">Lokasi Kami</h2>
                <p class="section-subtitle">Temukan toko kami dengan mudah</p>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="map-container" style="width:100%; height:400px; border-radius:10px; overflow:hidden;">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.4368941317257!2d110.43267329999999!3d-7.0752391!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708eb67323717f%3A0x2b6a1808d0c36ec0!2sJl.%20Ulin%20Selatan%20V%20No.204%2C%20RT.005%2FRW.013%2C%20Padangsari%2C%20Kec.%20Banyumanik%2C%20Kota%20Semarang%2C%20Jawa%20Tengah%2050267!5e0!3m2!1sid!2sid!4v1759504451288!5m2!1sid!2sid" 
                            width="100%" 
                            height="400" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Mengapa Pilih H2Hand?</h2>
                <p class="section-subtitle">Keunggulan berbelanja di H2Hand</p>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4 class="feature-title">100% Original</h4>
                        <p>Semua produk dijamin keasliannya</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-tag"></i>
                        </div>
                        <h4 class="feature-title">Harga Terbaik</h4>
                        <p>Harga kompetitif dengan kualitas terjamin</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <h4 class="feature-title">Pengiriman Cepat</h4>
                        <p>Proses pengiriman yang cepat dan aman</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h4 class="feature-title">Support 24/7</h4>
                        <p>Customer service siap membantu Anda</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Marketplace Section -->
    <section class="marketplace-section" id="marketplace">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title text-white">Kunjungi Toko Kami</h2>
                <p class="section-subtitle text-white">Belanja mudah di marketplace favorit Anda</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4 mx-auto">
                    <div class="marketplace-card">
                        <div class="marketplace-icon mb-3">
                        <img src="{{ asset('images/home/tokped.webp') }}" 
                             alt="Tokopedia Logo" 
                             style="width:200px; height:auto;">
                        </div>
                        <h3 class="marketplace-name">Tokopedia</h3>
                        <p>Mulai dari sini</p>
                        <a href="https://www.tokopedia.com/h2hand-stationery" class="marketplace-btn">
                            <i class="fas fa-external-link-alt me-2"></i>Kunjungi Toko
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer text-white">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h4 class="mb-4">
                        <i class="fas fa-handshake me-2"></i>H2Hand
                    </h4>
                    <p class="text-white">Solusi lengkap untuk kebutuhan ATK, peripheral equipment, gadget accessories, natural latex products, dan bluetooth speaker berkualitas tinggi.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/h2h.stationery/" target="_blak" class="text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://wa.me/6281390892522" target="_blank"
                        class="text-white"><i class="fab fa-whatsapp fa-lg"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6 class="mb-3">Produk</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white text-decoration-none">ATK</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Peripheral</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Gadget Accessories</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Natural Latex</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Bluetooth Speaker</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6 class="mb-3">Marketplace</h6>
                    <ul class="list-unstyled">
                        <li><a href="https://www.tokopedia.com/h2hand-stationery" class="text-white text-decoration-none">Tokopedia</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6 class="mb-3">Informasi</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white text-decoration-none">Tentang Kami</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Kebijakan Privasi</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6 class="mb-3">Bantuan</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white text-decoration-none">Cara Pemesanan</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Pembayaran</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Pengiriman</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Return & Refund</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.category-card, .feature-box, .marketplace-card, .product-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'all 0.6s ease';
            observer.observe(el);
        });
    </script>
</body>
</html>