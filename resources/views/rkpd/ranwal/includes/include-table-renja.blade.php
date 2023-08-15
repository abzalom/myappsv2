<div class="table-responsive">
    <table class="table table-sm table-bordered table-hover" style="width: 120%; font-size:90%">
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
                @foreach ($urusan->bidangs->where('kode_opd', $opd->kode_opd) as $bidang)
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
                                    <td style="width: 1%">{{ $subkegiatan->kode_subkegiatan }}</td>
                                    <td style="width: 10%">{{ $subkegiatan->uraian }}</td>
                                    <td style="width: 10%">{{ $subkegiatan->indikator }}</td>
                                    <td class="text-center" style="width: 2%">{{ $subkegiatan->target_indikator }}</td>
                                    <td class="text-center" style="width: 2%">{{ $subkegiatan->satuan }}</td>
                                    <td class="text-end" style="width: 2%">{{ number_format($subkegiatan->subkeluarans_sum_anggaran, 2, ',', '.') }}</td>
                                    <td style="width: 10%"></td>
                                    <td style="width: 10%"></td>
                                    <td class="text-center" style="width: 5%">
                                        @if ($subkegiatan->jenis)
                                            {{ $subkegiatan->jenis }}
                                        @else
                                            jenis error <i class="fa-solid fa-circle-exclamation fa-lg" style="color: #ff4242;"></i>
                                        @endif
                                    </td>
                                    <td class="text-center" style="width: 5%">
                                        @can('input renja')
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="/rkpd/ranwal/opd/{{ $opd->id }}/subkegiatan/{{ $subkegiatan->id }}/subkeluaran" type="button" class="btn btn-sm btn-primary"><i class="fa-solid fa-plus-square"></i></a>
                                                <a href="/rkpd/ranwal/opd/{{ $opd->id }}/subkegiatan/{{ $subkegiatan->id }}/edit" type="button" class="btn btn-sm btn-info"><i class="fa-solid fa-edit"></i></a>
                                                @if (!$subkegiatan->subkeluarans_count)
                                                    <form action="/rkpd/ranwal/opd/{{ $opd->id }}/subkegiatan/destroy" method="post">
                                                        @csrf
                                                        <input type="hidden" name="aksi" value="delete">
                                                        <input type="hidden" name="subkegiatan" value="{{ $subkegiatan->id }}">
                                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                                                    </form>
                                                @endif
                                            </div>
                                        @endcan
                                    </td>
                                </tr>
                                @foreach ($subkegiatan->subkeluarans as $subkeluaran)
                                    <tr class="fst-italic" id="subkeltr">
                                        <td></td>
                                        <td colspan="2">{{ $subkeluaran->uraian }}</td>
                                        <td class="text-center">{{ $subkeluaran->target }}</td>
                                        <td class="text-center">{{ $subkeluaran->satuan }}</td>
                                        <td class="text-end">{{ number_format($subkeluaran->anggaran, 2, ',', '.') }}</td>
                                        <td>{{ $subkeluaran->lokasi }}</td>
                                        @if ($subkeluaran->pagu)
                                            <td>
                                                {{ $subkeluaran->pagu->uraianpendapatan->uraian }}
                                            </td>
                                        @else
                                            <td class="text-center align-middle">
                                                sumber dana error <i class="fa-solid fa-circle-exclamation fa-lg" style="color: #ff4242;"></i>
                                            </td>
                                        @endif
                                        <td></td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                @can('input renja')
                                                    <a href="/rkpd/ranwal/opd/{{ $opd->id }}/subkegiatan/{{ $subkegiatan->id }}/subkeluaran/{{ $subkeluaran->id }}/edit" type="button" class="btn btn-sm btn-info"><i class="fa-solid fa-edit"></i></a>
                                                    <form action="/rkpd/ranwal/opd/{{ $opd->id }}/subkegiatan/{{ $subkegiatan->id }}/subkeluaran/{{ $subkeluaran->id }}/destroy" method="post">
                                                        @csrf
                                                        <input type="hidden" name="aksi" value="delete">
                                                        <input type="hidden" name="subkeluaran" value="{{ $subkeluaran->id }}">
                                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
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
