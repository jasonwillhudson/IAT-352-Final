$(document).ready(function () {
  //=====remove from collection if user click unlike=====//
  $(document).on("click", ".unlike", function () {
    //store the form data and post it with the request
    var data = new FormData();

    var el = $(this); //the selector being clicked

    //add the post id to the data
    data.append("postID", $(this).attr("id"));

    //add the action command to the data
    data.append("action", "removeFromPage");

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
