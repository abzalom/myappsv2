$(document).ready(function () {

    $('.akun').on('click', function () {
        id = $(this).val();
        $.ajax({
            type: "post",
            url: "/referensi/rekening/lo/kelompok",
            data: {
                id: id
            },
            success: function (data) {
                $('#akun' + id).html(data);
            }
        });
    });

    $('body').delegate('.kelompok', 'click', function () {
        id = $(this).val();
        $.ajax({
            type: "post",
            url: "/referensi/rekening/lo/jenis",
            data: {
                id: id
            },
            success: function (data) {
                $('#kelompok' + id).html(data);
            }
        });
    });

    $('body').delegate('.jenis', 'click', function () {
        id = $(this).val();
        $.ajax({
            type: "post",
            url: "/referensi/rekening/lo/objek",
            data: {
                id: id
            },
            success: function (data) {
                $('#jenis' + id).html(data);
            }
        });
    });

    $('body').delegate('.objek', 'click', function () {
        id = $(this).val();
        $.ajax({
            type: "post",
            url: "/referensi/rekening/lo/rincian",
            data: {
                id: id
            },
            success: function (data) {
                $('#objek' + id).html(data);
            }
        });
    });

    $('body').delegate('.rincian', 'click', function () {
        id = $(this).val();
        $.ajax({
            type: "post",
            url: "/referensi/rekening/lo/subrincian",
            data: {
                id: id
            },
            success: function (data) {
                $('#rincian' + id).html(data);
            }
        });
    });
});
