<?php include 'checksession.php'?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<?php
include("connection.php");
include('ps_pagination.php');
?>
   <head>
      <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
      <link rel="shortcut icon" type="image/ico" href="../images/favicon.ico" />
      <title>Grub Tracker</title>
      <link href="styles.css" type="text/css" media="screen" rel="stylesheet" />
      <style type="text/css">
         img, div { behavior: url(iepngfix.htc) }
      </style>
      <link href="../css/search.css" type="text/css" media="screen" rel="stylesheet" />
      <link href="../css/picker.css" type="text/css" media="screen" rel="stylesheet" />
      <script type="text/javascript" src="../functions/jquery.min.js"></script>
      <script type="text/javascript" src="../functions/search.js"></script>
      <script type="text/javascript" src="../functions/timer.js" ></script>
	  
      
<script>var seconds = 0; var minutes = 0; var hours = 0; var startCount = 0;</script>   </head>

   <body class="staff">
   
    <div id="fade" class="black_overlay"></div>
      <div id="wrappertop"></div> 
     
        <!-- End Search Results -->
        <div id="wrapper">
         <div id="content">
         	<div id="header" style="">
                 <h2>Grub Tracker&nbsp;&nbsp;<NOBR> </NOBR></h2>
               <!--<div id="logo"><a href="#"><img src="" alt="GrubTracker"></a></div>-->
               <div id="usercontainer">
                  <ul id="user-options">
                     <li class="boldtext">Welcome: <?php echo $_SESSION["login"]; ?></li>
                     <li class="boldtext">|</li>
                     <li><a id="logout-link" href="../logout.php" alt="Logout"></a></li>
                  </ul>
               </div>
            </div>
          
        	<?php 
                if($_SESSION["login"] != 'admin@canopus.com')
                 {
		include("menu.php");
                 }
                ?>

<?php 
if($_SESSION["login"] == 'admin@canopus.com')
                 { ?>	
<a href="managevendor.php" class="green-action">Add New Vendor</a>
<?php } ?>
<div id="darkbanner" class="banner320">
   <!-- <img src="images/manageclients.png"> -->
   <h2>Manage Vendor&nbsp;&nbsp;<NOBR> </NOBR></h2>
</div>

<div id="darkbannerwrap">
</div>
	<?php
   {
	$sql="SELECT `id`, `firstname`, `lastname`, `emailid`, `password`, `usertype`, `phoneno`, `city`, `zipcode`, `website`, `facebookid`, `latitude`, `longitude`, `deviceId`, `golivestatus`, `image` FROM userregistration WHERE emailid !='admin@canopus.com' ORDER BY `userregistration`.`id` DESC ";
	
$pager = new PS_Pagination($con, $sql, 10, 5);
$rs = $pager->paginate();
$result=mysql_query($sql);
}

?>

               </p>
      <table id="activeinvoicetable" bgcolor="white" border="1">
         <tr>
            <th class="number">ID</th>
            <th>Name</th>
            <th>E-Mail</th>
           <!-- <th>E-Mail</th>-->
            <th>Image</th>
            <th>Status</th>
            <th>Actions</th>
         </tr>
		 <?php	

while($row = mysql_fetch_array($rs))
 {
 
?>
                     <tr>
               <td class="number tdmidgreen greentext"><a href="updateprofiledesign.php?editid=<?php echo $row['id'];?>"><?php echo $row['id'];?></a></td>

               <td class="td300b"><?php echo $row['firstname'];?></td>

              <!-- <td class="td300>Allan John<span><a href="AddVendor.html">[View]</a></span></td>-->
               <td class="td250"><?php echo $row['emailid'];?></td>
	      <td class="td65"><img src='<?php echo $row['image'];?>' width="50" height="50" style="border-radius:50%" /></td>
               <td class="td80">Active</td>
               <td class="actions">

                    <a href="updateprofiledesign.php?editid=<?php echo $row['id'];?>"title="Edit"><img src='images/url.png' height='20px' alt='Edit' /></a>
                     <a href="deletevendor.php?DelUserId=<?php echo $row['id'];?>" onclick="return confirm('Do you want to delete this Vendor?');" title="Delete"><img src="images/delete.png"/></a>
               </td>
               </tr>
			   <?php
 }

?>

                        </table>
<?php
echo '<div style="text-align:right">'.$pager->renderFullNav().'</div>';
?>                     
               <br>
               <br>
                           <div id="footer"><!--<a href="http://www.GrubTracker.com" target='_blank'>Freelance Suite</a>--></div>
   </div>
   </div>
   <div id="wrapperbottom"></div>
   </body>
   </html>
