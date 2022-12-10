$(document).ready(function () {

    //initialize the first image to display on the canvas
  if($('.gallery-img').length>0) $(".first-image").attr("src", $(".gallery-img").attr("src"));

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

  //=====display an image on big canvas if user click on it=====//
  $(document).on("click", ".gallery-img", function () {
    var el = $(this); //the selector being clicked
    $(".first-image").attr("src", el.attr("src"));
    
  });


  //====add to collection if user click like======//
  $(document).on('click',".like-button",function () {
    //store the form data and post it with the request
    var data = new FormData();

    var el = $(this); //the selector being clicked

    //add the post id to the data
    data.append("postID", $("#postID").text());

    //add the action command to the data
    data.append("action", "addCollection");

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
      if (msg == "success") {

        //replace the empty star to yellow star
        $(".star").addClass("unlike");
        $(".star").removeClass("like");
        $(".star").html("&#9733;");

        //change text to unlike
        el.addClass("unlike-button");
        el.removeClass("like-button");
        $(".button-text").html("Unlike");
      } else console.log("error" + msg);
    });

    request.fail(function (msg) {
      console.log("error" + msg);
    });
  });



  //====add to collection if user click like======//
  $(document).on('click',".unlike-button",function () {
    //store the form data and post it with the request
    var data = new FormData();

    var el = $(this); //the selector being clicked

    //add the post id to the data
    data.append("postID", $("#postID").text());

    //add the action command to the data
    data.append("action", "removeCollection");

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
      if (msg == "success") {

        //replace the empty star to yellow star
        $(".star").addClass("like");
        $(".star").removeClass("unlike");
        $(".star").html("&#9734;");

        //change text to unlike
        el.addClass("like-button");
        el.removeClass("unlike-button");
        $(".button-text").html("Like");
      } else console.log("error" + msg);
    });

    request.fail(function (msg) {
      console.log("error" + msg);
    });
  });


});
