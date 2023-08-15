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
                    <div class="row">
                        <div class="col-6"></div>
                        <div class="col-6 text-end">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#arsipPaguOpdModal">
                                <i class="fa-regular fa-folder-open"></i> Arsip
                            </button>

                        </div>
                    </div>
                    <table class="table table-bordered table-hover table-striped datatables-pagu">
                        <thead class="table-info">
                            <tr>
                                <th></th>
                                <th>Sumber Dana</th>
                                <th>Jumlah Pagu</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @foreach ($opds as $opd)
                                @if (!$opd->pagus->count())
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div style="width: 65%">
                                                    {{ $opd->kode_opd }} - {{ $opd->nama_opd }}
                                                </div>
                                                <div style="width: 25%">
                                                    Total : Rp. {{ number_format($opd->pagus->sum('jumlah'), 2, ',', '.') }}
                                                </div>
                                                <div class="text-center" style="width: 10%">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="button" class="btn btn-sm btn-primary btn-add-pagu-opd" value="{{ $opd->kode_opd }}" data-bs-toggle="modal" data-bs-target="#addPaguOpdModal"><i class="fa-solid fa-plus-square fa-lg"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td></td>
                                        <td class="text-end" style="width: 20%">
                                        </td>
                                        <td class="text-center" style="width: 10%">
                                        </td>
                                    </tr>
                                @endif
                                @foreach ($opd->pagus as $pagu)
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div style="width: 65%">
                                                    {{ $opd->kode_opd }} - {{ $opd->nama_opd }}
                                                </div>
                                                <div style="width: 25%">
                                                    Total : Rp. {{ number_format($opd->pagus->sum('jumlah'), 2, ',', '.') }}
                                                </div>
                                                <div class="text-center" style="width: 10%">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="button" class="btn btn-sm btn-primary btn-add-pagu-opd" value="{{ $opd->kode_opd }}" data-bs-toggle="modal" data-bs-target="#addPaguOpdModal"><i class="fa-solid fa-plus-square fa-lg"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $pagu->uraianpendapatan->uraian }}</td>
                                        <td class="text-end" style="width: 20%">
                                            Rp. {{ number_format($pagu->jumlah, 2, ',', '.') }}
                                        </td>
                                        <td class="text-center" style="width: 10%">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-sm btn-info btn-edit-pagu-opd" value="{{ $pagu->id }}" data-bs-toggle="modal" data-bs-target="#editPaguOpdModal"><i class="fa-solid fa-edit fa-lg"></i></button>
                                                <form action="/management/pagu/destroy" method="post">
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

    <script src="/asset/js/pagu_opd.js"></script>
    @include('anggaran.ranwal.modal.modal-add-pagu-opd')
    @include('anggaran.ranwal.modal.modal-edit-pagu-opd')
    @include('anggaran.ranwal.modal.modal-restore-pagu-opd')
    @include('sccript')
</x-app-layout>
