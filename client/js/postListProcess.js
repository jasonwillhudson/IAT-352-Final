$(document).ready(function () {


  //select all the sub filter if media category is selected
  $("#media").change(
    function(){
        if ($(this).is(':checked')) {
            $('input[name="media"]').each(function() {
                $(this).prop("checked", true); 
            });
        }
        else{
            $('input[name="media"]').each(function() {
                $(this).prop("checked", false); 
            });
        }
    });


    //select all the sub filter if media category is selected
  $("#electronics").change(
    function(){
        if ($(this).is(':checked')) {
            $('input[name="electronics"]').each(function() {
                $(this).prop("checked", true); 
            });
        }
        else{
            $('input[name="electronics"]').each(function() {
                $(this).prop("checked", false); 
            });
        }
    });


    //select all the sub filter if media category is selected
  $("#toys").change(
    function(){
        if ($(this).is(':checked')) {
            $('input[name="collectible"]').each(function() {
                $(this).prop("checked", true); 
            });
        }
        else{
            $('input[name="collectible"]').each(function() {
                $(this).prop("checked", false); 
            });
        }
    });
 

  //form submit action triggers the event
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

    //AJAX
    var request = $.ajax({
      url: "../../server/postListProcess.php",
      type: "post",
      data: data,
      //dataType: "json",
      contentType: false,
      processData: false,
    });

    request.done(function (msg) {
      $("#posts").html(msg);
    });

    request.fail(function (msg) {
      console.log("error" + msg);
    });
  });
});
