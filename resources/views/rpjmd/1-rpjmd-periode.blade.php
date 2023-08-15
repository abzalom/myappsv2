<x-app-layout :apps="$apps">
    <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Periode</li>
            <li class="breadcrumb-item"><a href="/rpjmd/visi">Visi</a></li>
            <li class="breadcrumb-item"><a href="/rpjmd/misi">Misi</a></li>
            <li class="breadcrumb-item"><a href="/rpjmd/tujuan">Tujuan</a></li>
            <li class="breadcrumb-item"><a href="/rpjmd/sasaran">Sasaran</a></li>
            <li class="breadcrumb-item"><a href="/rpjmd/program">Program</a></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-4">
            <div class="card mb-4">
                <div class="card-header {{ $edit ? 'bg-warning' : 'bg-primary text-white' }}">
                    Form Input Periode
                </div>
                <div class="card-body">
                    <form action="{{ $edit ? route('rpjmd.periode.update') : '' }}" method="post" autocomplete="off">
                        @csrf
                        @if ($edit)
                            <input type="hidden" name="id" value="{{ $edit->id }}">
                        @endif
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="periodeAwalInput" class="form-label">Tahun Awal</label>
                                    <input type="number" name="awal" value="{{ $edit ? $edit->awal : old('awal') }}" class="form-control" id="periodeAwalInput" placeholder="contoh: {{ now()->format('Y') }}">
                                    @error('awal')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="periodeAkhirInput" class="form-label">Tahun Akhir</label>
                                    <input type="number" name="akhir" value="{{ $edit ? $edit->akhir : old('akhir') }}" class="form-control" id="periodeAkhirInput" placeholder="contoh: {{ now()->format('Y') + 5 }}">
                                    @error('akhir')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="kdhInput" class="form-label">Nama Kepala Daerah (<small class="fst-italic text-muted">wajib isi</small>)</label>
                            <input type="text" name="kdh" value="{{ $edit ? $edit->kdh : old('kdh') }}" class="form-control" id="kdhInput" placeholder="Kepala Daerah">
                            @error('kdh')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="wkdhInput" class="form-label">Nama Wakil Kepala Daerah (<small class="fst-italic text-muted">wajib isi</small>)</label>
                            <input type="text" name="wkdh" value="{{ $edit ? $edit->wkdh : old('wkdh') }}" class="form-control" id="wkdhInput" placeholder="Wakil Kepala Daerah">
                            @error('wkdh')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- <div class="mb-3">
                            <label for="pjInput" class="form-label">Nama Pejabat Sementara (<small class="fst-italic text-muted">bisa dikosongkan</small>)</label>
                            <input type="text" name="pj" class="form-control" id="pjInput" placeholder="Pejabat Sementara">
                        </div>
                        <div class="mb-3">
                            <label for="sekdaInput" class="form-label">Nama Sekretaris Daerah (<small class="fst-italic text-muted">wajib isi</small>)</label>
                            <input type="text" name="sekda" class="form-control" id="sekdaInput" placeholder="Pejabat Sementara">
                        </div> --}}
                        @if ($edit)
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="{{ route('rpjmd.periode') }}" class="btn btn-secondary w-100">Batal</a>
                                </div>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary w-100">Update</button>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <button type="submit" class="btn btn-primary w-100">Simpan</button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <div class="col-8">
            <div class="card">
                <div class="card-header bg-info">
                    Periode Jabatan Kepala Daerah
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-stripped datatables" style="width: 120%;font-size:90%">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Periode</th>
                                    <th>Kepala Daerah</th>
                                    <th>Wakil Kepala Daerah</th>
                                    <th>Sekretaris Daerah</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($periodes as $periode)
                                    <tr>
                                        <td style="width: 5%">{{ $no++ }}</td>
                                        <td style="width: 15%">{{ $periode->awal . ' - ' . $periode->akhir }}</td>
                                        <td style="width: 20%">{{ str($periode->kdh)->upper() }}</td>
                                        <td style="width: 20%">{{ str($periode->wkdh)->upper() }}</td>
                                        <td style="width: 20%">
                                            @if ($sekda)
                                                {{ str($sekda->nama)->upper() }}
                                            @else
                                                <a href="{{ route('man.pejabat.sekda') }}">Tambahkan</a>
                                            @endif
                                        </td>
                                        <td style="width: 5%">
                                            @if ($periode->active)
                                                <i class="fa-solid fa-circle-check fa-xl text-primary"></i>
                                            @else
                                                <i class="fa-solid fa-circle-xmark fa-xl text-danger"></i>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                @if (!$periode->active)
                                                    <form action="{{ route('rpjmd.periode.active') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="periode_id" value="{{ $periode->id }}">
                                                        <button type="submit" class="btn btn-sm btn-success"><i class="fa-solid fa-lock-open"></i></button>
                                                    </form>
                                                @endif
                                                <a href="?edit={{ $periode->id }}" class="btn btn-sm btn-info"><i class="fa-solid fa-edit"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('sccript')
    <script src="/asset/js/olahdata.js"></script>
</x-app-layout>
