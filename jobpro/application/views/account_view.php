<!DOCTYPE html>

<head>
<meta charset="UTF-8">

<script>
	
    function fcharacters_only(x)
    {
		var A = 0;
		
		var fname=document.getElementById("fname").value;
		if(fname=="")
		{
			 document.getElementById("fnameError").style.display = "block";
			document.getElementById("fnameError").innerHTML="Please enter first name";
		
		A = 1;
		}
		else
		{
			  
		var re = /^[A-Za-z]+$/;
		
		if(!re.test(document.getElementById(x).value))
		{
			document.getElementById("fnameError").style.display = "block";
			document.getElementById("fnameError").innerHTML="Numbers and special characters are not allowed.";
		A = 1;
		}
		else
		
		{
			var fname=document.getElementById("fname").value;

			if((fname.length <= 2 )|| (fname.length >= 15 ) )
			{
				document.getElementById("fnameError").style.display = "block";
				document.getElementById("fnameError").innerHTML="please enter a valid length(minimum 3 characters & maximum 14 characters )";
				A = 1;
				
			}
			else
			{
				document.getElementById("fnameError").style.display = "none";
				document.getElementById("fnameError").innerHTML="";
				
			}
			
		}
		
		}
		
		if(A == 0)
		{
		return true;	
		}
		else{
		return false;	
		}
	}
	
	
	 function lcharacters_only(x)
	 
     {
		var lname=document.getElementById("lname").value;
		if(lname=="")
		{
			 document.getElementById("lnameError").style.display = "block";
			document.getElementById("lnameError").innerHTML="Please enter last name";
		A = 1;
		
		}
		else
		{
			  
		var re = /^[A-Za-z]+$/;
		
		if(!re.test(document.getElementById(x).value))
		{
			document.getElementById("lnameError").style.display = "block";
			document.getElementById("lnameError").innerHTML="Numbers and special characters are not allowed.";
		A = 1;
		}
		else
		
		{
			var lname=document.getElementById("lname").value;

			if((lname.length <= 2 )|| (lname.length >= 15 ) )
			{
				document.getElementById("lnameError").style.display = "block";
				document.getElementById("lnameError").innerHTML="please enter a valid length(minimum 3 characters & maximum 14 characters )";
		A = 1;		
			}
			else
			{
				document.getElementById("lnameError").style.display = "none";
				document.getElementById("lnameError").innerHTML="";
			}
			
		}
		
		}
		
		if(A == 0)
		{
		return true;	
		}
		else{
		return false;	
		}
		
	}
	
	 function validateEmail(x)
    {
		var email=document.getElementById("email").value;
		if(email=="")
		{
			 document.getElementById("emailError").style.display = "block";
			document.getElementById("emailError").innerHTML="Please enter email address";
		
		A = 1;
		}
		else{
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		if(!re.test(document.getElementById(x).value))
		{
			document.getElementById("emailError").style.display = "block";
			document.getElementById("emailError").innerHTML="Invalid email address";
		A = 1;
		}
		else
		{
			document.getElementById("emailError").style.display = "none";
			document.getElementById("emailError").innerHTML="";
		
		A = 1;
		}}
		
		if(A == 0)
		{
		return true;	
		}
		else{
		return false;	
		}
	}
		
	

		
	 function validatec_Email(x)
     {
		var A = 0;
		var c_email=document.getElementById("c_email").value;
		var email=document.getElementById("email").value;
		if(c_email=="")
		{
			 document.getElementById("c_emailError").style.display = "block";
			document.getElementById("c_emailError").innerHTML="Please re_type email address";
		
		A = 1;
		}else{
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		if(!re.test(document.getElementById(x).value))
		{
			document.getElementById("c_emailError").style.display = "block";
			document.getElementById("c_emailError").innerHTML="Invalid email address";
		A = 1;
		}
		else
		{
			if(c_email!==email)
			{
				document.getElementById("c_emailError").style.display = "block";
				document.getElementById("c_emailError").innerHTML="Email address doesn't match";
			}
			else
			{
				document.getElementById("c_emailError").style.display = "none";
				document.getElementById("c_emailError").innerHTML="";
			}
		
		A = 1;
		}
	}

		if(A == 0)
		{
		return true;	
		}
		else{
		return false;	
		}

}

	 function Valid_password(x)
    {
		var password=document.getElementById("password").value;
		if(password=="")
		{
			 document.getElementById("passwordError").style.display = "block";
			document.getElementById("passwordError").innerHTML="Please create a password";
		A = 1;
			
		}
		else
		{
			
		 if((password.length <= 3 )|| (password.length >= 11 ))
			{
				document.getElementById("passwordError").style.display = "block";
				document.getElementById("passwordError").innerHTML="please enter a valid length(minimum 4 characters & maximum 10 characters )";
				
				A = 1;
			}
		
			else
			{
				document.getElementById("passwordError").style.display = "none";
				document.getElementById("passwordError").innerHTML="";
			}
			
		}
			
			if(A == 0)
		{
		return true;	
		}
		else{
		return false;	
		}
			
	 }

	 function Valid_radio(x)
    {
		var gender=document.getElementById("gender").value;
		if(document.getElementById(x).checked)
		{
			document.getElementById("err_gender").style.display = "none";
			document.getElementById("err_gender").innerHTML="";
		}
		else
		{
			document.getElementById("err_gender").style.display = "block";
			document.getElementById("err_gender").innerHTML="Please Choose a Gender";
		A = 1;
		}
		
		if(A == 0)
		{
		return true;	
		}
		else{
		return false;	
		}
	}

	function Valid_role(x)
    {
		var role=document.getElementById("role").value;
		if(document.getElementById(x).checked)
		{
			document.getElementById("err_role").style.display = "none";
			document.getElementById("err_role").innerHTML="";
		}
		else
		{
			document.getElementById("err_role").style.display = "block";
			document.getElementById("err_role").innerHTML="Please your  Role";
		A = 1;
		}
		
		if(A == 0)
		{
		return true;	
		}
		else{
		return false;	
		}
		
	}
	



    
  function valid()
 {
	 
		var A = 0;
	   
		var fname=document.getElementById("fname").value;
		if(fname=="")
		{
		document.getElementById("fnameError").style.display = "block";
		document.getElementById("fnameError").innerHTML="Please enter first name";
		A = 1;

		}
		else
		{
	
			document.getElementById("fnameError").style.display = "none";
			document.getElementById("fnameError").innerHTML="";
	
		}
		
		
		var lname = document.getElementById("lname").value;
		if(lname=="")
		{
		document.getElementById("lnameError").style.display = "block";

			document.getElementById("lnameError").innerHTML="Please enter last name";
		A = 1;
		}
		else
		{
	
			document.getElementById("lnameError").style.display = "none";
			document.getElementById("lnameError").innerHTML="";
	
		}
	
	
	var email = document.getElementById("email").value;
		if(email=="")
		{
		document.getElementById("emailError").style.display = "block";

		document.getElementById("emailError").innerHTML="Please enter email address";
		A = 1;	
		}
		else
		{
		document.getElementById("emailError").style.display = "none";
		document.getElementById("emailError").innerHTML="";
	
		}
	
	var c_email = document.getElementById("c_email").value;
		if(c_email=="")
		{
		document.getElementById("c_emailError").style.display = "block";
		document.getElementById("c_emailError").innerHTML="Please re-type email address";
		A = 1;

		}
		else
		{
		document.getElementById("emailError").style.display = "none";
		document.getElementById("emailError").innerHTML="";
	
		}
	
	
	  
	
	var password = document.getElementById("password").value;
		if(password=="")
		{
		document.getElementById("passwordError").style.display = "block";
		document.getElementById("passwordError").innerHTML="Please create a password";
		A = 1;
		}
		else
		{
		document.getElementById("passwordError").style.display = "none";
		document.getElementById("passwordError").innerHTML="";
	
		}
	
	
	var genderM = document.getElementById("male").checked;
	var genderF = document.getElementById("female").checked;
	     if((genderM == "") && (genderF == ""))
		{
		document.getElementById("err_gender").style.display = "block";
		document.getElementById("err_gender").innerHTML="Please choose your gender";
		A = 1;
		}
		else
		{
		document.getElementById("err_gender").innerHTML="";
	
		}
	
	var mentor = document.getElementById("mentor").checked;
	var jobseeker = document.getElementById("jobseeker").checked;
		if((mentor == "") && (jobseeker == ""))
		{
		document.getElementById("err_role").style.display = "block";
		document.getElementById("err_role").innerHTML="Please choose your role";
		A = 1;
		}
		else
		{
		document.getElementById("err_role").innerHTML="";
		}
	
		
		if(A == 0)
		{
		return true;	
		}
		else
		{
		return false;	
		}
	
}


	</script>


