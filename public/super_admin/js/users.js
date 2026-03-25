(function ($) {
    "use strict";

    const destinationUrl = $('#user-route').val();

    const userTable = $('#userDataTable').DataTable({
        pageLength: 8,
        ordering: false,
        order: [],
        columnDefs: [
            {targets: '_all', orderable: false},
        ],
        paging: true,
        lengthChange: false,
        serverSide: true,
        processing: true,
        responsive: true,
        searching: false,
        ajax: {
            url: destinationUrl,
            data: function (d) {
                d.type = 'admins';
                d.search = $('#userSearchInput').val();
            }
        },
        language: {
            paginate: {
                previous: "<i class='fa-solid fa-angles-left'></i>",
                next: "<i class='fa-solid fa-angles-right'></i>",
            }
        },
        dom: 'tr<"tableBottom"<"row align-items-center justify-content-center"<"col-sm-12 text-center"<"tablePagi common-datatable-pagination"p>>>><"clear">',
        drawCallback: function () {
            const api = this.api();
            const pages = api.page.info().pages || 0;
            const container = api.table().container();

            // Hide pagination UI when there's only one page
            $(container).find('.tablePagi').toggle(pages > 1);
            $(container)
                .closest('.dataTables_wrapper')
                .find('.dataTables_paginate')
                .toggle(pages > 1);
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'mobile', name: 'mobile'},
            {data: 'role', name: 'role', searchable: false},
            {data: 'status', name: 'status', searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    let debounceTimer;
    $('#userSearchForm').on('submit', function (e) {
        e.preventDefault();
        userTable.ajax.reload();
    });

    $('#userSearchInput').on('input', function () {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function () {
            userTable.ajax.reload();
        }, 400);
    });
})(jQuery);

