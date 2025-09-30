@extends('admin.layouts.app')

@push('style-link')
    <style>
        .invoice-container {
            color: #d3d3d3;
            border: 1px solid #1b2e4b;
        }

        .invoice-header,
        .invoice-payment-info {
            background-color: #191e3a;
        }

        .invoice-body {
            background-color: #191e3a;
        }

        .invoice-table-header {
            background-color: #1b2e4b;
            color: #e0e6ed;
            font-weight: bold;
        }

        .invoice-table-body {
            background-color: #191e3a;
        }

        .invoice-header h5 {
            color: #e0e6ed;
        }

        .invoice-header p {
            color: #d3d3d3;
        }

        .invoice-header .status {
            font-weight: bold;
        }

        .table-dark-custom {
            background-color: transparent;
            color: #d3d3d3;
        }

        .table-dark-custom th,
        .table-dark-custom td {
            border-top: 1px solid #506690;
            padding: 0.9rem;
        }

        .table-dark-custom th:not(:last-child),
        .table-dark-custom td:not(:last-child) {
            border-right: 1px solid #506690;
        }

        .participant-group {
            border: 1px solid #506690;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .participant-name-header {
            background-color: #0e1726;
        }

        .participant-name-header td {
            font-weight: bold;
            font-size: 1rem;
            color: #e0e6ed;
        }

        hr {
            border-top: 1px solid #1b2e4b;
        }

        .btn svg {
            width: 20px;
            height: 20px;
            vertical-align: text-bottom;
            margin-right: 4px;
        }

        .status-paid {
            color: #00ab55;
        }

        .status-unpaid {
            color: #e2a03f;
        }

        .status-overdue {
            color: #e7515a;
        }
    </style>
@endpush

