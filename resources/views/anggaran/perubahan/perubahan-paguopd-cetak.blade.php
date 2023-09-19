<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pagu OPD {{ request()->filter ? 'Filter' : '' }} {{ session()->get('tahun') }}</title>
    <link href="/vendors/bootstrap-5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <table class="table table-bordered table-striped">
        <thead class="text-center align-middle">
            <th>Kode OPD</th>
            <th>Nama OPD</th>
            @foreach ($sumberdanas as $header)
                <th>{{ $header->uraian }}</th>
            @endforeach
        </thead>
        <tbody class="align-middle">
            @foreach ($opds as $opd)
                <tr>
                    <td>{{ $opd['kode_opd'] }}</td>
                    <td>{{ $opd['nama_opd'] }}</td>
                    @foreach ($sumberdanas as $body)
                        <td>
                            @foreach ($opd['pagus'][0] as $pagu)
                                @if ($body->kode_unik == $pagu['kode_unik_sumberdana'])
                                    {{ $pagu['gaji'] ? number_format($pagu['menjadi_jumlah'] - $pagu['gaji'], 2, ',', '.') : number_format($pagu['menjadi_jumlah'], 2, ',', '.') }}
                                @endif
                            @endforeach
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
