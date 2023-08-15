<x-app-layout :apps="$apps">

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/management/pegawai/asn">ASN</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile : {{ $pegawai->nama }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Profile Pegawai {{ $pegawai->nama }}</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <img src="/asset/img/no-img.png" class="img-thumbnail" alt="{{ $pegawai->nip }}">
                        </div>
                        <div class="col-8">
                            <form action="/management/pegawai/asn/{{ $pegawai->id }}/profile" method="post">
                                @csrf
                                <input type="hidden" name="aksi" value="update">
                                <input type="hidden" name="id" value="{{ $pegawai->id }}">
                                <div class="mb-3">
                                    <label for="namaProfile" class="form-label">Nama Pegawai</label>
                                    <input type="text" name="nama" class="form-control" value="{{ $pegawai->nama ? $pegawai->nama : old('nama') }}" id="namaProfile" placeholder="Nama Lengkap Pegawai">
                                    @error('nama')
                                        <small class="text-danger"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nipProfile" class="form-label">Nomor Induk Pegawai</label>
                                    <input type="number" class="form-control" value="{{ $pegawai->nip ? $pegawai->nip : old('nip') }}" id="nipProfile" placeholder="Nomor Induk Pegawai" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="pangkatProfile" class="form-label">Pangkat / Golongan / Ruang</label>
                                    <select name="pangkat" class="form-select select2-single" id="pangkatProfile" data-placeholder="Pilih...">
                                        <option value="">Pilih...</option>
                                        @foreach ($pangkats as $pangkat)
                                            <option value="{{ $pangkat->id }}" {{ $pegawai->pangkat_pegawai_id == $pangkat->id ? 'selected' : (old('pangkat') == $pangkat->id ? 'selected' : '') }}>{{ $pangkat->golongan . str($pangkat->ruang . '. ' . $pangkat->pangkat)->title() }}</option>
                                        @endforeach
                                    </select>
                                    @error('pangkat')
                                        <small class="text-danger"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="opdProfile" class="form-label">Unit Kerja</label>
                                    <select name="opd" class="form-select select2-single" id="opdProfile" data-placeholder="Pilih...">
                                        <option value="">Pilih...</option>
                                        @foreach ($opds as $opd)
                                            <option value="{{ $opd->id }}" {{ $opd->kode_opd == $pegawai->opdpeg->kode_opd ? 'selected' : (old('opd') == $opd->id ? 'selected' : '') }}>{{ $opd->kode_opd . ' ' . $opd->nama_opd }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="jabatanProfile" class="form-label">Jabatan pada Unit Kerja</label>
                                    <select name="jabatan" class="form-select select2-single" id="jabatanProfile" data-placeholder="Pilih...">
                                        <option value="">Pilih...</option>
                                        @foreach ($jabatans as $jabatan)
                                            <option value="{{ $jabatan->id }}" {{ $jabatan->nama == $pegawai->opdpeg->jabatan ? 'selected' : (old('jabatan') == $jabatan->id ? 'selected' : '') }}>{{ $jabatan->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="phoneProfile" class="form-label">Nomor HP</label>
                                    <input type="number" name="phone" class="form-control" value="{{ $pegawai->phone ? $pegawai->phone : old('phone') }}" id="phoneProfile" placeholder="Nomor HP">
                                    @error('phone')
                                        <small class="text-danger"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="emailProfile" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ $pegawai->email ? $pegawai->email : old('email') }}" id="emailProfile" placeholder="name@example.com">
                                    @error('email')
                                        <small class="text-danger"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('sccript')
</x-app-layout>
