$(document).ready(function () {

  // get the data inside the html form.
  // this function is called after the submit button is clicked inside the product-insert-form form.
  $("form").submit(function (event) {

    //prevent default event
    event.preventDefault();

    //create a object to store json data
    var data = $(this).serializeArray();

    //check if the inputs are empty
    if ($("#email").val() == "" || $("#password").val() == "")
      $(".errorMssg").html("please enter email and password");
    //if inputs are not empty
    else {
      data.push({ email: $("#email").val(), password: $("#password").val() });

      // write and AJAX request to send the data to the server (loginProcess.php)
      var request = $.ajax({
        url: "../../server/loginProcess.php",
        method: "post",
        data: data,
      });

      request.done(function (msg) {
        if(msg == "success")    window.location.href = "../pages/register.php";
        $(".errorMssg").html(msg);
      });

      request.fail(function (msg) {
        $(".errorMssg").html(msg);
      });
    } //end of else
  });
});
