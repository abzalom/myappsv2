$(document).ready(function () {
    $('.datatables-indikator').DataTable({
        rowGroup: {
            dataSrc: [0, 1, 2, 3],
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
                targets: [2],
                visible: false,
            },
            {
                targets: [3],
                visible: false,
            },
            {
                targets: '_all',
                searchable: true
            },
        ],
    });

    $('.btn-add-indikator').on('click', function () {
        id = $(this).val();
        $.ajax({
            type: "post",
            url: "/api/rpjmd/sasaran",
            data: {
                id: id
            },
            dataType: "JSON",
            success: function (sasaran) {
                $('#visiId').val(sasaran.tujuan.misi.visi.id)
                $('#misiId').val(sasaran.tujuan.misi.id)
                $('#tujuanId').val(sasaran.tujuan.id)
                $('#sasaranId').val(sasaran.id)
            }
        });
    });

    $('.btn-edit-indikator').on('click', function () {
        $('#namaIndikatorEditModalLabel').html('');
        $('#indikatorIdEdit').val('');
        $('#indikatorEdit').val('');
        $('#indikatorSatuanEdit').val('');
        id = $(this).val();
        $.ajax({
            type: "post",
            url: "/api/rpjmd/indikator",
            data: {
                id: id
            },
            dataType: "JSON",
            success: function (indikator) {
                $('#namaIndikatorEditModalLabel').html(indikator.indikator.indikator)
                $('#indikatorIdEdit').val(indikator.indikator.id)
                $('#indikatorEdit').val(indikator.indikator.indikator)
                $('#indikatorSatuanEdit').val(indikator.indikator.satuan)
            }
        });
    });
});
