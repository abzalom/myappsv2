<!-- Modal -->
<div class="modal fade" id="editPendapatanModal" tabindex="-1" aria-labelledby="editPendapatanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editPendapatanModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/perubahan/pendapatan/update" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="aksi" value="update">
                    <input type="hidden" name="iduraian" id="idUraianEdit">
                    <div class="mb-3">
                        <label for="pendapatanSelectRekeningEdit" class="form-label">Rekening Pendapatan</label>
                        <select class="form-select" id="pendapatanSelectRekeningEdit" disabled>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="inputUraianPendapatanEdit" class="form-label">Uraian Komponent</label>
                        <textarea name="uraian" class="form-control" id="inputUraianPendapatanEdit" rows="3" placeholder="Uraian komponent pendapatan"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="inputJumlahPendapatanEdit" class="form-label">Jumlah</label>
                        <input type="text" name="jumlah" class="form-control" id="inputJumlahPendapatanEdit" placeholder="Jumlah pendapatan">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
