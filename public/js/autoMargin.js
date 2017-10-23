/*
 This script is created for automatic margin ajustment,
 this script only gives the required margin to a device and is responsive.
 Created by: Lawal Oladipupo
 Version: 1.0
*/
/*
 How this script will be working.
 - Check for any HTML with the class "autoMargin" (case SENsiTive)
 - Check its width and heihgt
 - Check the available width and height of the browser itself
 - Remove the element's width from the browser's width and insert into a variable
 - Remove the element's height from the browser's height and insert into a variable 
 - It then divide the width and height into two and set to the element's css using $('element').css('margin','')
*/
//Calling Script when page finished loading
$(document).ready(function(){
  if($('.autoMargin')){
    //Getting the element's width and height
    $ew = parseFloat($('.autoMargin').css('width')); //$ew = Element's Width
    $eh = parseFloat($('.autoMargin').css('height')); //$eh = Element's Height

    //Getting the browser's available widthe and Height
    $bw = parseFloat($(window).width()); //$ew = Element's Width
    $bh = parseFloat($(window).height()); //$eh = Element's Height
    
    //Subtracting both the width and height
    $nw = $bw - $ew;
    $nh = $bh - $eh;
    
    //Dividing the width and height into two for the element to use
    $nw = $nw / 2;
    $nh = $nh / 2;
    
    //Setting the new height and width to the element
    $amw = $('.autoMargin').css({'marginLeft': $nw + 'px', 'marginRight' : $nw + 'px'});
    $amw = $('.autoMargin').css({'marginBottom': $nh + 'px', 'marginTop' : $nh + 'px'});
  }
});