<x-app-layout :apps="$apps">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Perubahan Renja Perangkat Daerah Tahun Anggaran {{ session()->get('tahun') }}</span>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        @role(['admin', 'bappeda'])
                            <div class="col-6">
                                <form action="/perubahan/rkpd/renja/all/upload" method="post" id="formUploadRenjaAllOpd" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="file" id="fileRenjaAllOpd" onchange="return getElementById('formUploadRenjaAllOpd').submit()" hidden>
                                    <button type="button" class="btn btn-secondary" onclick="return getElementById('fileRenjaAllOpd').click()"><i class="fa-solid fa-folder-open"></i> Upload Renja</button>
                                </form>
                            </div>
                        @endrole
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" style="width: 100%">
                            <thead class="table-secondary align-middle text-center">
                                <tr>
                                    <th rowspan="2">Kode OPD</th>
                                    <th rowspan="2">Nama OPD</th>
                                    <th>Pagu Perubahan {{ session()->get('tahun') }}</th>
                                    <th>Renja {{ session()->get('tahun') }}</th>
                                    <th>Perubahan Renja {{ session()->get('tahun') }}</th>
                                    <th>Bertambah / Berkurang</th>
                                    <th>Sisa Pagu {{ session()->get('tahun') }}</th>
                                    <th rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th class="text-end">{{ number_format($jumlah_pagu, 2, ',', '.') }}</th>
                                    <th class="text-end">{{ number_format($jumlah_renja, 2, ',', '.') }}</th>
                                    <th class="text-end">{{ number_format($menjadi_jumlah_renja, 2, ',', '.') }}</th>
                                    <th class="text-end">{{ number_format($jumlah_renja - $menjadi_jumlah_renja, 2, ',', '.') }}</th>
                                    <th class="text-end">{{ number_format($jumlah_pagu - $jumlah_renja, 2, ',', '.') }}</th>
                                </tr>
                                <tr class="fst-italic" style="font-size: 80%">
                                    <th style="background-color: #e2ffce">1</th>
                                    <th style="background-color: #e2ffce">2</th>
                                    <th style="background-color: #e2ffce">3</th>
                                    <th style="background-color: #e2ffce">4</th>
                                    <th style="background-color: #e2ffce">5</th>
                                    <th style="background-color: #e2ffce">6 = 5-4</th>
                                    <th style="background-color: #e2ffce">7 = 3-5</th>
                                    <th style="background-color: #e2ffce"></th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                @foreach ($opds as $opd)
                                    <tr>
                                        <td>{{ $opd->kode_opd }}</td>
                                        <td>{{ $opd->nama_opd }}</td>
                                        <td class="text-end">{{ number_format($opd->paguperubahans_sum_menjadi_jumlah, 2, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($opd->perubahansubkeluarans_sum_anggaran, 2, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($opd->perubahansubkeluarans_sum_menjadi_anggaran, 2, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($opd->perubahansubkeluarans_sum_menjadi_anggaran - $opd->perubahansubkeluarans_sum_anggaran, 2, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($opd->paguperubahans_sum_menjadi_jumlah - $opd->perubahansubkeluarans_sum_menjadi_anggaran, 2, ',', '.') }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="/perubahan/rkpd/opd/{{ $opd->id }}" class="btn btn-sm btn-primary">Renja</a>
                                                <a href="/perubahan/rkpd/cetak?opd={{ encrypt($opd->id) }}&_token={{ csrf_token() }}" class="btn btn-sm btn-secondary btn-group-form-last" target="_blank"><i class="fa-solid fa-print"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-dark align-middle text-center">
                                <tr>
                                    <th colspan="2" class="text-end">TOTAL</th>
                                    <th class="text-end">{{ number_format($jumlah_pagu, 2, ',', '.') }}</th>
                                    <th class="text-end">{{ number_format($jumlah_renja, 2, ',', '.') }}</th>
                                    <th class="text-end">{{ number_format($menjadi_jumlah_renja, 2, ',', '.') }}</th>
                                    <th class="text-end">{{ number_format($jumlah_renja - $menjadi_jumlah_renja, 2, ',', '.') }}</th>
                                    <th class="text-end">{{ number_format($jumlah_pagu - $jumlah_renja, 2, ',', '.') }}</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('sccript')
</x-app-layout>
