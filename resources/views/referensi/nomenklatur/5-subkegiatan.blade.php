<x-app-layout :apps="$apps">

    <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/referensi/nomenklatur/urusan/">Urusan</a></li>
            <li class="breadcrumb-item"><a href="/referensi/nomenklatur/urusan/{{ str($nomen->bidang->kode_urusan)->replace('.', '-') }}/bidang">Bidang</a></li>
            <li class="breadcrumb-item"><a href="/referensi/nomenklatur/urusan/{{ str($nomen->bidang->program->kode_urusan)->replace('.', '-') }}/bidang/{{ str($nomen->bidang->program->kode_bidang)->replace('.', '-') }}/program">Program</a></li>
            <li class="breadcrumb-item"><a href="/referensi/nomenklatur/urusan/{{ str($nomen->bidang->program->kode_urusan)->replace('.', '-') }}/bidang/{{ str($nomen->bidang->program->kode_bidang)->replace('.', '-') }}/program/{{ str($nomen->bidang->program->kegiatan->kode_program)->replace('.', '-') }}/kegiatan">Kegiatan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sub Kegiatan</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12 mx-auto">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Referensi Nomenklatur Bidang Urusan Kepmendagri 050-5889 Tahun 2021</span>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped">
                        <thead class="table-dark align-middle">
                            <tr>
                                <th>KODE</th>
                                <th>URAIAN</th>
                                <th>KLASIFIKASI</th>
                                <th>KINERJA</th>
                                <th>INDIKATOR</th>
                                <th>SATUAN</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            <tr>
                                <th>{{ $nomen->kode_urusan }}</th>
                                <th colspan="5">{{ $nomen->uraian }}</th>
                            </tr>
                            <tr>
                                <th>{{ $nomen->bidang->kode_bidang }}</th>
                                <th colspan="5">{{ $nomen->bidang->uraian }}</th>
                            </tr>
                            <tr>
                                <th>{{ $nomen->bidang->program->kode_program }}</th>
                                <th colspan="5">{{ $nomen->bidang->program->uraian }}</th>
                            </tr>
                            <tr>
                                <th>{{ $nomen->bidang->program->kegiatan->kode_kegiatan }}</th>
                                <th colspan="5">{{ $nomen->bidang->program->kegiatan->uraian }}</th>
                            </tr>
                            @foreach ($nomen->bidang->program->kegiatan->subkegiatans as $subkegiatan)
                                <tr>
                                    <td style="width: 5%">{{ $subkegiatan->kode_subkegiatan }}</td>
                                    <td style="width: 30%">
                                        {{ $subkegiatan->uraian }}
                                    </td>
                                    <td style="width: 20%">{{ $subkegiatan->klasifikasi_belanja }}</td>
                                    <td style="width: 20%">{{ $subkegiatan->kinerja }}</td>
                                    <td style="width: 20%">{{ $subkegiatan->indikator }}</td>
                                    <td style="width: 5%">{{ $subkegiatan->satuan }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('sccript')
</x-app-layout>
