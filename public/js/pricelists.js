var pricelist_id = "";

function addPriceList() {
  var form = document.getElementById("add_pricelist_form");
  var formData = new FormData(form);
  $.ajax({
         type: "post",
         url: "/pricelists",
         data: formData,
         contentType: false,
         processData: false,
         success: function(table) {
           $(".my_loader").fadeOut(0);
           $(".btn-success").prop("disabled", false);
           closeModal("add_pricelist_modal");
           $("#priceListsTable").html(table);
           $("#success-alert").text("PriceList added successfully");
           $("#success-alert").fadeIn(0, function() {
             $("#success-alert").fadeOut(1500);
           });
         },
         error: function(error) {
           console.log(error);
           $(".my_loader").fadeOut(0);
           $(".btn-success").prop("disabled", false);
           data = JSON.parse(error.responseText);
           showAddPriceListErrors(data.errors);
         }
       });
       $(".my_loader").fadeIn(0);
       $(".btn-success").prop("disabled", true);
}

function showAddPriceListErrors(errors) {
  if(errors.name != null) {
    $("#pricelist_name_error").text(errors.name);
    $("#pricelist_name_error").fadeIn(0);
  }
  if(errors.effective_date != null) {
    $("#effective_date_error").text(errors.effective_date);
    $("#effective_date_error").fadeIn(0);
  }
  if(errors.color != null) {
    $("#pricelist_color_error").text(errors.color);
    $("#pricelist_color_error").fadeIn(0);
  }
}

function showEditPriceListModal(pricelist) {
  pricelist_id = pricelist.id

  showModal("edit_pricelist_modal");

  $("#edit_pricelist_name").val(pricelist.name);

  $("#edit_effective_date").val(pricelist.effective_date);

  $("#edit_pricelist_color").val(pricelist.color);
}

function attemptEditPriceList() {
  var form = document.getElementById('edit_pricelist_form');
  var formData = new FormData(form);
  $.ajax({
    type: "post",
    url: "/pricelists/" + pricelist_id,
    data: formData,
    contentType: false,
    processData: false,
    success: function(table) {
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      closeModal("edit_pricelist_modal");
      $("#priceListsTable").html(table);
      $("#success-alert").text("PriceList updated successfully");
      $("#success-alert").fadeIn(0, function() {
        $("#success-alert").fadeOut(1500);
      });
    },
    error: function(error) {
      console.log(error);
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      data = JSON.parse(error.responseText);
      showEditPriceListErrors(data.errors);
    }
  });
  $(".my_loader").fadeIn(0);
  $(".btn-success").prop("disabled", true);
}

function showEditPriceListErrors(errors) {
  if(errors.name != null) {
    $("#edit_pricelist_name_error").text(errors.name);
    $("#edit_pricelist_name_error").fadeIn(0);
  }
  if(errors.effective_date != null) {
    $("#edit_effective_date_error").text(errors.effective_date);
    $("#edit_effective_date_error").fadeIn(0);
  }
  if(errors.color != null) {
    $("#edit_pricelist_color_error").text(errors.color);
    $("#edit_pricelist_color_error").fadeIn(0);
  }
}

function showPriceListDeleteModal(id) {
  showModal("delete_confirmation_modal");
  pricelist_id = id;
}

function deletePriceList() {
  $.ajax({
    type: 'delete',
    url: '/pricelists/' + pricelist_id,
    success: function(table) {
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      closeModal("delete_confirmation_modal");
      $("#priceListsTable").html(table);
      $("#success-alert").text("PriceList deleted successfully");
      $("#success-alert").fadeIn(0, function() {
        $("#success-alert").fadeOut(1500);
      });
    },
    error: function(error) {
      console.log(error);
    }
  });
  $(".btn-success").prop("disabled", true);
  $(".my_loader").fadeIn(0);
}
