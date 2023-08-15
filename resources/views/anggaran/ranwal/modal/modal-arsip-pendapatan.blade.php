<!-- Modal -->
<div class="modal fade" id="arsipPendapatanModal" tabindex="-1" aria-labelledby="arsipPendapatanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="arsipPendapatanModalLabel">Arsip</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-bordered">
                    <thead class="table-info">
                        <tr>
                            <th>Uraian</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($uraians as $uraian)
                            <tr>
                                <td>{{ $uraian->kode_uraian . ' - ' . $uraian->uraian }}</td>
                                <td>
                                    <form action="/management/pendapatan/ranwal/restore" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $uraian->id }}">
                                        <button type="submit" class="btn btn-warning"><i class="fa-solid fa-rotate"></i></button>
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
