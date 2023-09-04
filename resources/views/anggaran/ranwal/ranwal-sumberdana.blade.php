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
                    <span class="card-title">Sumber Pendanaan Tahun {{ session()->get('tahun') }}</span>
                </div>
                <div class="card-body">
                    <h5 class="mb-4">
                        Total Sumber Pendanaan : {{ number_format($total, 2, ',', '.') }}
                    </h5>
                    <div class="row mb-4">
                        <div class="col-6 text-start">
                            <a href="/ranwal/sumberdana/form" class="btn btn-primary"><i class="fa-solid fa-plus-square"></i> Input Sumber Dana</a>
                        </div>
                        <div class="col-6 text-end">
                            <button class="btn btn-secondary me-3" data-bs-toggle="modal" data-bs-target="#arsipSumberDanaRanwalModal"><i class="fa-solid fa-folder-open"></i> Arsip</button>
                            <a href="/ranwal/sumberdana/cetak" class="btn btn-info" target="_blank"><i class="fa-solid fa-print"></i> Cetak</a>
                        </div>
                    </div>
                    <table class="table table-bordered table-stripped table-hover datatables-sumbedana">
                        <thead class="table-info">
                            <tr>
                                <th></th>
                                <th>Kode</th>
                                <th>Akun / Uraian</th>
                                <th>Anggaran</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sumberdanas as $sumberdana)
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($sumberdana->ranwals as $ranwal)
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div style="width: 70%">
                                                    Akun {{ $sumberdana->kode . ' - ' . $sumberdana->uraian }}
                                                </div>
                                                <div style="width: 20%;text-align:end">
                                                    {{ number_format($sumberdana->ranwals_sum_jumlah, 2, ',', '.') }}
                                                </div>
                                                <div style="width: 10%;text-align:left">
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $ranwal->kode_unik }}</td>
                                        <td style="width: 70%">{{ $ranwal->uraian }}</td>
                                        <td style="width: 20%; text-align: right">{{ number_format($ranwal->jumlah, 2, ',', '.') }}</td>
                                        <td style="width: 10%; text-align: center">
                                            <div class="btn-group" role="group">
                                                <a href="/ranwal/sumberdana/form?edit={{ $ranwal->id }}" class="btn btn-sm btn-info"><i class="fa-solid fa-edit"></i></a>
                                                @if ($ranwal->paguranwals->count() == 0)
                                                    <form action="/ranwal/sumberdana/destroy" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $ranwal->id }}">
                                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                                                    </form>
                                                @endif
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

    @include('anggaran.ranwal.modal.ranwal-modal-arsip-sumberdana')
    <script src="/asset/js/sumberdana.js"></script>
    @include('sccript')
</x-app-layout>
