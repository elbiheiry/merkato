/*Loading
==========================*/
$(window).on("load", function () {
  "use strict";
  $(".spinner").fadeOut(function () {
    $(this).parent().fadeOut();
    $("body").css({ "overflow-y": "visible" });
  });
});

$(document).ready(function () {
  "use strict";
  // Tooltip
  $('[data-toggle="tooltip"]').tooltip();
  // Toggle Button
  $(".toggle-btn").click(function () {
    $("aside").toggleClass("move");
  });
  // Data Table
  if ($(".datatable").length > 0) {
    $(".datatable").DataTable({
      fixedHeader: true,
      dom: "Bfrtip",
      buttons: [
        {
          extend: "pdfHtml5",
          text: '<i class="fa fa-file-pdf"></i>',
          titleAttr: "PDF",
        },
      ],
    });
  }
  $(".jfilestyle").jfilestyle({
    // theme: "blue",
    text: " Add Image ",
    placeholder: " Add image ",
  });
});
