<x-app-layout :apps="$apps">
    <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/rpjmd/periode">Periode</a></li>
            <li class="breadcrumb-item"><a href="/rpjmd/visi">Visi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Misi</li>
            <li class="breadcrumb-item"><a href="/rpjmd/tujuan">Tujuan</a></li>
            <li class="breadcrumb-item"><a href="/rpjmd/sasaran">Sasaran</a></li>
            <li class="breadcrumb-item"><a href="/rpjmd/indikator">Indikator</a></li>
            <li class="breadcrumb-item"><a href="/rpjmd/program">Program</a></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header {{ $edit ? 'bg-warning' : '' }}">
                    <span class="card-title">
                        Input Misi RPJMD Periode {{ $periode->awal . ' - ' . $periode->akhir }}
                    </span>
                </div>
                <div class="card-body">
                    <form action="{{ $edit ? route('rpjmd.misi.update') : '' }}" method="post">
                        @csrf
                        <input type="hidden" name="periode_id" value="{{ $periode->id }}">
                        @if ($edit)
                            <input type="hidden" name="misi_id" value="{{ $edit->id }}">
                        @endif
                        <div class="mb-3">
                            <label for="visiSelectInput" class="form-label">Visi Kepala Daerah</label>
                            <select name="visi" class="form-select select2-single" id="visiSelectInput" data-placeholder="Pilih...">
                                <option value=""></option>
                                @foreach ($periode->visis as $visiselect)
                                    <option value="{{ $visiselect->id }}" {{ $edit ? ($edit->rpjmd_visi_id == $visiselect->id ? 'selected' : '') : (old('visi') == $visiselect->id ? 'selected' : '') }}>{{ $visiselect->visi }}</option>
                                @endforeach
                            </select>
                            @error('visi')
                                <small class="text-danger fsw-bold">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="rpjmdNomorMisiInput" class="form-label">Nomor Urut Misi</label>
                            <input type="number" name="nomor" value="{{ $edit ? $edit->nomor : old('nomor') }}" class="form-control @error('nomor') is-invalid @enderror" id="rpjmdNomorMisiInput" placeholder="No" style="width: 30%">
                            @error('nomor')
                                <small class="text-danger fsw-bold">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="rpjmdMisiInput" class="form-label">Misi Kepala Daerah</label>
                            <textarea name="misi" class="form-control @error('misi') is-invalid @enderror" id="rpjmdMisiInput" placeholder="Misi kepala daerah" rows="4">{{ $edit ? $edit->misi : old('misi') }}</textarea>
                            @error('misi')
                                <small class="text-danger fsw-bold">{{ $message }}</small>
                            @enderror
                        </div>
                        @if ($edit)
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="{{ route('rpjmd.misi') }}" class="btn btn-secondary w-100">Batal</a>
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
                <div class="card-header">
                    <span class="card-title">Misi RPJMD Periode {{ $periode->awal . ' - ' . $periode->akhir }}</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover datatables-misi" style="width: 100%">
                            <thead class="table-dark">
                                <tr>
                                    <th>Visi</th>
                                    <th>#</th>
                                    <th>Misi</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($periode->visis as $visi)
                                    @foreach ($visi->misis as $misi)
                                        <tr>
                                            <td>VISI : {{ str($visi->visi)->upper() }}</td>
                                            <td class="text-center" style="width: 15%">MISI KE {{ $misi->nomor }}</td>
                                            <td class="text-justify" style="text-align: justify">{{ $misi->misi }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="?edit={{ $misi->id }}" class="btn btn-sm btn-info"><i class="fa-solid fa-edit fa-lg"></i></a>
                                                    <form action="{{ route('rpjmd.misi.destory') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $misi->id }}">
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
    </div>

    @include('sccript')
    <script src="/asset/js/rpjmd_misi.js"></script>
</x-app-layout>
