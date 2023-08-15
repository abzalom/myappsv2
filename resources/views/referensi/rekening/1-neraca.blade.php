<x-app-layout :apps="$apps">

    <div class="row mt-4 mb-4">
        <ul class="list-group list-group-flush">
            @foreach ($akuns as $akun)
                <li class="list-group-item">
                    <div class="row align-items-center mb-2">
                        <div class="col-1" style="width: 4%">
                            <button class="btn btn-primary btn-sm akun" type="button" value="{{ $akun->id }}" data-bs-toggle="collapse" data-bs-target="#akun{{ $akun->id }}" aria-expanded="false" aria-controls="akun{{ $akun->id }}"><i class="fa-solid fa-plus-square"></i></button>
                        </div>
                        <div class="col-11">
                            <div class="row">
                                <div class="col-12">
                                    {{ $akun->kode_unik_akun }} - {{ $akun->uraian }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush collapse" style="margin-left: 2%" id="akun{{ $akun->id }}">
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>

    @include('sccript')
    <script src="/asset/js/rekening_neraca.js"></script>

</x-app-layout>
