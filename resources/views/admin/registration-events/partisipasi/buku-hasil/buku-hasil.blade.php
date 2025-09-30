@extends('admin.layouts.app')
@section('breadcumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('my-participations.index') }}">Partisipasi</a></li>
        <li class="breadcrumb-item"><a
                href="{{ route('my-participations.show', Crypt::encryptString($event->id)) }}">{{ $event->name }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Buku Hasil</li>
    </ol>
@endsection
@push('style-link')
    <style>
        .widget-content-area {
            padding: 20px;
        }

        .header-tabs {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .header-tabs li {
            display: inline-block;
            margin-left: 25px;
        }

        .header-tabs li a {
            color: #888ea8;
            font-weight: 600;
            padding-bottom: 8px;
            text-decoration: none;
        }

        .header-tabs li.active a {
            color: #e0e6ed;
            border-bottom: 2px solid #e0e6ed;
        }

        .race-header {
            background-color: #ffc107;
            color: #000;
            font-weight: bold;
            text-align: center;
            padding: 8px;
            margin-top: 2rem;
            border: 1px solid #dee2e6;
            border-bottom: none;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .table-bordered {
            border-radius: 8px;
            overflow: hidden;
        }

        .table-bordered th {
            background-color: #3b3f5c;
            color: #e0e6ed;
            text-align: center;
            vertical-align: middle;
            font-weight: 600;
            border-color: #3b3f5c;
        }

        .table-bordered td {
            vertical-align: middle;
            border-color: #3b3f5c;
            background-color: #1b202f;
            color: #e0e6ed;
        }

        .table-bordered {
            border: 1px solid #3b3f5c;
        }

        .podium-highlight {
            background-color: rgba(255, 215, 0, 0.2) !important;
            color: #FFD700 !important;
            font-weight: bold;
        }

        .btn.btn-pdf-custom {
            background-color: #e74c3c !important;
            color: #ffffff !important;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            box-shadow: none;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn.btn-pdf-custom:hover {
            background-color: #c0392b !important;
            color: #ffffff !important;
        }

        .btn.btn-pdf-custom i {
            margin-right: 8px;
            font-size: 1.2em;
        }
    </style>
@endpush
@section('content')
    <div class="layout-px-spacing">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Perlombaan</h3>
            <ul class="header-tabs">
                <li><a href="{{ route('my-participations.show', Crypt::encryptString($event->id)) }}">Detail</a></li>
                <li><a href="{{ route('my-participations.schedule', Crypt::encryptString($event->id)) }}">Susunan Acara
                        Lomba</a></li>
                <li><a href="{{ route('my-participations.event-book', Crypt::encryptString($event->id)) }}">Buku Acara</a>
                </li>
                <li class="active"><a href="#!">Buku Hasil</a></li>
                <li><a href="{{ route('my-participations.juara', Crypt::encryptString($event->id)) }}">Juara</a></li>
            </ul>
        </div>

        <div class="col-12 layout-spacing">
            <div class="widget-content widget-content-area br-8">
                <div class="p-3">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">Buku Hasil - {{ $event->name }}</h5>
                        <div>
                            <a href="{{ route('my-participations.show', Crypt::encryptString($event->id)) }}"
                                class="btn btn-secondary">
                                Kembali
                            </a>

                            <a href="{{ route('my-participations.event-book.hasil.cetak-pdf', Crypt::encryptString($event->id)) }}"
                                class="btn btn-pdf-custom" target="_blank">
                                <i class="fas fa-print"></i> Cetak PDF
                            </a>
                        </div>
                    </div>

                    @forelse ($eventBookData as $raceName => $participants)
                        <div class="race-header">
                            {{ $raceName }}
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" style="width:100%; margin-bottom: 2rem;">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">POS</th>
                                        <th style="width: 5%;">DAY</th>
                                        <th style="width: 5%;">SERI</th>
                                        <th style="width: 8%;">MULAI</th>
                                        <th style="width: 5%;">LINT</th>
                                        <th style="width: 20%;">NAMA</th>
                                        <th style="width: 15%;">TIM</th>
                                        <th style="width: 15%;">HASIL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($participants as $participant)
                                        <tr class="{{ $loop->index < 3 ? 'podium-highlight' : '' }}">
                                            <td class="text-center font-weight-bold">{{ $loop->iteration }}</td>
                                            <td class="text-center">1</td>
                                            <td class="text-center">{{ $participant->seri }}</td>
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($participant->waktu_mulai)->format('H:i') }}
                                            </td>
                                            <td class="text-center">{{ $participant->lintasan }}</td>
                                            <td>{{ $participant->participant->name }}</td>
                                            <td>{{ $participant->participant->club }}</td>
                                            <td class="text-center font-weight-bold">{{ $participant->hasil }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @empty
                        <div class="alert alert-warning text-center">
                            Belum ada hasil yang bisa ditampilkan. Silakan lengkapi data di Buku Acara terlebih dahulu.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection