<?php include 'checksession.php'?>
<!DOCTYPE html>
<html>
   <head>
   <?php
include("connection.php");
include('ps_pagination.php');
?>
      <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
      <link rel="shortcut icon" type="image/ico" href="../images/favicon.ico" />
      <title>Grub Tracker</title>
      <link href="styles.css" type="text/css" media="screen" rel="stylesheet" />
      <style type="text/css">
         img, div { behavior: url(../iepngfix.htc) }
      </style>
	<script>
		function valid()
		{
			var category=document.getElementsByName("category")[0].value;
		//	var category_image=document.getElementsByName("category_image")[0].value;
			if(category=="")
			{
				document.getElementById("Scategory").innerHTML=" Please Enter Category name";
				return false;
			}
			if(category_image!=="")
			{
					//var imagetype=(".gif" || ".png" || ".bmp" || ".jpeg" || ".jpg" || ".GIF" || ".PNG" || ".JPEG" || ".JPG" || ".BMP");
					var imagetype=/^\S+\.(jpg|jpeg|png|JPG|JPEG|PNG)$/;
					if(!category_image.match(imagetype))
					{
					//		alert('Please Enter a Valid Image Type. Only JPEG, JPG, PNG, GIF, & BMP Is Allowed.');  
						document.getElementById("category_image").focus();				
						document.getElementById("Simage").innerHTML=" Please Enter a Valid Image Type. Only JPG, PNG Is Allowed";
						return false;
					}
					else
						{
							document.getElementById("Simage").innerHTML="";
						}
				}
		}
		</script>
   </head>

   <body class="staff">
      <div id="wrappertop"></div> 
      <!-- Show Search Results -->
			<!--<div id="search-results">
        	</div>-->
        <!-- End Search Results -->
<div id="wrapper">
         <div id="content">
         	<div id="header">
               <!--<div id="logo"><a href="index.php"><img src="/demo/staff/images/logo.png" alt="GrubTracker"></a></div>-->
               <div id="usercontainer">
			   <?php
			   		$mail=$_SESSION['login'];
					$sql="select firstname,image,id from userregistration where emailid='$mail'";
					$result=mysql_query($sql,$con);
					while($data=mysql_fetch_array($result))
					{
						$firstname=$data[0];
						$image=$data[1];
						$id=$data[2];
					}
			   ?>
                  <ul id="user-options">
                     <li class="boldtext">Welcome: <?php echo'<h6 style=color:blue>'.$firstname.'</h6>'.'<img src='.$image.' height="50px" width="50px" />'?></li>
                     <li class="boldtext">|</li>
                     <li><a id="logout-link" href="finallogin.php" alt="Logout"></a></li>
                  </ul>
               </div>
            </div>
        	<?php 
					include("menu.php");
				?>
			<div id="darkbanner" class="banner320">
   <img src="../images/client.png">
   <h2>Manage Vendor</h2>
</div>
<div id="darkbannerwrap">
</div>
<form name="form1" method="post" onSubmit="return valid()" enctype="multipart/form-data">
   <fieldset class="form1">
      <legend>Provide Menu Category Details</legend>
     	   <table id="activeinvoicetable">
		   <tr style="background:#424242; color:#FFFFFF">
            <th>Name</th>
            <th>E-Mail</th>
            <th>Photo</th>
            <th>Status</th>
            <th colspan="2">Actions</th>
         </tr>
		<?php 
			{
			$sql="SELECT `id`, `firstname`, `lastname`, `emailid`, `password`, `usertype`, `phoneno`, `city`, `zipcode`, `website`, `facebookid`, `latitude`, `longitude`, `deviceId`, `golivestatus`, `image` FROM userregistration ";	
			$pager = new PS_Pagination($con, $sql, 10, 5);
			$rs = $pager->paginate();
			$result=mysql_query($sql);
				while($row = mysql_fetch_array($rs))
				{
				$userid=$row['id'];
				$userfisrtname=$row['firstname'];
				$userlastname=$row['lastname'];
				$username=$userfisrtname.' '.$userlastname;
				$useremailid=$row['emailid'];
				$usestatus=$row['golivestatus'];
				$userimage=$row['image'];
				if($usestatus==1)
				{
					$usestatus="Active";
				}
				else
				{
					$usestatus="Deactive";
				}
				echo"<tr>
						<td class='td300b'>$username</td>
						<td class='td250'>$useremailid</td>
						<td class='td65'><img src='$userimage' height='50px' width='50px' style='border-radius:50%' /></td>
						<td class='td80'>$usestatus</td>
						<td class='actions'><a href='updateprofiledesign.php?editid=$userid' value='$userid'><img src='images/url.png' height='20px' alt='Edit' /></a></td>
						<td class='actions'><a href='#'><img src='images/delete.png' alt='Delete'></a></td>
					</tr>";
				/*
				<tr>
               <td class="number tdmidgreen greentext"><a href=updateprofiledesign.php?editid=<?php $userid ?>' value=<?php echo $userid ?>>Edit</a></td>
               <td class="td300b"><?php echo $userfisrtname;?></td>
              <!-- <td class="td300">Allan John<span><a href="AddVendor.html">[View]</a></span></td>-->
               <td class="td250"><?php echo $useremailid;?></td>
				<td class="td65"><img src='<?php echo $userimage;?>' style='border-radius:50%; border:1px solid #006600' width="50" height="50" /></td>
               <td class="td80">Active</td>
               <td class="actions">
                     <a href="updateprofiledesign.php?editid=$row['id']"><img src="images/pencil.png" alt="Edit" /></a>
                     <a href="?DelUserId=3" onclick="return confirm('Are you sure you want to delete this?');"><img src="images/delete.png"/></a>
               </td>
               </tr>*/
				}

			}

		?>
	</table>
	
<?php
echo '<div style="text-align:right">'.$pager->renderFullNav().'</div>';
?>               

	 </fieldset>
</form>
<div id="footer"><a href="#" target='_blank'></a></div>
   </div>
   </div>
   <div id="wrapperbottom"></div>

   </body>
   </html>