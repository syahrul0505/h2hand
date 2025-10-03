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
            filter: grayscale(100%);
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
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container hero-content">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1 class="hero-title">H2Hand</h1>
                    <p class="hero-subtitle">Solusi Lengkap untuk Kebutuhan ATK, Gadget Accessories, Peripheral Equipment, dan Bluetooth Speaker Berkualitas</p>
                    <a href="#marketplace" class="btn cta-button cta-primary">
                        <i class="fas fa-shopping-cart me-2"></i>Belanja Sekarang
                    </a>
                </div>
                <div class="col-lg-5 text-center mt-5 mt-lg-0">
                    <i class="fas fa-laptop-code" style="font-size: 15rem; opacity: 0.2;"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="category-section">
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
                            <a href="#marketplace" class="btn product-btn">
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
                            <a href="#marketplace" class="btn product-btn">
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
                            <a href="#marketplace" class="btn product-btn">
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
                            <a href="#marketplace" class="btn product-btn">
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
                            <a href="#marketplace" class="btn product-btn">
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
                            <a href="#marketplace" class="btn product-btn">
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
                            <a href="#marketplace" class="btn product-btn">
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
                            <a href="#marketplace" class="btn product-btn">
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
                            <a href="#marketplace" class="btn product-btn">
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
                            <a href="#marketplace" class="btn product-btn">
                                <i class="fas fa-shopping-cart me-2"></i>Lihat Produk
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="#marketplace" class="btn cta-button" style="background: var(--primary-color); color: white; border: none;">
                    Lihat Semua Produk <i class="fas fa-arrow-right ms-2"></i>
                </a>
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
                <div class="col-md-4">
                    <div class="marketplace-card">
                        <div class="marketplace-icon" style="color: #EE4D2D;">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <h3 class="marketplace-name">Shopee</h3>
                        <p>Belanja dengan promo menarik</p>
                        <a href="#" class="marketplace-btn">
                            <i class="fas fa-external-link-alt me-2"></i>Kunjungi Toko
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="marketplace-card">
                        <div class="marketplace-icon" style="color: #00AA5B;">
                            <i class="fas fa-shopping-basket"></i>
                        </div>
                        <h3 class="marketplace-name">Tokopedia</h3>
                        <p>Mulai dari sini</p>
                        <a href="#" class="marketplace-btn">
                            <i class="fas fa-external-link-alt me-2"></i>Kunjungi Toko
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="marketplace-card">
                        <div class="marketplace-icon" style="color: #F57224;">
                            <i class="fas fa-store"></i>
                        </div>
                        <h3 class="marketplace-name">Lazada</h3>
                        <p>Belanja online terpercaya</p>
                        <a href="#" class="marketplace-btn">
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
                        <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
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
                        <li><a href="#" class="text-white text-decoration-none">Shopee</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Tokopedia</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Bukalapak</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Lazada</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Blibli</a></li>
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