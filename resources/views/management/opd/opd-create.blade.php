<x-app-layout :apps="$apps">

    <div class="card col-6 mx-auto">
        <div class="card-header">
            <span class="card-title">Form Input Perangkat Daerah</span>
        </div>
        <div class="card-body">
            <form action="" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <div class="mb-3">
                            <label for="opdInput" class="form-label">Perangkat Daerah</label>
                            <input name="opd" value="{{ old('opd') }}" type="text" class="form-control" id="opdInput" placeholder="Nama perangkat daerah">
                            @error('opd')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mb-3">
                            <label for="tagBidang1" class="form-label">Bidang 1</label>
                            <select name="bidang1" class="form-select select2-single" id="tagBidang1" aria-label="Default select example" data-placeholder="Pilih...">
                                <option value=""></option>
                                @foreach ($bidangs as $bidang)
                                    <option value="{{ $bidang->kode_bidang }}" {{ old('bidang1') == $bidang->kode_bidang ? 'selected' : '' }}>{{ $bidang->kode_bidang . ' - ' . $bidang->uraian }}</option>
                                @endforeach
                            </select>
                            @error('bidang1')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mb-3">
                            <label for="tagBidang2" class="form-label">Bidang 2</label>
                            <select name="bidang2" class="form-select select2-single" id="tagBidang2" aria-label="Default select example" data-placeholder="Pilih...">
                                <option value=""></option>
                                @foreach ($bidangs as $bidang)
                                    <option value="{{ $bidang->kode_bidang }}" {{ old('bidang2') == $bidang->kode_bidang ? 'selected' : '' }}>{{ $bidang->kode_bidang . ' - ' . $bidang->uraian }}</option>
                                @endforeach
                            </select>
                            @error('bidang2')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mb-3">
                            <label for="tagBidang3" class="form-label">Bidang 3</label>
                            <select name="bidang3" class="form-select select2-single" id="tagBidang3" aria-label="Default select example" data-placeholder="Pilih...">
                                <option value=""></option>
                                @foreach ($bidangs as $bidang)
                                    <option value="{{ $bidang->kode_bidang }}" {{ old('bidang3') == $bidang->kode_bidang ? 'selected' : '' }}>{{ $bidang->kode_bidang . ' - ' . $bidang->uraian }}</option>
                                @endforeach
                            </select>
                            @error('bidang3')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @include('sccript')
</x-app-layout>
