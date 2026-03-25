(function ($) {
    "use strict";

    const destinationUrl = $('#destination-route').val();

    const countryTable = $('#countryDataTable').DataTable({
        pageLength: 25,
        ordering: false,
        order: [],
        columnDefs: [
            { targets: '_all', orderable: false },
        ],
        serverSide: true,
        processing: true,
        responsive: true,
        searching: false,
        ajax: {
            url: destinationUrl,
            data: function (d) {
                d.type = 'countries';
                d.search = $('#countrySearchInput').val();
            }
        },
        language: {
            paginate: {
                previous: "<i class='fa-solid fa-angles-left'></i>",
                next: "<i class='fa-solid fa-angles-right'></i>",
            }
        },
        dom: 'tr<"tableBottom"<"row align-items-center justify-content-center"<"col-sm-12 text-center"<"tablePagi common-datatable-pagination"p>>>><"clear">',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false},
            {data: 'country_name', name: 'country_name'},
            {data: 'short_name', name: 'short_name'},
            {data: 'region_name', name: 'region_name'},
            {data: 'status', name: 'status', searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    let debounceTimer;
    $('#countrySearchForm').on('submit', function (e) {
        e.preventDefault();
        countryTable.ajax.reload();
    });

    $('#countrySearchInput').on('input', function () {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function () {
            countryTable.ajax.reload();
        }, 400);
    });

    $('#regionSearchForm').on('submit', function (e) {
        e.preventDefault();
    });

    $('#regionSearchInput').on('input', function () {
        const keyword = ($(this).val() || '').toLowerCase().trim();
        $('#region-card-wrap .region_card').each(function () {
            const text = $(this).text().toLowerCase();
            $(this).toggle(text.indexOf(keyword) !== -1);
        });
    });

    // Keep Unique Code synced with selected Region Name (add form)
    $('#regionNameSelect').on('change', function () {
        const code = $(this).find(':selected').data('region-code');
        if (code) {
            $('#regionCodeSelect').val(code).trigger('change');
        }
    });

    // Keep Unique Code synced with selected Region Name (edit modal)
    $(document).on('change', '#editRegionNameSelect', function () {
        const code = $(this).find(':selected').data('region-code');
        if (code) {
            $('#editRegionCodeSelect').val(code).trigger('change');
        }
    });
})(jQuery);
