<x-app-layout :apps="$apps">

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/management/pegawai/asn">ASN</a></li>
            <li class="breadcrumb-item active" aria-current="page">Input Pegawai</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Pegawai ASN</span>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <a href="/management/pegawai/asn" class="btn btn-primary"><i class="fa-regular fa-circle-left"></i> Kembali</a>
                        </div>
                    </div>
                    <form action="" method="post">
                        @csrf
                        <input type="hidden" name="aksi" value="create">
                        <div class="mb-3">
                            <label for="pegawaiNamaInput" class="form-label">Nama Lengkap Pegawai</label>
                            <input type="text" name="nama" value="{{ old('nama') }}" class="form-control @error('nama') is-invalid @enderror" id="pegawaiNamaInput" placeholder="Nama lengkap dengan title">
                            @error('nama')
                                <small class="text-danger"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pegawaiNIPInput" class="form-label">NIP</label>
                            <input type="number" name="nip" value="{{ old('nip') }}" class="form-control @error('nip') is-invalid @enderror" id="pegawaiNIPInput" placeholder="NIP">
                            @error('nip')
                                <small class="text-danger"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pegawaiPangkatInput" class="form-label">Pangkat / Golongan</label>
                            <select name="pangkat" class="form-select @error('pangkat') is-invalid @enderror select2-single" id="pegawaiPangkatInput" data-placeholder="Pilih...">
                                <option value="">Pilih...</option>
                                @foreach ($pangkats as $pangkat)
                                    <option value="{{ $pangkat->id }}" {{ old('pangkat') == $pangkat->id ? 'selected' : '' }}>{{ $pangkat->golongan . str($pangkat->ruang . '. ' . $pangkat->pangkat)->title() }}</option>
                                @endforeach
                            </select>
                            @error('pangkat')
                                <small class="text-danger"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pegawaiNomorHpInput" class="form-label">Nomor HP</label>
                            <input type="number" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" id="pegawaiNomorHpInput" placeholder="Nomor HP Aktif">
                            @error('phone')
                                <small class="text-danger"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pegawaiEmailInput" class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="pegawaiEmailInput" placeholder="name@example.com">
                            @error('email')
                                <small class="text-danger"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('sccript')
</x-app-layout>
