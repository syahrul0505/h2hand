<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Klasemen Juara - {{ $event->name }}</title>
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
            border: 1px solid #000000ff;
            padding: 6px;
            vertical-align: middle;
        }

        .table thead th {
            text-align: center;
            vertical-align: middle;
            background-color: #ffff00;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .title-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .medal-icon {
            width: 20px;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div class="title-header">
        <h3>KLASEMEN JUARA UMUM</h3>
        <h4 style="text-transform: uppercase;">{{ $event->name }}</h4>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th rowspan="2" style="width: 5%;">NO</th>
                <th rowspan="2">TIM</th>
                <th colspan="3">PEROLEHAN PER ACARA</th>
            </tr>
            <tr>
                <th style="width: 15%;">
                    <img src="https://em-content.zobj.net/source/apple/354/1st-place-medal_1f947.png" alt="Emas"
                        class="medal-icon"> 1
                </th>
                <th style="width: 15%;">
                    <img src="https://em-content.zobj.net/source/apple/354/2nd-place-medal_1f948.png" alt="Perak"
                        class="medal-icon"> 2
                </th>
                <th style="width: 15%;">
                    <img src="https://em-content.zobj.net/source/apple/354/3rd-place-medal_1f949.png" alt="Perunggu"
                        class="medal-icon"> 3
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($standings as $index => $team)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $team['club_name'] }}</td>
                    <td class="text-center">{{ $team['gold'] > 0 ? $team['gold'] : '' }}</td>
                    <td class="text-center">{{ $team['silver'] > 0 ? $team['silver'] : '' }}</td>
                    <td class="text-center">{{ $team['bronze'] > 0 ? $team['bronze'] : '' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data juara.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>