$(document).ready(function () {
    "use strict";

    // Basic Table
    $("#basic-datatable").DataTable({
        keys: true,
        language: {
            paginate: {
                previous: "<i class='ri-arrow-left-s-line'>",
                next: "<i class='ri-arrow-right-s-line'>"
            }
        },
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
        }
    });

    // Buttons Table
    var buttonsTable = $("#datatable-buttons").DataTable({
        lengthChange: false,
        buttons: ["copy", "print"],
        language: {
            paginate: {
                previous: "<i class='ri-arrow-left-s-line'>",
                next: "<i class='ri-arrow-right-s-line'>"
            }
        },
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
        }
    });
    buttonsTable.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");

    // Selection Table
    $("#selection-datatable").DataTable({
        select: { style: "multi" },
        language: {
            paginate: {
                previous: "<i class='ri-arrow-left-s-line'>",
                next: "<i class='ri-arrow-right-s-line'>"
            }
        },
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
        }
    });

    // Alternative Paging
    $("#alternative-page-datatable").DataTable({
        pagingType: "full_numbers",
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
        }
    });

    // Scroll Vertical
    $("#scroll-vertical-datatable").DataTable({
        scrollY: "350px",
        scrollCollapse: true,
        paging: false,
        language: {
            paginate: {
                previous: "<i class='ri-arrow-left-s-line'>",
                next: "<i class='ri-arrow-right-s-line'>"
            }
        },
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
        }
    });

    // Scroll Horizontal
    $("#scroll-horizontal-datatable").DataTable({
        scrollX: true,
        language: {
            paginate: {
                previous: "<i class='ri-arrow-left-s-line'>",
                next: "<i class='ri-arrow-right-s-line'>"
            }
        },
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
        }
    });

    // Complex Header
    $("#complex-header-datatable").DataTable({
        columnDefs: [{ visible: false, targets: -1 }],
        language: {
            paginate: {
                previous: "<i class='ri-arrow-left-s-line'>",
                next: "<i class='ri-arrow-right-s-line'>"
            }
        },
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
        }
    });

    // Row Callback Example
    $("#row-callback-datatable").DataTable({
        createdRow: function (row, data, dataIndex) {
            if (parseFloat(data[5].replace(/[\$,]/g, "")) > 150000) {
                $("td", row).eq(5).addClass("text-danger");
            }
        },
        language: {
            paginate: {
                previous: "<i class='ri-arrow-left-s-line'>",
                next: "<i class='ri-arrow-right-s-line'>"
            }
        },
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
        }
    });

    // State Saving Table
    $("#state-saving-datatable").DataTable({
        stateSave: true,
        language: {
            paginate: {
                previous: "<i class='ri-arrow-left-s-line'>",
                next: "<i class='ri-arrow-right-s-line'>"
            }
        },
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
        }
    });

    // Fixed Columns Table
    $("#fixed-columns-datatable").DataTable({
        scrollY: 300,
        scrollX: true,
        scrollCollapse: true,
        paging: false,
        fixedColumns: true
    });

    // ✅ Fixed Header Table (Fixes your error)
    $("#fixed-header-datatable").DataTable({
        responsive: true,
        fixedHeader: true, // ✅ FIXED
        language: {
            paginate: {
                previous: "<i class='ri-arrow-left-s-line'>",
                next: "<i class='ri-arrow-right-s-line'>"
            }
        },
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
        }
    });

    // Styling select and label globally
    $(".dataTables_length select").addClass("form-select form-select-sm");
    $(".dataTables_length label").addClass("form-label");
});