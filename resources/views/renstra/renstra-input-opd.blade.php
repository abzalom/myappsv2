<x-app-layout :apps="$apps">

    @if ($errors->any())
        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Input Renstra Pada Perangkat Daerah {{ ucwords($opd->nama_lower) }}</span>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped datatables-renstra-tujuan">
                        <thead class="table-dark">
                            <tr>
                                <th>Sasaran RPJMD</th>
                                <th>Tujuan PD</th>
                                <th>Sasaran PD</th>
                                <th>Program PD</th>
                                <th>Kegiatan PD</th>
                                @foreach ($tahuns as $tahun)
                                    <th>Tahun {{ $rpjmd->awal == $tahun ? 'Awal ' . $tahun : $tahun }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sasaran RPJMD</td>
                                <td>Sasaran Renstra</td>
                                <td>Tujuan Renstra</td>
                                <td>Program Renstra</td>
                                <td>Kegiatan Renstra</td>
                                <td>100%</td>
                                <td>100%</td>
                                <td>100%</td>
                                <td>100%</td>
                                <td>100%</td>
                                <td>100%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="/asset/js/renstra.js"></script>
    @include('sccript')
</x-app-layout>
