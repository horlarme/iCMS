$('document').ready(function () {

    //Post URL Address Suggester
    $('input[name=title]').on('keyup', function () {
        //Getting the value from post title
        title = $('.blogtitle').val();
        //Creating HTML object for the suggestion
        s = "<a href='//" + buildAddress('/blog/' + title) + "/'>" + "" + buildAddress('/blog/' + title) + "</a>";
        //Updating the DOM with the created HTML Anchor Tag
        $('.suggestedURL').html(s);
    });

    $('input[name=schedule]').click(function () {
        if ($(this).val() === 'no') {
            showScheduleForm();
        } else {
            hideScheduleForm();
        }
    });

});


/**
 * Generate a full web address based on the provided link
 * 
 * @param link string
 */
function buildAddress(link = false){
    if(!link){
      link = "";
    }
    
    let host      = window.location.hostname;
    let port      = window.location.port ? ":" + window.location.port : "";
    let protocol  = window.location.protocol;
    
    return protocol + "://" + host + port + link;
}

function checkDescription() {
    $textlength = ($('.blogdescription').val().length);
    $s = "Characters: " + $textlength;
    $('.blogdescrip').text($s);
    if ($textlength > 250) {
        $('.blogdescrip').text("You have written more than expected: -" + ($textlength - 250));
    }
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