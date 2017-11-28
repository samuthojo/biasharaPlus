var price_id = "";
var product_id = "";
var price_list_id = "";

function addPrice() {
  $.ajax({
    type: "post",
    url: "/prices",
    data: $("#add_price_form").serialize(),
    success: function (price) {
      closeModal("add_price_modal");
      window.location.href = "/products/" + price.product_id + "/prices";
    },
    error: function (error) {
      data = JSON.parse(error.responseText);
      showAddPriceErrors(data.errors);
    }
  });
}

function showAddPriceErrors(errors) {
  if(errors.price_list_id != null) {
    $("#pricelist_id_error").text(errors.price_list_id);
    $("#pricelist_id_error").fadeIn(0);
  }
  if(errors.tanzania != null) {
    $("#tanzania_price_error").text(errors.tanzania);
    $("#tanzania_price_error").fadeIn(0);
  }
  if(errors.kenya != null) {
    $("#kenya_price_error").text(errors.kenya);
    $("#kenya_price_error").fadeIn(0);
  }
  if(errors.uganda != null) {
    $("#uganda_price_error").text(errors.uganda);
    $("#uganda_price_error").fadeIn(0);
  }
}

function showEditPriceModal(price) {
  price_id = price.id;

  product_id = price.product_id;

  price_list_id = price.price_list_id;

  showModal("edit_price_modal");

  $("#edit_price_list_id").val(price.pricelist_name);

  $("#edit_price").val(price.price);

  $("#edit_tanzania").val(price.tanzania);

  $("#edit_kenya").val(price.kenya);

  $("#edit_uganda").val(price.uganda);
}

function attemptUpdatePrice() {
  var form = document.getElementById("edit_price_form");
  var formData = new FormData(form);
  formData.append('product_id', product_id);
  formData.append('price_list_id', price_list_id);
  $.ajax({
    type: "post",
    url: "/prices/" + price_id,
    data: formData,
    contentType: false,
    processData: false,
    success: function(table) {
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false)
      closeModal("edit_price_modal");
      $("#productPricesTable").html(table);
      $("#success-alert").text("Product Price updated successfully");
      $("#success-alert").fadeIn(0, function() {
        $("#success-alert").fadeOut(1500);
      });
    },
    error: function(error) {
      console.log(error);
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      data = JSON.parse(error.responseText);
      showUpdatePriceErrors(data.errors);
    }
  });
  $(".my_loader").fadeIn(0);
  $(".btn-success").prop("disabled", true);
}

function applyTheUpdates(price) {
  $("#pricelist_name_" + price.pricelist_name).text(price.pricelist_name);
  $("#tanzania_" + price.tanzania).text(price.tanzania);
  $("#kenya_" + price.kenya).text(price.kenya);
  $("#uganda_" + price.uganda).text(price.uganda);
}

function showUpdatePriceErrors(errors) {
  if(errors.price_list_id != null) {
    $("#edit_pricelist_id_error").text(errors.price_list_id);
    $("#edit_pricelist_id_error").fadeIn(0);
  }
  if(errors.price != null) {
    $("#edit_price_error").text(errors.price);
    $("#edit_price_error").fadeIn(0);
  }
  if(errors.tanzania != null) {
    $("#edit_tanzania_price_error").text(errors.tanzania);
    $("#edit_tanzania_price_error").fadeIn(0);
  }
  if(errors.kenya != null) {
    $("#edit_kenya_price_error").text(errors.kenya);
    $("#edit_kenya_price_error").fadeIn(0);
  }
  if(errors.uganda != null) {
    $("#edit_uganda_price_error").text(errors.uganda);
    $("#edit_uganda_price_error").fadeIn(0);
  }
}
