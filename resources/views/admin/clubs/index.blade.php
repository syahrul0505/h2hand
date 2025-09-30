@extends('admin.layouts.app')

@push('style-link')
    <link href="{{ asset('src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/assets/css/light/components/tabs.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('src/assets/css/dark/components/modal.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/assets/css/dark/components/tabs.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('breadcumbs')
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{ $page_title }}</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        @include('admin.components.alert')
        <div class="widget-content widget-content-area br-8">
            <table id="club-table" class="table dt-table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th width="7%">No</th>
                        <th>Nama Klub</th>
                        <th class="no-content" width="10%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="modalContainer"></div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('#club-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('clubs.get-data') }}",
                    error: function (xhr, textStatus, errorThrown) {
                        $('#club-table').DataTable().clear().draw();
                        console.log(xhr.responseText);
                        alert('Terjadi kesalahan saat mengambil data. Silakan coba lagi nanti.');
                    }
                },
                columns: [
                    {
                        "data": 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    { data: 'name_club', name: 'name_club' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],

                "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f<'toolbar align-self-center'>>>>" +
                    "<'table-responsive'tr>" +
                    "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                    "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [10, 20, 50],
                "pageLength": 10
            });

            $("div.toolbar").html('<button class="ms-2 btn btn-primary club-add" type="button" data-bs-target="#tabs-add-club">' +
                '<span>Create Club</span>' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>' +
                '</button>');

            $(document).on('click', '.club-add', function () {
                var getTarget = $(this).data('bs-target');
                $.get("{{ route('clubs.modal-add') }}", function (data) {
                    $('#modalContainer').html(data);
                    $(`${getTarget}`).modal('show');
                });
            });

            $(document).on('click', '.club-edit-table', function () {
                var clubId = $(this).data('bs-target');
                var parts = clubId.split("-");
                var id = parseInt(parts[1]);
                $.get("{{ url('clubs/modal-edit') }}/" + id, function (data) {
                    $('#modalContainer').html(data);
                    $(`${clubId}`).modal('show');
                });
            });

            $(document).on('click', '.club-delete-table', function () {
                var clubId = $(this).data('bs-target');
                var parts = clubId.split("-");
                var id = parseInt(parts[1]);
                $.get("{{ url('clubs/modal-delete') }}/" + id, function (data) {
                    $('#modalContainer').html(data);
                    $(`${clubId}`).modal('show');
                });
            });
        });
    </script>
@endpush