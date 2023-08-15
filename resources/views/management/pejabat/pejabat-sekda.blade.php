<x-app-layout :apps="$apps">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header {{ $edit ? 'bg-warning' : 'bg-primary text-white' }}">
                    <span class="card-title">Form Input Pejabat Sekda</span>
                </div>
                <div class="card-body">
                    <form action="{{ $edit ? route('man.pejabat.sekda.update') : '' }}" method="post">
                        @if ($edit)
                            <input type="hidden" name="id" value="{{ $edit->id }}">
                        @endif
                        @csrf
                        <div class="row">
                            <div class="mb-3">
                                <label for="namaPejabatSekdaInput" class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" value="{{ $edit ? $edit->nama : old('nama') }}" class="form-control" id="namaPejabatSekdaInput" placeholder="Nama Lengkap Pejabat Sekda">
                                @error('nama')
                                    <small class="text-danger fw-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nipPejabatSekdaInput" class="form-label">NIP</label>
                                <input type="number" name="nip" value="{{ $edit ? $edit->nip : old('nip') }}" class="form-control" id="nipPejabatSekdaInput" placeholder="contoh : {{ now()->format('Y') - 50 . now()->format('md') . '' . now()->format('Y') - 25 . now()->format('m') . '1001' }}">
                                @error('nip')
                                    <small class="text-danger fw-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="pangkatPejabatSekdaInput" class="form-label">Pangkat</label>
                                <select name="pangkat" id="pangkatPejabatSekdaInput" class="form-select select2-single" data-placeholder="Pilih...">
                                    <option value=""></option>
                                    @foreach ($pangkats as $pangkat)
                                        <option value="{{ $pangkat->id }}" {{ $edit ? ($edit->pangkat->id == $pangkat->id ? 'selected' : '') : (old('pangkat') == $pangkat->id ? 'selected' : '') }}>{{ str($pangkat->pangkat)->title() . ' (' . $pangkat->golongan . ')' }}</option>
                                    @endforeach
                                </select>
                                @error('pangkat')
                                    <small class="text-danger fw-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tahunPejabatSekdaInput" class="form-label">Tahun</label>
                                <input type="text" name="tahun" value="{{ $edit ? $edit->tahun : old('tahun') }}" class="form-control" id="tahunPejabatSekdaInput" placeholder="Tahun Menjabat">
                                @error('tahun')
                                    <small class="text-danger fw-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-outline-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-8">
            <div class="card">
                <div class="card-header bg-info">
                    <span class="card-title">
                        Daftar Pejabat Sekda
                    </span>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped datatables">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Nama / NIP / Pangkat</th>
                                <th>Status</th>
                                <th>Tahun</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($sekdas as $sekda)
                                <tr class="align-middle">
                                    <td class="text-center" style="width: 5%">{{ $no++ }}</td>
                                    <td>
                                        {{ str($sekda->nama)->upper() }}
                                        <br>
                                        NIP. {{ $sekda->nip }}
                                        <br>
                                        {{ str($sekda->pangkat->pangkat . ' ' . $sekda->pangkat->golongan)->upper() }}
                                    </td>
                                    <td class="text-center" style="width: 10%">
                                        @if ($sekda->active)
                                            <i class="fa-solid fa-circle-check fa-xl text-primary"></i>
                                        @else
                                            <i class="fa-solid fa-circle-xmark fa-xl text-danger"></i>
                                        @endif
                                    </td>
                                    <td class="text-center" style="width: 10%">{{ $sekda->tahun }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            @if (!$sekda->active)
                                                <form action="{{ route('man.pejabat.sekda.active') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="status" value="active">
                                                    <input type="hidden" name="sekda" value="{{ $sekda->id }}">
                                                    <button type="submit" class="btn btn-sm btn-success" title="aktifkan"><i class="fa-solid fa-lock-open"></i></button>
                                                </form>
                                            @endif
                                            <a href="?edit={{ $sekda->id }}" class="btn btn-sm btn-warning" title="edit"><i class="fa-solid fa-edit"></i></a>
                                            {{-- <button type="button" class="btn btn-sm btn-danger" title="hapus"><i class="fa-solid fa-trash"></i></button> --}}
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

    @include('sccript')
</x-app-layout>
