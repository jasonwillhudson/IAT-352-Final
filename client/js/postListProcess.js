$(document).ready(function () {
  //select all the sub filter if media category is selected
  $("#media").change(function () {
    if ($(this).is(":checked")) {
      $('input[name="media"]').each(function () {
        $(this).prop("checked", true);
      });
    } else {
      $('input[name="media"]').each(function () {
        $(this).prop("checked", false);
      });
    }
  });

  //select all the sub filter if electronics category is selected
  $("#electronics").change(function () {
    if ($(this).is(":checked")) {
      $('input[name="electronics"]').each(function () {
        $(this).prop("checked", true);
      });
    } else {
      $('input[name="electronics"]').each(function () {
        $(this).prop("checked", false);
      });
    }
  });

  //select all the sub filter if toys category is selected
  $("#toys").change(function () {
    if ($(this).is(":checked")) {
      $('input[name="collectible"]').each(function () {
        $(this).prop("checked", true);
      });
    } else {
      $('input[name="collectible"]').each(function () {
        $(this).prop("checked", false);
      });
    }
  });

  //======form submit action triggers the event====//
  $("#filter").submit(function (event) {
    //prevent default form submission
    event.preventDefault();

    //store the form data and post it with the request
    var data = new FormData();

    // Add Checked box input to the form data
    $.each($("input[name='media']:checked"), function () {
      data.append("filter[]", $(this).val());
    });

    $.each($("input[name='electronics']:checked"), function () {
      data.append("filter[]", $(this).val());
    });

    $.each($("input[name='collectible']:checked"), function () {
      data.append("filter[]", $(this).val());
    });

    //the action in php is to get filter result
    data.append("action", "filterResult");

    //AJAX
    var request = $.ajax({
      url: "../../server/postListProcess.php",
      type: "post",
      data: data,
      //dataType: "json",
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


  //====add to collection if user click like======//
  $(document).on('click',".like",function () {
    //store the form data and post it with the request
    var data = new FormData();

    var el = $(this); //the selector being clicked

    //add the post id to the data
    data.append("postID", $(this).attr("id"));

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
        el.addClass("unlike");
        el.removeClass("like");
        el.html("&#9733;");
      } else console.log("error" + msg);
    });

    request.fail(function (msg) {
      console.log("error" + msg);
    });
  });



  //=====remove from collection if user click unlike=====//
    $(document).on('click',".unlike",function () {
    //store the form data and post it with the request
    var data = new FormData();

    var el = $(this); //the selector being clicked

    //add the post id to the data
    data.append("postID", $(this).attr("id"));

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

        //replace the yellow star to empty star
        el.addClass("like");
        el.removeClass("unlike");
        el.html("&#9734;");
      } else console.log("success but" + msg);
    });

    request.fail(function (msg) {
      console.log("error" + msg);
    });
  });
});
