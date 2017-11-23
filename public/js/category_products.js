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
}

function moreDetails(product_id) {
  var tr = $("td.details-control").closest('tr');
  var row = table.row( tr );

  if ( row.child.isShown() ) {
      // This row is already open - close it
      row.child.hide();
      tr.removeClass('shown');
  }
  else {
    var link = "/products/" + product_id + "/more_details";
         $.getJSON(link)
          .done( function (product) {
            row.child.hide();
            tr.removeClass('shown');
            row.child(format(product)).show();
            tr.addClass('shown');
          })
          .fail( function (error) {
            console.log(error);
          });
          row.child(format2()).show();
          tr.addClass('shown');
  }
}

function format(product) {
  return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<th>Picture:</th>'+
            '<td>'+
              "<img class='img-rounded' alt='product picture' " +
                  "src=" + product.image + " width='30%' height='auto'>" +
            '</td>'+
        '</tr>'+
        '<tr>'+
            '<th>Description:</th>'+
            '<td>'+ product.description +'</td>'+
        '</tr>'+
    '</table>';
}

function format2() {
  return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
      '<tr>'+
          '<td>'+ '<span> Fetching...' +
            '<i class="fa fa-spinner fa-spin fa-3x fa-fw text-success"></i>' +
          '</span>' +'</td>'+
      '</tr>'+
  '</table>';
}
