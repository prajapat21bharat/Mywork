<?php
	$this->load->view('includes/header');
?>
	  
  <!-- jQuery Form Validation code -->
  <script>
  
  // When the browser is ready...
  $(function() {
  
    // Setup form validation on the #register-form element
    $("#register-form").validate({
    
        // Specify the validation rules
        rules: {
           
         
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 4, maxlength: 10
            },
          
        },
        
        // Specify the validation error messages
        messages: {
          
            password: {
                required: "Please enter a password",
                minlength: "Your password must be at least 4 characters long",
                maxlength: "Your password maximum length is 10 character",
            },
            email: {
             required:"Please enter email address",
             email:"Please enter a valid email address",
		 }
            
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
  
  </script>
		<?php
				///**---Email
						
						if(set_value('email')){
							$email = set_value('email');
						}
						else{
							$email = '';
						}
						
						///**---Password
						
						if(set_value('password')){
							$password = set_value('password');
						}
						else{
							$password = '';
						}
		?>


<!--contant start-->
<div id="contant_node1">
<div class="team_header">
<div class="inner_team_header">
<h2>Login</h2><div class="theme_icon"><img src="<?php echo base_url()?>ast/images/account_icon.png" alt="accont" />Create Account</div>
</div>
</div>
<div class="contant_node1_login">
<div class="inner_contant_node1_login">


<div class="testbox">
<?php  if($this->session->flashdata('Logmsg'))   echo  $this->session->flashdata('Logmsg'); ?>
	
	<form method="post" action="<?php echo site_url().'/login/'  ?>" id="register-form" >

<table cellpadding="3px" width="500px">
	
	 
	<!--<tr>
		<td></td><td><?php // echo form_error('email'); ?></td>
	</tr>-->
	<tr>
		<td><p>Email Address</p></td>
		<td> <input type="text" name="email" class="input_txt" id="" value="<?php  echo $email ?>" placeholder="Email" /></td>
		
	</tr>
	
	<tr>
		<td><p>Password</p></td>
		<td><input type="password" name="password" class="input_txt" id="" value="<?php  echo $password ?>" placeholder="Password" /></td>
	</tr>
	
	 <tr> 
	 <td colspan="2" align="right"><input type="submit" name="login" value="Log In!" class="submitbutton"></td>
	 </tr>
</table>

  </form>
  
<!--  <div class="social_icon_login">
 <div class="google"><a href="#"> <img src="<?php // echo base_url()?>ast/images/google.png" alt="google" /></a></div>
  
  <div class="facebook"><a href="#"> <img src="<?php // echo base_url()?>ast/images/facebook.png" alt="face" /></a></div>
  </div>
-->
  
</div>

</div>
</div>

<!--contant end-->
</div>

<?php
	$this->load->view('includes/footer');
?>
