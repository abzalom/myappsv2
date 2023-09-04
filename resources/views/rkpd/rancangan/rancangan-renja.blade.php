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

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/rancangan/rkpd">OPD</a></li>
            <li class="breadcrumb-item active" aria-current="page">Renja</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <span class="card-title text-uppercase">rancangan Renja {{ $opd->nama_opd }} tahun {{ $opd->tahun }}</span>
                </div>
                <div class="card-body">
                    <h5>{{ $opd->kode_opd . ' - ' . $opd->nama_opd }}</h5>
                    <table class="table table-sm table-bordered" style="width: 75%; font-size: 90%">
                        <thead>
                            <tr class="align-middle">
                                <th style="width: 18%">Kode</th>
                                <th>Sumber Dana</th>
                                <th class="text-center">Batasan Pagu</th>
                                <th class="text-center">Inputan Renja</th>
                                <th class="text-center">Sisa Anggaran</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @foreach ($infopagus as $pagu)
                                <tr>
                                    <td class="text-start">{{ $pagu->kode_unik_sumberdana }}</td>
                                    <td>{{ $pagu->sumberdana->uraian }}</td>
                                    <td class="text-end">{{ number_format($pagu->jumlah, 2, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($pagu->subkeluarans_sum_anggaran, 2, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($pagu->jumlah - $pagu->subkeluarans_sum_anggaran, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th class="text-end" colspan="2">Total Alokasi Pagu</th>
                                <th class="text-end">{{ number_format($opd->pagurancangans_sum_jumlah, 2, ',', '.') }}</th>
                                <th class="text-end">{{ number_format($opd->rancangansubkeluarans_sum_anggaran, 2, ',', '.') }}</th>
                                <th class="text-end">{{ number_format($opd->pagurancangans_sum_jumlah - $opd->rancangansubkeluarans_sum_anggaran, 2, ',', '.') }}</th>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mb-3 col">
                        <h5>Jadwal Tahapan Rancangan {!! countdownRkpd('rancangan', session()->get('tahun')) !!}</h5>
                    </div>
                    @if (lockRkpd('rancangan', session()->get('tahun')))
                        <div class="row mb-4">
                            <div class="col-2">
                                @can('input renja')
                                    <a href="/rancangan/rkpd/opd/{{ $opd->id }}/subkegiatan" class="btn btn-primary"><i class="fa-solid fa-plus-square fa-lg"></i> Sub Kegiatan</a>
                                @endcan
                            </div>
                            <div class="col-3">
                                <form action="/rancangan/rkpd/renja/opd/upload" id="formUploadRenja" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="file" id="fileRenja" onchange="document.getElementById('formUploadRenja').submit()" hidden>
                                    <input type="hidden" name="idopd" value="{{ $opd->id }}">
                                    <button type="button" class="btn btn-secondary" id="btnUploadRenja" onclick="document.getElementById('fileRenja').click()"><i class="fa-solid fa-upload"></i> Upload</button>
                                </form>
                            </div>
                            <div class="col-7 text-end">
                                <button class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#arsipSubkegiatanrancanganRenjaModal"><i class="fa-regular fa-folder-open"></i> Arsip Sub Kegiatan</button>
                                <button class="btn btn-secondary text-white" data-bs-toggle="modal" data-bs-target="#arsipSubkeluaranrancanganRenjaModal"><i class="fa-regular fa-folder-open"></i> Arsip Sub Keluaran</button>
                            </div>
                        </div>
                        @include('rkpd.rancangan.includes.rancangan-include-table-renja')
                    @else
                        @include('rkpd.rancangan.includes.rancangan-inlcude-table-renja-lock')
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- <script src="/asset/js/input_rancangan.js"></script> --}}
    @include('rkpd.rancangan.modal.rancangan-modal-arsip-renja-subkegiatan')
    @include('rkpd.rancangan.modal.rancangan-modal-arsip-renja-subkeluaran')
    @include('sccript')
</x-app-layout>
