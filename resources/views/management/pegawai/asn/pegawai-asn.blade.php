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
                                    <th>Username</th>
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
                                            @if (!$pegawai->deleted_at)
                                                @if (!$pegawai->user->deleted_at)
                                                    {{ $pegawai->user->username }}
                                                @else
                                                    <form action="/user/setting/users/unlock" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ encrypt($pegawai->user->id) }}">
                                                        <button type="submit" class="btn btn-sm btn-secondary btn-group-form-last" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Buka akses user"><i class="fa-solid fa-user-lock"></i> dikunci</button>
                                                    </form>
                                                @endif
                                            @else
                                                <i class="fa-solid fa-user-lock"></i> dikunci
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if (!$pegawai->deleted_at)
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="/management/pegawai/asn/{{ $pegawai->id }}/profile" class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit user"><i class="fa-solid fa-user-tie fa-lg"></i></a>
                                                    <form action="/management/pegawai/asn/lock" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $pegawai->id }}">
                                                        <button type="submit" class="btn btn-sm btn-danger btn-group-form-last" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Kunci pegawai"><i class="fa-solid fa-user-lock"></i></button>
                                                    </form>
                                                </div>
                                            @else
                                                <form action="/management/pegawai/asn/unlock" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $pegawai->id }}">
                                                    <button type="submit" class="btn btn-sm btn-secondary btn-group-form-last" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Aktifkan pegawai"><i class="fa-solid fa-lock-open"></i></button>
                                                </form>
                                            @endif
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
