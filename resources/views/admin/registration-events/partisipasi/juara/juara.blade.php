@extends('admin.layouts.app')
@section('breadcumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('my-participations.index') }}">Partisipasi</a></li>
        <li class="breadcrumb-item"><a
                href="{{ route('my-participations.show', Crypt::encryptString($event->id)) }}">{{ $event->name }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Juara</li>
    </ol>
@endsection

@push('css')
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

        .table-bordered th {
            background-color: #cfe2ff;
            color: #000;
            text-align: center;
            vertical-align: middle;
            font-weight: 600;
        }

        .text-center {
            text-align: center;
        }

        .table-bordered td {
            vertical-align: middle;
        }

        .title-header {
            background-color: #ffc107 !important;
            color: #000000 !important;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .title-header h5,
        .title-header h6 {
            color: #000000 !important;
        }

        .title-header h5 {
            font-weight: 900;
            font-size: 1.1rem;
        }

        .medal-icon {
            width: 25px;
            height: auto;
            vertical-align: middle;
            margin-right: 5px;
        }

        .btn-pdf-custom {
            background-color: #e74c3c !important;
            color: #ffffff !important;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            box-shadow: none;
            border: none;
        }

        .btn-pdf-custom:hover {
            background-color: #c0392b !important;
            color: #ffffff !important;
        }

        .btn-pdf-custom i {
            margin-right: 8px;
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
                <li><a href="{{ route('my-participations.event-book.hasil', Crypt::encryptString($event->id)) }}">Buku
                        Hasil</a></li>
                <li class="active"><a href="#!">Juara</a></li>
            </ul>
        </div>


        <div class="col-12 layout-spacing">
            <div class="widget-content widget-content-area br-8">
                <div class="p-3">
                    <div class="d-flex justify-content-end mb-4">
                        <a href="{{ route('my-participations.juara.cetak-pdf', Crypt::encryptString($event->id)) }}"
                            class="btn btn-pdf-custom" target="_blank">
                            <i class="fas fa-print"></i> Cetak PDF
                        </a>
                    </div>
                    <div class="text-center title-header">
                        <h5 class="mb-0 font-weight-bold ">KLASEMEN JUARA UMUM</h5>
                        <h6 class="mb-0" style="text-transform: uppercase;">{{ $event->name }}</h6>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered" style="width:100%;">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="width: 5%;">NO</th>
                                    <th rowspan="2">TIM</th>
                                    <th colspan="3">PEROLEHAN PER ACARA</th>
                                </tr>
                                <tr>
                                    <th style="width: 15%;">
                                        <img src="https://em-content.zobj.net/source/apple/354/1st-place-medal_1f947.png"
                                            alt="Emas" class="medal-icon"> 1
                                    </th>
                                    <th style="width: 15%;">
                                        <img src="https://em-content.zobj.net/source/apple/354/2nd-place-medal_1f948.png"
                                            alt="Perak" class="medal-icon"> 2
                                    </th>
                                    <th style="width: 15%;">
                                        <img src="https://em-content.zobj.net/source/apple/354/3rd-place-medal_1f949.png"
                                            alt="Perunggu" class="medal-icon"> 3
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($standings as $index => $team)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $team['club_name'] }}</td>
                                        <td class="text-center">{{ $team['gold'] > 0 ? $team['gold'] : '' }}</td>
                                        <td class="text-center">{{ $team['silver'] > 0 ? $team['silver'] : '' }}</td>
                                        <td class="text-center">{{ $team['bronze'] > 0 ? $team['bronze'] : '' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada data juara yang bisa ditampilkan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection