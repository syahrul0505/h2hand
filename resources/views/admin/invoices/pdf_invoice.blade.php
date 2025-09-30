<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-f8" />
    <title>Invoice #{{ $invoice->invoice_number }}</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            background-color: #ffffff;
            color: #212529;
            font-size: 10px;
            margin: 0;
            padding: 0;
        }

        .invoice-container {
            width: 95%;
            margin: 1rem auto;
        }

        .invoice-header {
            background-color: #1b2e4b;
            padding: 1.25rem;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .invoice-body,
        .invoice-payment-info {
            padding: 1rem;
        }

        .participant-group {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            overflow: hidden;
            margin-bottom: 1rem;
        }

        .invoice-header h5 {
            color: #e0e6ed;
            margin: 0 0 0.2rem 0;
            font-size: 1.1rem;
        }

        .invoice-header p {
            color: #d3d3d3;
            margin: 0 0 0.2rem 0;
        }

        .invoice-payment-info p,
        .invoice-payment-info h6 {
            color: #212529;
            margin: 0 0 0.2rem 0;
        }

        .invoice-header .status-paid {
            color: #00ab55;
            font-weight: bold;
        }

        .invoice-header .status-unpaid {
            color: #e2a03f;
            font-weight: bold;
        }

        .invoice-header .status-overdue {
            color: #e7515a;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: transparent;
        }

        table th,
        table td {
            border-top: 1px solid #dee2e6;
            padding: 0.5rem;
            text-align: left;
        }

        table th:not(:last-child),
        table td:not(:last-child) {
            border-right: 1px solid #dee2e6;
        }

        .invoice-table-header {
            background-color: #1b2e4b;
            font-weight: bold;
        }

        .invoice-table-header th,
        .invoice-table-header td {
            color: white !important;
        }

        .participant-name-header {
            background-color: #f8f9fa;
        }

        .participant-name-header td {
            font-weight: bold;
            font-size: 0.9rem;
            color: #212529;
        }

        hr {
            border-top: 1px solid #dee2e6;
            margin-top: 0;
            margin-bottom: 1rem;
        }

        .spacer-row td {
            height: 0.75rem;
            background-color: #ffffff;
            border: none;
        }

        .participant-group td,
        .participant-group th {
            color: #212529;
        }

        .text-muted {
            color: #6c757d !important;
        }

        .text-end {
            text-align: right;
        }

        .fw-bold {
            font-weight: bold;
        }

        .fs-5 {
            font-size: 1.1rem;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .mb-1 {
            margin-bottom: 0.25rem;
        }

        .mb-3 {
            margin-bottom: 0.75rem;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }

        .mt-5 {
            margin-top: 1.5rem;
        }

        h6 {
            font-size: 0.9rem;
            margin-top: 0;
            margin-bottom: 0.75rem;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        {{-- HEADER INVOICE --}}
        <div class="invoice-header">
            <h5 class="mb-1">INVOICE #{{ $invoice->invoice_number }}</h5>
            <p class="mb-1"><span class="fw-bold">Subjek:</span> {{ $invoice->event->name ?? 'N/A' }}</p>
            <p class="mb-1"><span class="fw-bold">Tanggal:</span>
                {{ \Carbon\Carbon::parse($invoice->payment_date)->translatedFormat('d F Y') }}</p>
            <p class="mb-1"><span class="fw-bold">Jatuh Tempo:</span>
                {{ \Carbon\Carbon::parse($invoice->due_date)->translatedFormat('d F Y') }}</p>
            <p class="mb-0"><span class="fw-bold">Status:</span> <span
                    class="status status-{{ $invoice->status }}">{{ strtoupper($invoice->status) }}</span></p>
        </div>

        <div class="invoice-body">
            <hr>
            <div class="mb-4">
                <p class="mb-1" style="color: #6c757d;">Ditujukan Kepada</p>
                <p class="fw-bold mb-0 fs-5" style="font-size: 1rem;">{{ $invoice->club->name_club ?? 'N/A' }}</p>
            </div>
            <hr>

            <h6 class="mb-3">Rincian Biaya</h6>
            <div class="participant-group">
                <table>
                    <thead class="invoice-table-header">
                        <tr>
                            <th>Deskripsi</th>
                            <th class="text-end" style="width: 25%;">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($groupedDetails as $participant)
                            <tr class="participant-name-header">
                                <td class="fw-bold" style="border-right: 1px solid #dee2e6;">
                                    {{ $participant['participant_name'] }}
                                    @php
                                        $paidAmount = $participant['paid_amount'] ?? 0;
                                        $totalPrice = $participant['total_price'] ?? 0;
                                        $isPaid = $participant['is_paid'] ?? false;
                                    @endphp
                                    @if ($isPaid)
                                        <span style="color: #00ab55; font-weight: bold;">(LUNAS)</span>
                                    @endif
                                </td>
                                <td class="text-end"></td>
                            </tr>
                            @foreach($participant['races'] as $race)
                                <tr>
                                    <td class="text-muted">- {{ $race['name'] }}</td>
                                    <td class="text-end text-muted">Rp. {{ number_format($race['price'], 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                            @if (($participant['discount_amount'] ?? 0) > 0)
                                <tr>
                                    <td class="fw-bold" style="color: #00ab55;">Diskon</td>
                                    <td class="text-end fw-bold" style="color: #00ab55;">- Rp.
                                        {{ number_format($participant['discount_amount'], 0, ',', '.') }}</td>
                                </tr>
                            @endif
                            <tr class="invoice-table-header">
                                <td class="fw-bold">Subtotal Peserta</td>
                                <td class="text-end fw-bold">Rp.
                                    {{ number_format($participant['total_price'], 0, ',', '.') }}
                                </td>
                            </tr>

                            @if (!$loop->last)
                                <tr class="spacer-row">
                                    <td colspan="2"></td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="2" style="text-align: center;">Tidak ada detail partisipasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="fw-bold fs-5">SUBTOTAL</td>
                            <td class="text-end fw-bold fs-5">Rp.
                                {{ number_format($invoice->total_amount, 0, ',', '.') }}
                            </td>
                        </tr>
                        @if ($invoice->discount > 0)
                            <tr>
                                <td class="fw-bold fs-5" style="color: #00ab55;">DISKON</td>
                                <td class="text-end fw-bold fs-5" style="color: #00ab55;">- Rp.
                                    {{ number_format($invoice->discount, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endif
                        <tr class="invoice-table-header">
                            <td class="fw-bold fs-5">GRAND TOTAL</td>
                            <td class="text-end fw-bold fs-5">Rp.
                                {{ number_format($invoice->total_amount - $invoice->discount, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="mt-5">
                <h6 class="mb-3">Transaksi</h6>
                <div class="participant-group">
                    <table>
                        <thead class="invoice-table-header">
                            <tr>
                                <th>Tanggal Transaksi</th>
                                <th>Nama Anggota</th>
                                <th>Metode Pembayaran</th>
                                <th class="text-end">Jumlah</th>
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
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align: center;">Belum Ada Transaksi</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="invoice-payment-info">
            <hr>
            <h6 class="mb-3">Informasi Pembayaran</h6>
            <p class="mb-1">BANK BCA - 628375486</p>
            <p class="mb-0">AN. ADE HERMAWAN</p>
        </div>
    </div>
</body>

</html>