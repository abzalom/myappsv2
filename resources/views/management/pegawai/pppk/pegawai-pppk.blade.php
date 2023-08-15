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
            <li class="breadcrumb-item"><a href="/management/pegawai/asn">ASN</a></li>
            <li class="breadcrumb-item active" aria-current="page">PPPK</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Pegawai Pemerintah dengan Perjanjian Kontrak (PPPK)</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12"></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>Nama / NIK</th>
                                    <th>Alamat</th>
                                    <th>Jabatan</th>
                                    <th>Perangkat Daerah</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-sm btn-info"><i class="fa-solid fa-edit"></i></button>
                                            <button type="button" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('sccript')
</x-app-layout>
