$(document).ready(function () {
    $('.datatables-tujuan').DataTable({
        rowGroup: {
            dataSrc: [0, 1],
        },
        columnDefs: [{
                targets: [0],
                visible: false,
            },
            {
                targets: [1],
                visible: false,
            },
            {
                targets: '_all',
                searchable: true
            },
        ],
    });

    $('.btn-add-tujuan').on('click', function () {
        $('#visiId').val();
        $('#misiId').val();
        $('#addTujuanModalLabel').html('Modal title');
        visi = $(this).data('visi');
        misi = $(this).data('misi');
        nomisi = $(this).data('nomisi');
        $('#visiId').val(visi);
        $('#misiId').val(misi);
        $('#addTujuanModalLabel').html('Tujuan Misi Ke ' + nomisi);
    });

    $('.btn-edit-tujuan').on('click', function () {
        id = $(this).val();
        $.ajax({
            type: "post",
            url: "/api/rpjmd/tujuan",
            data: {
                id: id,
            },
            dataType: "JSON",
            success: function (tujuan) {
                $('#tujuanIdEdit').val(tujuan.id);
                $('#rpjmdNomorTujuanEdit').val(tujuan.nomor);
                $('#rpjmdTujuanEdit').val(tujuan.tujuan);
                $('#editTujuanModalLabel').html('Edit Tujuan Nomor ' + tujuan.nomor);
            }
        });
    });

    $('#editTujuanModal').on('hide.bs.modal', function () {
        $('#tujuanIdEdit').val();
        $('#rpjmdNomorTujuanEdit').val();
        $('#rpjmdTujuanEdit').val();
        $('#editTujuanModalLabel').html('Modal title');
    })
});
