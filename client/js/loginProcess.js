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


      //if the request successful done
      request.done(function (msg) {
        msg = JSON.parse(msg);
        console.log(typeof msg[0].mssg);
        console.log(msg[0].visitedUrl);


        //direct user to last visted page if no error occurs
        if (msg[0].mssg == "success") {
          if (msg[0].visitedUrl == "")
            window.location.href = "../pages/register.php";
          else window.location.replace("http://" + msg[0].visitedUrl);
        } 
        
        //show error message if something wrong in the backend
        else $(".errorMssg").html(msg[0].mssg);
      });


      //if the request fail
      request.fail(function (msg) {
        $(".errorMssg").html("failed to login");
      });
    } //end of else
  });
});
