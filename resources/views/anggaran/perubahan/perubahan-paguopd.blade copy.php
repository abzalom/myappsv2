<x-app-layout :apps="$apps">

    @if ($errors->any())
        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Manajement Pagu OPD</span>
                </div>
                <div class="card-body">
                    <h5 class="mb-3 text-center">Total Alokasi Pagu : {{ number_format($total, 2, ',', '.') }}</h5>
                    <div class="row mb-3">
                        <div class="col-6">
                            <form action="/perubahan/pagu/upload" method="post" id="formUploadPagu" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="file" id="filePagu" onchange="return getElementById('formUploadPagu').submit()" hidden>
                                <button type="button" class="btn btn-secondary" onclick="return getElementById('filePagu').click()"><i class="fa-regular fa-folder-open"></i> Upload</button>
                            </form>
                        </div>
                        <div class="col-6 text-end">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#arsipPaguOpdModal">
                                <i class="fa-regular fa-folder-open"></i> Arsip
                            </button>

                        </div>
                    </div>
                    <table class="table table-bordered table-hover table-striped">
                        <thead class="table-info align-middle">
                            <tr>
                                <th>Kode</th>
                                <th>Sumber Dana</th>
                                <th>Jumlah Pagu</th>
                                <th>Perubahan Jumlah Pagu</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @foreach ($opds as $opd)
                                @if (!$opd->paguperubahans->count())
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div style="width: 54%">
                                                    {{ $opd->kode_opd }} - {{ $opd->nama_opd }}
                                                </div>
                                                <div class="text-center" style="width: 18%; padding: 0px; margin: 0px">
                                                    Total Sebelum : <br> Rp. {{ number_format($opd->paguperubahans->sum('jumlah'), 2, ',', '.') }}
                                                </div>
                                                <div class="text-center" style="width: 18%; padding: 0px; margin: 0px">
                                                    Total Perubahan : <br> Rp. {{ number_format($opd->paguperubahans->sum('menjadi_jumlah'), 2, ',', '.') }}
                                                </div>
                                                <div class="text-center" style="width: 10%">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="button" class="btn btn-sm btn-primary btn-add-pagu-opd" value="{{ $opd->kode_opd }}" data-bs-toggle="modal" data-bs-target="#addPaguOpdModal"><i class="fa-solid fa-plus-square fa-lg"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        <td></td>
                                        <td class="text-end" style="width: 20%">
                                        </td>
                                        <td class="text-end" style="width: 20%">
                                        </td>
                                        <td class="text-center" style="width: 10%">
                                        </td>
                                    </tr>
                                @endif
                                @foreach ($opd->paguperubahans as $pagu)
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div style="width: 54%">
                                                    {{ $opd->kode_opd }} - {{ $opd->nama_opd }}
                                                </div>
                                                <div class="text-center" style="width: 18%; padding: 0px; margin: 0px">
                                                    Total Sebelum : <br> Rp. {{ number_format($opd->paguperubahans->sum('jumlah'), 2, ',', '.') }}
                                                </div>
                                                <div class="text-center" style="width: 18%; padding: 0px; margin: 0px">
                                                    Total Perubahan : <br> Rp. {{ number_format($opd->paguperubahans->sum('menjadi_jumlah'), 2, ',', '.') }}
                                                </div>
                                                <div class="text-center" style="width: 10%">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="button" class="btn btn-sm btn-primary btn-add-pagu-opd" value="{{ $opd->kode_opd }}" data-bs-toggle="modal" data-bs-target="#addPaguOpdModal"><i class="fa-solid fa-plus-square fa-lg"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $pagu->sumberdana->kode_sumberdana . ' - ' . $pagu->sumberdana->uraian }}</td>
                                        <td class="text-end" style="width: 20%">
                                            Rp. {{ number_format($pagu->jumlah, 2, ',', '.') }}
                                        </td>
                                        <td class="text-end" style="width: 20%">
                                            Rp. {{ number_format($pagu->menjadi_jumlah, 2, ',', '.') }}
                                        </td>
                                        <td class="text-center" style="width: 10%">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-sm btn-info btn-edit-pagu-opd" value="{{ $pagu->id }}" data-bs-toggle="modal" data-bs-target="#editPaguOpdModal"><i class="fa-solid fa-edit fa-lg"></i></button>
                                                <form action="/perubahan/pagu/destroy" method="post">
                                                    @csrf
                                                    <input type="hidden" name="idpagu" value="{{ $pagu->id }}">
                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash fa-lg"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="/asset/js/perubahan/pagu_opd_perubahan.js"></script>
    @include('anggaran.perubahan.modal.perubahan-modal-add-pagu-opd')
    @include('anggaran.perubahan.modal.perubahan-modal-edit-pagu-opd')
    @include('anggaran.perubahan.modal.perubahan-modal-restore-pagu-opd')
    @include('sccript')
</x-app-layout>
