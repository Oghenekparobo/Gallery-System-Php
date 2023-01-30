$(document).ready(function () {
  var user_ref;
  var user_ref_splitted;
  var user_id;
  var image_ref;
  var image_ref_splitted;
  var image_name;
  var photo_id;

  $(".modal_thumbnails").click(function () {
    $("#set_user_image").prop("disabled", false);
    user_ref = $("#user-id").prop("href");
    user_ref_splitted = user_ref.split("=");
    user_id = user_ref_splitted[user_ref_splitted.length - 1];

    image_ref = $(this).prop("src");
    image_ref_splitted = image_ref.split("/");
    image_name = image_ref_splitted[image_ref_splitted.length - 1];
    photo_id = $(this).attr("data");


    $.ajax({
      url: "includes/ajax_code.php",
      data: { photo_id },
      type: "POST",
      success: function (data) {
        if (!data.error) {
          $("#modal_sidebar").html(data);
        }
      }
    });
  });

  $("#set_user_image").click(function () {
    $.ajax({
      url: "includes/ajax_code.php",
      data: { image_name, user_id },
      type: "POST",
      success: function (data) {
        if (!data.error) {
          location.reload(true);
        }
      }
    });
  });
});
