$(document).ready(function () {

    $('.select2-pendapatan-rancangan').each(function () {
        $(this).select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $(this).parent(),
            ajax: {
                type: "post",
                url: "/api/rekening/pendapatan/search",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term,
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                id: item.kode_unik_subrincian,
                                text: item.kode_unik_subrincian + " - " + item.uraian,
                            };
                        }),
                    };
                },
            },
        })
    });

    $('.btn-edit-pendapatan-uraian').on('click', function () {
        iduraian = $(this).val();
        $.ajax({
            type: "post",
            url: "/api/rekening/pendapatan/uraian/id",
            data: {
                tahapan: 'rancangan',
                id: iduraian,
            },
            dataType: "JSON",
            success: function (response) {
                console.log(response);
                $('#editPendapatanModalLabel').html(response.kode_uraian + ' - ' + response.uraian)
                $('#pendapatanSelectRekeningEdit').html('<option>' + response.subrincian.kode_subrincian + ' - ' + response.subrincian.uraian + '</option>')
                $('#idUraianEdit').val(response.id)
                $('#inputUraianPendapatanEdit').val(response.uraian)
                $('#inputJumlahPendapatanEdit').val(response.jumlah)
            }
        });
    });

});
