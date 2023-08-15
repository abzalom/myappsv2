<x-app-layout :apps="$apps">
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Input Tahun</span>
                </div>
                <div class="card-body">
                    <form method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="tahunInput" class="form-label">Tahun</label>
                            <input type="number" name="tahun" value="{{ old('tahun') }}" class="form-control" id="tahunInput" placeholder="Tahun">
                            @error('tahun')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <table class="table table-sm table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Tahun</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tahuns as $tahun)
                                <tr>
                                    <td>{{ $tahun->tahun }}</td>
                                    <td>{{ $tahun->active ? 'Aktif' : 'Tidak Aktif' }}</td>
                                    <td class="text-center">
                                        @if ($tahun->active)
                                            <form action="/config/tahun/update" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $tahun->id }}">
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-lock"></i></button>
                                            </form>
                                        @else
                                            <form action="/config/tahun/update" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $tahun->id }}">
                                                <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-lock-open"></i></button>
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
