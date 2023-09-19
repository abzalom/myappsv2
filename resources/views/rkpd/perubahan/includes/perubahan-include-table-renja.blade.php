<div class="table-responsive">
    <table class="table table-sm table-bordered table-hover" style="width: 120%; font-size:90%">
        <thead class="table-dark align-middle text-center">
            <tr>
                <th rowspan="2">Kode</th>
                <th rowspan="2">Uraian</th>
                <th rowspan="2">Indikator</th>
                <th colspan="6">semula</th>
                <th rowspan="2" style="width: 1%;background-color: #a4a4a4"></th>
                <th colspan="6">menjadi</th>
                <th rowspan="2">Bertambah / Berkurang</th>
                <th rowspan="2"></th>
                <th rowspan="2"></th>
            </tr>
            <tr>
                <th>Target</th>
                <th>Satuan</th>
                <th>Anggaran</th>
                <th>Lokasi</th>
                <th>Sumber Dana</th>
                <th>Jenis</th>
                <th>Target</th>
                <th>Satuan</th>
                <th>Anggaran</th>
                <th>Lokasi</th>
                <th>Sumber Dana</th>
                <th>Jenis</th>
            </tr>
        </thead>
        <tbody class="align-middle">
            @foreach ($urusans as $urusan)
                <tr>
                    <th>{{ $urusan->kode_urusan }}</th>
                    <th colspan="19">{{ $urusan->uraian }}</th>
                </tr>
                @foreach ($urusan->bidangs->where('kode_opd', $opd->kode_opd) as $bidang)
                    <tr>
                        <th>{{ $bidang->kode_bidang }}</th>
                        <th colspan="19">{{ $bidang->uraian }}</th>
                    </tr>
                    @foreach ($bidang->programs as $program)
                        <tr>
                            <th>{{ $program->kode_program }}</th>
                            <th colspan="19">{{ $program->uraian }}</th>
                        </tr>
                        @foreach ($program->kegiatans as $kegiatan)
                            <tr>
                                <th>{{ $kegiatan->kode_kegiatan }}</th>
                                <th colspan="19">{{ $kegiatan->uraian }}</th>
                            </tr>
                            @foreach ($kegiatan->subkegiatans as $subkegiatan)
                                @php
                                    $selisih = $subkegiatan->subkeluarans_sum_menjadi_anggaran - $subkegiatan->subkeluarans_sum_anggaran;
                                @endphp
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
                                    {{-- Batas Perubahan --}}
                                    <td style="background-color: #a4a4a4"></td>
                                    <td class="text-center" style="width: 2%">{{ $subkegiatan->menjadi_target_indikator }}</td>
                                    <td class="text-center" style="width: 2%">{{ $subkegiatan->satuan }}</td>
                                    <td class="text-end" style="width: 2%">{{ number_format($subkegiatan->subkeluarans_sum_menjadi_anggaran, 2, ',', '.') }}</td>
                                    <td style="width: 10%"></td>
                                    <td style="width: 10%"></td>
                                    <td class="text-center" style="width: 5%">
                                        @if ($subkegiatan->menjadi_jenis)
                                            {{ $subkegiatan->menjadi_jenis }}
                                        @else
                                            jenis error <i class="fa-solid fa-circle-exclamation fa-lg" style="color: #ff4242;"></i>
                                        @endif
                                    </td>
                                    <td class="text-end" style="width: 10%">{{ number_format($subkegiatan->subkeluarans_sum_menjadi_anggaran - $subkegiatan->subkeluarans_sum_anggaran, 2, ',', '.') }}</td>
                                    <td>
                                        @if ($subkegiatan->subkeluarans_sum_anggaran != 0)
                                            @if ($selisih != 0)
                                                <span class="badge rounded-pill text-bg-warning">Berubah Anggaran</span>
                                            @else
                                                @if ($subkegiatan->target_indikator !== $subkegiatan->menjadi_target_indikator)
                                                    <span class="badge rounded-pill text-bg-success">Berubah Target</span>
                                                @else
                                                    <span class="badge rounded-pill text-bg-secondary">Tetap</span>
                                                @endif
                                            @endif
                                        @else
                                            <span class="badge rounded-pill text-bg-primary">Baru</span>
                                        @endif
                                    </td>
                                    <td class="text-center" style="width: 5%">
                                        @can('input-renja')
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="/perubahan/rkpd/opd/{{ $opd->id }}/subkegiatan/{{ $subkegiatan->id }}/subkeluaran" type="button" class="btn btn-sm btn-primary"><i class="fa-solid fa-plus-square"></i></a>
                                                <a href="/perubahan/rkpd/opd/{{ $opd->id }}/subkegiatan/{{ $subkegiatan->id }}/edit" type="button" class="btn btn-sm btn-info"><i class="fa-solid fa-edit"></i></a>
                                                @if (!$subkegiatan->subkeluarans_count)
                                                    <form action="/perubahan/rkpd/opd/{{ $opd->id }}/subkegiatan/destroy" method="post">
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
                                                {{ $subkeluaran->pagu->sumberdana->uraian }}
                                            </td>
                                        @else
                                            <td class="text-center align-middle">
                                                sumber dana error <i class="fa-solid fa-circle-exclamation fa-lg" style="color: #ff4242;"></i>
                                            </td>
                                        @endif
                                        <td></td>
                                        {{-- Batas Perubahan --}}
                                        <td style="background-color: #a4a4a4"></td>
                                        <td class="text-center">{{ $subkeluaran->menjadi_target }}</td>
                                        <td class="text-center">{{ $subkeluaran->menjadi_satuan }}</td>
                                        <td class="text-end">{{ number_format($subkeluaran->menjadi_anggaran, 2, ',', '.') }}</td>
                                        <td>{{ $subkeluaran->menjadi_lokasi }}</td>
                                        @if ($subkeluaran->menjadi_pagu)
                                            <td>
                                                {{ $subkeluaran->menjadi_pagu->sumberdana->uraian }}
                                            </td>
                                        @else
                                            <td class="text-center align-middle">
                                                sumber dana error <i class="fa-solid fa-circle-exclamation fa-lg" style="color: #ff4242;"></i>
                                            </td>
                                        @endif
                                        <td></td>
                                        <td class="text-end">{{ number_format($subkeluaran->menjadi_anggaran - $subkeluaran->anggaran, 2, ',', '.') }}</td>
                                        <td></td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                @can('input-renja')
                                                    <a href="/perubahan/rkpd/opd/{{ $opd->id }}/subkegiatan/{{ $subkegiatan->id }}/subkeluaran/{{ $subkeluaran->id }}/edit" type="button" class="btn btn-sm btn-info"><i class="fa-solid fa-edit"></i></a>
                                                    <form action="/perubahan/rkpd/opd/{{ $opd->id }}/subkegiatan/{{ $subkegiatan->id }}/subkeluaran/{{ $subkeluaran->id }}/destroy" method="post">
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
