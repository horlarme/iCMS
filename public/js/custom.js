/*=============================================================
 Authour URI: www.binarytheme.com
 License: Commons Attribution 3.0

 http://creativecommons.org/licenses/by/3.0/

 100% To use For Personal And Commercial Use.
 IN EXCHANGE JUST GIVE US CREDITS AND TELL YOUR FRIENDS ABOUT US

 ========================================================  */


(function ($) {
    "use strict";
    var mainApp = {

        main_fun: function () {
            /*====================================
             METIS MENU
             ======================================*/
            $('#main-menu').metisMenu();

            /*====================================
             LOAD APPROPRIATE MENU BAR
             ======================================*/
            $(window).bind("load resize", function () {
                if ($(this).width() < 768) {
                    $('div.sidebar-collapse').addClass('collapse')
                } else {
                    $('div.sidebar-collapse').removeClass('collapse')
                }
            });


        },

        initialization: function () {
            mainApp.main_fun();

        }

    }
    // Initializing ///

    $(document).ready(function () {
        mainApp.main_fun();
    });

}(jQuery));


/**
 * iCMS Javascript Starts Here
 * @author Lawal Oladipupo Olawunmi
 */
//All Page Scripts
$('document').ready(function () {
    var h = $(window).innerHeight(),
        nh = $('#page-wrapper #page-inner').position();
    $('.fileManagerFrame').css('height', (h - nh.top));
    $('.theWebSite').css('height', (h - nh.top));
    /**
     * Hide Loading Bar when the button is clicked
     */
    $('.loading').click(function () {
        hideLoading();
    });
});

/**
 * Setting Up AJAX
 */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

/**
 * Deleting Category
 */
$(document).on('click', '[data-cat-delete]', function (e) {
    e.preventDefault();
    var element = $(this), name = element.data('cat-delete');
    $.ajax({
        url: name,
        type: 'post',
        dataType: 'JSON',
        data: {
            '_method': 'delete'
        },
        success: function (res) {
            element.parents('tr').remove();
            showLoading(res.message);
        },
        error: function (res) {
            showLoading(res.statusText, 'error');
        }
    })
});

/**
 * @function hideLoading
 * Hide tbe loading bar by setting the top position of the element to -1000px
 */
function hideLoading() {
    $('.loading').css({'top': '-1000px'});
}

/**
 * @function showLoading
 * Show the loading bar
 * @param $text The text to be shown in the bar
 */
function showLoading($text = "Loading...", status = "loading") {

    var loading = $('.loading');

    loading
        .css({'top': '55px'})
        .find('.content')
        .text($text);

    /**
     * Generating the class name for the loading
     */
    var className;
    switch (status) {
        case 'loading':
            loading.addClass('bg-primary')
                .removeClass('bg-danger')
                .removeClass('bg-success');
            break;
        case 'error':
            loading.addClass('bg-danger')
                .removeClass('bg-primary')
                .removeClass('bg-success');
            break;
        default:
            loading.addClass('bg-success')
                .removeClass('bg-primary')
                .removeClass('bg-danger');
            break;
    }


    /**
     * The loading bar cloaes after 3 seconds
     */
    setTimeout(function () {
            hideLoading()
        }, 5000
    );
}