<x-app-layout :apps="$apps">
    <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/rpjmd/periode">Periode</a></li>
            <li class="breadcrumb-item"><a href="/rpjmd/visi">Visi</a></li>
            <li class="breadcrumb-item"><a href="/rpjmd/misi">Misi</a></li>
            <li class="breadcrumb-item"><a href="/rpjmd/tujuan">Tujuan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sasaran</li>
            <li class="breadcrumb-item"><a href="/rpjmd/indikator">Indikator</a></li>
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
                    <span class="card-title">Sasaran RPJMD Periode 2021 - 2026</span>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover datatables-sasaran" style="width: 100%">
                        <thead class="table-dark">
                            <tr>
                                <th>VISI</th>
                                <th>MISI</th>
                                <th>TUJUAN</th>
                                <th>NOMOR</th>
                                <th>SASARAN</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($periode->visis as $visi)
                                @foreach ($visi->misis as $misi)
                                    @foreach ($misi->tujuans as $tujuan)
                                        @if (!$tujuan->sasarans->count())
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
                                                        <div style="width: 85%">
                                                            {{ $tujuan->tujuan }}
                                                        </div>
                                                        <div style="width: 5%; padding-left: 0;">
                                                            <button class="btn btn-sm btn-primary btn-add-sasaran" data-misinomor="{{ $misi->nomor }}" data-tujuannomor="{{ $tujuan->nomor }}" data-visi="{{ $visi->id }}" data-misi="{{ $misi->id }}" data-tujuan="{{ $tujuan->id }}" data-bs-toggle="modal" data-bs-target="#addSasaranModal"><i class="fa-solid fa-plus-square"></i></button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="width: 10%"></td>
                                                <td></td>
                                                <td style="width: 10%"></td>
                                            </tr>
                                        @endif
                                        @foreach ($tujuan->sasarans as $sasaran)
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
                                                        <div style="width: 85%">
                                                            {{ $tujuan->tujuan }}
                                                        </div>
                                                        <div style="width: 5%; padding-left: 0;">
                                                            <button class="btn btn-sm btn-primary btn-add-sasaran" data-misinomor="{{ $misi->nomor }}" data-tujuannomor="{{ $tujuan->nomor }}" data-visi="{{ $visi->id }}" data-misi="{{ $misi->id }}" data-tujuan="{{ $tujuan->id }}" data-bs-toggle="modal" data-bs-target="#addSasaranModal"><i class="fa-solid fa-plus-square"></i></button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end" style="width: 17%">
                                                    <div class="mb-2 mt-2">
                                                        SASARAN {{ $sasaran->nomor }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mb-2 mt-2">
                                                        {{ $sasaran->sasaran }}
                                                    </div>
                                                </td>
                                                <td style="width: 10%;text-align:center;">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="button" class="btn btn-sm btn-info btn-edit-sasaran" value="{{ $sasaran->id }}" data-bs-toggle="modal" data-bs-target="#editSasaranModal"><i class="fa-solid fa-edit"></i></button>
                                                        <button type="button" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
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

    @include('rpjmd.modal-add.modal-add-rpjmd-sasaran')
    @include('rpjmd.modal-edit.modal-edit-rpjmd-sasaran')

    <script src="/asset/js/rpjmd_sasaran.js"></script>
</x-app-layout>
