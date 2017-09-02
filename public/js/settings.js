/**
* This script is created to work for the settings page
* @author Lawal Oladipupo
*/
$(document).ready(function(){
	$('form.setting').on('change', '.update', function(){
	//Whenever anything on the settings page is changed
	//An ajax request will be sent to the server to update the setting
	    $.ajax({
	    	type: 'POST',
		    // dataType: 'JSON',
		    url: $('form.setting').attr('action'),
		    data: {
		    	'_token' : $('meta[name="csrf_token"]').attr('content'),
		    	'update' : $(this).attr('name'),
		    	'value' : $(this).val()
		    },
		    error: function (jqXHR, textStatus, errorThrown) {
		      console.log(textStatus);
		      console.log(errorThrown);
		      console.log(jqXHR);
		    },
		    success: function (pasteParserRulesets) {
		    }
	  });
	})
});