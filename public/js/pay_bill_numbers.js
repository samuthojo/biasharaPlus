var table = null;

var number_id = "";

function addNumber() {
  $.ajax({
    type: 'post',
    url: '/pay_bill_numbers',
    data: $("#add_number_form").serialize(),
    success: function (table) {
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      closeModal("add_number_modal");
      $("#numbersTable").html(table);
      $("#success-alert").text("Number added successfully");
      $("#success-alert").fadeIn(0, function() {
        $("#success-alert").fadeOut(1500);
      });
    },
    error: function(error) {
      console.log(error);
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      data = JSON.parse(error.responseText);
      showAddNumberErrors(data.errors);
    }
  });
  $(".my_loader").fadeIn(0);
  $(".btn-success").prop("disabled", true);
}

function showAddNumberErrors(errors) {
  if(errors.service_provider != null) {
    $("#service_provider_error").text(errors.service_provider);
    $("#service_provider_error").fadeIn(0);
  }
  if(errors.phone_number != null) {
    $("#phone_number_error").text(errors.phone_number);
    $("#phone_number_error").fadeIn(0);
  }
}

function showEditNumberErrors(errors) {
  if(errors.service_provider != null) {
    $("#edit_service_provider_error").text(errors.service_provider);
    $("#edit_service_provider_error").fadeIn(0);
  }
  if(errors.phone_number != null) {
    $("#edit_phone_number_error").text(errors.phone_number);
    $("#edit_phone_number_error").fadeIn(0);
  }
}

function showEditNumberModal(number) {
  showModal("edit_number_modal");

  $("#edit_service_provider").val(number.service_provider);
  $("#edit_phone_number").val(number.phone_number);

  number_id = number.id;
}

function attemptEditNumber() {
  var form = document.getElementById('edit_number_form');
  var formData = new FormData(form);
  $.ajax({
    type: "post",
    url: "/pay_bill_numbers/" + number_id,
    data: formData,
    contentType: false,
    processData: false,
    success: function(table) {
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      closeModal("edit_number_modal");
      $("#numbersTable").html(table);
      $("#success-alert").text("Number updated successfully");
      $("#success-alert").fadeIn(0, function() {
        $("#success-alert").fadeOut(1500);
      });
    },
    error: function(error) {
      console.log(error);
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      data = JSON.parse(error.responseText);
      showEditNumberErrors(data.errors);
    }
  });
  $(".my_loader").fadeIn(0);
  $(".btn-success").prop("disabled", true);
}

function showDeleteNumberModal(id) {
  number_id = id;
  showModal('delete_confirmation_modal');
}

function deleteNumber() {
  $.ajax({
    type: 'delete',
    url: '/pay_bill_numbers/' + number_id,
    success: function(table) {
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      closeModal("delete_confirmation_modal");
      $("#numbersTable").html(table);
      $("#success-alert").text("Number deleted successfully");
      $("#success-alert").fadeIn(0, function() {
        $("#success-alert").fadeOut(1500);
      });
    },
    error: function(error) {
      console.log(error);
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
    }
  });

  $(".my_loader").fadeIn(0);
  $(".btn-success").prop("disabled", true);
}
