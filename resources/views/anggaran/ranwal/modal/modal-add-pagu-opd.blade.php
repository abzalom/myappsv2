<!-- Modal -->
<div class="modal fade" id="addPaguOpdModal" tabindex="-1" aria-labelledby="addPaguOpdModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addPaguOpdModalLabel">Nama OPD</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="aksi" value="create">
                    <input type="hidden" name="opd" id="opdPaguInput">
                    <div class="mb-3">
                        <label for="uraianPaguInput" class="form-label">Sumber dana</label>
                        <select name="uraian" class="form-select select2-single" id="uraianPaguInput" aria-label="Default select example" data-placeholder="Pilih...">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jumlahPaguInput" class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" id="jumlahPaguInput" placeholder="Jumlah pagu">
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
