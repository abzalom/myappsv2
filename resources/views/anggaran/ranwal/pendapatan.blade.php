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
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Ranwal Pendapatan Tahun Anggaran {{ tahun() }}</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <!-- Add Pendapatan Button -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPendapatanModal">
                                <i class="fa-solid fa-plus-square fa-lg"></i> Tambah Pendapatan
                            </button>
                        </div>
                        <div class="col-6 text-end">
                            <button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#arsipPendapatanModal">
                                <i class="fa-regular fa-folder-open"></i></i> Arsip
                            </button>
                        </div>
                    </div>
                    <div class="table-reponsive mt-4">
                        <table class="table table-bordered table-hover table-striped">
                            <thead class="table-info">
                                <tr class="text-center">
                                    <th>Kode</th>
                                    <th>Uraian</th>
                                    <th>Jumlah (Rp.)</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($akun)
                                    <tr>
                                        <th>{{ $akun->kode_akun }}</th>
                                        <th>{{ $akun->uraian }}</th>
                                        <th class="text-end">{{ number_format($akun->uraians->sum('jumlah'), 2, ',', '.') }}</th>
                                        <th></th>
                                    </tr>
                                    @foreach ($akun->kelompoks as $kelompok)
                                        <tr>
                                            <th>{{ $kelompok->kode_kelompok }}</th>
                                            <th>{{ $kelompok->uraian }}</th>
                                            <th class="text-end">{{ number_format($kelompok->uraians->sum('jumlah'), 2, ',', '.') }}</th>
                                            <th></th>
                                        </tr>
                                        @foreach ($kelompok->jenises as $jenis)
                                            <tr>
                                                <th>{{ $jenis->kode_jenis }}</th>
                                                <th>{{ $jenis->uraian }}</th>
                                                <th class="text-end">{{ number_format($jenis->uraians->sum('jumlah'), 2, ',', '.') }}</th>
                                                <th></th>
                                            </tr>
                                            @foreach ($jenis->objeks as $objek)
                                                <tr>
                                                    <th>{{ $objek->kode_objek }}</th>
                                                    <th>{{ $objek->uraian }}</th>
                                                    <th class="text-end">{{ number_format($objek->uraians->sum('jumlah'), 2, ',', '.') }}</th>
                                                    <th></th>
                                                </tr>
                                                @foreach ($objek->rincians as $rincian)
                                                    <tr>
                                                        <th>{{ $rincian->kode_rincian }}</th>
                                                        <th>{{ $rincian->uraian }}</th>
                                                        <th class="text-end">{{ number_format($rincian->uraians->sum('jumlah'), 2, ',', '.') }}</th>
                                                        <th></th>
                                                    </tr>
                                                    @foreach ($rincian->subrincians as $subrincian)
                                                        <tr>
                                                            <th>{{ $subrincian->kode_subrincian }}</th>
                                                            <th>{{ $subrincian->uraian }}</th>
                                                            <th class="text-end">{{ number_format($subrincian->uraians->sum('jumlah'), 2, ',', '.') }}</th>
                                                            <th></th>
                                                        </tr>
                                                        @foreach ($subrincian->uraians as $uraian)
                                                            <tr class="fst-italic">
                                                                <td>{{ $uraian->kode_uraian }}</td>
                                                                <td>{{ $uraian->uraian }}</td>
                                                                <td class="text-end">{{ number_format($uraian->jumlah, 2, ',', '.') }}</td>
                                                                <td class="text-center" style="width: 5%">
                                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                                        <button type="button" class="btn btn-sm btn-info btn-edit-pendapatan-uraian" value="{{ $uraian->id }}" data-bs-toggle="modal" data-bs-target="#editPendapatanModal"><i class="fa-solid fa-edit"></i></button>
                                                                        @if (!$uraian->pagus->count())
                                                                            <form action="/management/pendapatan/ranwal/destroy" method="post">
                                                                                @csrf
                                                                                <input type="hidden" name="id" value="{{ $uraian->id }}">
                                                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                                                                            </form>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    @endforeach

                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('anggaran.ranwal.modal.modal-add-pendapatan')
    @include('anggaran.ranwal.modal.modal-edit-pendapatan')
    @include('anggaran.ranwal.modal.modal-arsip-pendapatan')
    @include('sccript')
    <script src="/asset/js/pendapatan_ranwal.js"></script>

</x-app-layout>
