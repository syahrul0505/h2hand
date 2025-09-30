<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Buku Hasil - {{ $event->name }}</title>
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
            page-break-after: avoid;
        }

        .text-center {
            text-align: center;
        }

        .font-weight-bold {
            font-weight: bold;
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
        }


        .podium-highlight {
            background-color: #fffacd !important;
            font-weight: bold;
        }

        table {
            page-break-inside: auto;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        thead {
            display: table-header-group;
        }
    </style>
</head>

<body>
    <h3>Buku Hasil - {{ $event->name }}</h3>

    @forelse ($eventBookData as $raceName => $participants)
        <div class="race-header">
            {{ $raceName }}
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 5%;">POS</th>
                    <th style="width: 5%;">DAY</th>
                    <th style="width: 5%;">SERI</th>
                    <th style="width: 8%;">MULAI</th>
                    <th style="width: 5%;">LINT</th>
                    <th>NAMA</th>
                    <th>TIM</th>
                    <th style="width: 15%;">HASIL</th>
                </tr>
            </thead>
            <tbody>
                {{-- highlight 3 teratas --}}
                @foreach ($participants as $participant)
                    <tr class="{{ $loop->index < 3 ? 'podium-highlight' : '' }}">
                        <td class="text-center font-weight-bold">{{ $loop->iteration }}</td>
                        <td class="text-center">1</td>
                        <td class="text-center">{{ $participant->seri }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($participant->waktu_mulai)->format('H:i') }}</td>
                        <td class="text-center">{{ $participant->lintasan }}</td>
                        <td>{{ $participant->participant->name }}</td>
                        <td>{{ $participant->participant->club }}</td>
                        <td class="text-center font-weight-bold">{{ $participant->hasil }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @empty
        <div style="text-align: center; margin-top: 20px;">
            Belum ada hasil yang bisa dicetak.
        </div>
    @endforelse
</body>

</html>