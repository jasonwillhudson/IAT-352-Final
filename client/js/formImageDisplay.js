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

        compressImage(f);

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

//=================================================== Image Compress===================//
function compressImage(input) {
  const MAX_WIDTH = 600;
  const MAX_HEIGHT = 600;
  const MIME_TYPE = "image/png";
  const QUALITY = 1;

  //const file = ev.target.files[0]; // get the file
  const blobURL = URL.createObjectURL(input);
  const img = new Image();
  img.src = blobURL;
  img.onerror = function () {
    URL.revokeObjectURL(this.src);
    // Handle the failure properly
    console.log("Cannot load image");
  };
  img.onload = function () {
    URL.revokeObjectURL(this.src);
    const [newWidth, newHeight] = calculateSize(img, MAX_WIDTH, MAX_HEIGHT);
    const canvas = document.createElement("canvas");
    canvas.width = newWidth;
    canvas.height = newHeight;
    const ctx = canvas.getContext("2d");
    ctx.drawImage(img, 0, 0, newWidth, newHeight);
    canvas.toBlob(
      (blob) => {
        // Here is where we convert the blob into a file and put inside DataTransfer
        let newfile = new File([blob], input.name, {
          type: MIME_TYPE,
          lastModified: new Date().getTime(),
        });
        //add file to the array storage
        imageArray.items.add(newfile);
        //set the file input the the array storage
        $("#fileInput")[0].files = imageArray.files;
        console.log(newfile);
      },
      MIME_TYPE,
      QUALITY
    );
    //document.getElementById("thumb-output").append(canvas);
  };
}

function calculateSize(img, maxWidth, maxHeight) {
  let width = img.width;
  let height = img.height;

  // calculate the width and height, constraining the proportions
  if (width > height) {
    if (width > maxWidth) {
      height = Math.round((height * maxWidth) / width);
      width = maxWidth;
    }
  } else {
    if (height > maxHeight) {
      width = Math.round((width * maxHeight) / height);
      height = maxHeight;
    }
  }
  return [width, height];
}
