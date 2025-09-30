@extends('web.layouts.app') {{-- Sesuaikan dengan layout utama Anda --}}

@section('content')
<main class="main-wrapper">
    <section class="wrapper bg-soft-primary">
        <div class="container pt-10 pb-12 pt-md-14 pb-md-16 text-center">
            <div class="row">
                <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                    <div class="post-header">
                        <h1 class="display-1 mb-4">{{ $poster->title }}</h1>
                        <ul class="post-meta mb-5">
                            <li class="post-date">
                                <i class="uil uil-calendar-alt"></i>
                                <span>{{ $poster->created_at->format('d M Y') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="wrapper bg-light">
        <div class="container pb-14 pb-md-16">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="blog single mt-n17">
                        <figure class="card-img-top mb-12">
                            <img src="{{ Storage::url($poster->image) }}" alt="{{ $poster->title }}" />
                        </figure>
                        <div class="card">
                            <div class="card-body">
                                <div class="classic-view">
                                    {!! nl2br(e($poster->description)) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection