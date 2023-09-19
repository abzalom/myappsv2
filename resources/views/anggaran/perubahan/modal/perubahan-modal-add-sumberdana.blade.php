<!-- Modal -->
<div class="modal fade" id="addSumberDana" tabindex="-1" aria-labelledby="addSumberDanaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addSumberDanaLabel">Nama OPD</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="aksi" value="create">
                    <div class="mb-3">
                        <label for="uraianSumberdanaInput" class="form-label">Sumber dana</label>
                        <select name="uraian" class="form-select select2-single" id="uraianSumberdanaInput" aria-label="Default select example" data-placeholder="Pilih...">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="uraianSumberdanaInput" class="form-label">Uraian</label>
                        <input type="text" name="uraian" class="form-control" id="uraianSumberdanaInput" placeholder="Uraian">
                    </div>
                    <div class="mb-3">
                        <label for="jumlahSumberdanaInput" class="form-label">Jumlah Anggaran</label>
                        <input type="number" name="jumlah" class="form-control" id="jumlahSumberdanaInput" placeholder="Jumlah Anggaran">
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
