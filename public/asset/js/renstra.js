$(document).ready(function () {
    $('.datatables-renstra-tujuan').DataTable({
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
});
