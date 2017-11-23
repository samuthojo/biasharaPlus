var price_id = "";

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

function showEditPriceModal(id) {
  price_id = id;
  var link = "/prices/" + price_id;
   $.getJSON(link)
    .done( function (price) {
      $(".loader").fadeOut(0);
      showModal("edit_price_modal");
      $("#edit_price_list_id").val(price.price_list_id);
      $("#edit_tanzania").val(price.tanzania);
      $("#edit_kenya").val(price.kenya);
      $("#edit_uganda").val(price.uganda);
    })
    .fail( function (error) {
      console.log(error);
    });
   $(".loader").fadeIn(0);
}

function attemptUpdatePrice() {
  $.ajax({
    type: "post",
    url: "/prices/" + price_id,
    data: $("#edit_price_form").serialize(),
    success: function(price) {
      closeModal("edit_price_modal");
      applyTheUpdates(price);
      $("#success-alert").text("Price updated successfully");
      $("#success-alert").fadeIn(0, function() {
        $("#success-alert").fadeOut(1500);
      });
    },
    error: function(error) {
      data = JSON.parse(error.responseText);
      showUpdatePriceErrors(data.errors);
    }
  });
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
