<?php include 'checksession.php'?>
<!DOCTYPE html>
<html>
   <head>
   	<?php
		include("connection.php");
	?>
      <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
      <link rel="shortcut icon" type="image/ico" href="../images/favicon.ico" />
      <title>Grub Tracker</title>
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
			var category=document.getElementsByName("category")[0].value;
			//var category_image=document.getElementsByName("category_image")[0].value;
			if(category=="")
			{
				document.getElementById("Scategory").innerHTML=" Please Enter Category name";
				return false;
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
  </ul>-->	<?php 
					include("menu.php");
				?>
			<div id="darkbanner" class="banner320">
 
   <h2>Add New Menu Category</h2>
</div>
<div id="darkbannerwrap">
</div>
<form name="form1" method="post" onSubmit="return valid()" enctype="multipart/form-data">
   <fieldset class="form">
      <legend>Provide Menu Category Details</legend>
      <p>
         <label for="category"><span id="SContact" style="color:red;font-size:14px;">* </span>Category Name:</label>
		 <input name="category" type="text" id="category" onkeypress="javascript:return OnlyValues(event);" /><span id="Scategory" style="color:red"></span>
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
				$category=$_POST["category"];				
                 $sql1="SELECT * FROM menucategory WHERE vid='$id' AND name='$category'";		
						$result1=mysql_query($sql1);
						if($result1)
						{	
							if(mysql_num_rows($result1)<=0)
							{
									
										//Do image stuff and query
										$sql="INSERT INTO menucategory(vid,name) values('$id','$category')";
										$result=mysql_query($sql);
										if(($result)or die(mysql_error()))
										{
										echo"<script>alert('Menu Category Added Successfully')</script>";
										}									
							}
							else
									{
										echo"<script>alert('Error: Category Already Exists !')</script>";
									}
						}
			}
		?>
   </body>
   </html>