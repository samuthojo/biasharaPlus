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
