<x-app-layout :apps="$apps">

    <style>
        li .select2-search--inline {
            height: 0px !important;
        }
    </style>

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
                    <div class="row mb-5">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-3">
                                    <form action="/perubahan/pagu/upload" method="post" id="formUploadPagu" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="file" id="filePagu" onchange="return getElementById('formUploadPagu').submit()" hidden>
                                        <button type="button" class="btn btn-secondary" onclick="return getElementById('filePagu').click()"><i class="fa-regular fa-folder-open"></i> Upload</button>
                                    </form>
                                </div>
                                <div class="col-6">
                                </div>
                            </div>
                        </div>
                        <div class="col-6 text-end">
                            <!-- Button trigger modal -->
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#arsipPaguOpdModal">
                                    <i class="fa-regular fa-folder-open"></i> Arsip
                                </button>
                                <form action="/perubahan/pagu/cetak" method="get" target="blank">
                                    @if (request()->filter)
                                        @foreach (request()->filter as $print)
                                            <input type="hidden" name="filter[]" value="{{ $print }}">
                                        @endforeach
                                    @endif
                                    <button type="submit" class="btn btn-secondary btn-group-form-last"><i class="fa-solid fa-print"></i> Cetak</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <form action="" method="get">
                        <div class="row mb-3 mt-4">
                            <div class="col-10">
                                <select class="form-select select2-multiple" name="filter[]" data-placeholder="Filter per sumber dana" multiple>
                                    @foreach ($filters as $filter)
                                        @if (request()->filter)
                                            @if (in_array($filter->kode_unik, request()->filter))
                                                <option value="{{ $filter->kode_unik }}" selected>{{ $filter->uraian }}</option>
                                            @else
                                                <option value="{{ $filter->kode_unik }}">{{ $filter->uraian }}</option>
                                            @endif
                                        @else
                                            <option value="{{ $filter->kode_unik }}">{{ $filter->uraian }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-outline-primary" type="button">Filter</button>
                                <a href="/perubahan/pagu" class="btn btn-outline-danger" type="button">Bersihkan</a>
                            </div>
                        </div>
                    </form>
                    @if (request()->filter)
                        <div class="row mb-3">
                            <h6 class="text-muted">Total Filter : {{ number_format($totalfilter, 2, ',', '.') }}</h6>
                        </div>
                    @endif

                </div>
                <table class="table table-bordered table-hover table-striped">
                    <thead class="table-info align-middle">
                        <tr>
                            <th>Kode</th>
                            <th>Uraian</th>
                            <th>Jumlah Pagu</th>
                            <th>Perubahan Jumlah Pagu</th>
                            <th>Bertambah / Berkurang</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($opds as $opd)
                            <tr class="fw-bold">
                                <td>{{ $opd->kode_opd }}</td>
                                <td>{{ $opd->nama_opd }}</td>
                                <td>{{ number_format($opd->paguperubahans->sum('jumlah'), 2, ',', '.') }}</td>
                                <td>{{ number_format($opd->paguperubahans->sum('menjadi_jumlah'), 2, ',', '.') }}</td>
                                <td>{{ number_format($opd->paguperubahans->sum('menjadi_jumlah') - $opd->paguperubahans->sum('jumlah'), 2, ',', '.') }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-sm btn-primary btn-add-pagu-opd" value="{{ $opd->kode_opd }}" data-bs-toggle="modal" data-bs-target="#addPaguOpdModal"><i class="fa-solid fa-plus-square fa-lg"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @foreach ($opd->paguperubahans as $pagu)
                                <tr>
                                    <td>{{ $pagu->kode_sumberdana }}</td>
                                    <td>{{ $pagu->sumberdana->uraian }}</td>
                                    <td>{{ number_format($pagu->jumlah, 2, ',', '.') }}</td>
                                    <td>{{ number_format($pagu->menjadi_jumlah, 2, ',', '.') }}</td>
                                    <td>{{ number_format($pagu->menjadi_jumlah - $pagu->jumlah, 2, ',', '.') }}</td>
                                    <td class="text-center">
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
