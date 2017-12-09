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
      <title>Grub Tracker</title>
      <link href="styles.css" type="text/css" media="screen" rel="stylesheet" />
      <style type="text/css">
         img, div { behavior: url(../iepngfix.htc) }
      </style>
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
					include("menu.php");
				?>
			<div id="darkbanner" class="banner320">
   <img src="../images/client.png">
   <h2>Add New Vendor</h2>
</div>
<div id="darkbannerwrap">
</div>
<form name="form1" method="post" onSubmit="return valid()" enctype="multipart/form-data">
   <fieldset class="form">
      <legend>Provide Vendor Details</legend> 
      <p>
         <label for="client_email"><span id="sEmail" style="color:red;font-size:14px;">* </span>E-Mail:</label>
         <input name="client_email" type="text" id="client_email" /><span id="smail" style="color:red"></span>
         <input name="userlevel" type="hidden" id="userlevel" value="1">
      </p>
      <p>
         <label for="client_fname"><span id="SFName" style="color:red;font-size:14px;">* </span>First Name:</label>
         <input name="client_fname" type="text" id="client_fname"  /><span id="SFname" style="color:red"></span>
      </p>
      <p>
         <label for="client_lname">Last Name:</label>
         <input name="client_lname" type="text" id="client_lname"  /><span id="SLname" style="color:red"></span>
      </p>
	  <p>
         <label for="client_password"><span id="SPassword" style="color:red;font-size:14px;">* </span>Password:</label>
         <input name="client_password" type="password" id="client_password"  /><span id="spassword" style="color:red"></span>
      </p>    
     <!-- <p>
         <label for="client_confirm_password">Confirm Password:</label>
         <input name="client_confirm_password" type="password" id="client_confirm_password" />
      </p>    -->
      <p>
         <label for="client_city">City:</label>
         <input name="client_city" type="text" id="client_city"  /><span id="Scity" style="color:red"></span>
      </p>
	  <p>
         <label for="client_contact"><span id="SContact" style="color:red;font-size:14px;">* </span>Contact No.:</label>
         <input name="client_contact" type="text" id="client_contact"  /><span id="Scontactno" style="color:red"></span>
      </p>      
	        
	  <p>
         <label for="client_zipcode">Zipcode:</label>
         <input name="client_zipcode" type="text" id="client_zipcode"  /><span id="Szipcode" style="color:red"></span>
      </p>
	  <p>
         <label for="client_website_url">Website Url:</label>
         <input name="client_website_url" type="text" id="client_website_url"  /><span id="Surl" style="color:red"></span>
      </p>
	  <p>
         <label for="client_photo">Photo:</label>
         <input name="client_photo" type="file" id="client_photo" style="height:30px"  />
		 <span id="Sphoto" style="color:red"></span>
      </p>
      <button type="Submit" class="positive" name="Submit" style="height:30px" >Submit</button>
   </fieldset>
</form>

<div id="footer"><a href="#" target='_blank'></a></div>
   </div>
   </div>
   <div id="wrapperbottom"></div>
		<?php 
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
				
				/*$imgname=$_FILES['client_photo']['name'];
				$imgtmp=$_FILES['client_photo']['tmp_name'];
				move_uploaded_file($imgtmp,"Uploads/".$imgname) or die (mysql_error());
				$path="Uploads/".$imgname;*/
				
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
									}
									//////////// mail function start////////////
				
				$message='<table width="650" border="0" align="center" cellpadding="0" cellspacing="0">';
$message .='<tr>';
$message .='<td height="25" colspan="2" align="left" valign="middle" class="topfont colorGray"><strong>Dear,'.$firstname.' Your GrubTracker Account Created Successfully.</strong></td>';
$message .='</tr>';
$message .='<tr>';
$message .='<td align="left" colspan="2" valign="middle" class="topfont colorGray">Your UserName '.$firstname.'</td>';
$message .='</tr>';
$message .='<tr>';
$message .='<td align="left" colspan="2" valign="middle" class="topfont colorGray">Your Password '.$password.'</td>';
$message .='</tr>';
$message .='<tr>';
$message .='<td align="left" colspan="2" valign="middle" class="topfont colorGray">&nbsp;</td>';
$message .='</tr>';
$message .='<tr>';
$message .='<td align="left" colspan="2" valign="middle" class="topfont colorGray">Thanks! </td>';
$message .='</tr>';
$message .='<tr>';
$message .='<td height="10" colspan="2" align="left" valign="middle" ></td>';
$message .='</tr>';											  
$message .='</table></td>';
$message .='</tr>';
$message .='</table>';						
						$email_to = $email;
						$email_subject="Registration";					
						$email_from = "kapil.sariwal@canopusinfosystems.com";
						$email_message= $message;
						$headers = "MIME-Version: 1.0\r\n";
						$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
						$headers .= "From: ".$email_from."\r\n";
					mail($email_to, $email_subject, $email_message, $headers);
						//{
								//$final_result_1 =  'true';								
								//$final_result_3 =  '';							
								//$response='Your ResetPassword Link Send Successfully,Plz Check Your Email..';	
						//}							
						//else
						//{
								//$final_result_1 =  'false';								
								//$final_result_3 =  '';							
								//$response='Invalid Email Id';							
						       								
                        //}
						
				//////////// mail function End//////////////
				
							}
		
									else
									{
										echo"<script>alert('Error: Email Id Already Exists !')</script>";
									}
						}
			
		}
		?>
   </body>
   </html>