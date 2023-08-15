<x-app-layout :apps="$apps">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Ranwal Renja Perangkat Daerah Tahun Anggaran {{ session()->get('tahun') }}</span>
                </div>
                <div class="card-body">
                    <div class="table-reponsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead class="table-info">
                                <tr>
                                    <th>Kode OPD</th>
                                    <th>Nama OPD</th>
                                    <th>Pagu {{ session()->get('tahun') }}</th>
                                    <th>Renja {{ session()->get('tahun') }}</th>
                                    <th>Sisa Pagu {{ session()->get('tahun') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($opds as $opd)
                                    <tr>
                                        <td>{{ $opd->kode_opd }}</td>
                                        <td>{{ $opd->nama_opd }}</td>
                                        <td class="text-end">{{ number_format($opd->pagus_sum_jumlah, 2, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($opd->ranwalsubkeluarans_sum_anggaran, 2, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($opd->pagus_sum_jumlah - $opd->ranwalsubkeluarans_sum_anggaran, 2, ',', '.') }}</td>
                                        <td>
                                            <a href="/rkpd/ranwal/opd/{{ $opd->id }}" class="btn btn-sm btn-primary">Renja</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('sccript')
</x-app-layout>
