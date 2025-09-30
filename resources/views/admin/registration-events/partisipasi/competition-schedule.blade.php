@extends('admin.layouts.app')

@section('breadcumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('my-participations.index') }}">Partisipasi</a></li>
        <li class="breadcrumb-item"><a href="{{ route('my-participations.show', $event->id) }}">{{ $event->name }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Susunan Acara Lomba</li>
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

        .detail-item {
            margin-bottom: 1.5rem;
        }

        .detail-label {
            color: #888ea8;
            font-size: 13px;
            margin-bottom: 4px;
            font-weight: 600;
        }

        .detail-value {
            font-weight: 500;
            font-size: 15px;
        }

        .detail-value a {
            color: #4361ee !important;
            font-weight: 600;
        }

        .detail-value svg {
            width: 16px;
            height: 16px;
            margin-right: 8px;
            color: #888ea8;
        }

        .btn-back svg {
            width: 20px;
            height: 20px;
            margin-right: 5px;
        }
    </style>
@endpush

@section('content')
    <div class="layout-px-spacing">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Perlombaan</h3>
            <ul class="header-tabs">
                <li><a href="{{ route('my-participations.show', Crypt::encryptString($event->id)) }}">Detail</a></li>
                <li class="active"><a href="{{ route('my-participations.schedule', $event->id) }}">Susunan Acara Lomba</a>
                </li>
                <li><a href="{{ route('my-participations.event-book', Crypt::encryptString($event->id)) }}">Buku Acara</a>
                </li>
                <li><a href="{{ route('my-participations.event-book.hasil', Crypt::encryptString($event->id)) }}">Buku
                        Hasil</a></li>
                <li><a href="{{ route('my-participations.juara', Crypt::encryptString($event->id)) }}">Juara</a></li>
            </ul>
        </div>

        <div class="col-12 layout-spacing">
            <div class="widget-content widget-content-area br-8">
                <div class="p-3">
                    <h5 class="mb-4">Detail</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="detail-item">
                                <div class="detail-label">Nama</div>
                                <div class="detail-value d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-award">
                                        <circle cx="12" cy="8" r="7"></circle>
                                        <polyline points="8.21 13.89 7 23 12 17 17 23 15.79 13.88"></polyline>
                                    </svg>
                                    <span>{{ $event->name }}</span>
                                </div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Technical Meeting</div>
                                <div class="detail-value d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-calendar">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    <span>{{ $event->date_technical->format('d F Y') }}</span>
                                </div>
                            </div>
                            <a href="{{ route('my-participations.index') }}"
                                class="btn btn-primary btn-back mt-3 d-inline-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-arrow-left">
                                    <line x1="19" y1="12" x2="5" y2="12"></line>
                                    <polyline points="12 19 5 12 12 5"></polyline>
                                </svg>
                                <span>Semua Partisipasi</span>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-item">
                                <div class="detail-label">Perlombaan</div>
                                <div class="detail-value d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-calendar">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    <span>{{ $event->date_technical->format('d F Y') }}</span>
                                </div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Pendaftaran</div>
                                <div class="detail-value d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-edit-3">
                                        <path d="M12 20h9"></path>
                                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                    </svg>
                                    <span>{{ $event->start_registration_date->format('d M Y') }} -
                                        {{ $event->end_registration_date->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-item">
                                <div class="detail-label">Lokasi</div>
                                <div class="detail-value">
                                    <a href="{{ $event->location_link ?: '#!' }}" target="_blank"
                                        class="d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-map-pin">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        <span>{{ $event->location }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel susunan acara --}}
        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
            <div class="d-flex justify-content-end mb-3">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#generateBookModal">
                    <i class="fas fa-magic me-2"></i>Buat Buku Acara
                </button>
            </div>
            <div class="widget-content widget-content-area br-8">
                <div class="p-3">
                    <h5 class="mb-4">Susunan Acara Lomba</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th style="width: 5%;">No.</th>
                                    <th>Nomor Acara Lomba</th>
                                    <th style="width: 15%;">Kelas</th>
                                    <th style="width: 10%;">Putri</th>
                                    <th style="width: 10%;">Putra</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $iteration = 1; @endphp
                                @forelse ($scheduleItems as $item)
                                    @if ($item['putra_count'] > 0 || $item['putri_count'] > 0)
                                        <tr>
                                            <td class="text-center">{{ $iteration++ }}</td>
                                            <td>{{ $item['race_name'] }}</td>
                                            <td class="text-center">{{ $item['class'] }}</td>
                                            <td class="text-center font-weight-bold text-danger">{{ $item['putri_count'] }}</td>
                                            <td class="text-center font-weight-bold text-primary">{{ $item['putra_count'] }}</td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada peserta yang terdaftar untuk membuat
                                            susunan acara.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal buku acara --}}
    <div class="modal fade" id="generateBookModal" tabindex="-1" aria-labelledby="generateBookModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="generateBookModalLabel">Buat Buku Acara</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="generateBookForm"
                        action="{{ route('my-participations.event-book', Crypt::encryptString($event->id)) }}"
                        method="POST">
                        @csrf
                        <input type="hidden" name="master_override" value="1">

                        <div class="mb-3">
                            <label for="groupCount" class="form-label">Maksimal Peserta per Kelompok/Seri</label>
                            <input type="number" class="form-control" id="groupCount" name="group_count"
                                placeholder="Contoh: 8" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="startTime" class="form-label">Waktu Mulai Lomba</label>
                            <input type="time" class="form-control" id="startTime" name="start_time" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" form="generateBookForm" class="btn btn-primary">Buat</button>
                </div>
            </div>
        </div>
    </div>
@endsection