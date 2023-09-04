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

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Referensi Sumber Pendanaan</span>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-stripped table-hover">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Uraian Akun</th>
                                <th>Input</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sumberdanas as $sumberdana)
                                <tr>
                                    <td>{{ $sumberdana->kode }}</td>
                                    <td>{{ $sumberdana->uraian }}</td>
                                    <td>{{ $sumberdana->input ? 'Ya' : 'Tidak' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('sccript')
</x-app-layout>
