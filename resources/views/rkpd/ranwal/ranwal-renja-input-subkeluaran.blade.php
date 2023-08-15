<x-app-layout :apps="$apps">

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/rkpd/ranwal">OPD</a></li>
            <li class="breadcrumb-item"><a href="/rkpd/ranwal/opd/{{ $opd->id }}">Renja</a></li>
            <li class="breadcrumb-item active" aria-current="page">Input Sub Keluaran</li>
        </ol>
    </nav>

    <div class="row mb-5">
        <div class="col-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">FORM INPUT RENJA {{ $opd->nama_opd }} TAHUN {{ tahun() }}</span>
                </div>
                <form action="" method="post">
                    <div class="card-body">
                        @csrf
                        <input type="hidden" name="aksi" value="create">
                        <input type="hidden" name="opd" value="{{ $opd->id }}">
                        <input type="hidden" name="subkegiatan" value="{{ $subkegiatan->id }}">
                        <div class="row">
                            <div class="col-8">
                                <div class="mb-3">
                                    <label for="uraianSubkelInput" class="form-label">Uraian Sub Keluaran</label>
                                    <textarea name="uraian" class="form-control" id="uraianSubkelInput" placeholder="Sub Keluaran atau Nama Pekerjaan" rows="2">{{ old('uraian') }}</textarea>
                                    @error('uraian')
                                        <small class="text-danger"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="targetSubkelInput" class="form-label">Target</label>
                                            <input type="text" name="target" value="{{ old('target') }}" class="form-control" id="targetSubkelInput" placeholder="Target">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="satuanSubkelInput" class="form-label">Satuan</label>
                                            <input type="text" class="form-control" id="satuanSubkelInput" value="{{ $subkegiatan->satuan }}" placeholder="Satuan" disabled>
                                        </div>
                                    </div>
                                </div>
                                @error('target')
                                    <small class="text-danger"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="anggaranSubkelInput" class="form-label">Anggaran {{ tahun() }}</label>
                                    <input type="number" name="anggaran" value="{{ old('anggaran') }}" class="form-control" id="anggaranSubkelInput" placeholder="Rp. ">
                                    @error('anggaran')
                                        <small class="text-danger"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="sumberdanaSubkelInput" class="form-label">Sumber Dana</label>
                                    <select name="sumberdana" class="form-select select2-single" id="sumberdanaSubkelInput" data-placeholder="Pilih...">
                                        <option value="">Pilih...</option>
                                        @foreach ($opd->pagus as $sumberdana)
                                            <option value="{{ $sumberdana->id }}" {{ old('sumberdana') == $sumberdana->id ? 'selected' : '' }}>{{ $sumberdana->uraianpendapatan->uraian }}</option>
                                        @endforeach
                                    </select>
                                    @error('sumberdana')
                                        <small class="text-danger"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="lokasiSubkelInput" class="form-label">Lokasi Fokus</label>
                                    <input type="text" name="lokasi" value="{{ old('lokasi') }}" class="form-control" id="lokasiSubkelInput" placeholder="Lokasi">
                                    @error('lokasi')
                                        <small class="text-danger"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="anggaranMajuSubkelInput" class="form-label">Anggaran Maju {{ tahun() + 1 }}</label>
                                    <input type="number" name="anggaran_maju" value="{{ old('anggaran_maju') }}" class="form-control" id="anggaranMajuSubkelInput" placeholder="Rp. ">
                                    @error('anggaran_maju')
                                        <small class="text-danger"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <button class="btn btn-primary col-5 mx-auto">Simpan</button>
                            <button class="btn btn-secondary col-5 mx-auto">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('sccript')
    <script src="/asset/js/input_ranwal.js"></script>
</x-app-layout>
