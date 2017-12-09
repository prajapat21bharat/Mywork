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

<div class="container">
		
		<div id="login">

		  <h1><b>Login Form</b></h1>
		  <form class="form-horizontal login-form" id="register-form" method="post" action="<?php echo site_url().'account/login/'  ?>">
		  <?php  if($this->session->flashdata('Logmsg'))   echo  $this->session->flashdata('Logmsg'); ?>
			<input type="text" class="loginid"  name="email" id="email" value="<?php  echo $email ?>" placeholder="test@gmail.com" />
			<input type="password" class="" name="password" id="password" value="<?php  echo $password ?>" placeholder="******" />
			<input type="submit" value="Log in" name="login" />
		  </form>
		</div>
</div>
<?php
	$this->load->view('includes/footer');
?>
