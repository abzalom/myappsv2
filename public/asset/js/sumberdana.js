$(document).ready(function () {
    $('.datatables-sumbedana').DataTable({
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
