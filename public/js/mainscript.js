$(document).ready(function () {

    $('.fancy').fancybox();

    function responsive_filemanager_callback(field_id){

        var url = $('#' + field_id).val();

        //Setting the image to use this new image
        $('.blogImageUpload').attr('src', $url);
        close_window();
        parent.jQuery.fancybox.close();
    }

    //Advert Placement Form
    $('form[name=advertForm]').on('submit', function (e) {
        e.preventDefault();
        submitAdvert();
    });

    $().click(function (e) {
        e.preventDefault();
        submitAdvert();
    });


    //Page Scroolling changes the nav
    $(window).scroll(function () {
        if ($(window).scrollTop() > 60) {
            $(".body")
                .addClass('scrolled');
        } else {
            $(".body")
                .removeClass('scrolled');
        }
    });

    var buttons = $('.navigation-button'),
        menu = buttons.children('.openButton'),
        close = buttons.children('.closeButton'),
        nav = $('.navigation-container .navigation'),
        back = $('.navigation-background');

    function showNav() {
        //Adding slideInLeft to nav and displaying it
        nav.removeClass('slideOutLeft').addClass('slideInLeft').show();
        //Hiding openButton
        menu.hide();
        //Displaying closeButton
        close.show();
        //Displaying back
        back.show();
    }

    function hideNav() {
        //Adding slideOutRight to nav and hiding it
        nav.removeClass('slideInLeft').hide();
        //Hiding closeButton
        close.hide();
        //Displaying openButton
        menu.show();
        //Hiding the background
        back.hide();
    }

    menu.click(function () {
        showNav();
    });
    close.click(function () {
        hideNav();
    });
    back.click(function () {
        hideNav();
    });

    //Offline Post Saving
    //This function will be triggered after 3 minutes
    // after loading the page
    setTimeout(function () {
        // alert("The Post Has Been Started To Be Saved...");
        //Saving posts to the localStorage of the device every 15seconds
        setInterval(offlineSave(), 15000);
    }, 300000);


    //Loading the post's contents to the DOM at first


    //Contact Us Form Display
    $('.contactForm .closeButton').click(function () {
        $('.contactForm').addClass('slideInDown').css({'display': 'none'});
        $('.contactBackground').css('display', 'none')
    });

    //Post URL Address Suggester
    $('input[name=blogtitle]').on('keyup', function () {
        //Getting the value from post title
        $title = $('.blogTitle').val();
        //Replacing the white space with an underscore
        $sURL = window.location.hostname + "/" + $title;
        //Creating HTML object for the suggestion
        $s = "<a href='//" + $sURL + "/'>" + "" + $sURL + "</a>";
        //Updating the DOM with the created HTML Anchor Tag
        $('.suggestedURL').html($s);
    });

    $grid_button = $('.grid-button');
    $list_button = $('.list-button');

    $list = $('.post').children('.list');
    $grid = $('.post').children('.grid');

    $list_button.click(function () {
        $grid.css({'display': 'none'});
        $list.css({'display': 'inline-block'});
        $('.post').removeClass('gridView');

        $grid_button.removeClass('active');
        $list_button.addClass('active');
    });

    $grid_button.click(function () {
        $list.css({'display': 'none'});
        $grid.css({'display': 'inline-block'});
        $('.post').addClass('gridView');

        $list_button.removeClass('active');
        $grid_button.addClass('active');
    });


    $('input[name=schedule]').click(function () {
        if ($(this).val() === 'no') {
            showScheduleForm();
        } else {
            hideScheduleForm();
        }
    });

    $('.tagbutton').click(function (e) {
        e.preventDefault();
        //Tag Box containing user custom tags
        $tagbox = $('.tags input[name=tagbox]');

        //This is where the tags will be displayed on the page
        $page = $('.tags .content');

        //this is what will be parsed with the form when it is submitted
        tagForm = $('input[name=tag]');

        //checking the value in the form
        if (!validateEmptySpace($tagbox.val())) {
            //adding the value back to the form
            //to make a full list of tags
            newTagForm = tagForm.val() + "," + $tagbox.val();
            tagForm.val(newTagForm);

            //clearing the DOM to create new tag list
            $page.children().remove();

            //Adding the value to the page
            taglist = tagForm.val().split(',');

            for (var tags in taglist) {
                $page.append("<a href='/" + taglist[tags] + "/'> " + taglist[tags] + "</a>");
            }

            //setting back the input form to empty
            $tagbox.val("");
        }


    });

    //The search box for the site
    $('.search-button').click(function (e) {
        //What needs to be validated
        //In this case, the searchbox
        var toValidate = $('.search-box');
        //Checking if the searchbox contains values
        if (validateEmptySpace(toValidate.val())) {
            //prevent the form from taking its default function
            e.preventDefault();
        }

    });

    // creating a script which will handle user newsletter subscriptions
    // The Newsletter Subscribe button
    $('input[name=newsletterButton]').click(function () {
        //The Value entered by the user
        var email = $('input[name=newsletterEmail]').val(),
            error = $('.newsletterResultBox');

        error.addClass('text-success').text("Loading...");

        //checking if the value entered into the email box is not empty
        if (validateEmptySpace(email)) {
            error.addClass('error').text("Try filling the box with a valid character");
            return false;
        }
        // If the value is genuine, then this script will run
        $.ajax({
            url: 'newsletter.php',
            data: {
                email: email,
                action: 'add'
            },
            dataType: 'json',
            type: 'POST',
            success: function (s) {
                //Going through the result received from the contacted page
                // If the result is 1, then it is successful else 0, it failed
                if (s.result === 'exist') {
                    error.removeClass('text-success').addClass('error').text("The email is already subscribed to our newsletter!");
                }
                if (s.result === 'added') {
                    error.removeClass('error').addClass('text-success').text("Email is added successfully, check and verify your account by checking the mail sent to the provided email!");
                }
                if (s.result === 'error') {
                    error.removeClass('text-success').addClass('text-error').text("There\'s an error removing your account, try again!");
                }
            },
            error: function () {
                error.removeClass('text-success').addClass('error').text("There seems to be an error adding your! Please try again.");
            }
        });
    });

// closing $('document').ready() function
});

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
function checkDescription() {
    $textlength = ($('.blogdescription').val().length);
    $s = "Characters: " + $textlength;
    $('.blogdescrip').text($s);
    if ($textlength > 250) {
        $('.blogdescrip').text("You have written more than expected: -" + ($textlength - 250));
    }
}
function validateEmptySpace(whattocheck) {
    //This function will validate a form to check if the value
    //in it is nothing or space

    //what to check
    var check = whattocheck;
    //checking if the value is empty
    if (check === "" || check.length < 1 || check === " ") {
        //returns true if the value is not empty
        return true;
    } else {
        //returns false if the value is empty
        return false;
    }
}

