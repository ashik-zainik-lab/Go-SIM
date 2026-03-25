
document.addEventListener("DOMContentLoaded", function () {
    /* Flag Dropdown Start  */
    $(document).on("click", ".dropdown-menu .dropdown-item", function (e) {
        e.preventDefault();

        const flag = $(this).data("flag");
        const text = $(this).text();

        $(this)
            .closest(".dropdown")
            .find(".flag_dropdown")
            .html(
                "<span class='flag-icon flag-icon-" + flag + " me-1'></span> " +
                "<span>" + text + "</span>"
            );
    });
    /* Flag Dropdown End */

    /* Mobile Menu Start */
    const menuIcon = document.getElementById("mobileMenuIcon");
    const sidebar = document.querySelector(".dark_sidebar");

    if (menuIcon && sidebar) {
        menuIcon.addEventListener("click", function () {
            // Toggles the 'cross' class on the icon itself
            this.classList.toggle("cross");
            // Toggles the 'active_sidebar' class on the sidebar
            sidebar.classList.toggle("active_sidebar");
        });
    }
    /* Mobile Menu End */

    /* Select2 Initialization Start  */

    $(".select2-activate-without-search").select2({
        minimumResultsForSearch: Infinity,
    });
    $(".select2-activate-with-search").select2({
    });
    /* Select2 Initialization  */

    // Define the SVG icons
    const undoIcon = `<svg xmlns="http://www.w3.org/2000/svg" width="21" height="9" viewBox="0 0 21 9" fill="none">
    <path d="M10.5 1C7.85 1 5.45 1.99 3.6 3.6L0 0V9H9L5.38 5.38C6.77 4.22 8.54 3.5 10.5 3.5C14.04 3.5 17.05 5.81 18.1 9L20.47 8.22C19.08 4.03 15.15 1 10.5 1Z" fill="#616B80"/>
    </svg>`;

    const redoIcon = `<svg xmlns="http://www.w3.org/2000/svg" width="21" height="9" viewBox="0 0 21 9" fill="none">
    <path d="M16.86 3.6C15.01 1.99 12.61 1 9.96 1C5.31 1 1.38 4.03 0 8.22L2.36 9C3.41 5.81 6.41 3.5 9.96 3.5C11.91 3.5 13.69 4.22 15.08 5.38L11.46 9H20.46V0L16.86 3.6Z" fill="#616B80"/>
    </svg>`;



    // Now initialize your Quill editor only if the container exists
    const quillContainer = document.querySelector('#quill-editor');
    if (quillContainer) {
        const quill = new Quill('#quill-editor', {
        theme: 'snow',
        modules: {
            toolbar: {
                container: [
                    ['undo', 'redo'], // Now these will show the SVGs above
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic'],
                    [{ 'align': [] }],
                    [{ 'list': 'bullet' }, { 'list': 'ordered' }],
                    [{ 'indent': '-1' }, { 'indent': '+1' }],
                    ['image']
                ],
                handlers: {
                    'undo': function () { this.quill.history.undo(); },
                    'redo': function () { this.quill.history.redo(); }
                }
            }
        }
    });
    }




})