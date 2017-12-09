<?php include 'checksession.php'?>
<!DOCTYPE html>
<html>
   <head>
   	<?php
		include("connection.php");
	?>

      <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	  <meta name="viewport" content="width=device-width">
      <link rel="shortcut icon" type="image/ico" href="../images/favicon.ico" />
      <title>Update Profile|Grub Tracker</title>
      <link href="styles.css" type="text/css" media="screen" rel="stylesheet" />
      <style type="text/css">
         img, div { behavior: url(../iepngfix.htc) }
      </style>
 <script language="javascript" type="text/javascript">
        function OnlyValues(event) {

            //alert("Test"); 
            var Key = event.keyCode ? event.keyCode : event.charCode ? event.charCode : event.which;

          
             if (Key == 32) { return false; }

           else {
                return true;
            }

        }
    </script>
      	<script>
		function valid()
		{
			var client_email=document.getElementsByName("client_email")[0].value;
			var client_fname=document.getElementsByName("client_fname")[0].value;
			var client_lname=document.getElementsByName("client_lname")[0].value;
			var client_password=document.getElementsByName("client_password")[0].value;
			//var client_confirm_password=document.getElementsByName("client_confirm_password")[0].value;
			var client_city=document.getElementsByName("client_city")[0].value;
			var client_contact=document.getElementsByName("client_contact")[0].value;
			var client_zipcode=document.getElementsByName("client_zipcode")[0].value;
			var client_website_url=document.getElementsByName("client_website_url")[0].value;
			var client_photo=document.getElementsByName("client_photo")[0].value;
			/*if(client_email="" || client_fname=="" || client_lname=="" || client_password=="" || client_city=="" || client_contact=="" || client_zipcode=="" || client_website_url=="" || client_photo=="")
			{
				alert('Error Cannot Leave Blank !');
				return false;
			}*/
			if(client_email=="")
			{
//				alert('Error: Please Fill Email ID !');
				document.getElementById("client_email").focus();
				document.getElementById("smail").innerHTML=" Please Enter Email-ID";
				return false;

			}
			else
			{
				var atpos = client_email.indexOf("@");
				var dotpos = client_email.lastIndexOf(".");
				if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=client_email.length)
				{
	//				alert("Not a valid e-mail address");
				    document.getElementById("client_email").focus();
					document.getElementById("smail").innerHTML=" Please Enter valid E-mail ID";
					return false;

				}
				else
				{
					document.getElementById("smail").innerHTML="";
				}
			}
			if(client_fname=="")
			{
				//alert('Error: Please Fill First Name !');
				document.getElementById("client_fname").focus();
				document.getElementById("SFname").innerHTML=" Please Enter First Name";
				return false;
			}
			else
				{
					var letters = /^[A-Za-z]+$/;  
					  if(!client_fname.match(letters))  
					  {
						//alert('Please Enter First Name in Alphabet Characters only Ex. A-Z or a-z');
						document.getElementById("client_fname").focus();
						document.getElementById("SFname").innerHTML=" Please Enter Only Characters";  
						return false;  
					  }
					  else
						{
							document.getElementById("SFname").innerHTML="";
							document.getElementById("client_lname").focus();					
						}
				}
			if(client_lname!=="")
		/*	{
				//alert('Error: Please Fill Last Name !');
				document.getElementById("client_lname").focus();
				document.getElementById("").innerHTML=" Please Enter Last Name";
								return false;

			}
			else
			*/	{
					var letters = /^[A-Za-z]+$/;  
					  if(!client_lname.match(letters)) 
					  {
					//	alert('Please Enter Last Name in Alphabet Characters only Ex. A-Z or a-z'); 
						document.getElementById("client_lname").focus();					 
						document.getElementById("SLname").innerHTML=" Please Enter Only Characters"; 
						return false;
					  }
					  else
						{
							document.getElementById("SLname").innerHTML="";
						}
				}
			if(client_password=="")
			{
				//alert('Error: Please Fill Password !');
				document.getElementById("client_password").focus();
				document.getElementById("spassword").innerHTML=" Please Enter Password";
				return false;

			}
			else
			{
				if((client_password.length<=5)||(client_password.length>15))
					{
					//	alert('Error: Password must be minimum 6 Characters & maximum 10 Character !');
						document.getElementById("client_password").focus();
						document.getElementById("spassword").innerHTML=" Password length Should be 6-15 Characters";
						return false;
					}
					else
						{
							document.getElementById("spassword").innerHTML="";
							document.getElementById("client_city").focus();
						}
			}/*
			if(client_confirm_password=="")
			{
				alert('Error: Please Fill Confirm Password !');
				return false;
				document.getElementById("client_confirm_password").focus();
				document.getElementById("").innerHTML=" Please Enter Confirm Password";
			}
			if(client_password!==client_confirm_password)
			{
				alert('Error: Password Does not matched !');
				return false;
				document.getElementById("client_password").focus();
				document.getElementById("smail").innerHTML=" Password Does not matched !";
			}*/
			if(client_city!=="")
			/*{
				//alert('Error: Please Fill City Name !');
				document.getElementById("client_city").focus();
				document.getElementById("").innerHTML=" Please Enter City";
								return false;

			}
			else
				*/{
					var letters = /^[A-Za-z]+$/;  
					if(!client_city.match(letters))  
					{
				//		alert('Please Enter City Name in Alphabet Characters only Ex. A-Z or a-z'); 
						document.getElementById("client_city").focus();
						document.getElementById("Scity").innerHTML=" Please Enter Only Characters";
						return false;
					}
					else
						{
							document.getElementById("Scity").innerHTML="";
						}
				}
			if(client_contact=="")
			{
			//	alert('Error: Please Fill Contact Number !');
				document.getElementById("client_contact").focus();
				document.getElementById("Scontactno").innerHTML=" Please Enter Contact Number";
				return false;

			}
			else
			{
				var a = isNaN(client_contact)
				if(a)
					{
						//alert('Error: Only Numbers are allowed !');
						document.getElementById("client_contact").focus();
						document.getElementById("Scontactno").innerHTML=" Please Enter Only Numbers";
						return false;
					}
				else
				{
					if((client_contact.length<=9) || (client_contact.length>10))
					{
						//alert('Error: Contact Number Must Contain 10 Digits !');
						document.getElementById("client_contact").focus();
						document.getElementById("Scontactno").innerHTML=" Contact Number Should be 10 Digits";
						return false;
					}
					else
						{
							document.getElementById("Scontactno").innerHTML="";
						}
				}
			}
			if(client_zipcode!=="")
			/*{
			//	alert('Error: Please Fill Postal Code !');
				document.getElementById("").innerHTML=" Please Fill ZipCode";
								return false;

			}
			else
			*/{
			var a = isNaN(client_zipcode)
				if(a)
					{
				//		alert('Error: Only Numbers are allowed !');
						document.getElementById("client_zipcode").focus();
						document.getElementById("Szipcode").innerHTML=" Only Numbers are allowed";
						return false;
					}
				else
				{
					if((client_zipcode.length<6) || (client_zipcode.length>6))
					{
					//	alert('Error: Zipcode Must Contain 6 Digits !');
						document.getElementById("client_zipcode").focus();
						document.getElementById("Szipcode").innerHTML=" Zipcode Should be 6 Digits";
						return false;
					}
					else
						{
							document.getElementById("Szipcode").innerHTML="";
						}
				}
			}
			if(client_website_url!=="")
			/*{
			//	alert('Error: Please Fill Website Name !');
				document.getElementById("client_website_url").focus();
				document.getElementById("").innerHTML=" Please Enter Your Website Name";
								return false;

			}
			else
				*/{
					//var url =/^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/;  
					var url =/^(?:(?:http[s]?|ftp):\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/[^\s]*)?$/i;
					  if(!client_website_url.match(url))  
					  {
				//		alert('Please Enter a Valid Url');  
						document.getElementById("client_website_url").focus();				
						document.getElementById("Surl").innerHTML=" Please Enter a Valid Website";
						return false;
					  }
					  else
						{
							document.getElementById("Surl").innerHTML="";
						}
				}
			
			if(client_photo!=="")
			/*{
				//alert('Error: Please Upload a Photo !');
				document.getElementById("client_photo").focus();
				document.getElementById("").innerHTML=" Please Upload a Photo";
								return false;

			}
			else
				*/{
					//var imagetype=(".gif" || ".png" || ".bmp" || ".jpeg" || ".jpg" || ".GIF" || ".PNG" || ".JPEG" || ".JPG" || ".BMP");
					var imagetype=/^\S+\.(jpg|jpeg|png|JPG|JPEG|PNG)$/;
					if(!client_photo.match(imagetype))
					{
					//		alert('Please Enter a Valid Image Type. Only JPEG, JPG, PNG, GIF, & BMP Is Allowed.');  
						document.getElementById("client_photo").focus();				
						document.getElementById("Sphoto").innerHTML=" Please Enter a Valid Image Type. Only JPG, PNG Is Allowed";
						return false;
					}
					else
						{
							document.getElementById("Sphoto").innerHTML="";
						}
				}
		}
		</script>
	
   </head>

   <body class="staff">
