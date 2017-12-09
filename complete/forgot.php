<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<?php
	include("connection.php");
	//session_start();
?>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="shortcut icon" type="image/ico" href="/images/favicon.ico" />	
		<title>Grub Tracker</title>		
		<link href="styles.css" type="text/css" media="screen" rel="stylesheet" />		
		<style type="text/css">
		img, div { behavior: url("iepngfix.htc") }
		</style>

<script>
		function valid()
		{
			var email=document.getElementsByName("user_name")[0].value;
			//var password=document.getElementsByName("user_password")[0].value;
			if(email=="")
			{
				alert('Error Cannot Leave Blank !');
				return false;
			}
		}
		</script>	
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
	</head>
	<body id="login">
		<div id="wrappertop"></div>
			<div id="wrapper">
					<div id="content_1">
						<div id="header_1">
							<h2>Grub Tracker</h2>
						</div>
						<div id="darkbanner" class="banner320">
                                     <a href="finallogin.php" ><img src="images/backk.png"> </a>
							<h2>Forgot Password</h2>
						</div>
						<div id="darkbannerwrap">						</div>
						<form name="form1" method="post" onsubmit="return valid()">
						<fieldset class="form">
                        								<p>Please Provide Your Email Address.</p><br>
							<p>
								<label for="user_name">E-Mail:</label>
								<input name="user_name" id="user_name" type="text" onkeypress="javascript:return OnlyValues(event);" />
							</p>
							<button type="submit" class="positive" name="Submit">
								<img src="images/key.png" alt="Announcement"/>Request New Password</button>
							</fieldset>
					</div>
				</div> 

<div id="wrapperbottom_branding"><div id="wrapperbottom_branding_text"><!--<a href="#" style='text-decoration:none'></a>--></div></div>
<?php
			if(isset($_POST["Submit"]))
			{			
				 $email = $_POST["user_name"];                    
                    $query = "SELECT * FROM userregistration WHERE emailid = '".$email."' LIMIT 1";					
                    $query_result = mysql_query ($query);
                    $fetch_row = mysql_num_rows($query_result);                   
                    
                    if ( $fetch_row > 0 )
					{
						$row=mysql_fetch_array($query_result);
						$Pass=$row['password'];
						$getid=$row['id'];
						$nm=$row['firstname'].' '.$row['lastname'];						
							$message='<table width="650" border="0" align="center" cellpadding="0" cellspacing="0">';
							$message .='<tr>';
							$message .='<td height="25" colspan="2" align="left" valign="middle" class="topfont colorGray"><strong>Dear,'.$nm.' Your Reset Password Link</strong></td>';
							$message .='</tr>';
							$message .='<tr>';
							$message .='<td align="left" colspan="2" valign="middle" class="topfont colorGray"><a href="http://testgrubtracker.canopussystems.com/newresetpassword.php">Click Here</a></td>';
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
						$email_subject="Reset Password";					
						//$email_from = "kapil.sariwal@canopusinfosystems.com";
						$email_message= $message;
						$headers = "MIME-Version: 1.0\r\n";
						$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
						$headers .= "From:php.admin@canopusinfosystems.com";
						if(mail($email_to, $email_subject, $email_message, $headers))
						{
								echo"<script>alert('Your ResetPassword Link Send Successfully,Plz Check Your Email..')</script>";						
								//$response='Your ResetPassword Link Send Successfully,Plz Check Your Email..';	
}							
						//else
					//	{
						//		echo"<script>alert('Error: Invalid Email Id !')</script>";						
								//$response='Invalid Email Id';							
						       								
                        //}
						 
					}							
							else
							{
								echo"<script>alert('Error: Invalid Email Id !')</script>";			
								//$response='Invalid Email Id';							
						       								
							}
						
						
					}
					
					//else
					//{
						//		echo"<script>alert('Error: Invalid Email Id !')</script>";						
								//$response='Invalid Email Id';    		
					//}
			
			
		?>
</body>
</html>