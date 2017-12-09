<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<title></title>
	<head>
	<meta name="viewport" content="width=device-width">
	<title>Grub Tracker</title>		
		<link href="styles.css" type="text/css" media="screen" rel="stylesheet" /><style type="text/css">
		img, div { behavior: url("iepngfix.htc") }
		</style>
	<script type="text/javascript">
		function validator()
			{
				var email=document.getElementsByName("email")[0].value;
				var password=document.getElementsByName("password")[0].value;
				var confirmpassword=document.getElementsByName("confirmpassword")[0].value;				
				if(email=="")
				{
					alert('Error: Email Id cannot be blank!');
					return false;
				}
				if(password=="")
				{
					alert('Error: Password cannot be blank!');
					return false;
				}
				if(confirmpassword=="")
				{
					alert('Error: Confirm Password cannot be blank!');
					return false;
				}
				if(password!==confirmpassword)
				{
					alert('Password Does not Match');
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
                        <div style="width:218px;height:26px"><h2>Grub Tracker</h2></div>
							<!--<h1></h1>-->
						</div>
						<div id="darkbanner" class="banner320">
                                              <a href="finallogin.php" ><img src="images/backk.png"> </a>
							<h2>Reset Password</h2>
						</div>
						<div id="darkbannerwrap">
						</div>
						<form method="post" onsubmit="return validator()">
						<fieldset class="form">
                        	                                                                                       <p>
								<label style="float: left;text-align: right;width: 36%;font-weight: bold;margin-right: 10px;padding-top: 7px;" for="user_name">Enter E-Mail Id:</label>
								<input style="height: 20px;	width: 56%;_width: 56%;margin-bottom: 15px;padding: 3px;font: 16px 'Lucida Grande', arial, sans-serif;" name="email" id="email" type="text" value="" onkeypress="javascript:return OnlyValues(event);"/>
							</p>
							<p>
								<label style="float: left;text-align: right;width: 36%;font-weight: bold;margin-right: 10px;padding-top: 7px;" for="user_password">New Password:</label>
								<input style="height: 20px;	width: 56%;_width: 56%;margin-bottom: 15px;padding: 3px;font: 16px 'Lucida Grande', arial, sans-serif;" name="password" id="password" type="password" onkeypress="javascript:return OnlyValues(event);"/>
							</p>
                            <p>
								<label style="float: left;text-align: right;width: 36%;font-weight: bold;margin-right: 10px;padding-top: 7px;" for="user_password">Confirm Password:</label>
								<input style="height: 20px;	width: 56%;_width: 56%;margin-bottom: 15px;padding: 3px;font: 16px 'Lucida Grande', arial, sans-serif;"  name="confirmpassword" id="confirmpassword" type="password" onkeypress="javascript:return OnlyValues(event);"/>
							</p>
 
							<button style="display:block;float:left;margin:0 15px 0 120px; _margin-left: 45px;" type="submit" class="positive" name="Submit">
								<img src="images/key.png" alt="Announcement"/>Request New Password</button>

								<!--<input type="submit" name="Submit" class="positive" value="Reset" />-->
                            						</fieldset>
						</form>
						
					</div>
				</div>   
	
</body>
		<?php
				$con=mysql_connect("208.91.199.11","can_grub","QAZ123");
				mysql_select_db("canoppwh_grubtracker",$con);
				if(isset($_POST["Submit"]))
				{
					$email=$_POST["email"];
					$password=$_POST["password"];
					$confirmpassword=$_POST["confirmpassword"];
					$sql="select * from userregistration where emailid='$email'";
					$result=mysql_query($sql);		
							if($result)
							{
								if(mysql_num_rows($result)>0)
								{	
								$sql="UPDATE userregistration SET password='$password' where emailid='$email'";
								$result=mysql_query($sql);
								if($result)
									{
										echo"<script>alert('Password Changed Successfully')</script>";
									}
								else
									{
										echo"<script>alert('Try Again')</script>";
									}
								}
								else
									{				
									echo"<script>alert('User Does not Exist')</script>";
									}
							}
				}
			?>
</html>