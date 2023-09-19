<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test Perubahan</title>
    <link href="/vendors/bootstrap-5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Kode Opd</th>
                <th>Kode</th>
                <th>Uraian</th>
                <th>Anggaran Sebelum</th>
                <th>Anggaran Sesudah</th>
                <th>Selisih</th>
            </tr>
        </thead>
        <tbody>
            {{-- <tr>
                <td>{{ $opds->kode_opd }}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr> --}}
            @foreach ($opds->perubahansubkeluarans as $subkel)
                <tr>
                    <td>{{ $opds->kode_opd }}</td>
                    <td>{{ $subkel->kode_subkeluaran }}</td>
                    <td>{{ $subkel->uraian }}</td>
                    <td>{{ number_format($subkel->anggaran, 2, ',', '.') }}</td>
                    <td>{{ number_format($subkel->menjadi_anggaran, 2, ',', '.') }}</td>
                    <td>{{ number_format($subkel->menjadi_anggaran - $subkel->anggaran, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
