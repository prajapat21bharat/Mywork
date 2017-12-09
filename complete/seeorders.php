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
<!--
<script type="text/javascript" src="jquery-1.8.2.js"></script>
<script type="text/javascript">
$(function() {
$('.showhide').click(function() {
$(".slidediv").slideToggle();
});
});
</script>-->





	<script>
		/*function valid()
		{
			var vendorid=document.getElementsByName("vendorid")[0].value;
			var category=document.getElementsByName("category")[0].value;			
			if(vendorid=="")
			{
				alert('Error: Can not Leave Vendor Id Blank !');
				//document.getElementsByName('client_email').focus();
				document.getElementById("vendorid").focus();
				return false;
			}
			if(category=="")
			{
				alert('Error: Can not Leave Category Blank !');
				//document.getElementsByName('client_email').focus();
				document.getElementById("category").focus();
				return false;
			}
		}*/
		function show(xc)
		{
			
			var x=document.getElementById("show"+xc).style;
						if(x.display.match("block"))
						{
						x.display="none";
						}
						else{
						x.display="block";
						}
		}
		</script>
   </head>

   <body class="staff">
<div id="wrapper">
         <div id="content">
         	<div id="header">
               <!--<div id="logo"><a href="index.php"><img src="/demo/staff/images/logo.png" alt="GrubTracker"></a></div>-->
               <?php
               include("header_session.php");
               ?>
            </div>
            <!--<ul id="staffmenu">
  </ul>-->	
        	<?php 
					include("menu.php");
				?>
			<div id="darkbanner" class="banner320">
   <img src="../images/client.png">
   <h2>View Orders</h2>
</div>
<div id="darkbannerwrap">
</div>
<form name="form1" method="post" onSubmit="return valid()" enctype="multipart/form-data">
   <fieldset class="form">
      <legend>Order Details</legend>
        <div class="form" align="center">
		  <table class="grid">
		<?php 
			if(isset($_SESSION["login"]))
			{
				$sql="SELECT id FROM userregistration WHERE emailid='$mail'";
						
						$result=mysql_query($sql);
						if($result)
						{	
							$data=mysql_fetch_array($result);
							$id=$data[0];
							if($result)
							{
									$sql="SELECT userregistration.firstname,userregistration.lastname,userregistration.image,customerorder.datetime,customerorder.totalamount,customerorder.cid,customerorder.orderstatus FROM customerorder JOIN userregistration ON userregistration.id=customerorder.cid where customerorder.vid='$id'";
									$pager = new PS_Pagination($con, $sql, 100, 5);
									$rs = $pager->paginate();
									$cs=0;
									$result=mysql_query($sql);
									if($result>0)
									{
										echo"<tr><th class='grid'>User Name</th><th class='grid'>Image</th><th class='grid'>Order Date</th><th class='grid'>Total Amount</th><th class='grid'>Status</th></tr>";
										while($userInfo = mysql_fetch_array($rs))
										{
											$cs++;	
											$userfname=$userInfo[0];
											$userlname=$userInfo[1];
											$username=$userfname.' '.$userlname;
											$userimage=$userInfo[2];
											$userorderdate=$userInfo[3];
											$userordertotalamount=$userInfo[4];
											$cid=$userInfo[5];
											$orderstatus=$userInfo['orderstatus'];
/*											$usertip=$userInfo[5];
											$userordercoupon=$userInfo[6];
											$userorderisspecial=$userInfo[7];
											$userorderstatus=$userInfo[8];
											$userorderitemname=$userInfo[9];
*/											if($orderstatus=='0')
															{
																$orderstatus="Order Not Completed";
															}
															else
															{
																$orderstatus="Order Completed"; 
															}
											echo "<table class='grid'><tr>
													<td onclick='show($cs);'>$username</td>
													<td onclick='show($cs);'><img src='$userimage' height='50px' width='50px' style='border-radius:50%' /></td>
													<td onclick='show($cs);'>$userorderdate</td>
													<td onclick='show($cs);'>$userordertotalamount</td>
													<td onclick='show($cs);'>$orderstatus</td>
												</tr></table>";
												
												$qr="SELECT ordermenu.orderid,ordermenu.price,ordermenu.itemname,ordermenu.quantity,customerorder.coupon,customerorder.tip,customerorder.totalamount FROM `ordermenu` join customerorder on customerorder.id=ordermenu.orderid WHERE customerorder.cid=$cid";
												$rss=mysql_query($qr);
												
												if($rss)
												{
													while($dr=mysql_fetch_array($rss))
													{
															
													$price=$dr['price'];
													$itemname=$dr['itemname'];
													$O_id=$dr['orderid'];
													$quantity=$dr['quantity'];
													$tip=$dr['tip'];
													//$orderstatus=$dr['orderstatus'];
														
												
												
														
															echo"<tr>
																<table id='show".$cs."' class='slidediv'>";
																
																//echo $itemname;
																echo"
																<th>Item Name</th><th>Quantity</th><th>Price</th>";
															$ppr="SELECT ordermenu.price,ordermenu.itemname FROM `ordermenu` join customerorder on customerorder.id=ordermenu.orderid WHERE customerorder.cid=$cid";
														$oo=mysql_query($ppr);
														if($oo)
																{
																	while($dr2=mysql_fetch_array($oo))
																	{
																			$price=$dr2['price'];
																			$itemname=$dr2['itemname'];
																				echo"<tr><td>$itemname</td><td>$quantity</td><td>$price</td></tr>";
																	}
																}
																	echo"																	
																	<tr><td></td><th style='text-align:right'>Total Amount</th><th>$userordertotalamount</th></tr>";
																	echo "</table>
																	</tr>";
																
																	
													}
												}
										
										}}
			}}
		}
							
							else
									{
										echo"<script>alert('Error: Try Again !')</script>";
									}
					?>
	</table>
	<?php

	//Display the navigation

	//echo $pager->renderFullNav();

	echo '<div style="text-align:right">'.$pager->renderFullNav().'</div>';

?>
     </div>
   </fieldset>
</form>

<div id="footer"><a href="#" target='_blank'></a></div>
   </div>
   </div>
   <div id="wrapperbottom"></div>
   </body>
   </html>