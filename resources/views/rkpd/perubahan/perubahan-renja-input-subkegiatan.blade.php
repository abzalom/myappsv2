<x-app-layout :apps="$apps">

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/perubahan/rkpd">OPD</a></li>
            <li class="breadcrumb-item"><a href="/perubahan/rkpd/opd/{{ $opd->id }}">Renja</a></li>
            <li class="breadcrumb-item active" aria-current="page">Input Sub Kegiatan</li>
        </ol>
    </nav>

    <div class="row mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">FORM INPUT RENJA {{ $opd->nama_opd }} TAHUN {{ tahun() }}</span>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        @csrf
                        <input type="hidden" id="oldbidang" value="{{ old('bidang') }}">
                        <input type="hidden" id="oldprogram" value="{{ old('program') }}">
                        <input type="hidden" id="oldkegiatan" value="{{ old('kegiatan') }}">
                        <input type="hidden" id="oldsubkegiatan" value="{{ old('subkegiatan') }}">
                        <input type="hidden" id="oldcapaian" value="{{ old('capaian') }}">
                        <input type="hidden" id="oldtarget_capaian" value="{{ old('target_capaian') }}">
                        <input type="hidden" id="oldsatuan_capaian" value="{{ old('satuan_capaian') }}">
                        <input type="hidden" id="oldtarget_hasil" value="{{ old('target_hasil') }}">
                        <input type="hidden" id="oldsatuan_hasil" value="{{ old('satuan_hasil') }}">
                        <input type="hidden" id="oldtarget_indikator" value="{{ old('target_indikator') }}">
                        <input type="hidden" id="oldmulai" value="{{ old('mulai') }}">
                        <input type="hidden" id="oldselesai" value="{{ old('selesai') }}">
                        <input type="hidden" name="aksi" value="create">
                        <input type="hidden" name="opd" value="{{ $opd->kode_opd }}">

                        <div class="row">
                            {{-- Nomenklatur --}}
                            <div class="col-sm-4">
                                {{-- Bidang --}}
                                <div class="mb-3">
                                    <label for="perubahanBidangInput" class="form-label">Bidang Urusan</label>
                                    <select name="bidang" class="form-select select2-single" id="perubahanBidangInput">
                                        <option value="">Pilih...</option>
                                        @foreach ($opd->tags as $tag)
                                            <option value="{{ $tag->bidang->kode_bidang }}" data-rutin="{{ $tag->bidang->kode_bidang == $rutin ? true : false }}" {{ old('bidang') == $tag->bidang->kode_bidang ? 'selected' : '' }}>{{ $tag->bidang->kode_bidang . ' ' . $tag->bidang->uraian }} {{ $tag->bidang->kode_bidang == $rutin ? '(rutin)' : '' }}</option>
                                        @endforeach
                                    </select>
                                    @error('bidang')
                                        <small class="text-danger"><i class="fa-solid fa-triangle-exclamation fa-sm"></i> {{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Program --}}
                                <div class="mb-3">
                                    <label for="perubahanProgramInput" class="form-label">Program</label>
                                    <select name="program" class="form-select select2-single" id="perubahanProgramInput" disabled>
                                        <option value="">Pilih...</option>
                                    </select>
                                    @error('program')
                                        <small class="text-danger"><i class="fa-solid fa-triangle-exclamation fa-sm"></i> {{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Kegiatan --}}
                                <div class="mb-3">
                                    <label for="perubahanKegiatanInput" class="form-label">Kegiatan</label>
                                    <select name="kegiatan" class="form-select select2-single" id="perubahanKegiatanInput" disabled>
                                        <option value="">Pilih...</option>
                                    </select>
                                    @error('kegiatan')
                                        <small class="text-danger"><i class="fa-solid fa-triangle-exclamation fa-sm"></i> {{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Sub Kegiatan --}}
                                <div class="mb-3">
                                    <label for="perubahanSubkegiatanInput" class="form-label">Sub Kegiatan</label>
                                    <select name="subkegiatan" class="form-select select2-single" id="perubahanSubkegiatanInput" disabled>
                                        <option value="">Pilih...</option>
                                    </select>
                                    @error('subkegiatan')
                                        <small class="text-danger"><i class="fa-solid fa-triangle-exclamation fa-sm"></i> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>




                            {{-- Kinerja --}}
                            <div class="col-sm-7">
                                {{-- Capaian Program --}}
                                <div class="row">
                                    <div class="col-8">
                                        <div class="mb-3">
                                            <label for="perubahanCapaianProgramInput" class="form-label">Capaian Program</label>
                                            <textarea name="capaian" class="form-control" id="perubahanCapaianProgramInput" placeholder="Capaian Program">Persentase ketersediaan laporan capaian kinerja</textarea>
                                            @error('capaian')
                                                <small class="text-danger"><i class="fa-solid fa-triangle-exclamation fa-sm"></i> {{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="perubahanTargetProgramInput" class="form-label">Target Capain Program</label>
                                            <div class="input-group">
                                                <input name="target_capaian" type="text" value="98,40" class="form-control" id="perubahanTargetProgramInput" placeholder="Target" aria-label="Target" aria-describedby="targetProgramAddOn">
                                                <input name="satuan_capaian" type="text" value="%" class="form-control" id="perubahanSatuanProgramInput" placeholder="Satuan" aria-label="Satuan">
                                            </div>
                                            @error('target_capaian')
                                                <small class="text-danger"><i class="fa-solid fa-triangle-exclamation fa-sm"></i> {{ $message }}</small><br>
                                            @enderror
                                            @error('satuan_capaian')
                                                <small class="text-danger"><i class="fa-solid fa-triangle-exclamation fa-sm"></i> {{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Hasil Kegiatan --}}
                                <div class="row">
                                    <div class="col-8">
                                        <div class="mb-3">
                                            <label for="perubahanHasilKegiatanReadonly" class="form-label">Hasil Kegiatan</label>
                                            <textarea class="form-control" id="perubahanHasilKegiatanReadonly" placeholder="Hasil Kegiatan" disabled></textarea>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="perubahanTargetKegiatanInput" class="form-label">Target Hasil Kegiatan</label>
                                            <div class="input-group">
                                                <input name="target_kinerja" type="number" value="100" class="form-control" id="perubahanTargetKegiatanInput" placeholder="Target" aria-label="Target" aria-describedby="targetKegiatanAddOn">
                                                <input name="satuan_kinerja" type="text" value="%" class="form-control" id="perubahanSatuanKegiatanInput" placeholder="Satuan" aria-label="Satuan">
                                            </div>
                                            @error('target_kinerja')
                                                <small class="text-danger"><i class="fa-solid fa-triangle-exclamation fa-sm"></i> {{ $message }}</small><br>
                                            @enderror
                                            @error('satuan_kinerja')
                                                <small class="text-danger"><i class="fa-solid fa-triangle-exclamation fa-sm"></i> {{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Indikator Sub Kegiatan --}}
                                <div class="row">
                                    <div class="col-8">
                                        <div class="mb-3">
                                            <label for="perubahanIndikatorSubkegiatanReadonly" class="form-label">Indikator</label>
                                            <textarea class="form-control" id="perubahanIndikatorSubkegiatanReadonly" placeholder="Indikator" disabled></textarea>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="perubahanTargetSubkegInput" class="form-label">Target Indikator</label>
                                            <div class="input-group">
                                                <input name="target_indikator" type="number" class="form-control" id="perubahanTargetSubkegInput" placeholder="Target" aria-label="Target" aria-describedby="satuanSubkegAddOn">
                                                <span class="input-group-text" id="satuanSubkegAddOn">Satuan</span>
                                            </div>
                                            @error('target_indikator')
                                                <small class="text-danger"><i class="fa-solid fa-triangle-exclamation fa-sm"></i> {{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="perubahanMulaiInput" class="form-label">Waktu Pelaksaan Mulai</label>
                                            <input name="mulai" type="date" value="2024-01-01" class="form-control" id="perubahanMulaiInput">
                                            @error('mulai')
                                                <small class="text-danger"><i class="fa-solid fa-triangle-exclamation fa-sm"></i> {{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="perubahanSelesaiInput" class="form-label">Waktu Pelaksaan Selesai</label>
                                            <input name="selesai" type="date" value="2024-10-10" class="form-control" id="perubahanSelesaiInput">
                                            @error('selesai')
                                                <small class="text-danger"><i class="fa-solid fa-triangle-exclamation fa-sm"></i> {{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="perubahanJenisInput" class="form-label">Jenis Kegiatan</label>
                                            <select name="jenis" class="form-select" id="perubahanJenisInput">
                                                <option value="" selected>Pilih...</option>
                                                <option value="fisik" {{ old('jenis') ? (old('jenis') == 'fisik' ? 'selected' : '') : '' }}>Fisik</option>
                                                <option value="non fisik" {{ old('jenis') ? (old('jenis') == 'non fisik' ? 'selected' : '') : '' }}>Non Fisik</option>
                                            </select>
                                            @error('jenis')
                                                <small class="text-danger"><i class="fa-solid fa-triangle-exclamation fa-sm"></i> {{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>



                        <div class="row mt-3">
                            <button type="submit" class="btn btn-primary col-sm-5 mx-auto">Simpan</button>
                            <a href="/perubahan/rkpd/opd/{{ $opd->id }}" class="btn btn-secondary col-sm-5 mx-auto">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('sccript')
    <script src="/asset/js/perubahan/input_perubahan.js"></script>
</x-app-layout>
