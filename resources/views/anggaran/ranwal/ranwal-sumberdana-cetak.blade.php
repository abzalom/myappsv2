<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cetak Sumber Dana tahun {{ session()->get('tahun') }}</title>
    <link href="/vendors/bootstrap-5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="/vendors/select2/dist/css/select2.min.css" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.css"> --}}
    <link rel="stylesheet" type="text/css" href="/vendors/select2-bootstrap5/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" type="text/css" href="/vendors/datatables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="/vendors/datatables/RowGroup-1.2.0/css/rowGroup.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/vendors/fontawesome/css/all.css" />
    <link rel="stylesheet" type="text/css" href="/asset/css/style.css">
</head>

<body>
    <table class="table table-bordered">
        <thead class="table-info">
            <tr>
                <th>kode_sumberdana</th>
                <th>nomor</th>
                <th>kode_unik</th>
                <th>uraian</th>
                <th>jumlah</th>
                <th>tahun</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sumberdanas as $sumberdana)
                @php
                    $no = 1;
                    $unik = 1;
                @endphp
                @foreach ($sumberdana->ranwals as $ranwal)
                    <tr>
                        <td>{{ $sumberdana->kode }}</td>
                        <td>{{ $no++ }}</td>
                        <td>{{ $sumberdana->kode . '-' . $unik++ }}</td>
                        <td>{{ $ranwal->uraian }}</td>
                        <td>{{ number_format($ranwal->jumlah, 2, ',', '') }}</td>
                        <td>{{ $ranwal->tahun }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>

</html>
