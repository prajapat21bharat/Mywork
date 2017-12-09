<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<?php
		include("connection.php");
error_reporting(0);
		//session_start();
	?>
	<head>
		<meta name="viewport" content="width=device-width">
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="shortcut icon" type="image/ico" href="/images/favicon.ico" />	
		<title>Grub Tracker</title>		
		<link href="styles.css" type="text/css" media="screen" rel="stylesheet" />		<style type="text/css">
		img, div { behavior: url("iepngfix.htc") }
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
			var email=document.getElementsByName("user_name")[0].value;
			var password=document.getElementsByName("user_password")[0].value;
			if(email="" || password=="")
			{
				alert('Error Cannot Leave Blank !');
				return false;
			}
		}
		</script>
	</head>
	<body id="login">
		<div id="wrappertop"></div>
			<div id="wrapper">
					<div id="content_1">
						<div id="header_1">
                        <div style="width:218px;height:26px"><h2>Grub Tracker</h2></div>							
						</div>
						<div id="darkbanner" class="banner320">
							<h2>Login</h2>
						</div>
						<div id="darkbannerwrap">
						</div>
						<form name="form1" method="post" onsubmit="return valid()">
						<fieldset class="form">
                        	<p>
								<label for="user_name">E-Mail Id:</label>
								<input name="user_name" id="user_name" type="text" value="" onkeypress="javascript:return OnlyValues(event);" />
							</p>
							<p>
								<label for="user_password">Password:</label>
								<input name="user_password" id="user_password" type="password" onkeypress="javascript:return OnlyValues(event);" />
							</p>
							<button type="submit" class="positive" name="Submit" value="Login">
								<img src="images/key.png" alt="Announcement"/>Login</button>
								<ul id="forgottenpassword">
								<li class="boldtext"></li>
								<li><a href="forgot.php">Forgot Password?</a></li>
							</ul>
                            						</fieldset>
						
						
					</div>
				</div>   

<div id="wrapperbottom_branding"><div id="wrapperbottom_branding_text"><!--<a href="" style='text-decoration:none'></a>--></div></div>
	<?php
			if(isset($_POST["Submit"]))
			{			
				$emailid=$_POST["user_name"];
				$password=$_POST["user_password"];
				$sql="SELECT password, emailid FROM userregistration WHERE emailid='$emailid' AND password='$password'";
				$result=mysql_query($sql);		
				if($result)
				{
					if(mysql_num_rows($result)>0)
					{	
						session_start();
						$_SESSION['login']=$emailid;
                                                if($_SESSION['login']=='admin@canopus.com')
                                                {
                                                   echo "<script type='text/javascript'> document.location='vendors.php';</script>";
                                                }
                                                else
                                                {
						//header('location:index.htm');
						//echo "<script type='text/javascript'> document.location='addnewvendor.php';</script>";
						echo "<script type='text/javascript'> document.location='addmenu.php';</script>";
                                                }
					}
					else
					{
						echo"<script>alert('Error: Invalid Username & Password !')</script>";
					}
				}
			}
		?>
	</body>
</html>