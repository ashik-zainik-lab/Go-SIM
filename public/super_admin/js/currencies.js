(function ($) {
    "use strict";
    const currencyTable = $('#commonDataTable').DataTable({
        pageLength: 25,
        ordering: false,
        serverSide: true,
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
        dom: 'tr<"tableBottom"<"row align-items-center"<"col-sm-6"<"tableInfo"i>><"col-sm-6"<"tablePagi"p>>>><"clear">',
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
