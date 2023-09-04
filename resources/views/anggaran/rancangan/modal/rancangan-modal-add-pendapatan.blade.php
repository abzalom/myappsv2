<!-- Modal -->
<div class="modal fade" id="addPendapatanModal" tabindex="-1" aria-labelledby="addPendapatanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addPendapatanModalLabel">Input Ranwal Pendapatan {{ tahun() }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="aksi" value="create">
                    <div class="mb-3">
                        <label for="pendapatanSelectRekening" class="form-label">Rekening Pendapatan</label>
                        <select name="rekening" class="form-select select2-pendapatan-rancangan" id="pendapatanSelectRekening">
                            <option value="">Pilih...</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="inputUraianPendapatan" class="form-label">Uraian Komponent</label>
                        <textarea name="uraian" class="form-control" id="inputUraianPendapatan" rows="3" placeholder="Uraian komponent pendapatan"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="inputJumlahPendapatan" class="form-label">Jumlah</label>
                        <input type="text" name="jumlah" class="form-control" id="inputJumlahPendapatan" placeholder="Jumlah pendapatan">
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
