<x-app-layout :apps="$apps">

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/config/jadwal">Jadwal</a></li>
            <li class="breadcrumb-item active" aria-current="page">RKPD Tahun {{ session()->get('tahun') }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-5 mx-auto">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Jadwal RKPD Tahun {{ session()->get('tahun') }}</span>
                </div>
                <div class="card-body">
                    <form action="{{ $edit ? '/config/jadwal/rkpd/update' : '' }}" method="post">
                        @csrf
                        @if ($edit)
                            <input type="hidden" name="id" value="{{ $edit->id }}">
                        @endif
                        <div class="row">
                            <div class="mb-3">
                                <label for="tahapanJadwalRkpdSelect" class="form-label">Tahapan RKPD</label>
                                <select name="tahapan" class="form-select select2-single @error('tahapan') is-invalid @enderror" id="tahapanJadwalRkpdSelect" data-placeholder="Pilih..." {{ $edit ? 'disabled' : '' }}>
                                    <option value="">Pilih...</option>
                                    <option value="ranwal" {{ $edit ? ($edit->tahapan == 'ranwal' ? 'selected' : '') : (old('tahapan') == 'ranwal' ? 'selected' : '') }}>Ranwal</option>
                                    <option value="rancangan" {{ $edit ? ($edit->tahapan == 'rancangan' ? 'selected' : '') : (old('tahapan') == 'rancangan' ? 'selected' : '') }}>Rancangan</option>
                                    <option value="perubahan" {{ $edit ? ($edit->tahapan == 'perubahan' ? 'selected' : '') : (old('tahapan') == 'perubahan' ? 'selected' : '') }}>Perubahan</option>
                                </select>
                                @error('tahapan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="keteranganJadwalRkpdInput" class="form-label">Keterangan Tahapan</label>
                                <textarea name="keterangan" class="form-control" id="keteranganJadwalRkpdInput" rows="3" placeholder="Contoh : Input Renja Sumber Dana DAU">{{ $edit ? $edit->keterangan : old('keterangan') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="mulaiJadwalRkpdInput" class="form-label">Waktu Mulai Pelaksanaan</label>
                                @if ($edit)
                                    <input value="{{ $edit ? $edit->mulai : old('mulai') }}" type="datetime-local" class="form-control @error('mulai') is-invalid @enderror" id="mulaiJadwalRkpdInput" disabled>
                                @else
                                    <input name="mulai" value="{{ $edit ? $edit->mulai : old('mulai') }}" type="datetime-local" class="form-control @error('mulai') is-invalid @enderror" id="mulaiJadwalRkpdInput">
                                @endif
                                @error('mulai')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="selesaiJadwalRkpdInput" class="form-label">Waktu Selesai Pelaksanaan</label>
                                <input name="selesai" value="{{ $edit ? $edit->selesai : old('selesai') }}" type="datetime-local" class="form-control @error('selesai') is-invalid @enderror" id="selesaiJadwalRkpdInput">
                                @error('selesai')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">{{ $edit ? 'Update' : 'Simpan' }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('sccript')
</x-app-layout>
