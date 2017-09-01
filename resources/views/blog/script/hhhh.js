$('form[name=advertForm]').on('submit', function (e){
    e.preventDefault();
    submitAdvert();
});

$().click(function (e){
    e.preventDefault();
    submitAdvert();
});

function submitAdvert(){
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

    $.ajax({
        contentType : false,
        processData : false,
        url : 'class/ajaxRequest.php',
        type : 'POST',
        data : form,
        success : function (r){

        },
        error : function (r){

        }
    });
}