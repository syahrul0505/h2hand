@extends('admin.layouts.app')

@push('style-link')
    <style>
        .widget-content-area {
            padding: 20px;
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
            color: #4361ee;
            font-weight: 600;
        }

        .detail-value svg {
            width: 16px;
            height: 16px;
            margin-right: 8px;
            color: #888ea8;
        }

        .detail-item {
            margin-bottom: 1.5rem;
        }

        .header-tabs {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .header-tabs li {
            display: inline-block;
            margin-left: 20px;
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

        .dataTables_filter input {
            background-color: #0e1726 !important;
            border: 1px solid #1b2e4b;
            color: #e0e6ed;
            padding: 6px 12px;
        }

        .dataTables_filter label {
            color: #e0e6ed;
        }

        .btn-back svg {
            width: 20px;
            height: 20px;
            margin-right: 5px;
        }
    </style>
@endpush

@section('breadcumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#!">Perlombaan</a></li>
        <li class="breadcrumb-item"><a href="{{ route('my-participations.index') }}">Partisipasi</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail</li>
    </ol>
@endsection

@section('content')
    <div class="layout-px-spacing">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Perlombaan</h3>
            <ul class="header-tabs">
                <li class="active"><a href="#!">Detail</a></li>
                <li><a href="{{ route('my-participations.schedule', Crypt::encryptString($event->id)) }}">Susunan Acara
                        Lomba</a></li>
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

        <div class="col-12 layout-spacing">
            <div class="widget-content widget-content-area br-8">
                <div class="p-4">
                    <h5 class="mb-4">Partisipasi</h5>
                    <div class="table-responsive">
                        <table id="participation-detail-table" class="table dt-table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Peserta</th>
                                    <th>Event</th>
                                    <th>Klub</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('#participation-detail-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('my-participations.get-detail-data', $event) }}",
                columns: [
                    { "data": 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'event_name', name: 'registrationEvent.event.name' },
                    { data: 'club_name', name: 'club' },
                ],
                "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" + "<'table-responsive'tr>" + "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                "oLanguage": { "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' }, "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data", "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>', "sSearchPlaceholder": "Cari...", "sLengthMenu": "Tampilkan :  _MENU_  data", },
                "pageLength": 10
            });
        });
    </script>
@endpush