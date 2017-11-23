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
    var link = "/products/" + product_id + "/product_details";
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

function showEditProductsModal(prod_id) {
  var link = "/products/" + prod_id + "/product_details";
   $.getJSON(link)
    .done( function (product) {
      $(".loader").fadeOut(0);
      showModal("edit_product_modal");
      $("#edit_category_id").val(product.category_id);
      $("#edit_product_name").val(product.name);
      $("#edit_product_code").val(product.code);
      $("#edit_product_cc").val(product.cc);
      $("#edit_product_description").val(product.description);
    })
    .fail( function (error) {
      console.log(error);
    });
   $(".loader").fadeIn(0);
   product_id = prod_id;
}

function attemptEditProduct() {
  var form = document.getElementById('edit_product_form');
  var formData = new FormData(form);
  $.ajax({
    type: "post",
    url: "/products/" + product_id,
    data: formData,
    contentType: false,
    processData: false,
    success: function(product) {
      closeModal("edit_product_modal");
      updateTheUI(product);
      $("#success-alert").text("Product updated successfully");
      $("#success-alert").fadeIn(0, function() {
        $("#success-alert").fadeOut(1500);
      });
    },
    error: function(error) {
      data = JSON.parse(error.responseText);
      $("#edit_category_name_error").text(data.errors.name);
      $("#edit_category_name_error").fadeIn(0, function() {
        $("#edit_category_name_error").fadeOut(1500);
      });
    }
  });
}

function updateTheUI(product) {
  $("#product_name_" + product.id).text(product.name);
  $("#category_name_" + product.id).text(product.category_name);
  $("#product_code_" + product.id).text(product.code);
  $("#product_cc_" + product.id).text(product.cc);
}

function showProductsDeleteModal(prod_id) {
  showModal("delete_confirmation_modal");
  product_id = prod_id;
}

function deleteCategoryProducts() {
  $.ajax({
    type: 'delete',
    url: '/products/' + product_id,
    success: function() {
      window.location.href = "/products";
    }
  });
}
