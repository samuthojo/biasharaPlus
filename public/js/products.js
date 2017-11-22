var table = null;

$(document).ready( function() {
 table = $("#myTable").DataTable({
    dom: 'Bfrtip',
    buttons: [
        {
          extend: 'print',
          exportOptions: {
            columns: ":not(:last-child)"
          },
          title: "Products",
          messageTop: "The List Of Products As Of {{date('d-m-Y')}}"
        },
         {
           extend: 'excel',
           exportOptions: {
             columns: ":not(:last-child)"
           },
           title: "Products",
           messageTop: "The List Of Products As Of {{date('d-m-Y')}}"
        },
         {
           extend: 'pdf',
           exportOptions: {
             columns: ":not(:last-child)"
           },
           title: "Products",
           messageTop: "The List Of Products As Of {{date('d-m-Y')}}"
        }
    ],
    iDisplayLength: 8,
    bLengthChange: false
  });

});

function productMoreDetails(image, description) {
  var tr = $(this).closest('tr');
  var row = table.row( tr );

  if ( row.child.isShown() ) {
      // This row is already open - close it
      row.child.hide();
      tr.removeClass('shown');
  }
  else {
    row.child(format(image, description)).show();
    tr.addClass('shown');
  }
}

function format(image, description) {
  return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<th>Image:</th>'+
            '<td>'+ "<img class='img-rounded' " +
                      "alt='product image' src=" + image +  " width='10%' height='auto'>"
                   +
            '</td>'+
        '</tr>'+
        '<tr>'+
          '<th>Description:</th>'+
          '<td>' + description + '</td>'+
        '<tr>'+
    '</table>';
}
