<x-app-layout :apps="$apps">
    <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/rpjmd/periode">Periode</a></li>
            <li class="breadcrumb-item"><a href="/rpjmd/visi">Visi</a></li>
            <li class="breadcrumb-item"><a href="/rpjmd/misi">Misi</a></li>
            <li class="breadcrumb-item"><a href="/rpjmd/tujuan">Tujuan</a></li>
            <li class="breadcrumb-item"><a href="/rpjmd/sasaran">Sasaran</a></li>
            <li class="breadcrumb-item active" aria-current="page">Indikator</li>
            <li class="breadcrumb-item"><a href="/rpjmd/program">Program</a></li>
        </ol>
    </nav>

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
                    <table class="table table-bordered table-striped table-hover datatables-indikator">
                        <thead class="table-dark">
                            <tr>
                                <th>VISI</th>
                                <th>MISI</th>
                                <th>TUJUAN</th>
                                <th>SASARAN</th>
                                <th>#</th>
                                <th>INDIKATOR</th>
                                <th>SATUAN</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($periode->visis as $visi)
                                @foreach ($visi->misis as $misi)
                                    @foreach ($misi->tujuans as $tujuan)
                                        @foreach ($tujuan->sasarans as $sasaran)
                                            @if (!$sasaran->indikators->count())
                                                <tr>
                                                    <td>
                                                        <div class="row mb-2 mt-2">
                                                            <div style="width: 5%; padding-right: 0;">
                                                                VISI
                                                            </div>
                                                            <div style="width: 95%">
                                                                {{ $visi->visi }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="row mb-2 mt-2">
                                                            <div style="width: 7%; padding-right: 0;">
                                                                MISI {{ $misi->nomor }}
                                                            </div>
                                                            <div style="width: 90%">
                                                                {{ $misi->misi }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="row mb-2 mt-2">
                                                            <div style="width: 10%; padding-right: 0;">
                                                                TUJUAN {{ $tujuan->nomor }}
                                                            </div>
                                                            <div style="width: 90%">
                                                                {{ $tujuan->tujuan }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="row mb-2 mt-2">
                                                            <div style="width: 12%; padding-right: 0; text-align:right">
                                                                SASARAN {{ $sasaran->nomor }}
                                                            </div>
                                                            <div style="width: 83%">
                                                                {{ $sasaran->sasaran }}
                                                            </div>
                                                            <div style="width: 5%; padding-left: 0;">
                                                                <button class="btn btn-sm btn-primary btn-add-indikator" value="{{ $sasaran->id }}" data-bs-toggle="modal" data-bs-target="#addIndikatorModal"><i class="fa-solid fa-plus-square"></i></button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="width: 10%"></td>
                                                    <td></td>
                                                    <td style="width: 10%"></td>
                                                    <td style="width: 10%"></td>
                                                </tr>
                                            @endif
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($sasaran->indikators as $indikator)
                                                <tr>
                                                    <td>
                                                        <div class="row mb-2 mt-2">
                                                            <div style="width: 5%; padding-right: 0;">
                                                                VISI
                                                            </div>
                                                            <div style="width: 95%">
                                                                {{ $visi->visi }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="row mb-2 mt-2">
                                                            <div style="width: 7%; padding-right: 0;">
                                                                MISI {{ $misi->nomor }}
                                                            </div>
                                                            <div style="width: 90%">
                                                                {{ $misi->misi }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="row mb-2 mt-2">
                                                            <div style="width: 10%; padding-right: 0;">
                                                                TUJUAN {{ $tujuan->nomor }}
                                                            </div>
                                                            <div style="width: 90%">
                                                                {{ $tujuan->tujuan }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="row mb-2 mt-2">
                                                            <div style="width: 12%; padding-right: 0; text-align:right">
                                                                SASARAN {{ $sasaran->nomor }}
                                                            </div>
                                                            <div style="width: 83%">
                                                                {{ $sasaran->sasaran }}
                                                            </div>
                                                            <div style="width: 5%; padding-left: 0;">
                                                                <button class="btn btn-sm btn-primary btn-add-indikator" value="{{ $sasaran->id }}" data-bs-toggle="modal" data-bs-target="#addIndikatorModal"><i class="fa-solid fa-plus-square"></i></button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="width: 20%">
                                                        <div class="row mt-2 mb-2">
                                                            <div style="width: 100%; text-align:right">
                                                                {{ $no++ }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="row mb-2 mt-2">
                                                            <div style="width: 100%; padding-right: 0;">
                                                                {{ $indikator->indikator }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="width: 10%">
                                                        <div class="row mt-2 mb-2">
                                                            <div style="width: 100%; text-align:right">
                                                                {{ $indikator->satuan }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="width: 10%">
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <button type="button" class="btn btn-sm btn-info btn-edit-indikator" value="{{ $indikator->id }}" data-bs-toggle="modal" data-bs-target="#editIndikatorModal"><i class="fa-solid fa-edit fa-lg"></i></button>
                                                            <form action="{{ route('rpjmd.indikator.destory') }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="aksi" value="destroy">
                                                                <input type="hidden" name="id" value="{{ $indikator->id }}">
                                                                <button type="submit" onclick="return confirm('Yakin ingin menghapus indikator ini?')" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash fa-lg"></i></button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
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

    @include('sccript')

    @include('rpjmd.modal-add.modal-add-rpjmd-indikator')
    @include('rpjmd.modal-edit.modal-edit-rpjmd-indikator')

    <script src="/asset/js/rpjmd_indikator.js"></script>
</x-app-layout>
