var table = null;

var bundle_id = "";

function showEditBundleErrors(errors) {
  if(errors.price != null) {
    $("#edit_price_error").text(errors.price);
    $("#edit_price_error").fadeIn(0);
  }
}

function showEditBundleModal(bundle) {
  showModal("edit_bundle_modal");

  $("#edit_name").val(bundle.name);
  $("#edit_duration").val(bundle.duration_in_months);
  $("#edit_price").val(bundle.price);

  bundle_id = bundle.id;
}

function attemptEditBundle() {
  var form = document.getElementById('edit_bundle_form');
  var formData = new FormData(form);
  $.ajax({
    type: "post",
    url: "/bundles/" + bundle_id,
    data: formData,
    contentType: false,
    processData: false,
    success: function(table) {
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      closeModal("edit_bundle_modal");
      $("#bundlesTable").html(table);
      $("#success-alert").text("Bundle updated successfully");
      $("#success-alert").fadeIn(0, function() {
        $("#success-alert").fadeOut(1500);
      });
    },
    error: function(error) {
      console.log(error);
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      data = JSON.parse(error.responseText);
      showEditBundleErrors(data.errors);
    }
  });
  $(".my_loader").fadeIn(0);
  $(".btn-success").prop("disabled", true);
}
