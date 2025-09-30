@extends('admin.layouts.app')
@section('breadcumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('my-participations.index') }}">Partisipasi</a></li>
        <li class="breadcrumb-item"><a
                href="{{ route('my-participations.show', Crypt::encryptString($event->id)) }}">{{ $event->name }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Buku Acara</li>
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

        .race-header {
            background-color: #ffc107;
            color: #000;
            font-weight: bold;
            text-align: center;
            padding: 8px;
            margin-top: 2rem;
            border: 1px solid #dee2e6;
            border-bottom: none;
        }

        .table-bordered th {
            background-color: #cfe2ff;
            color: #000;
            text-align: center;
            vertical-align: middle;
            font-weight: 600;
        }

        .table-bordered td {
            vertical-align: middle;
        }

        .seri-separator td {
            border-top: 2px solid #a9a9a9 !important;
        }

        .radio-group label {
            margin-right: 10px;
            font-weight: 500;
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
                <li class="active"><a href="#!">Buku Acara</a></li>
                <li><a href="{{ route('my-participations.event-book.hasil', Crypt::encryptString($event->id)) }}">Buku
                        Hasil</a></li>
                <li><a href="{{ route('my-participations.juara', Crypt::encryptString($event->id)) }}">Juara</a></li>
            </ul>
        </div>

        <div class="col-12 layout-spacing">
            <div class="widget-content widget-content-area br-8">
                <div class="p-3">
                    @if (session('success'))
                        <div id="auto-close-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Berhasil!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('my-participations.event-book.update', Crypt::encryptString($event->id)) }}"
                        method="POST">
                        @csrf
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="mb-0">Buku Acara - {{ $event->name }}</h5>
                            <div>
                                <a href="{{ route('my-participations.schedule', Crypt::encryptString($event->id)) }}"
                                    class="btn btn-secondary">
                                    Kembali
                                </a>
                                <a href="{{ route('my-participations.event-book.cetak-pdf', Crypt::encryptString($event->id)) }}"
                                    class="btn btn-pdf-custom" target="_blank">
                                    <i class="fas fa-print"></i> Cetak PDF
                                </a>
                                <button type="submit" class="btn btn-primary">Simpan Hasil</button>
                            </div>
                        </div>

                        @forelse ($eventBookData as $raceName => $participants)
                            <div class="race-header d-flex justify-content-center align-items-center position-relative">
                                <span class="fw-bold">{{ $raceName }}</span>
                                @if($participants->isNotEmpty())
                                    <div class="position-absolute" style="right: 15px;">
                                        <button type="button" class="btn btn-dark btn-sm" onclick="openMaxParticipantsModal(
                                                    '{{ route('race-event-numbers.update-max', $participants->first()->raceEventNumber->id) }}', 
                                                    '{{ $participants->first()->raceEventNumber->max_participants }}',
                                                    '{{ Crypt::encryptString($event->id) }}', 
                                                    '{{ \Carbon\Carbon::parse($participants->first()->waktu_mulai)->format('H:i') }}'
                                                )">
                                            <i class="fas fa-cog me-1"></i> Atur Maksimal/Seri
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" style="width:100%; margin-bottom: 2rem;">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">NO.</th>
                                            <th style="width: 5%;">DAY</th>
                                            <th style="width: 5%;">SERI</th>
                                            <th style="width: 8%;">MULAI</th>
                                            <th style="width: 5%;">NAMA</th>
                                            <th style="width: 5%;">TIM</th>
                                            <th style="width: 5%;">LINT</th>
                                            <th style="width: 15%;">HASIL</th>
                                            <th style="width: 15%;">CHECK</th>
                                            <th style="width: 5%;">POS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $lastSeri = null; @endphp
                                        @foreach ($participants as $pIndex => $participant)
                                            <tr data-seri="{{ $participant->seri }}" @if($lastSeri !== null && $lastSeri != $participant->seri) class="seri-separator" @endif>
                                                <td class="text-center">{{ $pIndex + 1 }}</td>
                                                <td class="text-center">1</td>
                                                <td class="text-center">{{ $participant->seri }}</td>
                                                <td class="text-center">
                                                    {{ \Carbon\Carbon::parse($participant->waktu_mulai)->format('H:i') }}
                                                </td>
                                                <td>{{ $participant->participant->name }}</td>
                                                <td>{{ $participant->participant->club }}</td>

                                                <td>
                                                    <input type="number" name="results[{{ $participant->id }}][lintasan]"
                                                        class="form-control form-control-sm text-center"
                                                        value="{{ $participant->lintasan }}" autocomplete="off">
                                                </td>
                                                <td>
                                                    <input type="text" name="results[{{ $participant->id }}][hasil]"
                                                        class="form-control form-control-sm hasil-input"
                                                        value="{{ $participant->hasil }}" placeholder="Contoh: 010934"
                                                        autocomplete="off">
                                                </td>

                                                <td class="checkbox-group text-center">
                                                    <label class="me-2">
                                                        <input type="checkbox" class="status-checkbox" data-status="NS"
                                                            data-id="{{ $participant->id }}" @if($participant->status == 'NS') checked
                                                            @endif> NS
                                                    </label>
                                                    <label>
                                                        <input type="checkbox" class="status-checkbox" data-status="DQ"
                                                            data-id="{{ $participant->id }}" @if($participant->status == 'DQ') checked
                                                            @endif> DQ
                                                    </label>

                                                    <input type="hidden" class="status-hidden-input"
                                                        name="results[{{ $participant->id }}][status]"
                                                        value="{{ $participant->status }}">
                                                </td>

                                                <td class="text-center font-weight-bold">{{ $participant->posisi }}</td>
                                            </tr>
                                            @php $lastSeri = $participant->seri; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @empty
                            <div class="alert alert-warning text-center">
                                Buku acara belum dapat dibuat. Silakan kembali ke halaman "Susunan Acara Lomba" untuk
                                membuatnya.
                            </div>
                        @endforelse
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="maxParticipantsModal" tabindex="-1" role="dialog"
        aria-labelledby="maxParticipantsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="maxParticipantsModalLabel">Ubah Maksimal Peserta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="maxParticipantsForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="event_id" id="eventId">
                    <input type="hidden" name="start_time" id="startTime">

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="groupCount" class="form-label">Maksimal Peserta per Kelompok/Seri</label>
                            <input type="number" class="form-control" id="groupCount" name="group_count"
                                placeholder="Contoh: 8" min="1" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const hasilInputs = document.querySelectorAll('.hasil-input');

            function getSortableTime(row) {
                const statusInput = row.querySelector('.status-hidden-input');
                const statusValue = statusInput ? statusInput.value : '';
                if (statusValue === 'NS' || statusValue === 'DQ') { return Infinity; }
                const hasilInput = row.querySelector('.hasil-input');
                const value = hasilInput.value.trim();
                if (!value) { return Infinity; }
                const numericValue = parseFloat(value.replace(/[:.]/g, ''));
                return isNaN(numericValue) ? Infinity : numericValue;
            }

            function sortTableRows(table) {
                const tbody = table.querySelector('tbody');

                if (!tbody) return;
                const seriNumbers = [...new Set(Array.from(tbody.querySelectorAll('tr[data-seri]')).map(tr => tr.dataset.seri))];
                seriNumbers.sort((a, b) => a - b);

                const allSortedRows = [];

                // Loop setiap seri sesuai urutan yang benar, urutkan baris di dalamnya
                seriNumbers.forEach(seri => {
                    const rowsInSeri = Array.from(tbody.querySelectorAll(`tr[data-seri="${seri}"]`));
                    rowsInSeri.sort((rowA, rowB) => {
                        const timeA = getSortableTime(rowA);
                        const timeB = getSortableTime(rowB);
                        return timeA - timeB;
                    });
                    allSortedRows.push(...rowsInSeri);
                });

                // Susun ulang seluruh isi tabel
                allSortedRows.forEach(row => tbody.appendChild(row));

                let lastSeri = null;
                allSortedRows.forEach((row, index) => {
                    const currentSeri = row.dataset.seri;
                    row.classList.remove('seri-separator');
                    if (index > 0 && currentSeri !== lastSeri) {
                        row.classList.add('seri-separator');
                    }
                    const noCell = row.querySelector('td:first-child');
                    if (noCell) {
                        noCell.textContent = index + 1;
                    }
                    lastSeri = currentSeri;
                });
            }

            // format input waktu 
            function parseAndFormatTime(value) {
                const rawValue = value.trim();
                if (rawValue === '') return '';
                const cleanValue = rawValue.replace(/,/g, '.').replace(/[^0-9.]/g, '');
                const parts = cleanValue.split('.').filter(p => p !== '');
                let minutes = 0, seconds = 0, milliseconds = 0;
                switch (parts.length) {
                    case 1:
                        const digits = parts[0].padStart(4, '0');
                        milliseconds = parseInt(digits.slice(-2), 10);
                        seconds = parseInt(digits.slice(-4, -2), 10);
                        minutes = parseInt(digits.slice(0, -4), 10) || 0;
                        break;
                    case 2:
                        seconds = parseInt(parts[0], 10) || 0;
                        milliseconds = parseInt(parts[1].padEnd(2, '0').substring(0, 2), 10) || 0;
                        break;
                    case 3:
                        minutes = parseInt(parts[0], 10) || 0;
                        seconds = parseInt(parts[1], 10) || 0;
                        milliseconds = parseInt(parts[2].padEnd(2, '0').substring(0, 2), 10) || 0;
                        break;
                    default: return rawValue;
                }
                const formattedMinutes = String(minutes).padStart(2, '0');
                const formattedSeconds = String(seconds).padStart(2, '0');
                const formattedMilliseconds = String(milliseconds).padStart(2, '0');
                return `${formattedMinutes}:${formattedSeconds}.${formattedMilliseconds}`;
            }
            hasilInputs.forEach(input => {
                input.addEventListener('blur', (e) => {
                    const originalValue = e.target.value;
                    if (originalValue) {
                        e.target.value = parseAndFormatTime(originalValue);
                    }
                    const table = e.target.closest('table');
                    if (table) {
                        sortTableRows(table);
                    }
                });

                input.addEventListener('keydown', (e) => {
                    const inputs = Array.from(document.querySelectorAll('.hasil-input'));
                    const currentIndex = inputs.indexOf(e.target);
                    if (e.key === 'Enter' || e.key === 'Tab' || e.key === 'ArrowDown') {
                        if (e.target.value) e.target.value = parseAndFormatTime(e.target.value);
                        if (e.key !== 'Tab') {
                            e.preventDefault();
                            const nextIndex = currentIndex + 1;
                            if (nextIndex < inputs.length) inputs[nextIndex].focus();
                        }
                    }
                    if (e.key === 'ArrowUp') {
                        e.preventDefault();
                        const prevIndex = currentIndex - 1;
                        if (prevIndex >= 0) inputs[prevIndex].focus();
                    }
                });
            });

            document.querySelectorAll('.status-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function (e) {
                    const currentRow = e.target.closest('tr');
                    const currentStatus = e.target.dataset.status;
                    const isChecked = e.target.checked;
                    currentRow.querySelectorAll('.status-checkbox').forEach(otherCheckbox => {
                        if (otherCheckbox !== e.target) otherCheckbox.checked = false;
                    });
                    const hiddenInput = currentRow.querySelector('.status-hidden-input');
                    hiddenInput.value = isChecked ? currentStatus : '';
                    const table = e.target.closest('table');
                    if (table) sortTableRows(table);
                });
            });

            document.querySelectorAll('.table.table-bordered').forEach(table => {
                sortTableRows(table);
            });

            const autoCloseAlert = document.getElementById('auto-close-alert');
            if (autoCloseAlert) {
                setTimeout(() => {
                    new bootstrap.Alert(autoCloseAlert).close();
                }, 1000);
            }
        });
        //ubah max partisipan manual
        function openMaxParticipantsModal(actionUrl, currentValue, eventId, startTime) {
            const form = document.getElementById('maxParticipantsForm');
            form.setAttribute('action', actionUrl);

            const groupCountInput = document.getElementById('groupCount');
            groupCountInput.value = currentValue;
            const eventIdInput = document.getElementById('eventId');
            eventIdInput.value = eventId;

            const startTimeInput = document.getElementById('startTime');
            startTimeInput.value = startTime;

            $('#maxParticipantsModal').modal('show');
        }
    </script>
@endpush