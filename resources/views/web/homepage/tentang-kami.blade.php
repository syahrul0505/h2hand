@extends('web.layouts.app')

@push('styles')
    <style>
        main.main-wrapper {
            padding-top: 85px; 
        }

        .page-header {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset('assets/images/homepage/satu.jpg') }}') center center;
            background-size: cover;
            color: white;
        }

        .page-header .text-primary {
            color: #cf2e2e !important;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
        }

        .text-justify {
            text-align: justify;
        }

        .feature-card {
            background-color: #fff;
            border-radius: 15px;
            padding: 2.5rem 2rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
            transition: all 0.3s ease;
            height: 100%;
        }
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        }
        .feature-card .icon-wrapper {
            margin: 0 auto 1.5rem;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg, #cf2e2e, #cd5050ff);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2.5rem;
        }
        .feature-card h4 {
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .counter-wrapper h3 {
            font-size: 3.5rem;
            font-weight: 700;
            color: #cf2e2e;
        }
    </style>
@endpush

@section('content')
    <main class="main-wrapper">

        <section class="page-header text-center py-10 py-md-12">
            <div class="container">
                <h1 class="display-3 fw-bold text-primary">Tentang Rajendra Project</h1>
                <p class="lead fs-22">Mitra Profesional untuk Setiap Momen Berkesan Anda</p>
            </div>
        </section>

        <section class="wrapper">
            <div class="container py-10 py-md-12">
                <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center">
                    <div class="col-lg-6">
                        <figure>
                            <img class="img-fluid rounded shadow-lg" 
                                 src="{{ asset('assets/tentangkami/team.jpg') }}" 
                                 alt="Tim Profesional Rajendra Project"
                                 data-aos="fade-up"      
                                 data-aos-delay="200"    
                                 data-aos-duration="1000" 
                            >
                        </figure>
                    </div>
                    <div class="col-lg-6">
                        <h2 class="display-5 mb-3 fw-bold" data-aos="fade-left" data-aos-delay="300">Solusi Event Anda Sejak 2013</h2>
                        <div class="text-secondary text-justify" data-aos="fade-left" data-aos-delay="400">
                            <p class="mb-4 lead">
                                <strong>Rajendra Project</strong> adalah perusahaan jasa penyelenggaraan acara (event services) yang hadir sebagai solusi lengkap untuk setiap kebutuhan acara Anda.
                            </p>
                            <p class="mb-4">
                                Dengan pengalaman sejak tahun 2013, kami didukung oleh tim yang profesional, kreatif, dan solid. Layanan utama kami meliputi Event Organizer (EO), penyediaan crew profesional, tim medis bersertifikat, hingga penyewaan sarana dan prasarana pendukung acara secara lengkap.
                            </p>
                            <p>
                                Kami percaya setiap acara memiliki cerita unik. Oleh karena itu, kami selalu berfokus pada detail dan pendekatan yang personal untuk memastikan acara Anda berjalan lancar, aman, dan meninggalkan kesan mendalam bagi semua yang hadir.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="wrapper bg-light">
            <div class="container py-10 py-md-12 text-center">
                <div class="row">
                    <div class="col-lg-9 col-xl-8 col-xxl-7 mx-auto">
                        <h2 class="display-5 fw-bold mb-3" data-aos="fade-up">Kenapa Memilih Kami?</h2>
                        <p class="lead mb-8" data-aos="fade-up" data-aos-delay="100">Kami mendedikasikan pengalaman dan kreativitas kami untuk kesuksesan acara Anda.</p>
                    </div>
                </div>
                <div class="row gx-lg-8 gx-xl-12 gy-8">
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="feature-card">
                            <div class="icon-wrapper"><i class="uil uil-calendar-alt"></i></div>
                            <h4>Solusi Event Lengkap</h4>
                            <p>Dari konsep, crew, tim medis, hingga peralatan. Kami menyediakan semua yang Anda butuhkan dalam satu atap.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="feature-card">
                            <div class="icon-wrapper"><i class="uil uil-shield-check"></i></div>
                            <h4>Eksekusi Profesional</h4>
                            <p>Tim berpengalaman kami memastikan setiap detail acara, dari perencanaan hingga hari-H, berjalan sukses dan lancar.</p>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4" data-aos="fade-up" data-aos-delay="400">
                        <div class="feature-card">
                            <div class="icon-wrapper"><i class="uil uil-heart"></i></div>
                            <h4>Mitra Terpercaya Anda</h4>
                            <p>Kepuasan Anda adalah prioritas utama. Kami siap menjadi mitra untuk menciptakan momen tak terlupakan bersama.</p>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="wrapper">
            <div class="container py-10 py-md-12">
                <div class="row text-center">
                    <div class="col-lg-10 col-xl-9 mx-auto">
                        <div class="row align-items-center counter-wrapper gy-6">
                            <div class="col-md-4" data-aos="fade-up">
                                <h3 class="counter">200+</h3>
                                <p class="fs-18 mb-0">Peserta di Setiap Event</p>
                            </div>
                            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                                <h3 class="counter">50+</h3>
                                <p class="fs-18 mb-0">Team Profesional</p>
                            </div>
                            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                                <h3 class="counter">100+</h3>
                                <p class="fs-18 mb-0">Event Terselenggara</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection