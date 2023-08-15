<x-app-layout :apps="$apps">

    <div class="row">
        <div class="col-12 mx-auto">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Referensi Nomenklatur Urusan Kepmendagri 050-5889 Tahun 2021</span>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>KODE</th>
                                <th>URAIAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nomens as $urusan)
                                <tr>
                                    <td style="width: 5%">{{ $urusan->kode_urusan }}</td>
                                    <td>
                                        <a href="/referensi/nomenklatur/urusan/{{ str($urusan->kode_urusan)->replace('.', '-') }}/bidang" class="text-decoration-none">
                                            {{ $urusan->uraian }}
                                        </a>
                                    </td>
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
