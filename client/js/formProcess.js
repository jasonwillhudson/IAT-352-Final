$(document).ready(function () {
  //hide the error message of check box on start
  $("#checkErrMssg").hide();

  //form submit action triggers the event
  $("form").submit(function (event) {
    //prevent default form submission
    event.preventDefault();

    //hide the error message of check box if at least one is chosen
    if (verifyCheckBox()) {
      $("#checkErrMssg").hide();
    }
    //terminate the function and show error message if checkbox not selected
    else {
      $("#checkErrMssg").show();
      return false;
    }

    //store the form data and post it with the request
    var data = new FormData();

    // Add selected file to the form data
    var totalfiles = $("#fileInput")[0].files.length;
   
    for (var index = 0; index < totalfiles; index++) {
      data.append("files[]", $("#fileInput")[0].files[index]);
    }

        for(var pair of data.entries()) {
        console.log(pair[0]+ ', '+ pair[1]['name']); 
     }

    // Add Checked box input to the form data
    $.each($("input[name='tradeCategory']:checked"), function () {
      data.append("tradeCategory[]", $(this).val());
    });

    //Add all other data
    data.append("title", $("#title").val());
    data.append("description", $("#description").val());
    data.append("worthValue", $("#worthValue").val());
    data.append("category", $("#category").val());


    //AJAX
    var request = $.ajax({
      url: "../../server/formProcess.php",
      type: "post",
      data: data,
      //dataType: "json",
      contentType: false,
      processData: false,
    });

    request.done(function (msg) {
        //if(msg == "success")    window.location.href = "../pages/register.php";
        console.log(msg);
      });

      request.fail(function (msg) {
        console.log("error" + msg);
      });
  });
});

//Check if any of check box are selected
function verifyCheckBox() {
  checked = $("input[type=checkbox]:checked").length;

  if (!checked) {
    $("#checkErrMssg").show();
    return false;
  } else return true;
}
