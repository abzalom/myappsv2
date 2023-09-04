$(document).ready(function () {

    $('.datatables-pagu').DataTable({
        rowGroup: {
            dataSrc: [0],
        },
        columnDefs: [{
                targets: [0],
                visible: false,
            },
            {
                targets: '_all',
                searchable: true
            },
        ],
    });

    $('.btn-add-pagu-opd').on('click', function () {
        kodeopd = $(this).val();
        $('#uraianPaguInput').html('<option value="">Pilih...</option>');
        $('#jumlahPaguInput').val('');
        $.ajax({
            type: "post",
            url: "/api/opd/kode",
            data: {
                kode_opd: kodeopd
            },
            dataType: "JSON",
            success: function (opd) {
                $('#addPaguOpdModalLabel').html(opd.nama_opd)
                $('#opdPaguInput').val(opd.kode_opd)
                $.ajax({
                    type: "post",
                    url: "/api/sumberdanarancangan/search",
                    data: {
                        kode_opd: opd.kode_opd
                    },
                    dataType: "JSON",
                    success: function (sumberdana) {
                        $.map(sumberdana, function (val, key) {
                            $('#uraianPaguInput').append('<option value="' + val.id + '">' + val.kode_sumberdana + ' - ' + val.uraian + '</option>');
                        });
                    }
                });
                $('#uraianPaguInput').select2({
                    theme: "bootstrap-5",
                    width: $('#uraianPaguInput').data('width') ? $('#uraianPaguInput').data('width') : $('#uraianPaguInput').hasClass('w-100') ? '100%' : 'style',
                    placeholder: $('#uraianPaguInput').data('placeholder'),
                    dropdownParent: $('#uraianPaguInput').parent(),
                });
            }
        });
    });

    $('.btn-edit-pagu-opd').on('click', function () {
        iduraian = $(this).val();
        $('#uraianPaguInputEdit').html('');
        $('#jumlahPaguInputEdit').val('');
        $('#idPaguEdit').val('');
        $.ajax({
            type: "post",
            url: "/api/sumberdanarancangan/id",
            data: {
                id: iduraian
            },
            dataType: "JSON",
            success: function (response) {
                console.log(response);
                $('#idPaguEdit').val(response.id);
                $('#idSumberdanaEdit').val(response.sumberdana.id);
                $('#uraianPaguInputEdit').html('<option selected>' + response.sumberdana.uraian + '</option>');
                $('#jumlahPaguInputEdit').val(response.jumlah);
            }
        });
    });

});
