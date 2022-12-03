$(document).ready(function () {
  $("#checkErrMssg").hide();
  $("form").submit(function (event) {
    $("#checkErrMssg").hide();

    event.preventDefault();
    var form_data = new FormData();

    // Read selected files
    var totalfiles = $("#fileInput")[0].files.length;
    for (var index = 0; index < totalfiles; index++) {
      form_data.append("files[]", $("#fileInput")[0].files[index]);
    }

    if (verifyCheckBox()) {
      $.ajax({
        url: "ajaxfile.php",
        type: "post",
        data: form_data,
        dataType: "json",
        contentType: false,
        processData: false,
        success: function (response) {
          for (var index = 0; index < response.length; index++) {
            var src = response[index];

            // Add img element in <div id='preview'>
            //$('#preview').append('<img src="'+src+'" width="200px;" height="200px">');
          }
        },
      });
    }
  });
});

function verifyCheckBox() {
  checked = $("input[type=checkbox]:checked").length;

  if (!checked) {
    $("#checkErrMssg").show();
    return false;
  } else return true;
}
