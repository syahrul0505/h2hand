@extends('web.layouts.app')

@push('styles')
    <style>
        main.main-wrapper {
            padding-top: 85px;
        }

        .page-header {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset('assets/images/homepage/swiper00.jpg') }}') center center;
            background-size: cover;
            color: white;
        }

        .page-header .text-primary {
            color: #cf2e2e !important; 
            text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
        }

        .contact-card {
            background-color: #fff;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
            transition: all 0.3s ease;
            height: 100%;
        }
        .contact-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        }
        .contact-card .icon-wrapper {
            margin: 0 auto 1.5rem;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg, #cf2e2e, #ca4949ff);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
        }
        .contact-card h5 {
            font-weight: 600;
            color: #343f52;
        }
        .contact-card p a {
            color: #60697b;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .contact-card p a:hover {
            color: #cf2e2e;
        }

        .form-wrapper, .map-wrapper {
            background-color: #fff;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            height: 100%;
        }
        .map-wrapper iframe {
            width: 100%;
            height: 100%;
            min-height: 400px; 
            border-radius: 10px;
            border: 0;
        }
    </style>
@endpush

@section('content')
    <main class="main-wrapper">

        <section class="page-header text-center py-10 py-md-12">
            <div class="container">
                <h1 class="display-3 fw-bold text-primary">Hubungi Kami</h1>
                <p class="lead fs-22">Kami siap membantu mewujudkan acara impian Anda.</p>
            </div>
        </section>

        <section class="wrapper">
            <div class="container py-10 py-md-12">
                <div class="row gy-4 mb-10">
                    <div class="col-md-6 col-lg-3">
                        <div class="contact-card">
                            <div class="icon-wrapper"><i class="uil uil-map-marker"></i></div>
                            <h5>Alamat</h5>
                            <p>Jakarta Selatan,<br>DKI Jakarta, 12640</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="contact-card">
                            <div class="icon-wrapper"><i class="uil uil-whatsapp"></i></div>
                            <h5>Whatsapp</h5>
                            <p><a href="https://wa.me/628889120198" target="_blank">0888-9120-198</a></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="contact-card">
                            <div class="icon-wrapper"><i class="uil uil-envelope"></i></div>
                            <h5>Email</h5>
                            <p><a href="mailto:rajendra.project25@gmail.com">rajendra.project25@gmail.com</a></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="contact-card">
                            <div class="icon-wrapper"><i class="uil uil-instagram"></i></div>
                            <h5>Instagram</h5>
                            <p><a href="https://instagram.com/rajendraproject25" target="_blank">@rajendraproject25</a></p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-9">
                        <div class="map-wrapper">
                             <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253840.656274439!2d106.68942838127395!3d-6.229746460330873!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f157c6a414e3%3A0x2e947c268b05b65d!2sSouth%20Jakarta%2C%20South%20Jakarta%20City%2C%20Jakarta!5e0!3m2!1sen!2sid!4v1663123456789!5m2!1sen!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection