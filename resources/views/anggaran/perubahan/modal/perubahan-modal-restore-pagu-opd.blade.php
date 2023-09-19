<!-- Modal -->
<div class="modal fade" id="arsipPaguOpdModal" tabindex="-1" aria-labelledby="arsipPaguOpdModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="arsipPaguOpdModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-bordered table-striped">
                    <thead class="table-info">
                        <tr>
                            <th>OPD</th>
                            <th>Sumber dana</th>
                            <th>Jumlah</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pagutrashes as $pagutrash)
                            <tr>
                                <td>{{ $pagutrash->opd->kode_opd . ' ' . $pagutrash->opd->nama_opd }}</td>
                                <td>{{ $pagutrash->sumberdana->uraian }}</td>
                                <td>{{ number_format($pagutrash->jumlah, 2, ',', '.') }}</td>
                                <td>
                                    <form action="/perubahan/pagu/restore" method="post">
                                        @csrf
                                        <input type="hidden" name="idpagu" value="{{ $pagutrash->id }}">
                                        <button type="submit" class="btn btn-sm btn-warning" title="restore"><i class="fa-solid fa-rotate"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