</head>
<body>
<?php
	$this->load->view('includes/header');
?>

<?php
						
						
						// ---For Set value  ----
						
						if(set_value('fname')){
							$fname = set_value('fname');
						}
						else{
							$fname = '';
						}
												
						if(set_value('lname')){
							$lname = set_value('lname');
						}
						else{
							$lname = '';
						}
						if(set_value('email')){
							$email = set_value('email');
						}
						else{
							$email = '';
						}
												
						if(set_value('c_email')){
							$c_email = set_value('c_email');
						}
						else{
							$c_email = '';
						}
						
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
<h2>CREATE ACCOUNT</h2><div class="theme_icon"><a href="<?php  echo site_url().'/login'?>"><img src="<?php echo base_url()?>ast/images/account_icon.png" alt="accont" /></a>My Account</div>
</div>
</div>
<div class="contant_node1_login">
<div class="inner_contant_node1_login">

<span id="err_valid" style="display: none;"></span>

<div class="testbox">

  <td><?php  if($this->session->flashdata('regsucc'))   echo  $this->session->flashdata('regsucc'); ?></td>
<td><?php  if($this->session->flashdata('error'))   echo  $this->session->flashdata('error'); ?></td> 

  <form action="" method ="post" onsubmit ="return valid()"  >
	  
