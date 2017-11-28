var table = null;

var version_id = "";

function format(version) {
  return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<th>Features:</th>'+
            '<td>'+ version.features +'</td>'+
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

function addVersion() {
  var form = document.getElementById("add_version_form");
  var formData = new FormData(form);
  $.ajax({
         type: "post",
         url: "/versions",
         data: formData,
         contentType: false,
         processData: false,
         success: function(table) {
           $(".my_loader").fadeOut(0);
           $(".btn-success").prop("disabled", false);
           closeModal("add_version_modal");
           $("#versionsTable").html(table);
           $("#success-alert").text("Version added successfully");
           $("#success-alert").fadeIn(0, function() {
             $("#success-alert").fadeOut(1500);
           });
         },
         error: function(error) {
           console.log(error);
           $(".my_loader").fadeOut(0);
           $(".btn-success").prop("disabled", false);
           data = JSON.parse(error.responseText);
           showAddVersionErrors(data.errors);
         }
       });
       $(".my_loader").fadeIn(0);
       $(".btn-success").prop("disabled", true);
}

function showAddVersionErrors(errors) {
  if(errors.version_number != null) {
    $("#version_number_error").text(errors.version_number);
    $("#version_number_error").fadeIn(0);
  }
  if(errors.features != null) {
    $("#features_error").text(errors.features);
    $("#features_error").fadeIn(0);
  }
}

function showEditVersionErrors(errors) {
  if(errors.version_number != null) {
    $("#edit_version_number_error").text(errors.version_number);
    $("#edit_version_number_error").fadeIn(0);
  }
  if(errors.features != null) {
    $("#edit_features_error").text(errors.features);
    $("#edit_features_error").fadeIn(0);
  }
}

function showEditVersionModal(version) {
  showModal("edit_version_modal");

  $("#edit_version_number").val(version.version_number);

  $("#edit_features").val(version.features);

  version_id = version.id;
}

function attemptEditVersion() {
  var form = document.getElementById('edit_version_form');
  var formData = new FormData(form);
  $.ajax({
    type: "post",
    url: "/versions/" + version_id,
    data: formData,
    contentType: false,
    processData: false,
    success: function(table) {
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      closeModal("edit_version_modal");
      $("#versionsTable").html(table);
      $("#success-alert").text("Version updated successfully");
      $("#success-alert").fadeIn(0, function() {
        $("#success-alert").fadeOut(1500);
      });
    },
    error: function(error) {
      console.log(error);
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      data = JSON.parse(error.responseText);
      showEditVersionErrors(data.errors);
    }
  });
  $(".my_loader").fadeIn(0);
  $(".btn-success").prop("disabled", true);
}
