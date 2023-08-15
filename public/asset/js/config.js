$(document).ready(function () {
    $('#menulinkcheck').on('change', function () {
        if ($(this).prop('checked') == true) {
            $('#menulink').html('<div class="mb-3"><label for="menuslink" class="form-label">Menu Link</label><input type="text" name="menulink" class="form-control" id="menuslink" placeholder="Contoh : home/profile"></div>');
        } else {
            $('#menulink').html('');
        }
    })

    $('#parentmenu').on('change', function () {
        $.ajax({
            type: "post",
            url: "/api/menu/find",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: $(this).val(),
            },
            dataType: "JSON",
            success: function (response) {
                if (response.data.link == '/' || response.data.link == '#') {
                    $('#submenulink-addon1').html('http://myapps.com/')
                } else {
                    $('#submenulink-addon1').html('http://myapps.com' + response.data.link + '/')
                }
            }
        });
    })

    $('.datatables-config').DataTable({
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
});
