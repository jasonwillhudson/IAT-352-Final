var imageArray = new DataTransfer();

//Preview
$("#fileInput").on("change", function(e) {
    var files = e.target.files;
    var filesLength = files.length;

    if(filesLength>=5) $("#fileInput").css('display', 'none');
    for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
            var file = e.target;
            var img = '<div class="img-wrap"><span id="deleteButton" data-name="'+file.name+'">&times;</span><img src="'+e.target.result+'" ></div>';
            imageArray.items.add(f);
            $("#fileInput")[0].files = imageArray.files;
            $('#thumb-output').append(img);
        });
        fileReader.readAsDataURL(f);
    }
});

//Remove
$(document).on('click','#deleteButton',function(){
    var pips = $('.img-wrap').toArray();
    var $selectedPip = $(this).parent('.img-wrap');
    var index = pips.indexOf($selectedPip[0]);

    var dt = new DataTransfer();
    var files = $("#fileInput")[0].files;

    for (var fileIdx = 0; fileIdx < files.length; fileIdx++) {
        if (fileIdx !== index) {
            dt.items.add(files[fileIdx]);
        }
    }

    $("#fileInput")[0].files = dt.files;

    imageArray = dt.files;

    $selectedPip.remove();
});

//Check current files
$(document).on('click','#showFiles',function(event){
    event.preventDefault();
    var data = $('#fileInput')[0].files; //this file data
    const fileListArr = Array.from(data);
    var fileName = $(this).data("name");

    for(i = 0; i < fileListArr.length; ++ i){
        console.log(fileListArr[i]);
    }
});