<div id="wrapper">
         <div id="content">
         	<div id="header">
               <!--<div id="logo"><a href="index.php"><img src="/demo/staff/images/logo.png" alt="GrubTracker"></a></div>-->
               <div id="usercontainer">
			   <?php
			   		$mail=$_SESSION['login'];
					$sql="select firstname,image from userregistration where emailid='$mail'";
					$result=mysql_query($sql,$con);
					while($data=mysql_fetch_array($result))
					{
						$firstname=$data[0];
						$image=$data[1];
					}
			   ?>
                  <ul id="user-options">
                     <li class="boldtext">Welcome: <?php echo'<h6 style=color:blue>'.$firstname.'</h6>'.'<img src='.$image.' height="50px" width="50px" />'?></li>
                     <li class="boldtext">|</li>
                     <li><a id="logout-link" href="finallogin.php" alt="Logout"></a></li>
                  </ul>
               </div>
            </div>
            <!--<ul id="staffmenu">
  </ul>-->	<?php 
                if($_SESSION["login"] != 'admin@canopus.com')
                 {
		include("menu.php");
                 }
                ?>
			<div id="darkbanner" class="banner320">
   <a href='vendors.php' title="Back"><img src="images/backk.png"></a>
   <h2>Update Profile</h2>
</div>
<div id="darkbannerwrap">
</div>
<form name="form1" method="post" onSubmit="return valid()" enctype="multipart/form-data">
   <fieldset class="form">
      <legend>Provide Vendor Details</legend>
	  		<?php 
			$editid=$_REQUEST['editid'];
			//echo $editid;
			$sql="select * from userregistration where id=$editid";
			$result=mysql_query($sql);
			if($result)
			{
				while($data=mysql_fetch_array($result))
				{
					$firstname=$data['firstname'];
					$lastname=$data['lastname'];
                                        $password=$data['password'];
					$emailid=$data['emailid'];
					$city=$data['city'];
					$phoneno=$data['phoneno'];
					$zipcode=$data['zipcode'];
					$website=$data['website'];
					$image=$data['image'];
					$updateimage=$data['image'];
					if(isset($_FILES['client_photo']))
					{
					$rand_no =  date('Y-m-d H-i-s');
$rand_no = str_replace(' ', '', $rand_no);
$filename=$rand_no.'.jpg';
move_uploaded_file($_FILES["client_photo"]["tmp_name"],"images/" . $filename);
$image="http://testgrubtracker.canopussystems.com/images/". $filename;

					}
					else
					{
					$image=$image;
					}
				}
			}
			echo "<p>
					 <label for='client_fname'><span id='SFName' style='color:red;font-size:14px;'>* </span>First Name:</label>
					 <input name='client_fname' type='text' id='client_fname' value='$firstname' onkeypress='javascript:return OnlyValues(event);' /><span id='SFname' style='color:red'></span>
				  </p>";
			echo"<p>
					<label for='client_lname'>Last Name:</label>
        			<input name='client_lname' type='text' id='client_lname' value='$lastname' onkeypress='javascript:return OnlyValues(event);' /><span id='SLname' style='color:red'></span>
				</p>";
			echo"<p>
					<label for='client_email'><span id='sEmail' style='color:red;font-size:14px;'>* </span>E-Mail:</label>
					<input name='client_email' type='text' id='client_email' value='$emailid' onkeypress='javascript:return OnlyValues(event);'  /><span id='smail' style='color:red'></span>
					<input name='userlevel' type='hidden' id='userlevel' value='1'>
				</p>";
			echo"<p>
					<label for='client_password'><span id='SPassword' style='color:red;font-size:14px;'>* </span>Password:</label>
      				<input name='client_password' type='password' id='client_password' value='$password' onkeypress='javascript:return OnlyValues(event);'  /><span id='spassword' style='color:red'></span>
				</p>";
		 	echo"<p>
					<label for='client_city'>City:</label>
       				<input name='client_city' type='text' id='client_city' value='$city' /><span id='Scity' style='color:red'></span>
				</p>";
			echo"<p>
					<label for='client_contact'><span id='SContact' style='color:red;font-size:14px;'>* </span>Contact No.:</label>
        			<input name='client_contact' type='text' id='client_contact' value='$phoneno' onkeypress='javascript:return OnlyValues(event);'  /><span id='Scontactno' style='color:red'></span>
				</p>";
			echo"<p>
					<label for='client_zipcode'>Zipcode:</label>
        			<input name='client_zipcode' type='text' id='client_zipcode' value='$zipcode' onkeypress='javascript:return OnlyValues(event);'  /><span id='Szipcode' style='color:red'></span>
				</p>";
			echo"<p>
					<label for='client_website_url'>Website Url:</label>
      				<input name='client_website_url' type='text' id='client_website_url' value='$website' onkeypress='javascript:return OnlyValues(event);'  /><span id='Surl' style='color:red'></span>
				</p>";
			echo"
			<table style='margin-left:20px'><tr><td><label for='client_photo'>Select Image:</label>	</td><td><input name='client_photo' type='file' id='client_photo' style='height:30px;'  />					
					<span id='Sphoto' style='color:red'></span>
					<img src='$image' height='50px' width='50px' style='border-radius:50%;' /></td></tr></table>				
					
				";
			echo"<p>
					<button type='Submit' class='positive' name='Submit' style='height:30px' >Save Changes</button>
				</p>";
		 	if(isset($_POST['Submit']))
			{
				$client_fname=$_POST['client_fname'];
				$client_lname=$_POST['client_lname'];
				$client_email=$_POST['client_email'];
				$client_password=$_POST['client_password'];
				/*client_city=$_POST['client_city'];*/
				$client_contact=$_POST['client_contact'];
				$client_city=$_POST['client_city'];
				$client_zipcode=$_POST['client_zipcode'];
				if ($_FILES['client_photo']['size'] == 0)
				{
				$query="update userregistration set firstname='$client_fname',lastname='$client_lname',emailid='$client_email',password='$client_password',phoneno='$client_contact',zipcode='$client_zipcode',city='$client_city',image='$updateimage' where id='$editid'";
				}
				else
				{				
				$query="update userregistration set firstname='$client_fname',lastname='$client_lname',emailid='$client_email',password='$client_password',phoneno='$client_contact',zipcode='$client_zipcode',city='$client_city',image='$image' where id='$editid'";
				//echo $query;exit;
				}				
				
				$result=mysql_query($query);
				
				if($result)
				{
					echo"<script>alert('Profile Updated Successfully')</script>";
					echo "<script type='text/javascript'> document.location='vendors.php';</script>";
				}
				else
				{
					echo"<script>alert('Profile Not Updated Successfully')</script>";
				}
			}
			/*
			if(isset($_POST["Submit"]))
			{
				$firstname=$_POST["client_fname"];
				$lastname=$_POST["client_lname"];
				$email=$_POST["client_email"];
				$password=$_POST["client_password"];
				//$confirmpassword=$_POST["client_confirm_password"];
				$contactno=$_POST["client_contact"];
				$city=$_POST["client_city"];
				$zipcode=$_POST["client_zipcode"];
				$website=$_POST["client_website_url"];
				
				
				$imgname=$_FILES['client_photo']['name'];
				$imgtmp=$_FILES['client_photo']['tmp_name'];
				move_uploaded_file('$imgname','upload/'.$imgname);
				//$photo=$_FILES["client_photo"];

                 $sql="select * from userregistration where emailid='$email'";		
						$result=mysql_query($sql);
						if($result)
						{
							if(mysql_num_rows($result)<=0)
							{
									$sql="INSERT INTO userregistration(emailid,firstname,lastname,password,phoneno,city,zipcode,website,image)
					values('$email','$firstname','$lastname','$password','$contactno','$city','$zipcode','$website','$imgname')";
				
								$result=mysql_query($sql);
							
									if($result)
									{
									echo"<script>alert('Registration Successful')</script>";
echo "<script type='text/javascript'> document.location='vendors.php';</script>";
									}
							}
		
									else
									{
										echo"<script>alert('Error: Email Id Already Exists !')</script>";
									}
						}
			
		}*/
			?>
   </fieldset>
</form>

<div id="footer"><a href="#" target='_blank'></a></div>
   </div>
   </div>
   <div id="wrapperbottom"></div>
   </body>
   </html>