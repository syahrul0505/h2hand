@extends('admin.layouts.app')
@push('style-link')
    <style>
        .btn-custom-gradient {
            background-image: linear-gradient(45deg, #ffb300, #ffca28);
            border: none;
            color: #212529;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 15px rgba(255, 179, 0, 0.4);
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
        }

        .btn-custom-gradient:hover {
            color: #000;
            box-shadow: 0 6px 20px rgba(255, 179, 0, 0.6);
            transform: translateY(-2px);
        }
    </style>
@endpush
@section('breadcumbs')
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('invoices.index') }}">Tagihan</a></li>
            <li class="breadcrumb-item"><a href="{{ route('invoices.show', $invoice->id) }}">Detail Tagihan</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $page_title }}</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @include('admin.components.alert')

        {{-- INFO TOTAL, DIBAYAR, DISKON, SISA --}}
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-primary-light">
                    <div class="card-body text-center">
                        <h6 class="text-white">Total Tagihan Klub</h6>
                        <p class="fs-4 text-white fw-bold mb-0">Rp. {{ number_format($invoice->total_amount, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-success-light">
                    <div class="card-body text-center">
                        <h6 class="text-white">Total Telah Dibayar</h6>
                        <p class="fs-4 text-white fw-bold mb-0">Rp. {{ number_format($invoice->paid_amount, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card" style="background-color: #00ab55;">
                    <div class="card-body text-center">
                        <h6 class="text-white">Total Diskon</h6>
                        <p class="fs-4 text-white fw-bold mb-0">Rp. {{ number_format($totalDiscounts, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-danger-light">
                    <div class="card-body text-center">
                        <h6 class="text-white">Sisa Tagihan Klub</h6>
                        <p class="fs-4 text-white fw-bold mb-0">Rp. {{ number_format($remainingClubInvoice, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>


        {{-- INFO TAGIHAN --}}
        <div class="widget-content widget-content-area br-8 mb-4 p-4">
            <h5 class="mb-4">Rincian Tagihan</h5>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                    <p class="mb-1" style="color: #888ea8; font-size: 14px;">Nomor</p>
                    <p class="fw-bold mb-0" style="font-size: 16px;">{{ $invoice->invoice_number }}</p>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                    <p class="mb-1" style="color: #888ea8; font-size: 14px;">Subjek</p>
                    <p class="fw-bold mb-0" style="font-size: 16px;">{{ $invoice->event->name ?? 'N/A' }}</p>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                    <p class="mb-1" style="color: #888ea8; font-size: 14px;">Tanggal</p>
                    <p class="fw-bold mb-0" style="font-size: 16px;">
                        {{ \Carbon\Carbon::parse($invoice->payment_date)->translatedFormat('d F Y') }}
                    </p>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                    <p class="mb-1" style="color: #888ea8; font-size: 14px;">Jatuh Tempo</p>
                    <p class="fw-bold mb-0" style="font-size: 16px;">
                        {{ \Carbon\Carbon::parse($invoice->due_date)->translatedFormat('d F Y') }}
                    </p>
                </div>
            </div>
            <hr>
            <div class="row mt-4">

                @if ($invoice->discount <= 0)
                    {{-- JIKA TIDAK ADA DISKON: Tampilkan satu total tagihan --}}
                    <div class="col-12 mb-3">
                        <p class="mb-1" style="color: #888ea8; font-size: 14px;">Total Tagihan</p>
                        <p class="fw-bold fs-4 mb-0">Rp. {{ number_format($invoice->total_amount, 0, ',', '.') }}</p>
                    </div>
                @else
                    {{-- JIKA ADA DISKON: Tampilkan Subtotal dan Total Setelah Diskon --}}
                    <div class="col-sm-6 col-12 mb-3">
                        <p class="mb-1" style="color: #888ea8; font-size: 14px;">Subtotal</p>
                        <p class="fw-bold fs-5 mb-0">Rp. {{ number_format($invoice->total_amount, 0, ',', '.') }}</p>
                    </div>
                @endif

            </div>
        </div>

        {{-- FORM TRANSAKSI --}}
        <div class="widget-content widget-content-area br-8 p-4">
            <h5 class="widget-header">Transaksi</h5>
            <div class="widget-body">
                <form action="{{ route('invoices.konfirmasi.store', $invoice->id) }}" method="POST"
                    enctype="multipart/form-data" data-remaining-club-invoice="{{ $remainingClubInvoice }}">
                    @csrf

                    {{-- PILIH ANGGOTA --}}
                    <div class="row mb-4">
                        <div class="col-12">
                            <label for="participant_select" class="form-label">Pilih Anggota</label>
                            <select id="participant_select" name="participant_id" class="form-select">
                                <option value="">-- Pembayaran untuk seluruh sisa tagihan klub --</option>
                                @foreach ($groupedDetails as $id => $details)
                                    @if ($details['remaining_price'] > 0)
                                        <option value="{{ $id }}" data-total="{{ $details['remaining_price'] }}">
                                            {{ $details['participant_name'] }} - (Sisa Tagihan: Rp
                                            {{ number_format($details['remaining_price'], 0, ',', '.') }})
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- OPSI DISKON --}}
                    <div id="discount_decision_section" class="row mb-4" style="display: none;">
                        <div class="col-12">
                            <label class="form-label">Beri Diskon?</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="discount_decision" id="discount_no"
                                        value="no">
                                    <label class="form-check-label" for="discount_no">Tidak</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="discount_decision" id="discount_yes"
                                        value="yes">
                                    <label class="form-check-label" for="discount_yes">Ya</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--FORM DISKON --}}
                    <div id="discount_form_section" class="row mb-4" style="display: none;">
                        <div class="col-md-6 mb-3">
                            <label for="select-type-discount">Tipe Diskon</label>
                            <select class="form-select" id="select-type-discount" name="discount_type">
                                <option selected disabled value="">Pilih Tipe Diskon</option>
                                <option value="price">Nominal (Rp)</option>
                                <option value="percent">Persentase (%)</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="input-value">Besar Diskon</label>
                            <div class="input-group">
                                <span class="input-group-text" id="prefix-icon">Rp.</span>
                                <input type="number" class="form-control" name="discount_value" id="input-value"
                                    placeholder="Pilih tipe diskon dahulu !" readonly>
                                <span class="input-group-text" id="suffix-icon" style="display: none;">%</span>
                            </div>
                        </div>
                    </div>

                    {{--  jika Tidak ada diskon) --}}
                    <div id="payment_type_section" class="row mb-4" style="display: none;">
                        <div class="col-12">
                            <label class="form-label">Jenis Pembayaran</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="payment_type" id="pay_lunas"
                                        value="lunas">
                                    <label class="form-check-label" for="pay_lunas">Lunas</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="payment_type" id="pay_cicil"
                                        value="cicil">
                                    <label class="form-check-label" for="pay_cicil">Cicil</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="transaction_form_section" style="display: none;">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="transaction_date" class="form-label">Tanggal Transaksi <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="transaction_date" name="transaction_date"
                                    value="{{ old('transaction_date', now()->format('Y-m-d')) }}" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="payment_method" class="form-label">Metode Pembayaran <span
                                        class="text-danger">*</span></label>
                                <select class="form-select" id="payment_method" name="payment_method" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Transfer Bank">Transfer Bank</option>
                                    <option value="Tunai">Tunai</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="payment_proof" class="form-label">Bukti Pembayaran <span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="payment_proof" name="payment_proof" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="amount" class="form-label">Jumlah Bayar <span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="amount" name="amount"
                                    value="{{ old('amount', 0) }}" placeholder="0" required>
                                <div id="remaining_balance_info" class="form-text" style="display: none;"></div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" id="submit-btn">Simpan</button>
                            <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-danger ms-2">Batalkan</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            function formatRupiah(angka) {
                var number_string = angka.toString().replace(/[^,\d]/g, ''),
                    sisa = number_string.length % 3,
                    rupiah = number_string.substr(0, sisa),
                    ribuan = number_string.substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    rupiah += (sisa ? '.' : '') + ribuan.join('.');
                }
                return 'Rp ' + rupiah;
            }

            const participantSelect = $('#participant_select');
            const discountDecisionSection = $('#discount_decision_section');
            const discountFormSection = $('#discount_form_section');
            const paymentTypeSection = $('#payment_type_section');
            const transactionFormSection = $('#transaction_form_section');
            const amountInput = $('#amount');
            const balanceInfo = $('#remaining_balance_info');
            const submitBtn = $('#submit-btn');
            const discountTypeSelect = $('#select-type-discount');
            const discountValueInput = $('#input-value');


            function resetAllSections() {
                discountDecisionSection.slideUp();
                discountFormSection.slideUp();
                paymentTypeSection.slideUp();
                transactionFormSection.slideUp();
                $('input[name="discount_decision"], input[name="payment_type"]').prop('checked', false);
                discountTypeSelect.val('');
                discountValueInput.val('').prop('readonly', true).attr('placeholder', 'Pilih tipe diskon dahulu !');
                amountInput.val(0).prop('readonly', false);
                balanceInfo.hide();
                submitBtn.prop('disabled', true);
            }

            participantSelect.on('change', function () {
                resetAllSections();
                if ($(this).val() !== "") {
                    discountDecisionSection.slideDown();
                } else {
                    const remainingClub = parseFloat($('form').data('remaining-club-invoice')) || 0;
                    amountInput.val(remainingClub);
                    transactionFormSection.slideDown();
                    validateAmount();
                }
            });

            $('input[name="discount_decision"]').on('change', function () {
                const decision = $(this).val();
                balanceInfo.hide();
                if (decision === 'yes') {
                    paymentTypeSection.slideUp();
                    discountFormSection.slideDown();
                    transactionFormSection.slideDown();
                    amountInput.val(0).prop('readonly', false);
                } else { // no
                    discountFormSection.slideUp();
                    paymentTypeSection.slideDown();
                    transactionFormSection.slideUp();
                }
            });

            discountTypeSelect.on('change', function () {
                const type = $(this).val();
                const prefix = $('#prefix-icon');
                const suffix = $('#suffix-icon');

                discountValueInput.val('').removeAttr('readonly').attr('placeholder', '0');
                if (type === 'percent') {
                    prefix.hide();
                    suffix.show();
                    discountValueInput.attr('max', '100');
                } else {
                    prefix.show();
                    suffix.hide();
                    discountValueInput.removeAttr('max');
                }
                calculateFinalAmount();
            });

            discountValueInput.on('keyup input', calculateFinalAmount);

            $('input[name="payment_type"]').on('change', function () {
                const paymentType = $(this).val();
                const selectedOption = participantSelect.find('option:selected');
                const totalBill = parseFloat(selectedOption.data('total'));

                transactionFormSection.slideDown();
                if (paymentType === 'lunas') {
                    amountInput.val(totalBill).prop('readonly', true);
                } else {
                    amountInput.val('').prop('readonly', false).attr('placeholder', 'Masukkan jumlah cicilan');
                }
                validateAmount();
            });

            function calculateFinalAmount() {
                const selectedOption = participantSelect.find('option:selected');
                const totalBill = parseFloat(selectedOption.data('total')) || 0;

                const discountType = discountTypeSelect.val();
                const discountValue = parseFloat(discountValueInput.val()) || 0;
                let discountAmount = 0;

                if (discountType === 'percent') {
                    discountAmount = (totalBill * discountValue) / 100;
                } else if (discountType === 'price') {
                    discountAmount = discountValue;
                }

                // Cek jika diskon melebihi total tagihan
                if (discountAmount > totalBill) {
                    balanceInfo.text('Diskon melebihi sisa tagihan!!!').show().css('color', '#e7515a'); 
                    submitBtn.prop('disabled', true);
                    amountInput.val(0); 
                    return; 
                }

                let finalAmount = totalBill - discountAmount;
                if (finalAmount < 0) finalAmount = 0;

                amountInput.val(finalAmount.toFixed(0)).prop('readonly', true);

                const sisaSetelahDiskon = totalBill - discountAmount;
                const displayText = 'Diskon ' + formatRupiah(discountAmount.toFixed(0)) + ' diterapkan. Sisa tagihan: ' + formatRupiah(sisaSetelahDiskon.toFixed(0));
                balanceInfo.text(displayText).show().css('color', '#00ab55');
                submitBtn.prop('disabled', finalAmount < 0 || discountValue <= 0);
            }

            function validateAmount() {
                if ($('input[name="discount_decision"]:checked').val() === 'yes') {
                    return;
                }

                const amountPaid = parseFloat(amountInput.val()) || 0;
                const selectedOption = participantSelect.find('option:selected');
                let maxAmount;

                if (selectedOption.val() !== "") {
                    maxAmount = parseFloat(selectedOption.data('total'));
                } else {
                    maxAmount = parseFloat($('form').data('remaining-club-invoice'));
                }

                if (amountPaid > maxAmount) {
                    balanceInfo.text('Pembayaran melebihi sisa tagihan (' + formatRupiah(maxAmount.toFixed(0)) + ')!').show().css('color', '#e7515a');
                    submitBtn.prop('disabled', true);
                } else {
                    const remainingBalance = maxAmount - amountPaid;
                    balanceInfo.text('Sisa tagihan setelah pembayaran ini: ' + formatRupiah(remainingBalance.toFixed(0))).show().css('color', '');
                    submitBtn.prop('disabled', amountPaid <= 0);
                }
            }
            amountInput.on('keyup input', validateAmount);

        });
    </script>
@endpush