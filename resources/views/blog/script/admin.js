$('document').ready(function(){
    $('.loginBTN').click(function(){
        $username = $('.username');
        $password = $('.password');
        $err = $('.loginError');
        if ($username.val().length < 4){
            $username.addClass('inputError');
            $err.show().text("Invalid username formate!");
            return false;
        }else{
            $username.removeClass('inputError').addClass('inputSuccess');
        }
        if($password.val().length < 4){
            $password.addClass('inputError');
            $err.show().text("Your password is incorrect!");
            return false;
        }else{
            $password.removeClass('inputError').addClass('inputSuccess');
        }
    });
    
});