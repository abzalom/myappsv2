<!-- Modal -->
<div class="modal fade" id="editPaguOpdModal" tabindex="-1" aria-labelledby="editPaguOpdModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editPaguOpdModalLabel">Edit Pagu</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/management/pagu/update" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="aksi" value="update">
                    <input type="hidden" name="idpagu" id="idPaguEdit">
                    <div class="mb-3">
                        <label for="uraianPaguInputEdit" class="form-label">Sumber dana</label>
                        <select class="form-select select2-single" id="uraianPaguInputEdit" aria-label="Default select example" data-placeholder="Pilih..." disabled>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jumlahPaguInputEdit" class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" id="jumlahPaguInputEdit" placeholder="Jumlah pagu">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"3 data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
