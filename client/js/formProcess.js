$("form").submit(function(e) {
    e.preventDefault();    
    var formData = new FormData(this);

    console.log(formData);
    $.ajax({
        url: "../../server/formProcess.php",
        type: 'POST',
        data: formData,
        success: function (data) {
            alert(data)
        },
        cache: false,
        contentType: false,
        processData: false
    });
});