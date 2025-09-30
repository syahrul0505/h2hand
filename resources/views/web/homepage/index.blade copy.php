<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H2Hand - Solusi Lengkap ATK & Gadget Accessories</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --accent-color: #f59e0b;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 120px 0 80px 0;
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="90" cy="40" r="0.5" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .section-padding {
            padding: 80px 0;
        }

        .product-card {
            background: white;
            border-radius: 15px;
            padding: 30px 20px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: none;
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(37, 99, 235, 0.2);
        }

        .product-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px auto;
            color: white;
            font-size: 30px;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.3);
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
        }

        .btn-outline-custom {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            background: transparent;
        }

        .btn-outline-custom:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        .stats-section {
            background: var(--light-color);
        }

        .stat-card {
            text-align: center;
            padding: 20px;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary-color);
            line-height: 1;
        }

        .stat-label {
            color: var(--dark-color);
            font-weight: 500;
            margin-top: 10px;
        }

        .cta-section {
            background: linear-gradient(135deg, var(--accent-color) 0%, #ea580c 100%);
            color: white;
        }

        .marketplace-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 40px;
        }

        .marketplace-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            transition: all 0.3s ease;
            text-decoration: none;
            color: var(--dark-color);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .marketplace-card:hover {
            transform: translateY(-5px);
            color: var(--primary-color);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }

        .marketplace-icon {
            font-size: 40px;
            margin-bottom: 15px;
            color: var(--primary-color);
        }

        .footer {
            background: var(--dark-color);
            color: white;
            padding: 40px 0 20px 0;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 20px;
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: #64748b;
            margin-bottom: 40px;
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 80px 0 60px 0;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .stat-number {
                font-size: 2.5rem;
            }
        }

        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .floating-shapes::before,
        .floating-shapes::after {
            content: '';
            position: absolute;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .floating-shapes::before {
            width: 100px;
            height: 100px;
            top: 20%;
            right: 20%;
            animation-delay: 0s;
        }

        .floating-shapes::after {
            width: 60px;
            height: 60px;
            bottom: 30%;
            left: 10%;
            animation-delay: 3s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="#" style="color: var(--primary-color);">
                <i class="fas fa-handshake me-2"></i>H2Hand
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#products">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#marketplace">Marketplace</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="floating-shapes"></div>
        <div class="container hero-content">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">
                        Solusi Lengkap <span style="color: var(--accent-color);">ATK & Gadget</span> Terpercaya
                    </h1>
                    <p class="lead mb-4">
                        H2Hand menyediakan ATK berkualitas, peripheral equipment, gadget accessories, produk natural latex, dan bluetooth speaker dengan harga terbaik untuk kebutuhan kantor dan personal Anda.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#marketplace" class="btn btn-primary-custom btn-lg">
                            <i class="fas fa-shopping-cart me-2"></i>Belanja Sekarang
                        </a>
                        <a href="#products" class="btn btn-outline-custom btn-lg">
                            <i class="fas fa-eye me-2"></i>Lihat Produk
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="row g-3 mt-4">
                        <div class="col-6">
                            <div class="bg-white bg-opacity-10 p-4 rounded-3">
                                <i class="fas fa-pen-fancy display-6 mb-3" style="color: var(--accent-color);"></i>
                                <h5>ATK Premium</h5>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-white bg-opacity-10 p-4 rounded-3">
                                <i class="fas fa-headphones display-6 mb-3" style="color: var(--accent-color);"></i>
                                <h5>Audio Equipment</h5>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-white bg-opacity-10 p-4 rounded-3">
                                <i class="fas fa-mobile-alt display-6 mb-3" style="color: var(--accent-color);"></i>
                                <h5>Gadget Accessories</h5>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-white bg-opacity-10 p-4 rounded-3">
                                <i class="fas fa-leaf display-6 mb-3" style="color: var(--accent-color);"></i>
                                <h5>Natural Latex</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section section-padding">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-number">1000+</div>
                        <div class="stat-label">Produk Tersedia</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-number">5000+</div>
                        <div class="stat-label">Pelanggan Puas</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-number">5</div>
                        <div class="stat-label">Tahun Pengalaman</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Customer Support</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="section-padding">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Kategori Produk Kami</h2>
                <p class="section-subtitle">Temukan berbagai produk berkualitas tinggi untuk kebutuhan Anda</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="product-card">
                        <div class="product-icon">
                            <i class="fas fa-pen-nib"></i>
                        </div>
                        <h4 class="mb-3">ATK (Alat Tulis Kantor)</h4>
                        <p class="text-muted">Pulpen, pensil, penggaris, buku tulis, map, dan berbagai kebutuhan alat tulis kantor berkualitas premium.</p>
                        <ul class="list-unstyled text-start mt-3">
                            <li><i class="fas fa-check text-success me-2"></i>Pulpen & Pensil Premium</li>
                            <li><i class="fas fa-check text-success me-2"></i>Buku & Kertas Berkualitas</li>
                            <li><i class="fas fa-check text-success me-2"></i>Organizer & Filling</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="product-card">
                        <div class="product-icon">
                            <i class="fas fa-keyboard"></i>
                        </div>
                        <h4 class="mb-3">Peripheral Equipment</h4>
                        <p class="text-muted">Mouse, keyboard, webcam, dan berbagai peralatan pendukung komputer untuk meningkatkan produktivitas.</p>
                        <ul class="list-unstyled text-start mt-3">
                            <li><i class="fas fa-check text-success me-2"></i>Mouse & Keyboard Gaming</li>
                            <li><i class="fas fa-check text-success me-2"></i>Webcam HD</li>
                            <li><i class="fas fa-check text-success me-2"></i>USB Hub & Adapters</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="product-card">
                        <div class="product-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h4 class="mb-3">Gadget Accessories</h4>
                        <p class="text-muted">Case, charger, power bank, dan aksesori gadget lainnya untuk melindungi dan memaksimalkan perangkat Anda.</p>
                        <ul class="list-unstyled text-start mt-3">
                            <li><i class="fas fa-check text-success me-2"></i>Case & Screen Protector</li>
                            <li><i class="fas fa-check text-success me-2"></i>Charger & Power Bank</li>
                            <li><i class="fas fa-check text-success me-2"></i>Cable & Adapter</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="product-card">
                        <div class="product-icon">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <h4 class="mb-3">Natural Latex Products</h4>
                        <p class="text-muted">Produk latex alami yang ramah lingkungan, aman, dan berkualitas tinggi untuk berbagai keperluan.</p>
                        <ul class="list-unstyled text-start mt-3">
                            <li><i class="fas fa-check text-success me-2"></i>Sarung Tangan Latex</li>
                            <li><i class="fas fa-check text-success me-2"></i>Matras & Bantal Latex</li>
                            <li><i class="fas fa-check text-success me-2"></i>Produk Kesehatan</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="product-card">
                        <div class="product-icon">
                            <i class="fas fa-volume-up"></i>
                        </div>
                        <h4 class="mb-3">Bluetooth Speaker</h4>
                        <p class="text-muted">Speaker bluetooth dengan kualitas suara jernih, bass yang dalam, dan desain portable untuk entertainment Anda.</p>
                        <ul class="list-unstyled text-start mt-3">
                            <li><i class="fas fa-check text-success me-2"></i>Hi-Fi Sound Quality</li>
                            <li><i class="fas fa-check text-success me-2"></i>Waterproof Design</li>
                            <li><i class="fas fa-check text-success me-2"></i>Long Battery Life</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="product-card">
                        <div class="product-icon">
                            <i class="fas fa-gift"></i>
                        </div>
                        <h4 class="mb-3">Produk Spesial</h4>
                        <p class="text-muted">Produk eksklusif dan limited edition yang hanya tersedia di H2Hand dengan kualitas premium dan harga terjangkau.</p>
                        <ul class="list-unstyled text-start mt-3">
                            <li><i class="fas fa-check text-success me-2"></i>Limited Edition Items</li>
                            <li><i class="fas fa-check text-success me-2"></i>Bundle Packages</li>
                            <li><i class="fas fa-check text-success me-2"></i>Seasonal Products</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Marketplace Section -->
    <section id="marketplace" class="cta-section section-padding">
        <div class="container text-center">
            <h2 class="section-title text-white mb-4">Temukan Produk Kami di Marketplace Terpercaya</h2>
            <p class="lead text-white mb-5">Belanja mudah dan aman di platform marketplace favorit Anda</p>
            
            <div class="marketplace-grid">
                <a href="#" class="marketplace-card" target="_blank">
                    <div class="marketplace-icon">
                        <i class="fab fa-shopify"></i>
                    </div>
                    <h5 class="mb-2">Shopee</h5>
                    <p class="small text-muted mb-0">Gratis ongkir & cashback</p>
                </a>
                
                <a href="#" class="marketplace-card" target="_blank">
                    <div class="marketplace-icon">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <h5 class="mb-2">Tokopedia</h5>
                    <p class="small text-muted mb-0">Mulai dari brand lokal</p>
                </a>
                
                <a href="#" class="marketplace-card" target="_blank">
                    <div class="marketplace-icon">
                        <i class="fab fa-amazon"></i>
                    </div>
                    <h5 class="mb-2">Bukalapak</h5>
                    <p class="small text-muted mb-0">Jual beli mudah</p>
                </a>
                
                <a href="#" class="marketplace-card" target="_blank">
                    <div class="marketplace-icon">
                        <i class="fas fa-store"></i>
                    </div>
                    <h5 class="mb-2">Lazada</h5>
                    <p class="small text-muted mb-0">Online revolution</p>
                </a>
                
                <a href="#" class="marketplace-card" target="_blank">
                    <div class="marketplace-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <h5 class="mb-2">Blibli</h5>
                    <p class="small text-muted mb-0">Big bang for bucks</p>
                </a>
            </div>
            
            <div class="mt-5">
                <a href="#contact" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-phone me-2"></i>Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section-padding bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Hubungi Kami</h2>
                <p class="section-subtitle">Kami siap membantu Anda 24/7</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="text-center p-4">
                        <div class="product-icon mb-3">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h5>Telepon</h5>
                        <p class="text-muted">+62 812-3456-7890</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="text-center p-4">
                        <div class="product-icon mb-3">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h5>Email</h5>
                        <p class="text-muted">info@h2hand.com</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="text-center p-4">
                        <div class="product-icon mb-3">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <h5>WhatsApp</h5>
                        <p class="text-muted">+62 812-3456-7890</p>
                    </div>
                </div>
            </div>
            
            <div class="row mt-5">
                <div class="col-lg-8 mx-auto">
                    <div class="bg-white p-5 rounded-3 shadow">
                        <h4 class="mb-4">Kirim Pesan</h4>
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" required>
                                </div>
                                <div class="col-12">
                                    <label for="subjek" class="form-label">Subjek</label>
                                    <input type="text" class="form-control" id="subjek" required>
                                </div>
                                <div class="col-12">
                                    <label for="pesan" class="form-label">Pesan</label>
                                    <textarea class="form-control" id="pesan" rows="5" required></textarea>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary-custom btn-lg">
                                        <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                                    </button>
                                </div>
                            </div>
                        </form>
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
                    <p class="text-muted">Solusi lengkap untuk kebutuhan ATK, peripheral equipment, gadget accessories, natural latex products, dan bluetooth speaker berkualitas tinggi.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6 class="mb-3">Produk</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-muted text-decoration-none">ATK</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Peripheral</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Gadget Accessories</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Natural Latex</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Bluetooth Speaker</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6 class="mb-3">Marketplace</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-muted text-decoration-none">Shopee</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Tokopedia</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Bukalapak</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Lazada</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Blibli</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6 class="mb-3">Informasi</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-muted text-decoration-none">Tentang Kami</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Kebijakan Privasi</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6 class="mb-3">Bantuan</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-muted text-decoration-none">Cara Pemesanan</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Pembayaran</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Pengiriman</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Return & Refund</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>