<x-app-layout :apps="$apps">
    <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/rpjmd/periode">Periode</a></li>
            <li class="breadcrumb-item"><a href="/rpjmd/visi">Visi</a></li>
            <li class="breadcrumb-item"><a href="/rpjmd/misi">Misi</a></li>
            <li class="breadcrumb-item"><a href="/rpjmd/tujuan">Tujuan</a></li>
            <li class="breadcrumb-item"><a href="/rpjmd/sasaran">Sasaran</a></li>
            <li class="breadcrumb-item"><a href="/rpjmd/indikator">Indikator</a></li>
            <li class="breadcrumb-item active" aria-current="page">Program</li>
        </ol>
    </nav>

    {{-- <div class="row">
        <div class="col-12">
            -Periode => {{ $periode->awal . ' - ' . $periode->akhir }}<br />
            @foreach ($periode->visis as $visi)
                ---Visi => {{ $visi->visi }}<br />
                @foreach ($visi->misis as $misi)
                    -----Misi => {{ $misi->misi }}<br />
                    @foreach ($misi->tujuans as $tujuan)
                        --------Tujuan => {{ $tujuan->tujuan }}<br />
                        @foreach ($tujuan->sasarans as $sasaran)
                            ---------Sasaran => {{ $sasaran->sasaran }}<br />
                            @foreach ($sasaran->indikators as $indikator)
                                ------------Indikator => {{ $indikator->indikator }}<br />
                                @foreach ($indikator->programs as $program)
                                    @foreach ($program->nomens as $nomen)
                                        ---------------Program => {{ $nomen->kode_program }}<br /><br />
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                @endforeach
            @endforeach
        </div>
    </div> --}}

    <div class="row">
        @if ($errors->any())
            <div class="col-sm-10 mx-auto">
                <div class="alert alert-danger">
                    <h5>Error => Inputan gagal karena kesalahan berikut :</h5>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="col-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Indikator Pembangunan RPJMD Periode {{ $periode->awal . ' - ' . $periode->akhir }}</span>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover datatables-program">
                        <thead class="table-dark">
                            <tr>
                                <th>VISI</th>
                                <th>MISI</th>
                                <th>TUJUAN</th>
                                <th>SASARAN</th>
                                <th>INDIKATOR</th>
                                <th>KODEFIKASI</th>
                                <th>PROGRAM</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($periode->visis as $visi)
                                @foreach ($visi->misis as $misi)
                                    @foreach ($misi->tujuans as $tujuan)
                                        @foreach ($tujuan->sasarans as $sasaran)
                                            @foreach ($sasaran->indikators as $indikator)
                                                @if (!$indikator->programs->count())
                                                    <tr>
                                                        <td>VISI {{ $visi->visi }}</td>
                                                        <td>MISI {{ $misi->nomor . ' : ' . $misi->misi }}</td>
                                                        <td>TUJUAN {{ $tujuan->nomor . ' : ' . $tujuan->tujuan }}</td>
                                                        <td>SASARAN {{ $sasaran->nomor . ' : ' . $sasaran->sasaran }}</td>
                                                        <td class="align-middle">
                                                            <div class="row">
                                                                <div style="width: 15%; padding-right: 0; padding-left:3%; text-align:right">
                                                                    INDIKATOR :
                                                                </div>
                                                                <div style="width: 80%">
                                                                    {{ $indikator->indikator }} <small class="text-muted italic">({{ $indikator->satuan }})</small>
                                                                </div>
                                                                <div style="width: 5%; padding-left: 0;">
                                                                    <button class="btn btn-sm btn-primary btn-add-program" value="{{ $indikator->id }}" data-bs-toggle="modal" data-bs-target="#addProgramRpjmdModal"><i class="fa-solid fa-plus-square"></i></button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                @endif
                                                @foreach ($indikator->programs as $program)
                                                    <tr>
                                                        <td>VISI {{ $visi->visi }}</td>
                                                        <td>MISI {{ $misi->nomor . ' : ' . $misi->misi }}</td>
                                                        <td>TUJUAN {{ $tujuan->nomor . ' : ' . $tujuan->tujuan }}</td>
                                                        <td>SASARAN {{ $sasaran->nomor . ' : ' . $sasaran->sasaran }}</td>
                                                        <td class="align-middle">
                                                            <div class="row">
                                                                <div style="width: 15%; padding-right: 0; padding-left:3%; text-align:right">
                                                                    INDIKATOR :
                                                                </div>
                                                                <div style="width: 80%">
                                                                    {{ $indikator->indikator }} <small class="text-muted italic">({{ $indikator->satuan }})</small>
                                                                </div>
                                                                <div style="width: 5%; padding-left: 0;">
                                                                    <button class="btn btn-sm btn-primary btn-add-program" value="{{ $indikator->id }}" data-bs-toggle="modal" data-bs-target="#addProgramRpjmdModal"><i class="fa-solid fa-plus-square"></i></button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td style="width: 20%">
                                                            <div style="padding-right: 0; padding-left:3%; text-align:right">
                                                                {{ $program->nomen->kode_program }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                {{ $program->nomen->uraian }}
                                                            </div>
                                                        </td>
                                                        <td style="width: 5%">
                                                            <div class="text-end">
                                                                <form action="{{ route('rpjmd.program.destory') }}" method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="aksi" value="destroy">
                                                                    <input type="hidden" name="id" value="{{ $program->id }}">
                                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus program ini?')"><i class="fa fa-solid fa-trash"></i></button>
                                                                </form>
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
            </div>
        </div>
    </div>

    @include('rpjmd.modal-add.modal-add-rpjmd-program')
    @include('rpjmd.modal-edit.modal-edit-rpjmd-program')

    @include('sccript')


    <script src="/asset/js/rpjmd_program.js"></script>

</x-app-layout>
