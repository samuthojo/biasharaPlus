var notification_type = "";

$(function() {
  $("#type").click(function() {
    $("#error-alert").fadeOut(0);
  });
  $(":text").keydown(function() {
    $("#error-alert").fadeOut(0);
  });
  $("#news").keydown(function() {
    $("#error-alert").fadeOut(0);
  });
});

function generalNews() {
  var type = parseInt($("#type").val());
  if (type == 1) {
    $("#notification_title").fadeOut(0);
    $("#general_news").fadeOut(0);
  }
  else if (type == 2) {
    $("#notification_title").fadeIn(0);
    $("#general_news").fadeIn(0);
  }
}

function sendNotification() {
  notification_type = parseInt($("#type").val());
  if(type == "" || type == null) {
    $("#error-alert").text("Please select a notification type");
    $("#error-alert").fadeIn(0);
  }
  else if(type == 1) {
    send();
  }
  else if (type == 2) {
    sendNewsNotification();
  }
}

function sendNewsNotification() {
  var title = news = ""
  title = ($("#title").val()).trim();
  news = ($("#news").val()).trim();
  if(title == "" || title == null) {
    $("#error-alert").text("Please enter notification title");
    $("#error-alert").fadeIn(0);
  }
  else if(news == "" || news == null) {
    $("#error-alert").text("Please enter the news");
    $("#error-alert").fadeIn(0);
  }
  else {
    send();
  }
}

function send() {
  $.ajax({
    type: 'post',
    url: '/notifications',
    data: $("#notification_form").serialize(),
    success: function(status) {
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      if(status) {
        $("#success-alert").text("Notification sent");
        $("#success-alert").fadeIn(0, function() {
          $("#success-alert").fadeOut(1500);
        });
        clearData();
      }
      else {
        $("#error-alert").text("Sending failed");
        $("#error-alert").fadeIn(0, function() {
          $("#error-alert").fadeOut(1500);
        });
      }
    },
    error: function(error) {
      $(".my_loader").fadeOut(0);
      $(".btn-success").prop("disabled", false);
      console.log(error);
    }
  });
  $(".my_loader").fadeIn(0);
  $(".btn-success").prop("disabled", true);
}

function clearData() {
  $("form").find('select, input, textarea').each(function () {
    $(this).val("");
  });
}
