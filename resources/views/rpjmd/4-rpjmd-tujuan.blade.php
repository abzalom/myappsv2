<x-app-layout :apps="$apps">
    <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/rpjmd/periode">Periode</a></li>
            <li class="breadcrumb-item"><a href="/rpjmd/visi">Visi</a></li>
            <li class="breadcrumb-item"><a href="/rpjmd/misi">Misi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tujuan</li>
            <li class="breadcrumb-item"><a href="/rpjmd/sasaran">Sasaran</a></li>
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
                    <span class="card-title">Tujuan RPJMD Periode {{ $periode->awal . ' - ' . $periode->akhir }}</span>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover datatables-tujuan">
                        <thead class="table-dark">
                            <tr>
                                <td>Visi</td>
                                <td>Misi</td>
                                <td>Nomor</td>
                                <td>Tujuan</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($periode->visis as $visi)
                                @foreach ($visi->misis as $misi)
                                    @if (!$misi->tujuans->count())
                                        <tr>
                                            <td>VISI : {{ $visi->visi }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-1">
                                                        MISI {{ $misi->nomor }}
                                                    </div>
                                                    <div class="col-sm-10">
                                                        {{ str($misi->misi)->title() }}
                                                    </div>
                                                    <div class="col-sm-1 text-center">
                                                        <button class="btn btn-sm btn-primary btn-add-tujuan" data-nomisi="{{ $misi->nomor }}" data-visi="{{ $misi->rpjmd_visi_id }}" data-misi="{{ $misi->id }}" data-bs-toggle="modal" data-bs-target="#addTujuanModal"><i class="fa-solid fa-plus-square fa-lg"></i></button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endif
                                    @foreach ($misi->tujuans as $tujuan)
                                        <tr>
                                            <td>VISI : {{ $visi->visi }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-1">
                                                        MISI {{ $misi->nomor }}
                                                    </div>
                                                    <div class="col-sm-10">
                                                        {{ str($misi->misi)->title() }}
                                                    </div>
                                                    <div class="col-sm-1 text-center">
                                                        <button class="btn btn-sm btn-primary btn-add-tujuan" data-nomisi="{{ $misi->nomor }}" data-visi="{{ $misi->rpjmd_visi_id }}" data-misi="{{ $misi->id }}" data-bs-toggle="modal" data-bs-target="#addTujuanModal"><i class="fa-solid fa-plus-square fa-lg"></i></button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end">{{ $tujuan->nomor }}</td>
                                            <td class="text-justify">{{ $tujuan->tujuan }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-sm btn-info btn-edit-tujuan" value="{{ $tujuan->id }}" data-bs-toggle="modal" data-bs-target="#editTujuanModal"><i class="fa-solid fa-edit fa-lg"></i></button>
                                                    <form action="{{ route('rpjmd.tujuan.destory') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="tujuanid" value="{{ $tujuan->id }}">
                                                        <button type="submit" onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash fa-lg"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    <div class="table-responsive">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('sccript')

    @include('rpjmd.modal-add.modal-add-rpjmd-tujuan')
    @include('rpjmd.modal-edit.modal-edit-rpjmd-tujuan')

    <script src="/asset/js/rpjmd_tujuan.js"></script>
</x-app-layout>
