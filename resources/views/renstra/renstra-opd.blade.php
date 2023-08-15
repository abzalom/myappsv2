<x-app-layout :apps="$apps">

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Restra Perangkat Daerah Periode RPJMD {{ $rpjmd->awal . ' - ' . $rpjmd->akhir }}</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead class="table-info align-middle">
                                <tr>
                                    <th rowspan="2">Perangkat Daerah</th>
                                    @foreach (session()->get('periode')['tahuns'] as $tahun)
                                        @if ($rpjmd->awal == $tahun)
                                            <th class="text-center" rowspan="2">Kondisi Awal Tahun {{ $tahun }}</th>
                                        @else
                                            @if (session()->get('tahun') == $tahun)
                                                <th class="text-center" colspan="2">Tahun {{ $tahun }} <small class="text-muted">(aktif)</small></th>
                                            @else
                                                <th class="text-center" colspan="2">Tahun {{ $tahun }}</th>
                                            @endif
                                        @endif
                                    @endforeach
                                </tr>
                                <tr class="text-center">
                                    <th>Program</th>
                                    <th>Kegiatan</th>
                                    <th>Program</th>
                                    <th>Kegiatan</th>
                                    <th>Program</th>
                                    <th>Kegiatan</th>
                                    <th>Program</th>
                                    <th>Kegiatan</th>
                                    <th>Program</th>
                                    <th>Kegiatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($opds as $opd)
                                    <tr>
                                        <td><a href="/renstra/opd/{{ $opd->id }}" class="text-decoration-none">{{ $opd->kode_opd . ' ' . $opd->nama_opd }}</a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
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
