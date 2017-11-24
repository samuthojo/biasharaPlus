var table = null;

var product_id = "";

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

  $("#category_id").click(function() {
    $(this).next().fadeOut(0);
  });

  $(":text").keydown(function() {
    $(this).next().fadeOut(0);
  });

  // Add event listener for opening and closing details
  $('#myTable tbody').on('click', 'td.details-control', function () {
    var tr = $(this).closest('tr');
    var row = table.row( tr );

    var product_id = row.data()[1];

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
  });

});

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

function addProduct() {
  var form = document.getElementById("add_product_form");
  var formData = new FormData(form);
  $.ajax({
         type: "post",
         url: "/products",
         data: formData,
         contentType: false,
         processData: false,
         success: function() {
           window.location.href = '/products';
         },
         error: function(error) {
           data = JSON.parse(error.responseText);
           showProductErrors(data.errors);
         }
       });
}

function showProductErrors(errors) {
  if(errors.category_id != null) {
    $("#category_id_error").text(errors.category_id);
    $("#category_id_error").fadeIn(0);
  }
  if(errors.name != null) {
    $("#product_name_error").text(errors.name);
    $("#product_name_error").fadeIn(0);
  }
  if(errors.code != null) {
    $("#product_code_error").text(errors.code);
    $("#product_code_error").fadeIn(0);
  }
  if(errors.cc != null) {
    $("#product_cc_error").text(errors.cc);
    $("#product_cc_error").fadeIn(0);
  }
  if(errors.image != null) {
    $("#product_image_error").text(errors.image);
    $("#product_image_error").fadeIn(0);
  }
}

function showEditProductModal(prod_id) {
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
      applyTheUpdates(product);
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

function applyTheUpdates(product) {
  $("#product_name_" + product.id).text(product.name);
  $("#category_name_" + product.id).text(product.category_name);
  $("#product_code_" + product.id).text(product.code);
  $("#product_cc_" + product.id).text(product.cc);
}

function showProductDeleteModal(prod_id) {
  showModal("delete_confirmation_modal");
  product_id = prod_id;
}

function deleteProduct() {
  $.ajax({
    type: 'delete',
    url: '/products/' + product_id,
    success: function() {
      window.location.href = "/products";
    }
  });
}
