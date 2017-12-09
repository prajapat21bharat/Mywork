/*get client email on image upload section*/

$("#pic").change(function(){
  var mailid=$('#email').val();
  $("#hidden_mail").val(mailid);
  
})


/*Hide message on click*/

$(document).ready(function(){
  $('.text-error-close').click(function(){
    $(this).hide();
    $(this).parent().hide();
  })
})

$(document).ready(function(){
  $('.text-success-close').click(function(){
    $(this).hide();
    $(this).parent().hide();
  })
})






/*Hide & show change buttons on change password for both users start*/
$("#show_field_change").click(function(){
  $('#currentpassword').removeAttr('disabled')
    $('#newpassword').removeAttr('disabled')
    $('#confirmpassword').removeAttr('disabled')
    $("#show_field_change").remove();
    $('#btn_changepassword').show();
    $('#btn_changepassword').addClass('btn btn-danger square-btn-adjust');
})

$(document).ready(function(){
  $('#btn_changepassword').removeAttr('class');
  $('#btn_changepassword').hide();
  
  
  var errorvalue=$('.text-error').text();
  if(errorvalue)
  {
    $('#currentpassword').removeAttr('disabled')
    $('#newpassword').removeAttr('disabled')
    $('#confirmpassword').removeAttr('disabled')
    $("#show_field_change").remove();
    $('#btn_changepassword').addClass('btn btn-danger square-btn-adjust');
    $('#btn_changepassword').show();

  }
})
/*Hide & show change buttons on change password for both users Ends*/


/**Rotate Image*/
/*

    var img = $(this);
    if(img.hasClass('north')){
        img.attr('class','west');
    }else if(img.hasClass('west')){
        img.attr('class','south');
    }else if(img.hasClass('south')){
        img.attr('class','east');
    }else if(img.hasClass('east')){
        img.attr('class','north');
    }

*/

//Function to allow only backspace & numbers to textbox
	function validatealphanumeric(key)
	{
		var keycode = (key.which) ? key.which : key.keyCode
		//comparing pressed keycodes
		//alert(keycode);
		if( (keycode==8)||(keycode==9)||(keycode>47 && keycode<58) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
