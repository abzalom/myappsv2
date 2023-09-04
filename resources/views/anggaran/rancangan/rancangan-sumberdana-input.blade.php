<x-app-layout :apps="$apps">

    <div class="row">
        <div class="col-5 mx-auto">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Form Sumber Pendanaan Tahun {{ tahun() }}</span>
                </div>
                <form action="{{ $edit ? '/rancangan/sumberdana/update' : '' }}" method="post">
                    <div class="card-body">
                        @csrf
                        @if ($edit)
                            <input type="hidden" name="aksi" value="update">
                            <input type="hidden" name="id" value="{{ $edit->id }}">
                        @else
                            <input type="hidden" name="aksi" value="create">
                        @endif
                        <div class="mb-3">
                            <label for="uraianSumberdanaInput" class="form-label">Sumber dana</label>
                            <select name="kode_sumberdana" class="form-select select2-single" id="uraianSumberdanaInput" aria-label="Default select example" data-placeholder="Pilih..." {{ $edit ? 'disabled' : '' }}>
                                <option value="">Pilih..</option>
                                @foreach ($sumberdanas as $sumberdana)
                                    <option value="{{ $sumberdana->kode }}" {{ $edit ? ($edit->kode_sumberdana == $sumberdana->kode ? 'selected' : '') : (old('kode_sumberdana') == $sumberdana->kode ? 'selected' : '') }}>{{ $sumberdana->kode . ' - ' . $sumberdana->uraian }}</option>
                                @endforeach
                            </select>
                            @error('kode_sumberdana')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="uraianSumberdanaInput" class="form-label">Uraian</label>
                            <textarea name="uraian" class="form-control" id="uraianSumberdanaInput" placeholder="Uraian">{{ $edit ? $edit->uraian : old('uraian') }}</textarea>
                            @error('uraian')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jumlahSumberdanaInput" class="form-label">Jumlah Anggaran</label>
                            <input type="text" name="jumlah" value="{{ $edit ? $edit->jumlah : old('jumlah') }}" class="form-control" id="jumlahSumberdanaInput" placeholder="Jumlah Anggaran">
                            @error('jumlah')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('sccript')
</x-app-layout>
