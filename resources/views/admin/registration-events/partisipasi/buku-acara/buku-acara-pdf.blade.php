<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Buku Acara - {{ $event->name }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 10px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }

        .table th,
        .table td {
            border: 1px solid #dee2e6;
            padding: 4px;
            vertical-align: middle;
        }

        .table thead th {
            text-align: center;
            vertical-align: middle;
            background-color: #e9ecef;
            font-weight: bold;
        }

        .race-header {
            background-color: #ffc107;
            color: #000;
            font-weight: bold;
            text-align: center;
            padding: 6px;
            margin-top: 1.5rem;
            border: 1px solid #dee2e6;
            border-bottom: none;
        }

        .text-center {
            text-align: center;
        }

        .seri-separator td {
            border-top: 2px solid #333 !important;
        }

        .page-break {
            page-break-after: always;
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h3>Buku Acara - {{ $event->name }}</h3>

    @forelse ($eventBookData as $raceName => $participants)
        <div class="race-header">
            {{ $raceName }}
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 4%;">NO.</th>
                    <th style="width: 4%;">DAY</th>
                    <th style="width: 4%;">SERI</th>
                    <th style="width: 6%;">MULAI</th>
                    <th>NAMA</th>
                    <th>TIM</th>
                    <th style="width: 4%;">LINT</th>
                    <th style="width: 10%;">HASIL</th>
                    <th style="width: 10%;">STATUS</th>
                    <th style="width: 5%;">POS</th>
                </tr>
            </thead>
            <tbody>
                @php $lastSeri = null; @endphp
                @foreach ($participants as $pIndex => $participant)
                    <tr @if($lastSeri !== null && $lastSeri != $participant->seri) class="seri-separator" @endif>
                        <td class="text-center">{{ $pIndex + 1 }}</td>
                        <td class="text-center">1</td>
                        <td class="text-center">{{ $participant->seri }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($participant->waktu_mulai)->format('H:i') }}</td>
                        <td>{{ $participant->participant->name }}</td>
                        <td>{{ $participant->participant->club }}</td>
                        <td class="text-center">{{ $participant->lintasan }}</td>
                        <td class="text-center">{{ $participant->hasil }}</td>
                        <td class="text-center">{{ $participant->status }}</td>
                        <td class="text-center">{{ $participant->posisi }}</td>
                    </tr>
                    @php $lastSeri = $participant->seri; @endphp
                @endforeach
            </tbody>
        </table>
    @empty
        <div style="text-align: center; margin-top: 20px;">
            Buku acara belum dapat dibuat.
        </div>
    @endforelse
</body>

</html>