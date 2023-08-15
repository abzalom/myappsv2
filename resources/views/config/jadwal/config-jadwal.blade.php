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
                    <span class="card-title">Tahapan dan Jadwal Waktu Pelaksanaan</span>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="mb-3 fst-italic">
                            <span>Keterangan:</span><br>
                            <p class="text-muted mb-0">* Tombol <button class="btn btn-sm btn-secondary" style="--bs-btn-padding-y:1px; --bs-btn-padding-x: 5px; --bs-btn-font-size: 15px" disabled><i class="fa-solid fa-arrows-rotate fa-sm"></i></button> untuk melakukan sinkron data tahapan sebelumnya</p>
                            <p class="text-muted mb-0">* Tombol <button class="btn btn-sm btn-info" style="--bs-btn-padding-y:1px; --bs-btn-padding-x: 5px; --bs-btn-font-size: 15px" disabled><i class="fa-solid fa-edit fa-sm"></i></button> untuk edit jadwal tahapan</p>
                            <p class="text-muted mb-0">* Tombol <button class="btn btn-sm btn-danger" style="--bs-btn-padding-y:1px; --bs-btn-padding-x: 5px; --bs-btn-font-size: 15px" disabled><i class="fa-solid fa-lock fa-sm"></i></button> untuk kunci jadwal tahapan</p>
                        </div>
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Input Jadwal
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/config/jadwal/renstra">Tahapan Renstra</a></li>
                                    <li><a class="dropdown-item" href="/config/jadwal/rkpd">Tahapan RKPD</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tahapan</th>
                                <th>Keterangan</th>
                                <th>Jadwal</th>
                                <th>Sisa Waktu</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($jadwal_rkpds as $rkpd)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $rkpd->tahapan }}</td>
                                    <td>{{ $rkpd->keterangan }}</td>
                                    <td class="text-center">
                                        {{ Carbon\Carbon::parse($rkpd->mulai)->isoFormat('dddd, D MMMM Y') }}<br>
                                        s.d<br>
                                        {{ Carbon\Carbon::parse($rkpd->selesai)->isoFormat('dddd, D MMMM Y') }}
                                    </td>
                                    <td>
                                        @if (!$rkpd->deleted_at)
                                            @if (Carbon\Carbon::parse($rkpd->mulai)->isPast())
                                                @if (!Carbon\Carbon::parse($rkpd->selesai)->isPast())
                                                    Sedang berlangsung
                                                    <br>
                                                    Selesai dalam : {{ str(Carbon\Carbon::parse($rkpd->selesai)->diffForHumans(['parts' => 3]))->replace('dari sekarang', '') }}
                                                @else
                                                    Selesai
                                                @endif
                                            @else
                                                Di mulai dalam
                                                <br>
                                                {{ str(Carbon\Carbon::parse($rkpd->mulai)->diffForHumans(['parts' => 2]))->replace('dari sekarang', '') }}
                                            @endif
                                        @else
                                            Tahapan dikunci
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            @if (!$rkpd->deleted_at)
                                                @if ($rkpd->tahapan !== 'ranwal')
                                                    <form action="/config/jadwal/rkpd/synchorn" method="post">
                                                        @csrf
                                                        <input type="hidden" name="tahapan" value="{{ $rkpd->tahapan }}">
                                                        <button class="btn btn-sm btn-secondary"><i class="fa-solid fa-arrows-rotate"></i></button>
                                                    </form>
                                                @endif
                                                <a href="/config/jadwal/rkpd?edit={{ $rkpd->id }}" type="button" class="btn btn-sm btn-info"><i class="fa-solid fa-edit"></i></a>
                                                <form action="/config/jadwal/rkpd/destory" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $rkpd->id }}">
                                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus jadwal ini?')" class="btn btn-sm btn-danger"><i class="fa-solid fa-lock"></i></button>
                                                </form>
                                            @endif
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

    @include('sccript')
</x-app-layout>
