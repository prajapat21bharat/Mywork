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
               <?php

               include("header_session.php");

               ?>

            </div>
        	<?php 

					include("menu.php");

				?>

			<div id="darkbanner" class="banner320">

   <img src="../images/client.png">

   <h2>View Menu</h2>

</div>

<div id="darkbannerwrap">

</div>

<form name="form1" method="post" onSubmit="return valid()" enctype="multipart/form-data">

   <fieldset class="form">

      <legend>Menu Details</legend>

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
				//echo $id; exit;
							if($result)

							{
									$sql="SELECT * FROM menucategory where vid='$id'";
									$pager = new PS_Pagination($con, $sql, 100, 5);
									$rs = $pager->paginate();
									$cs=0;
									$result=mysql_query($sql);
									if($result>0)
									{
										echo"<tr><th class='grid'>Category Name</th></tr>";
										while($userInfo = mysql_fetch_array($rs))
										{
											$cs++;	
											$categoryname=$userInfo['name'];
											$categoryid=$userInfo['id'];
											echo "<table class='grid'><tr>
													<td onclick='show($cs);'>$categoryname</td>
												</tr></table>";
												$qr="SELECT * from menu where vid=$id";
												$rss=mysql_query($qr);
												if($rss)
												{
													while($dr=mysql_fetch_array($rss))
													{
													$itemname=$dr['itemname'];
													$price=$dr['price'];
													//$orderstatus=$dr['orderstatus'];
															echo"<tr>
																<table id='show".$cs."' class='slidediv'>";
																//echo $itemname;
																echo"
																<th>Item Name</th><th>Price</th><th>Image</th>";
															$ppr="SELECT * From menu where vid='$id' and categoryid='$categoryid'";
														$oo=mysql_query($ppr);
														if($oo)
																{
																	while($dr2=mysql_fetch_array($oo))
																	{
																			$price=$dr2['price'];
																			$itemname=$dr2['itemname'];
																			$image=$dr2['image'];
																				echo"<tr><td>$itemname</td><td>$price</td><td><img src='$image' style='height:50px;width:50px; border-radius:50%' /></td></tr>";
																	}
																}
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