@section('breadcumbs')
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('invoices.index') }}">Tagihan</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $page_title ?? 'Detail Tagihan' }}</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        @include('admin.components.alert')
        <div class="widget-content widget-content-area br-8 invoice-container">

            {{-- HEADER INVOICE --}}
            <div class="invoice-header p-4">
                <div class="row">
                    <div class="col-12 text-start">
                        <h5 class="mb-1">INVOICE #{{ $invoice->invoice_number }}</h5>
                        <p class="mb-1"><span class="fw-bold">Subjek:</span> {{ $invoice->event->name ?? 'N/A' }}</p>
                        <p class="mb-1"><span class="fw-bold">Tanggal:</span>
                            {{ \Carbon\Carbon::parse($invoice->payment_date)->translatedFormat('d F Y') }}</p>
                        <p class="mb-1"><span class="fw-bold">Jatuh Tempo:</span>
                            {{ \Carbon\Carbon::parse($invoice->due_date)->translatedFormat('d F Y') }}</p>
                        <p class="mb-0"><span class="fw-bold">Status:</span>
                            <span class="status status-{{ $invoice->status }}">{{ strtoupper($invoice->status) }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="invoice-body p-4">
                <hr class="mt-0 mb-4">
                {{-- DITAGIHKAN KEPADA --}}
                <div class="mb-4">
                    <p class="text-white-50 mb-1">Ditujukan Kepada</p>
                    <p class="fw-bold mb-0 fs-5">{{ $invoice->club->name_club ?? 'N/A' }}</p>
                </div>
                <hr class="mb-4">

                <h6 class="mb-3">Rincian Biaya</h6>
                <div class="participant-group">
                    <table class="table table-dark-custom mb-0">
                        <thead class="invoice-table-header">
                            <tr>
                                <th>Deskripsi</th>
                                <th class="text-end" style="width: 25%;">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($groupedDetails as $participant)
                                <tr class="participant-name-header">
                                    <td class="fw-bold" style="border-right: 1px solid #506690;">
                                        {{ $participant['participant_name'] }}
                                        @php
                                            $paidAmount = $participant['paid_amount'] ?? 0;
                                            $totalPrice = $participant['total_price'] ?? 0;
                                            $isPaid = $participant['is_paid'] ?? false;

                                            // DEBUG
                                            error_log(sprintf(
                                                "Payment Debug - Name: %s, User ID: %s, Paid: %s, Total: %s, Is Paid: %s",
                                                $participant['participant_name'],
                                                $participant['user_id'] ?? 'none',
                                                number_format($paidAmount, 0, ',', '.'),
                                                number_format($totalPrice, 0, ',', '.'),
                                                $isPaid ? 'Yes' : 'No'
                                            ));
                                        @endphp
                                        @if ($isPaid)
                                            <span class="badge badge-light-success ms-2">LUNAS</span>
                                        @endif
                                        {{-- Debug INPO --}}
                                        @if(config('app.debug'))
                                            <small class="text-muted">
                                                (Dibayar: {{ number_format($paidAmount, 0, ',', '.') }},
                                                Total: {{ number_format($totalPrice, 0, ',', '.') }},
                                                Status: {{ $isPaid ? 'LUNAS' : 'BELUM' }})
                                            </small>
                                        @endif
                                    </td>
                                    <td class="text-end"></td>
                                </tr>
                                @foreach($participant['races'] as $race)
                                    <tr>
                                        <td class="text-white-50">- {{ $race['name'] }}</td>
                                        <td class="text-end text-white-50">Rp. {{ number_format($race['price'], 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                                @if (($participant['discount_amount'] ?? 0) > 0)
                                    <tr>
                                        <td class="fw-bold text-success">Diskon</td>
                                        <td class="text-end fw-bold text-success">- Rp. {{ number_format($participant['discount_amount'], 0, ',', '.') }}</td>
                                    </tr>
                                @endif
                                <tr class="invoice-table-header">
                                    <td class="fw-bold">Subtotal Peserta</td>
                                    <td class="text-end fw-bold">Rp.
                                        {{ number_format($participant['total_price'], 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">Tidak ada detail partisipasi.</td>
                                </tr>
                            @endforelse
                            </tb0ody>
                        <tfoot>
                            <tr>
                                <td class="fw-bold fs-5">SUBTOTAL</td>
                                <td class="text-end fw-bold fs-5">Rp.
                                    {{ number_format($invoice->total_amount, 0, ',', '.') }}
                                </td>
                            </tr>
                            <tr class="invoice-table-header">
                                <td class="fw-bold fs-5">GRAND TOTAL</td>
                                <td class="text-end fw-bold fs-5">Rp.
                                    {{ number_format($invoice->total_amount - $invoice->discount, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                {{-- TABEL TRANSAKSI --}}
                <div class="mt-5">
                    <h6 class="mb-3">Transaksi</h6>
                    <div class="participant-group">
                        <div class="table-responsive">
                            <table class="table table-dark-custom mb-0">
                                <thead class="invoice-table-header">
                                    <tr>
                                        <th>Tanggal Transaksi</th>
                                        <th>Nama Anggota</th>
                                        <th>Metode Pembayaran</th>
                                        <th class="text-end">Jumlah</th>
                                        <th class="text-center">Bukti</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($invoice->transactions as $transaction)
                                        <tr>
                                            <td>
                                                {{ \Carbon\Carbon::parse($transaction->transaction_date)->translatedFormat('d F Y') }}
                                            </td>
                                            <td>
                                                @if ($transaction->participant)
                                                    {{ $transaction->participant->fullname }}
                                                @else
                                                    Pembayaran Umum Klub
                                                @endif
                                            </td>
                                            <td>{{ $transaction->payment_method }}</td>
                                            <td class="text-end">Rp. {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                            <td class="text-center">
                                                @if ($transaction->payment_proof)
                                                    <a href="{{ Storage::url($transaction->payment_proof) }}" target="_blank"
                                                        class="btn btn-sm btn-outline-info">
                                                        Lihat
                                                    </a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Belum Ada Transaksi</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FOOTER & INFO PEMBAYARAN --}}
            <div class="invoice-payment-info p-4">
                <div class="row align-items-center">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <h6 class="mb-3">Informasi Pembayaran</h6>
                        <p class="mb-1">BANK BCA - 628375486</p>
                        <p class="mb-0">AN. ADE HERMAWAN</p>
                    </div>
                    <div class="col-md-8 text-md-end">
                        <div class="d-flex flex-wrap justify-content-md-end">
                            <a href="{{ route('invoices.index') }}" class="btn btn-primary m-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-arrow-left">
                                    <line x1="19" y1="12" x2="5" y2="12"></line>
                                    <polyline points="12 19 5 12 12 5"></polyline>
                                </svg>
                                Semua Tagihan
                            </a>
                            <a href="{{ route('invoices.konfirmasi', $invoice->id) }}" class="btn btn-success m-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-check-circle">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg>
                                Konfirmasi Pembayaran
                            </a>
                            <a href="{{ route('invoices.cetak-pdf', $invoice->id) }}" class="btn btn-danger m-1"
                                target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-printer">
                                    <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                    <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2">
                                    </path>
                                    <rect x="6" y="14" width="12" height="8"></rect>
                                </svg>
                                Cetak PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection