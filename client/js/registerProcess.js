$(document).ready(function () {


  // get the data inside the html form.
  // this function is called after the submit button is clicked inside the product-insert-form form.
  $("form").submit(function (event) {
    event.preventDefault();


    //create a object to store json data
    var data = $(this).serializeArray();


    //if any required inputs are empty, show the error message
    if (
      $("#email").val() == "" ||
      $("#password").val() == "" ||
      $("#city").val() == "" ||
      $("#reEnterPassword").val() == "" ||
      $("#name").val() == ""
    )
      $(".errorMssg").html("please fill all the required field");


    //if re-entered password does not match password, show error message
    else if ($("#password").val() != $("#reEnterPassword").val())
      $(".errorMssg").html("re-entered password does not match password");


    //if inputs are not empty, send the request to server
    else {


      //add the form inputs to the data object
      data.push({
        email: $("#email").val(),
        password: $("#password").val(),
        city: $("#city").val(),
        phone: $("#phone").val(),
        name: $("#name").val(),
      });

      
      // write and AJAX request to send the data to the server (loginProcess.php)
      var request = $.ajax({
        url: "../../server/registerProcess.php",
        method: "post",
        data: data,
      });
      

      request.done(function (msg) {
        if (msg == "success") window.location.href = "../pages/login.php";
        else $(".errorMssg").html(msg);
        // console.log(msg);
      });

      request.fail(function (msg) {
        $(".errorMssg").html(msg);
      });
    } //end of else
  });
});
