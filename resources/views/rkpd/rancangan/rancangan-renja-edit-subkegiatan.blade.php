<x-app-layout :apps="$apps">

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/rancangan/rkpd">OPD</a></li>
            <li class="breadcrumb-item"><a href="/rancangan/rkpd/opd/{{ $opd->id }}">Renja</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Sub Kegiatan : {{ $subkegiatan->uraian }}</li>
        </ol>
    </nav>

    <div class="row mb-5">
        <div class="col-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">FORM INPUT RENJA {{ $opd->nama_opd }} TAHUN {{ tahun() }}</span>
                </div>
                <div class="card-body">
                    <form action="/rancangan/rkpd/opd/{{ $opd->id }}/subkegiatan/update" method="post">
                        @csrf
                        <input type="hidden" name="aksi" value="update">
                        <input type="hidden" name="opd" value="{{ $opd->kode_opd }}">
                        <input type="hidden" name="subkegiatan" value="{{ $subkegiatan->id }}">

                        {{-- Kinerja --}}
                        <div class="row">
                            {{-- Capaian Program --}}
                            {{-- Sub Kegiatan --}}
                            <div class="mb-3">
                                <label for="ranwalSubkegiatanEdit" class="form-label">Sub Kegiatan</label>
                                <select class="form-select select2-single" id="ranwalSubkegiatanEdit" disabled>
                                    <option selected>{{ $subkegiatan->kode_subkegiatan . ' ' . $subkegiatan->uraian }}</option>
                                </select>
                                @error('subkegiatan')
                                    <small class="text-danger"><i class="fa-solid fa-triangle-exclamation fa-sm"></i> {{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-8">
                                <div class="mb-3">
                                    <label for="ranwalCapaianProgramEdit" class="form-label">Capaian Program</label>
                                    <textarea name="capaian" class="form-control" id="ranwalCapaianProgramEdit" placeholder="Capaian Program">{{ old('capaian') ? old('capaian') : $subkegiatan->kegiatan->capaian }}</textarea>
                                    @error('capaian')
                                        <small class="text-danger"><i class="fa-solid fa-triangle-exclamation fa-sm"></i> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="ranwalTargetProgramEdit" class="form-label">Target Capain Program</label>
                                    <div class="input-group">
                                        <input name="target_capaian" type="text" value="{{ old('target_capaian') ? old('target_capaian') : $subkegiatan->kegiatan->target_capaian }}" class="form-control" id="ranwalTargetProgramEdit" placeholder="Target" aria-label="Target" aria-describedby="ranwalSatuanProgramEdit">
                                        <input name="satuan_capaian" type="text" value="{{ old('satuan_capaian') ? old('satuan_capaian') : $subkegiatan->kegiatan->satuan_capaian }}" class="form-control" id="ranwalSatuanProgramEdit" placeholder="Satuan" aria-label="Satuan">
                                    </div>
                                    @error('target_capaian')
                                        <small class="text-danger"><i class="fa-solid fa-triangle-exclamation fa-sm"></i> {{ $message }}</small><br>
                                    @enderror
                                    @error('satuan_capaian')
                                        <small class="text-danger"><i class="fa-solid fa-triangle-exclamation fa-sm"></i> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Hasil Kegiatan --}}
                            <div class="col-8">
                                <div class="mb-3">
                                    <label for="ranwalHasilKegiatanReadonly" class="form-label">Hasil Kegiatan</label>
                                    <textarea class="form-control" id="ranwalHasilKegiatanReadonly" placeholder="Hasil Kegiatan" disabled>{{ $subkegiatan->kinerja }}</textarea>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="ranwalTargetKegiatanEdit" class="form-label">Target Hasil Kegiatan</label>
                                    <div class="input-group">
                                        <input name="target_kinerja" type="number" value="{{ old('target_kinerja') ? old('target_kinerja') : $subkegiatan->target_kinerja }}" class="form-control" id="ranwalTargetKegiatanEdit" placeholder="Target" aria-label="Target" aria-describedby="ranwalSatuanKegiatanEdit">
                                        <input name="satuan_kinerja" type="text" value="{{ old('satuan_kinerja') ? old('satuan_kinerja') : $subkegiatan->satuan_kinerja }}" class="form-control" id="ranwalSatuanKegiatanEdit" placeholder="Satuan" aria-label="Satuan">
                                    </div>
                                    @error('target_kinerja')
                                        <small class="text-danger"><i class="fa-solid fa-triangle-exclamation fa-sm"></i> {{ $message }}</small><br>
                                    @enderror
                                    @error('satuan_kinerja')
                                        <small class="text-danger"><i class="fa-solid fa-triangle-exclamation fa-sm"></i> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Indikator Sub Kegiatan --}}
                            <div class="col-8">
                                <div class="mb-3">
                                    <label for="ranwalIndikatorSubkegiatanReadonly" class="form-label">Indikator</label>
                                    <textarea class="form-control" id="ranwalIndikatorSubkegiatanReadonly" placeholder="Indikator" disabled>{{ $subkegiatan->indikator }}</textarea>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="ranwalTargetSubkegEdit" class="form-label">Target Indikator</label>
                                    <div class="input-group">
                                        <input name="target_indikator" type="number" value="{{ old('target_indikator') ? old('target_indikator') : $subkegiatan->target_indikator }}" class="form-control" id="ranwalTargetSubkegEdit" placeholder="Target" aria-label="Target" aria-describedby="satuanSubkegAddOnEdit">
                                        <span class="input-group-text" id="satuanSubkegAddOnEdit">{{ $subkegiatan->satuan }}</span>
                                    </div>
                                    @error('target_indikator')
                                        <small class="text-danger"><i class="fa-solid fa-triangle-exclamation fa-sm"></i> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="ranwalMulaiEdit" class="form-label">Waktu Pelaksaan Mulai</label>
                                    <input name="mulai" type="date" value="{{ old('mulai') ? old('mulai') : $subkegiatan->mulai }}" class="form-control" id="ranwalMulaiEdit">
                                    @error('mulai')
                                        <small class="text-danger"><i class="fa-solid fa-triangle-exclamation fa-sm"></i> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="ranwalSelesaiEdit" class="form-label">Waktu Pelaksaan Selesai</label>
                                    <input name="selesai" type="date" value="{{ old('selesai') ? old('selesai') : $subkegiatan->selesai }}" class="form-control" id="ranwalSelesaiEdit">
                                    @error('selesai')
                                        <small class="text-danger"><i class="fa-solid fa-triangle-exclamation fa-sm"></i> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="ranwalJenisEdit" class="form-label">Jenis Kegiatan</label>
                                    <select name="jenis" class="form-select" id="ranwalJenisEdit">
                                        <option value="" selected>Pilih...</option>
                                        <option value="fisik" {{ old('jenis') ? (old('jenis') == 'fisik' ? 'selected' : '') : (str($subkegiatan->jenis)->lower() == 'fisik' ? 'selected' : '') }}>Fisik</option>
                                        <option value="non fisik" {{ old('jenis') ? (old('jenis') == 'non fisik' ? 'selected' : '') : (str($subkegiatan->jenis)->lower() == 'non fisik' ? 'selected' : '') }}>Non Fisik</option>
                                    </select>
                                    @error('jenis')
                                        <small class="text-danger"><i class="fa-solid fa-triangle-exclamation fa-sm"></i> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <button type="submit" class="btn btn-primary col-sm-5 mx-auto">Simpan</button>
                            <a href="/rancangan/rkpd/opd/{{ $opd->id }}" class="btn btn-secondary col-sm-5 mx-auto">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('sccript')
    <script src="/asset/js/input_ranwal.js"></script>
</x-app-layout>
