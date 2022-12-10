$(document).ready(function () {
  //=====remove from collection if user click unlike=====//
  $(document).on("click", ".nav-btn", function () {
    var el = $(this); //the selector being clicked

    //if the user clicked login button
    if (el.text() == "Login") {
      window.location.href = "../pages/login.php";
    }

    //if user clicked sign out button
    else {
      //AJAX
      var request = $.ajax({
        url: "../../server/signOut.php",
        type: "post",
        data: {},
        contentType: false,
        processData: false,
      });

      //after request successfully done
      request.done(function (msg) {
        //direct user to items page
        window.location.href = "../pages/showmodels.php";
      });

      request.fail(function (msg) {
        console.log("error" + JSON.stringify(msg));
      });
    } //end of else
  });
});
