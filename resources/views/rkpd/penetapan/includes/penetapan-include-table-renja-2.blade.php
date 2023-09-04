<div class="table-responsive">
    <table class="table table-sm table-bordered table-hover" style="width: 150%; font-size:90%">
        <thead class="table-dark">
            <tr>
                <th>Kode</th>
                <th>Uraian</th>
                <th>Indikator</th>
                <th>Target</th>
                <th>Satuan</th>
                <th>Anggaran</th>
                <th>Lokasi</th>
                <th>Sumber Dana</th>
                <th>Jenis</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="align-middle">
            @foreach ($urusans as $urusan)
                <tr>
                    <th>{{ $urusan->kode_urusan }}</th>
                    <th colspan="9">{{ $urusan->uraian }}</th>
                </tr>
                @foreach ($urusan->bidangs as $bidang)
                    <tr>
                        <th>{{ $bidang->kode_bidang }}</th>
                        <th colspan="9">{{ $bidang->uraian }}</th>
                    </tr>
                    @foreach ($bidang->programs as $program)
                        <tr>
                            <th>{{ $program->kode_program }}</th>
                            <th colspan="9">{{ $program->uraian }}</th>
                        </tr>
                        @foreach ($program->kegiatans as $kegiatan)
                            <tr>
                                <th>{{ $kegiatan->kode_kegiatan }}</th>
                                <th colspan="9">{{ $kegiatan->uraian }}</th>
                            </tr>
                            @foreach ($kegiatan->subkegiatans as $subkegiatan)
                                <tr>
                                    <td>{{ $subkegiatan->kode_subkegiatan }}</td>
                                    <td>{{ $subkegiatan->uraian }}</td>
                                    <td>{{ $subkegiatan->indikator }}</td>
                                    <td>{{ $subkegiatan->target_indikator }}</td>
                                    <td>{{ $subkegiatan->indikator }}</td>
                                    <td>{{ $subkegiatan->target_indikator . ' ' . $subkegiatan->satuan }}</td>
                                </tr>
                                @foreach ($subkegiatan->subkeluarans as $subkeluaran)
                                    <tr>
                                        <td>{{ $subkeluaran->kode_subkeluaran }}</td>
                                        <td>{{ $subkeluaran->uraian }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>
