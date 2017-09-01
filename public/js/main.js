$('document').ready(function () {

    //Post URL Address Suggester
    $('input[name=blogtitle]').on('keyup', function () {
        //Getting the value from post title
        $title = $('.blogtitle').val();
        //Replacing the white space with an underscore
        $sURL = window.location.hostname + "/" + $title;
        //Creating HTML object for the suggestion
        $s = "<a href='//" + $sURL + "/'>" + "" + $sURL + "</a>";
        //Updating the DOM with the created HTML Anchor Tag
        $('.suggestedURL').html($s);
    });

    $('input[name=schedule]').click(function () {
        if ($(this).val() === 'no') {
            showScheduleForm();
        } else {
            hideScheduleForm();
        }
    });

});

function checkDescription() {
    $textlength = ($('.blogdescription').val().length);
    $s = "Characters: " + $textlength;
    $('.blogdescrip').text($s);
    if ($textlength > 250) {
        $('.blogdescrip').text("You have written more than expected: -" + ($textlength - 250));
    }
}

/**
 * Blog Post Image upload function
 */
function uploadImage(image) {
    //Checking to see if the function is called
    console.log("Function Called...");
    //Creating a form field to send the file
    var form = new FormData();
    //Adding the image to the form to be uploaded
    //image file name = image
    form.append('image', image);
    //adding a query to the form to tell the script
    //we are uploading an image not posting yet!
    form.append('action', 'uploadImage');

    //Configurations to be used for the image
    $imageBox = $("img[class=blogImageUpload]");
    $imageFormValue = $('input[name=blogimage]');

    //AJAX
    //Uploading the image file to the server
    $.ajax({
        contentType: false,
        processData: false,
        url: 'savepost.php',
        type: 'POST',
        data: form,
        success: function (res) {
            if (res.response == "true" || res.response == true) {
                console.log(res.response);
                //Configuring values
                imageLocation = res.message;
                //Updating the image box to load the new uploaded image
                $imageBox.attr('src', imageLocation);
                $imageFormValue.attr('value', imageLocation)
            } else {
                alert("The following errors occur: " + res.message);
            }
        },
        error: function (err) {
            alert("The following errors occur: " + res.message);
        }
    });

}


// Functions
function showScheduleForm() {
    $('.schedulePost').css('display', 'block');
    $('.publish').css('display', 'none');
    $('input[name=schedule]').val('yes');
}
function hideScheduleForm() {
    $('.schedulePost').css('display', 'none');
    $('.publish').css('display', 'block');
    $('input[name=schedule]').val('no');
}