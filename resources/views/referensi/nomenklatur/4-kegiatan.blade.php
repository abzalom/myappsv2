<x-app-layout :apps="$apps">

    <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/referensi/nomenklatur/urusan/">Urusan</a></li>
            <li class="breadcrumb-item"><a href="/referensi/nomenklatur/urusan/{{ str($nomen->bidang->program->kode_urusan)->replace('.', '-') }}/bidang">Bidang</a></li>
            <li class="breadcrumb-item"><a href="/referensi/nomenklatur/urusan/{{ str($nomen->bidang->program->kode_urusan)->replace('.', '-') }}/bidang/{{ str($nomen->bidang->program->kode_bidang)->replace('.', '-') }}/program">Program</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kegiatan</li>
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
                        <thead class="table-dark">
                            <tr>
                                <th>KODE</th>
                                <th>URAIAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>{{ $nomen->kode_urusan }}</th>
                                <th>{{ $nomen->uraian }}</th>
                            </tr>
                            <tr>
                                <th>{{ $nomen->bidang->kode_bidang }}</th>
                                <th>{{ $nomen->bidang->uraian }}</th>
                            </tr>
                            <tr>
                                <th>{{ $nomen->bidang->program->kode_program }}</th>
                                <th>{{ $nomen->bidang->program->uraian }}</th>
                            </tr>
                            @foreach ($nomen->bidang->program->kegiatans as $kegiatan)
                                <tr>
                                    <td style="width: 5%">{{ $kegiatan->kode_kegiatan }}</td>
                                    <td>
                                        <a href="/referensi/nomenklatur/urusan/{{ str($kegiatan->kode_urusan)->replace('.', '-') }}/bidang/{{ str($kegiatan->kode_bidang)->replace('.', '-') }}/program/{{ str($kegiatan->kode_program)->replace('.', '-') }}/kegiatan/{{ str($kegiatan->kode_kegiatan)->replace('.', '-') }}/subkegiatan" class="text-decoration-none">
                                            {{ $kegiatan->uraian }}
                                        </a>
                                    </td>
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
