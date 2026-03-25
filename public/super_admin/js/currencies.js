(function ($) {
    "use strict";
    const currencyTable = $('#commonDataTable').DataTable({
        pageLength: 8,
        ordering: false,
        serverSide: true,
        paging: true,
        processing: true,
        responsive: true,
        searching: false, // we are using custom search box like setting.html
        ajax: {
            url: $('#currency-route').val(),
            data: function (d) {
                d.search = $('#currencySearchInput').val();
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
            // Hide pagination UI when there's only one page
            $(api.table().container()).find('.tablePagi').toggle(pages > 1);
        },
        columns: [
            {"data": 'DT_RowIndex', "name": 'DT_RowIndex', searchable: false},
            {"data": "currency_code", "name": "currency_code", responsivePriority: 1},
            {"data": "symbol", "name": "symbol"},
            {"data": "currency_placement", "name": "currency_placement"},
            {"data": "action", searchable: false, responsivePriority: 2},
        ]
    });

    // Currency list search (index page) using custom search box like html/setting.html
    

    $("#sf-select-currency-add").select2({
        dropdownCssClass: "sf-select-dropdown",
        selectionCssClass: "sf-select-section",
        dropdownParent: $("#add-modal"),
    });

})(jQuery)