<table>
	<tr>
		<td><p>First Name</p></td>
		 <td><input class="input_txt" type="text" name="fname"  value="<?php echo set_value('fname')?>" id="fname" onblur="fcharacters_only(name)" placeholder="First name" /> </td></tr>
		<tr><td></td><td><span id="fnameError" style="display: none; font-size:20px;color:red;"></span></tr>
		</td>


	</tr>
	
	<tr>
		<td><p>Last Name</p></td>
		 <td><input class="input_txt" type="text" name="lname" value="<?php echo $lname?>" id="lname" onblur="lcharacters_only(name)" placeholder="last name" /> </td></tr>
		<tr><td></td><td><span id="lnameError" style="display: none; font-size:20px;color:red;"></span>
		</td>		</tr>
	
	<tr>
		<td><p>Email Address</p></td>
		<td> <input class="input_txt" type="text" name="email" value="<?php echo $email?>" id="email" onblur="validateEmail(name)" placeholder="Email address"/></td></tr>
		<tr><td></td><td><span id="emailError" style="display: none;font-size:20px;color:red;"></span></td></tr>
		
		
		<tr>
		<td><p>Re-type Email</p></td>
		<td> <input class="input_txt" type="text" name="c_email" value="<?php echo $c_email?>" id="c_email" onblur="validatec_Email(name)" placeholder="Re-type email address"/></td></tr>
		<tr><td></td><td><span id="c_emailError" style="display: none; font-size:20px;color:red;"></span></td></tr>
				
	
	<tr>
		<td><p>Password</p></td>
		<td><input class="input_txt" type="password" name="password" value="<?php echo $password?>" id="password" onblur="Valid_password(name)" placeholder="Password" /></td></tr>
		<tr><td></td><td><span id="passwordError" style="display: none; font-size:20px;color:red;"></span></td></tr>

	<tr>
		<td><p>Gender</p></td>
		<td>
			<input type="radio" name="gender" style="padding:10px; margin:10px;" id="male" value="Male" onblur="Valid_radio('id')"/><label class="radio" for="male" style="font-size:18px;">Male</label>
			<input type="radio" name="gender" style="padding:10px; margin:10px;" id="female" value="Female" onblur="Valid_radio('id')"/><label for="female" class="radio" style="font-size:18px;">Female</label>
		</td></tr>
		<tr><td></td><td><span id="err_gender" style="display: none; font-size:20px;color:red;" ></span></td></tr>			
	
	<tr>
		<td><p>Role</p></td>
		<td>
			<input type="radio" name="role" style="padding:10px; margin:10px;" id="mentor" value="Mentor" onblur="Valid_role('id')"/><label class="radio" for="mentor" style="font-size:18px;">Mentor</label>
			<input type="radio" name="role" style="padding:10px; margin:10px;" id="jobseeker" value="Jobseeker" onblur="Valid_role('id')"/><label for="jobseeker" class="radio" style="font-size:18px;">Jobseeker</label>
		</td></tr>
		<tr><td></td><td><span id="err_role" style="display: none; font-size:20px;color:red;" ></span></td></tr>			
			
    <tr> 
	<td></td> <td><input type="submit" name="submit" value="Register" class="submitbutton"></td>
	</tr>

</table>

  </form>
  
  <div class="social_icon_login">
 <div class="google"><a href="#"> <img src="<?php echo base_url()?>ast/images/google.png" alt="google" /></a></div>
  
  <div class="facebook"><a href="#"> <img src="<?php echo base_url()?>ast/images/facebook.png" alt="face" /></a></div>
 </div>
  
  
</div>

</div>
</div>

<!--contant end-->
</div>

<?php
	$this->load->view('includes/footer');
?>
</body>
</html>
