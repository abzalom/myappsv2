<x-app-layout :apps="$apps">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Ranwal Renja Perangkat Daerah Tahun Anggaran {{ session()->get('tahun') }}</span>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        @role(['admin', 'bappeda'])
                            <div class="col-6">
                                <form action="/ranwal/rkpd/renja/all/upload" method="post" id="formUploadRenjaAllOpd" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="file" id="fileRenjaAllOpd" onchange="return getElementById('formUploadRenjaAllOpd').submit()" hidden>
                                    <button type="button" class="btn btn-secondary" onclick="return getElementById('fileRenjaAllOpd').click()"><i class="fa-solid fa-folder-open"></i> Upload Renja</button>
                                </form>
                            </div>
                        @endrole
                    </div>
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
                                        <td class="text-end">{{ number_format($opd->paguranwals_sum_jumlah, 2, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($opd->ranwalsubkeluarans_sum_anggaran, 2, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($opd->paguranwals_sum_jumlah - $opd->ranwalsubkeluarans_sum_anggaran, 2, ',', '.') }}</td>
                                        <td>
                                            <a href="/ranwal/rkpd/opd/{{ $opd->id }}" class="btn btn-sm btn-primary">Renja</a>
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
