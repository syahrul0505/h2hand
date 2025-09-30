@extends('admin.layouts.app')

@push('style-link')
    // css buat table
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/table/datatable/dt-global_style.css') }}">

    //css
    <link href="{{ asset('src/assets/css/light/components/tabs.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/assets/css/dark/components/tabs.css') }}" rel="stylesheet" type="text/css">

    <style>
        .membership-detail-list {
            list-style: none;
            padding: 0;
        }

        .membership-detail-list li {
            padding: 8px 0;
            display: flex;
            font-size: 15px;
        }

        .membership-detail-list .detail-label {
            font-weight: 600;
            width: 200px;
            color: #888ea8;
        }

        .membership-detail-list .detail-value {
            font-weight: 600;
            color: #e0e6ed;
        }
    </style>
@endpush

@section('breadcumbs')
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $page_title }}</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <div class="widget-content widget-content-area br-8">

            <div class="simple-tab">
                <ul class="nav nav-tabs" id="myClubTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="detail-tab-button" data-bs-toggle="tab"
                            data-bs-target="#detail-tab-pane" type="button" role="tab" aria-controls="detail-tab-pane"
                            aria-selected="true">Club</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="anggota-tab-button" data-bs-toggle="tab"
                            data-bs-target="#anggota-tab-pane" type="button" role="tab" aria-controls="anggota-tab-pane"
                            aria-selected="false">Anggota</button>
                    </li>
                </ul>

                <div class="tab-content" id="myClubTabContent">
                    <div class="tab-pane fade show active" id="detail-tab-pane" role="tabpanel"
                        aria-labelledby="detail-tab-button" tabindex="0">
                        <div class="p-3">
                            <h5 class="mb-4">Club Anda : {{ Auth::user()->club->name_club }}</h5>
                            <ul class="membership-detail-list">
                                <li>
                                    <div class="detail-label">Nama Lengkap</div>
                                    <div class="detail-value">: {{ Auth::user()->fullname }}</div>
                                </li>
                                <li>
                                    <div class="detail-label">Alamat</div>
                                    <div class="detail-value">: {{ Auth::user()->address ?? '-' }}</div>
                                </li>
                                <li>
                                    <div class="detail-label">Nama Klub</div>
                                    <div class="detail-value">: {{ Auth::user()->club->name_club }}</div>
                                </li>
                                <li>
                                    <div class="detail-label">Kelas yang Diikuti</div>
                                    <div class="detail-value">: {{ Auth::user()->sportClass->name ?? 'Belum ada kelas' }}
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="anggota-tab-pane" role="tabpanel" aria-labelledby="anggota-tab-button"
                        tabindex="0">
                        <div class="table-responsive">
                            <table id="member-list-table" class="table dt-table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="7%">No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Alamat</th>
                                        <th>Kelas yang Diikuti</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($club->users as $member)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $member->fullname }}</td>
                                            <td>{{ $member->address ?? '-' }}</td>
                                            <td>{{ $member->sportClass->name ?? 'Belum ada kelas' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('src/plugins/src/table/datatable/datatables.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#member-list-table').DataTable({
                "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" +
                    "<'table-responsive'tr>" +
                    "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count mb-sm-0 mb-3'i><'dt--pagination'p>>",
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Cari...",
                    "sLengthMenu": "Hasil :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [10, 20, 50],
                "pageLength": 10
            });
        });
    </script>
@endpush