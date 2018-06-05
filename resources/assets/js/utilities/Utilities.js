exports.initDataTable = function () {

  $.fn.dataTable.moment('DD-MM-YYYY') //Sort the date column if present

  $("#myTable").dataTable({
      dom: 'Bfrtip',
      "order": [[0, "desc"]],
      buttons: [
          {
            extend: 'print',
            exportOptions: {
              columns: ":not(:last-child)"
            },
            title: "Payments",
            messageTop: "Payments As Of " + moment().format('MMMM Do YYYY')
          },
           {
             extend: 'excel',
             exportOptions: {
               columns: ":not(:last-child)"
             },
             title: "Payments",
             messageTop: "Payments As Of " + moment().format('MMMM Do YYYY')
          },
           {
             extend: 'pdf',
             exportOptions: {
               columns: ":not(:last-child)"
             },
             title: "Payments",
             messageTop: "Payments As Of  " + moment().format('MMMM Do YYYY')
          }
      ],
      iDisplayLength: 8,
      bLengthChange: false
  })
}
