var imageArray = new DataTransfer(); //store all the files being uploaded

//Preview
$("#fileInput").on("change", function (e) {
  var files = e.target.files;
  var filesLength = files.length;

  //alert user if the input is more than 5 file
  if (imageArray.files.length >= 5) {
    alert("you can only upload max 5 pictures");
  }

  //Display all the image from the files input
  else {
    for (var i = 0; i < filesLength; i++) {
      //load and read the files
      var f = files[i];
      var fileReader = new FileReader();
      fileReader.onload = function (e) {
        var file = e.target;

        //add file to the array storage
        imageArray.items.add(f);

        //set the file input the the array storage
        $("#fileInput")[0].files = imageArray.files;

        //add and show the image element on in the upload image section
        var img =
        '<div class="img-wrap"><span id="deleteButton" data-name="' +
        file.name +
        '">&times;</span><img src="' +
        e.target.result +
        '" ></div>';
        $("#thumb-output").append(img);
      };
      fileReader.readAsDataURL(f);
    }
  }
});

//Remove
$(document).on("click", "#deleteButton", function () {
  //init values
  var pips = $(".img-wrap").toArray();
  var $selectedPip = $(this).parent(".img-wrap");
  var index = pips.indexOf($selectedPip[0]);

  //create a new array to store the files
  var dt = new DataTransfer();
  var files = $("#fileInput")[0].files;

  //add all the files to the new array except the one being clicked
  for (var fileIdx = 0; fileIdx < files.length; fileIdx++) {
    if (fileIdx !== index) {
      dt.items.add(files[fileIdx]);
    }
  }

  //set the input to the new file storage array
  $("#fileInput")[0].files = dt.files;

  //set the array storage to the new file array storage
  imageArray = dt;

  //remove the image displayed
  $selectedPip.remove();
});

//Check current files
$(document).on("click", "#showFiles", function (event) {
  event.preventDefault();
  var data = $("#fileInput")[0].files; //this file data
  const fileListArr = Array.from(data);
  var fileName = $(this).data("name");

  for (i = 0; i < fileListArr.length; ++i) {
    console.log(fileListArr[i]);
  }
});
