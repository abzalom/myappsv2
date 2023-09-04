<!-- Modal -->
<div class="modal fade" id="arsipSubkegiatanRanwalRenjaModal" tabindex="-1" aria-labelledby="arsipSubkegiatanRanwalRenjaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="arsipSubkegiatanRanwalRenjaModalLabel">Arsip Sub Kegiatan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table-sm table-borderless" style="width: 100%">
                    @if ($subkegdels->count() == 0)
                        <tr>
                            <td class="text-center fst-italic">Tidak ada data yang dihapus!</td>
                        </tr>
                    @else
                        @foreach ($subkegdels as $subkegdel)
                            <tr>
                                <td>{{ $subkegdel->kode_subkegiatan . ' ' . $subkegdel->uraian }}</td>
                                <td>
                                    <form action="/ranwal/rkpd/opd/{{ $opd->id }}/subkegiatan/restore" method="post">
                                        @csrf
                                        <input type="hidden" name="aksi" value="restore">
                                        <input type="hidden" name="subkegiatan" value="{{ $subkegdel->id }}">
                                        <button type="submit" class="btn btn-sm btn-warning"><i class="fa-solid fa-arrows-rotate"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
