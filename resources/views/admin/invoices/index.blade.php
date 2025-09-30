@extends('admin.layouts.app')

@section('breadcumbs')
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{ $page_title ?? 'Tagihan' }}</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <div class="widget-content widget-content-area br-8">
            <table id="invoice-table" class="table dt-table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Invoice</th>
                        <th>Nama Club</th>
                        <th>Subjek</th>
                        <th>Tgl. Pembayaran</th>
                        <th>Jatuh Tempo</th>
                        <th>Total</th>
                        <th>Sisa</th>
                        <th>Status</th>
                        <th class="no-content">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('#invoice-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('invoices.get-data') }}",
                columns: [
                    { "data": 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'invoice_number', name: 'invoice_number' },
                    { data: 'nama_club', name: 'club.name_club' },
                    { data: 'subjek', name: 'registrationEvent.event.name' },
                    { data: 'payment_date', name: 'payment_date' },
                    { data: 'due_date', name: 'due_date' },
                    { data: 'total_pembayaran', name: 'total_amount' },
                    { data: 'sisa_pembayaran', searchable: false, orderable: false },
                     { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
                "dom": "<'dt--top-section'<'row'<'col-12 d-flex justify-content-end'f>>>" + "<'table-responsive'tr>" + "<'dt-bottom-section d-sm-flex justify-content-sm-between text-center'li'p'>",
                "oLanguage": { "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' }, "sInfo": "Showing page _PAGE_ of _PAGES_", "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>', "sSearchPlaceholder": "Search...", "sLengthMenu": "Results :  _MENU_", },
            });
        });
    </script>
@endpush