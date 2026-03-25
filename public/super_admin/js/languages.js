(function ($) {
    "use strict";
    const languageTable = $('#commonDataTable').DataTable({
        pageLength: 8,
        ordering: false,
        paging: true,
        serverSide: true,
        processing: true,
        responsive: true,
        searching: false, // we are using custom search box like setting.html
        ajax: {
            url: $('#language-route').val(),
            data: function (d) {
                d.search = $('#languageSearchInput').val();
            }
        },
        language: {
            paginate: {
                previous: "<i class='fa-solid fa-angles-left'></i>",
                next: "<i class='fa-solid fa-angles-right'></i>",
            }
        },
        // dom: 'tr<"tableBottom"<"row align-items-center"<"col-sm-6"<"tableInfo"i>><"col-sm-6"<"tablePagi"p>>>><"clear">',
        dom: 'tr<"tableBottom"<"row align-items-center justify-content-center"<"col-sm-12 text-center"<"tablePagi common-datatable-pagination"p>>>><"clear">',
        drawCallback: function () {
            const api = this.api();
            const pages = api.page.info().pages || 0;
            // Hide pagination UI when there's only one page
            $(api.table().container()).find('.tablePagi').toggle(pages > 1);
        },
        columns: [
            {"data": "flag", "name": "flag", searchable: false, responsivePriority: 1},
            {"data": "language", "name": "language"},
            {"data": "iso_code", "name": "iso_code"},
            {"data": "rtl", "name": "rtl", searchable: false},
            {"data": "action", searchable: false, responsivePriority: 2},
        ]
    });
    // old manual open/edit handlers are no longer needed for the new design,
    // Bootstrap data attributes handle opening modals.

    // Translate (delegated because translations table is reloaded via AJAX)
    $(document).on('click', '.addmore', function (e) {
        e.preventDefault()
        let html = `
                    <tr>
                        <td>
                            <textarea type="text" name="key" class="key primary-form-control common-textarea" required></textarea>
                        </td>
                        <td>
                            <input type="hidden" value="1" class="is_new">
                            <textarea type="text" name="value" class="val primary-form-control common-textarea" required></textarea>
                        </td>
                        <td class="text-end col-1">
                            <button type="button" class="updateLangItem primary_button">${$('.updateLangItem:first').text() || 'Update'}</button>
                        </td>
                    </tr>

                    <tr>

                    `;
        $('#append').prepend(html);
    })

    $(document).on('input', '.val', function () {
        $(this).closest('tr').find('button').attr('disabled', false);
    })

    $(document).on('click', '.updateLangItem', function () {
        var keyStr = $(this).closest('tr').find('.key').val();
        var valStr = $(this).closest('tr').find('.val').val();
        var is_new = $(this).closest('tr').find('.is_new').val();
        commonAjax('GET', $('#updateLangItemRoute').val(), getDataShowRes, getDataShowRes, {
            'key': keyStr,
            'val': valStr,
            'is_new': is_new
        });
    });

    $("#sf-select-modal-add").select2({
        dropdownCssClass: "sf-select-dropdown",
        selectionCssClass: "sf-select-section",
        dropdownParent: $("#add-modal"),
    });

    // Custom image preview function for the flag upload in add modal
    window.previewFileForCustomUpload = function(input) {
        "use strict";
        var previewImg = input.closest('.upload-img-box').querySelector('.preview-img');
        var defaultImg = "/assets/images/icon/upload-img-1.svg";
        
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            if (input.files[0].size > 1.024e7) {
                alert("Maximum file size is 10MB!");
                input.value = "";
                return;
            }
            
            reader.onload = function(e) {
                previewImg.src = e.target.result;
            };
            
            reader.readAsDataURL(input.files[0]);
        } else {
            previewImg.src = defaultImg;
        }
    };

    window.languageHandler = function(response) {
        var output = '';
        var type = 'error';
        $('.error-message').remove();
        $('.is-invalid').removeClass('is-invalid');
        if (response['status'] === true) {
            toastr.success(response['message'])

            setTimeout(() => {
                location.reload()
            }, 1000);


        } else {
            commonHandler(response)
        }
    }

    window.getDataShowRes = function(response) {
        var output = '';
        var type = 'error';
        $('.error-message').remove();
        $('.is-invalid').removeClass('is-invalid');
        if (response['status'] == true) {
            output = output + response['message'];
            type = 'success';
            toastr.success(response.message)
        } else {
            toastr.error(response['responseJSON'].message)
        }
    }

    // Load translations via AJAX
    function loadTranslations(page = 1, search = '') {
        $.ajax({
            url: $('#language-translate-route').val(),
            type: 'GET',
            data: { page: page, search: search },
            success: function (data) {
                $('#translations-container').html(data);
            },
            error: function () {
                toastr.error('Failed to load translations');
            }
        });
    }

    // Debounce timer for translate page search
    let debounceTimer;

    // Live search on input (translate page)
    $('#search-form input[name="search"]').on('input', function () {
        clearTimeout(debounceTimer);
        let search = $(this).val();
        debounceTimer = setTimeout(function () {
            loadTranslations(1, search); // always start from page 1
        }, 500); // 500ms debounce delay
    });

    // Also intercept form submit on translate page
    $('#search-form').on('submit', function (e) {
        e.preventDefault();
        let search = $(this).find('input[name="search"]').val();
        loadTranslations(1, search);
    });

    // Pagination click (AJAX)
    $(document).on('click', '.ajax-page', function () {
        let page = $(this).data('page');
        let search = $('#search-form').find('input[name="search"]').val();
        loadTranslations(page, search);
    });

    // Language list search (index page) using custom search box like html/setting.html
    $('#languageSearchForm').on('submit', function (e) {
        e.preventDefault();
        languageTable.ajax.reload();
    });

    $('#languageSearchInput').on('input', function () {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function () {
            languageTable.ajax.reload();
        }, 400);
    });


})(jQuery)

