$(document).ready(function () {

    $('#perubahanBidangInput').on('change', function () {
        $('#perubahanProgramInput').removeAttr('disabled');

        $('#perubahanHasilKegiatanReadonly').val('Hasil Kegiatan');
        $('#perubahanIndikatorSubkegiatanReadonly').val('Indikator');
        $('#satuanSubkegAddOn').html('Satuan');

        $('#perubahanKegiatanInput').attr('disabled', true);
        $('#perubahanSubkegiatanInput').attr('disabled', true);
        $('#perubahanKegiatanInput').html('<option value="">Pilih...</option>');
        $('#perubahanSubkegiatanInput').html('<option value="">Pilih...</option>');

        $('#perubahanProgramInput').html('<option value="">Pilih...</option>')
        kodebidang = $(this).val();
        rutin = $(this).find(':selected').data('rutin');
        $.ajax({
            type: "post",
            url: "/api/nomen/program/parent/bidang",
            data: {
                kode_bidang: kodebidang,
                rutin: rutin,
            },
            dataType: "JSON",
            success: function (programs) {
                $.each(programs, function (index, val) {
                    $('#perubahanProgramInput').append('<option value="' + val.kode_program + '">' + val.kode_program + ' ' + val.uraian + '</option>');
                });
            }
        });
        if (kodebidang !== '') {
            $('#perubahanProgramInput').removeAttr('disabled');
        } else {
            $('#perubahanProgramInput').html('<option value="">Pilih...</option>')
            $('#perubahanProgramInput').attr('disabled', true);
        }
    });

    $('#perubahanProgramInput').on('change', function () {

        $('#perubahanHasilKegiatanReadonly').val('Hasil Kegiatan');
        $('#perubahanIndikatorSubkegiatanReadonly').val('Indikator');
        $('#satuanSubkegAddOn').html('Satuan');

        $('#perubahanKegiatanInput').attr('disabled', true);
        $('#perubahanSubkegiatanInput').attr('disabled', true);
        $('#perubahanKegiatanInput').html('<option value="">Pilih...</option>');
        $('#perubahanSubkegiatanInput').html('<option value="">Pilih...</option>');

        $('#perubahanKegiatanInput').html('<option value="">Pilih...</option>')
        kodeprogram = $(this).val();
        $.ajax({
            type: "post",
            url: "/api/nomen/kegiatan/parent/program",
            data: {
                kode_program: kodeprogram,
            },
            dataType: "JSON",
            success: function (kegiatans) {
                $.each(kegiatans, function (index, val) {
                    $('#perubahanKegiatanInput').append('<option value="' + val.kode_kegiatan + '">' + val.kode_kegiatan + ' ' + val.uraian + '</option>');
                });
            }
        });
        if (kodeprogram !== '') {
            $('#perubahanKegiatanInput').removeAttr('disabled');
        } else {
            $('#perubahanKegiatanInput').html('<option value="">Pilih...</option>')
            $('#perubahanKegiatanInput').attr('disabled', true);
        }
    });

    $('#perubahanKegiatanInput').on('change', function () {

        $('#perubahanHasilKegiatanReadonly').val('Hasil Kegiatan');
        $('#perubahanIndikatorSubkegiatanReadonly').val('Indikator');
        $('#satuanSubkegAddOn').html('Satuan');

        $('#perubahanSubkegiatanInput').attr('disabled', true);
        $('#perubahanSubkegiatanInput').html('<option value="">Pilih...</option>');

        $('#perubahanSubkegiatanInput').html('<option value="">Pilih...</option>')
        kodekegiatan = $(this).val();
        $.ajax({
            type: "post",
            url: "/api/nomen/subkegiatan/parent/kegiatan",
            data: {
                kode_kegiatan: kodekegiatan,
            },
            dataType: "JSON",
            success: function (subkegiatans) {
                $.each(subkegiatans, function (index, val) {
                    $('#perubahanSubkegiatanInput').append('<option value="' + val.id + '">' + val.kode_subkegiatan + ' ' + val.uraian + '</option>');
                });
            }
        });
        if (kodekegiatan !== '') {
            $('#perubahanSubkegiatanInput').removeAttr('disabled');
        } else {
            $('#perubahanSubkegiatanInput').html('<option value="">Pilih...</option>')
            $('#perubahanSubkegiatanInput').attr('disabled', true);
        }
    });

    $('#perubahanSubkegiatanInput').on('change', function () {
        id = $(this).val();
        $.ajax({
            type: "post",
            url: "/api/nomen/subkegiatan/by/id",
            data: {
                id: id
            },
            dataType: "JSON",
            success: function (subkegiatan) {
                $('#perubahanHasilKegiatanReadonly').val(subkegiatan.kinerja);
                $('#perubahanIndikatorSubkegiatanReadonly').val(subkegiatan.indikator);
                $('#satuanSubkegAddOn').html(subkegiatan.satuan);
            }
        });
    });

    oldbidang = $('#oldbidang').val();
    oldprogram = $('#oldprogram').val();
    oldkegiatan = $('#oldkegiatan').val();
    oldsubkegiatan = $('#oldsubkegiatan').val();
    oldcapaian = $('#oldcapaian').val();
    oldtarget_capaian = $('#oldtarget_capaian').val();
    oldsatuan_capaian = $('#oldsatuan_capaian').val();
    oldtarget_hasil = $('#oldtarget_hasil').val();
    oldsatuan_hasil = $('#oldsatuan_hasil').val();
    oldtarget_indikator = $('#oldtarget_indikator').val();
    oldmulai = $('#oldmulai').val();
    oldselesai = $('#oldselesai').val();

    if (oldbidang !== '') {
        rutin = $('#perubahanBidangInput').find(':selected').data('rutin');
        $.ajax({
            type: "post",
            url: "/api/nomen/program/parent/bidang",
            data: {
                kode_bidang: oldbidang,
                rutin: rutin,
            },
            dataType: "JSON",
            success: function (programs) {
                $.each(programs, function (index, val) {
                    selected = val.kode_program == oldprogram ? 'selected' : ''
                    $('#perubahanProgramInput').append('<option value="' + val.kode_program + '" ' + selected + '>' + val.kode_program + ' ' + val.uraian + '</option>');
                });
            }
        });
        $('#perubahanProgramInput').removeAttr('disabled');
    }

    if (oldprogram !== '') {
        $.ajax({
            type: "post",
            url: "/api/nomen/kegiatan/parent/program",
            data: {
                kode_program: oldprogram,
            },
            dataType: "JSON",
            success: function (kegiatans) {
                $.each(kegiatans, function (index, val) {
                    selected = val.kode_kegiatan == oldkegiatan ? 'selected' : ''
                    $('#perubahanKegiatanInput').append('<option value="' + val.kode_kegiatan + '"' + selected + '>' + val.kode_kegiatan + ' ' + val.uraian + '</option>');
                });
            }
        });
        $('#perubahanKegiatanInput').removeAttr('disabled');
    }

    if (oldkegiatan !== '') {
        $.ajax({
            type: "post",
            url: "/api/nomen/subkegiatan/parent/kegiatan",
            data: {
                kode_kegiatan: oldkegiatan,
            },
            dataType: "JSON",
            success: function (subkegiatans) {
                $.each(subkegiatans, function (index, val) {
                    selected = val.id == oldsubkegiatan ? 'selected' : ''
                    $('#perubahanSubkegiatanInput').append('<option value="' + val.id + '"' + selected + '>' + val.kode_subkegiatan + ' ' + val.uraian + '</option>');
                });
            }
        });
        $('#perubahanSubkegiatanInput').removeAttr('disabled');
    }

    if (oldsubkegiatan !== '') {
        $.ajax({
            type: "post",
            url: "/api/nomen/subkegiatan/by/id",
            data: {
                id: oldsubkegiatan
            },
            dataType: "JSON",
            success: function (subkegiatan) {
                $('#perubahanHasilKegiatanReadonly').val(subkegiatan.kinerja);
                $('#perubahanIndikatorSubkegiatanReadonly').val(subkegiatan.indikator);
                $('#satuanSubkegAddOn').html(subkegiatan.satuan);
            }
        });
        $('#perubahanCapaianProgramInput').val(oldcapaian);
        $('#perubahanTargetProgramInput').val(oldtarget_capaian);
        $('#perubahanSatuanProgramInput').val(oldsatuan_capaian);
        $('#perubahanTargetKegiatanInput').val(oldtarget_hasil);
        $('#perubahanSatuanKegiatanInput').val(oldsatuan_hasil);
        $('#perubahanTargetSubkegInput').val(oldtarget_indikator);
        $('#perubahanMulaiInput').val(oldmulai);
        $('#perubahanSelesaiInput').val(oldselesai);
    }

});
