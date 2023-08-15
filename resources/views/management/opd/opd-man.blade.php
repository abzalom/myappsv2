<x-app-layout :apps="$apps">

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Perangkat Daerah Tahun {{ tahun() }}</span>
                </div>
                <div class="card-body">
                    <a href="{{ route('opd.create') }}" class="btn btn-outline-primary mb-3">Input OPD</a>
                    <table class="table table-bordered table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <td>KODE</td>
                                <td>NAMA OPD</td>
                                <td>BIDANG URUSAN PEMERINTAHAN</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($opds as $opd)
                                <tr>
                                    <td style="width: 10%; {{ $opd->deleted_at ? 'background-color: #fdb1b1' : '' }}">{{ $opd->kode_opd }}</td>
                                    <td style="{{ $opd->deleted_at ? 'background-color: #fdb1b1' : '' }}">{{ $opd->nama_opd }}</td>
                                    <td style="{{ $opd->deleted_at ? 'background-color: #fdb1b1' : '' }}">
                                        <ul>
                                            @foreach ($opd->tags as $tag)
                                                <li>{{ $tag->bidang->uraian }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="text-center" style="width: 10%; {{ $opd->deleted_at ? 'background-color: #fdb1b1' : '' }}">
                                        @if (!$opd->deleted_at)
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('opd.edit', encrypt($opd->id)) }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-edit"></i></a>
                                                <form action="{{ route('opd.destroy') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $opd->id }}">
                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-lock"></i></button>
                                                </form>
                                            </div>
                                        @else
                                            <form action="{{ route('opd.restore') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $opd->id }}">
                                                <button type="submit" class="btn btn-sm btn-secondary"><i class="fa-solid fa-unlock"></i></button>
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

    @include('sccript')
</x-app-layout>
