<!-- Modal -->
<div class="modal fade" id="arsipSubkeluaranRanwalRenjaModal" tabindex="-1" aria-labelledby="arsipSubkeluaranRanwalRenjaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="arsipSubkeluaranRanwalRenjaModalLabel">Arsip Sub Keluaran</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table-sm table-borderless" style="width: 100%">
                    @if ($subkeldels->count() == 0)
                        <tr>
                            <td class="text-center fst-italic">Tidak ada data yang dihapus!</td>
                        </tr>
                    @else
                        @foreach ($subkeldels as $subkeldel)
                            <tr>
                                <td>{{ $subkeldel->uraian }}</td>
                                <td>{{ number_format($subkeldel->anggaran, 2, ',', '.') }}</td>
                                <td>{{ $subkeldel->pagu->sumberdana->uraian }}</td>
                                <td>
                                    <form action="/ranwal/rkpd/opd/{{ $opd->id }}/subkegiatan/{{ $subkeldel->subkegiatan->id }}/subkeluaran/{{ $subkeldel->id }}/restore" method="post">
                                        @csrf
                                        <input type="hidden" name="aksi" value="restore">
                                        <input type="hidden" name="subkeluaran" value="{{ $subkeldel->id }}">
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
