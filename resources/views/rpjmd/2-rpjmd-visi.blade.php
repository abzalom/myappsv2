<x-app-layout :apps="$apps">
    <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/rpjmd/periode">Periode</a></li>
            <li class="breadcrumb-item active" aria-current="page">Visi</li>
            <li class="breadcrumb-item"><a href="/rpjmd/misi">Misi</a></li>
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
                        Input Visi RPJMD Periode {{ $periode->awal . ' - ' . $periode->akhir }}
                    </span>
                </div>
                <div class="card-body">
                    <form action="{{ $edit ? route('rpjmd.visi.update') : '' }}" method="post">
                        @csrf
                        <input type="hidden" name="periode_id" value="{{ $periode->id }}">
                        @if ($edit)
                            <input type="hidden" name="visi_id" value="{{ $edit->id }}">
                        @endif
                        <div class="mb-3">
                            <label for="rpjmdVisiInput" class="form-label">Visi Kepala Daerah</label>
                            <input type="text" name="visi" value="{{ $edit ? $edit->visi : old('visi') }}" class="form-control @error('visi')is-invalid @enderror" id="rpjmdVisiInput" placeholder="Visi kepala daerah">
                            @error('visi')
                                <small class="text-danger fsw-bold">{{ $message }}</small>
                            @enderror
                        </div>
                        @if ($edit)
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="{{ route('rpjmd.visi') }}" class="btn btn-secondary w-100">Batal</a>
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
                    <span class="card-title">
                        Visi RPJMD Periode {{ $periode->awal . ' - ' . $periode->akhir }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Visi</th>
                                    <th>Periode</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($periode->visis as $visi)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ str($visi->visi)->upper() }}</td>
                                        <td>{{ $periode->awal . ' - ' . $periode->akhir }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="?edit={{ $visi->id }}" class="btn btn-sm btn-info"><i class="fa-solid fa-edit fa-lg"></i></a>
                                                <form action="{{ route('rpjmd.visi.destory') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $visi->id }}">
                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash fa-lg"></i></button>
                                                </form>
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
</x-app-layout>
