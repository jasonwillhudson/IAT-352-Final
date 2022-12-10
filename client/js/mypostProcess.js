$(document).ready(function () {
  //=====remove post if user click delete=====//
  $(document).on("click", ".delete-button", function () {
    //store the form data and post it with the request
    var data = new FormData();

    //add the post id to the data
    data.append("postID", $(this).attr("id"));

    //add the action command to the data
    data.append("action", "removeMyPost");

    //AJAX
    var request = $.ajax({
      url: "../../server/postListProcess.php",
      type: "post",
      data: data,
      contentType: false,
      processData: false,
    });

    //render all the elements on the page if success
    request.done(function (msg) {
      $("#posts").html(msg);
    });

    request.fail(function (msg) {
      console.log("error" + msg);
    });
  });
});
