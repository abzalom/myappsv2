<x-app-layout :apps="$apps">

    @if ($errors->any())
        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">ASN</li>
            <li class="breadcrumb-item"><a href="/management/pegawai/pppk">PPPK</a></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Pegawai ASN</span>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <a href="/management/pegawai/asn/create" class="btn btn-primary"><i class="fa-solid fa-user-plus"></i> Tambah Pegawai</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>Nama / NIP/ Pangkat</th>
                                    <th>Jabatan</th>
                                    <th>Perangkat Daerah</th>
                                    <th>User</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pegawais as $pegawai)
                                    <tr class="align-middle">
                                        <td>
                                            {{ $pegawai->nama }}<br>
                                            NIP. {{ $pegawai->nip }}<br>
                                            {{ str($pegawai->pangkat->pangkat . ' (' . $pegawai->pangkat->golongan . '/' . $pegawai->pangkat->ruang . ')')->upper() }}
                                        </td>
                                        <td>
                                            @if ($pegawai->opdpeg)
                                                {{ str($pegawai->opdpeg->jabatan)->upper() }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($pegawai->opdpeg)
                                                {{ $pegawai->opdpeg->opd->nama_opd }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $pegawai->user->getRoleNames() }}
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="/management/pegawai/asn/{{ $pegawai->id }}/profile" class="btn btn-sm btn-info"><i class="fa-solid fa-user-tie fa-lg"></i></a>
                                                <button type="button" class="btn btn-sm btn-danger"><i class="fa-solid fa-lock fa-lg"></i></button>
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
