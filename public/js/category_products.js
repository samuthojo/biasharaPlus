var table =  null;

function myDataTable(category_name) {
  table = $("#myTable").DataTable({
     dom: 'Bfrtip',
     buttons: [
         {
           extend: 'print',
           exportOptions: {
             columns: ":not(:last-child)"
           },
           title: category_name + " Products",
           messageTop: category_name + " Products As Of {{date('d-m-Y')}}"
         },
          {
            extend: 'excel',
            exportOptions: {
              columns: ":not(:last-child)"
            },
            title: category_name + " Products",
            messageTop: category_name + " Products As Of {{date('d-m-Y')}}"
         },
          {
            extend: 'pdf',
            exportOptions: {
              columns: ":not(:last-child)"
            },
            title: category_name + " Products",
            messageTop: category_name + " Products As Of {{date('d-m-Y')}}"
         }
     ],
     iDisplayLength: 8,
     bLengthChange: false
   });

   // Add event listener for opening and closing details
   $('#myTable tbody').on('click', 'td.details-control', function () {
     var tr = $(this).closest('tr');
     var row = table.row( tr );

     if ( row.child.isShown() ) {
         // This row is already open - close it
         row.child.hide();
         tr.removeClass('shown');
     }
     else {
       row.child(format(data)).show();
       tr.addClass('shown');
     }
   });

}