function showContactForm() {
    $('.contactForm').css('display', 'block');
    $('.contactBackground').css('display', 'block');
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

/**
 * Save a copy of the blog post to the localstorage of the browser
 * @return boolean true if the posts are saved to the localstorage successfully
 * @return boolean false if the posts are not saved or the browser doesn't support it
 *
 */
function offlineSave() {
    //Do you support localstorage
    if (!window.localStorage) {
        console.log("Your browser doesn't support localStorage, please upgrade it...");
        return false;
    } else {
        //We are free to save a copy of the document every interval of time provided below
        var saveInterval = 15;
        //The values to be stored
        var store = window.localStorage,
            postTitle = $('input[name=blogtitle]').val(),
            postContent = $('iframe#blogcontent_ifr')[0].contentDocument.all,
            postDescription = $('textarea[name=blogdescription]').val(),
            postTag = $('input[name=tag]').val();

        store.setItem('itblog_postTitle', postTitle);
        store.setItem('itblog_postDescription', postDescription);
        store.setItem('itblog_postContent', postContent);
        store.setItem('itblog_postTag', postTag);

        return true;
    }
}


function submitAdvert() {
    var form = new FormData(),
        message = $('textarea[name=message]').val(),
        website = $('input[name=webiste]').val(),
        mobile = $('input[name=mobile]').val(),
        email = $('input[name=email]').val(),
        name = $('input[name=fullname]').val();

    //Adding information to the form
    form.append('message', message);
    form.append('website', website);
    form.append('mobile', mobile);
    form.append('email', email);
    form.append('name', name);
    form.append('action', 'advertise');

    $('body').append("<div class='alert'></div>");

    $.ajax({
        contentType: false,
        processData: false,
        url: 'class/ajaxRequest.php',
        type: 'POST',
        data: form,
        dataType: 'JSON',
        success: function (r) {
            if (r.result === 'true') {
                $('.alert').addClass('success');
                $('.alert').append('<div class="fi-x"></div>');
                $('.alert').append('<div class="body">' + r.message + '</div>');
            } else {
                $('.alert').addClass('error');
                $('.alert').append('<div class="fi-x"></div>');
                $('.alert').append('<div class="body">' + r.message + '</div>');

            }
            //Alert Box
            $('.alert').children('.fi-x').click(function () {
                //Remove the alert box from the DOM
                $('.alert').remove();
            });
        }
    });
}