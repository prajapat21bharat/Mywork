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
			var vendorid=document.getElementsByName("vendorid")[0].value;
			var category=document.getElementsByName("category")[0].value;
			var menuitem=document.getElementsByName("menuitem")[0].value;
			var price=document.getElementsByName("price")[0].value;
			var menu_image=document.getElementsByName("menu_image")[0].value;
			if(vendorid=="")
			{
				document.getElementById("Svendorid").innerHTML=" Please Enter Vendor Id";
				return false;
				document.getElementById("vendorid").focus();
				
			}
			
			if(category=="")
			{
				document.getElementById("Scategory").innerHTML=" Please Select Category";
				return false;
				document.getElementById("category").focus();
							}
			if(category!=="")
			{
				document.getElementById("Scategory").innerHTML="";
			}
			if(menuitem=="")
			{
				document.getElementById("Smenuitem").innerHTML=" Please Enter Item name";
				return false;
				document.getElementById("menuitem").focus();
							}
			if(menuitem!=="")
			{
				document.getElementById("Smenuitem").innerHTML="";
			}
			if(price=="")
			{
				document.getElementById("Sprice").innerHTML=" Please Enter Price";
				return false;
				document.getElementById("price").focus();
							}
else
			{
				var a = isNaN(price)
				if(a)
					{
						//alert('Error: Only Numbers are allowed !');
						document.getElementById("price").focus();
						document.getElementById("Sprice").innerHTML=" Please Enter Valid Price";
						return false;
					}
			}
			if(price!=="")
			{
				document.getElementById("Sprice").innerHTML="";
			}
			if(menu_image!=="")
			{
					//var imagetype=(".gif" || ".png" || ".bmp" || ".jpeg" || ".jpg" || ".GIF" || ".PNG" || ".JPEG" || ".JPG" || ".BMP");
					var imagetype=/^\S+\.(jpg|jpeg|png|JPG|JPEG|PNG)$/;
					if(!menu_image.match(imagetype))
					{
					//		alert('Please Enter a Valid Image Type. Only JPEG, JPG, PNG, GIF, & BMP Is Allowed.');  
						document.getElementById("menu_image").focus();				
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
                if($_SESSION["login"] != 'admin@canopus.com')
                 {
		include("menu.php");
                 }
                ?>
			<div id="darkbanner" class="banner320">
   <!-- <img src="../images/client.png"> -->
   <h2>Add New Menu</h2>
</div>
<div id="darkbannerwrap">
</div>
<form name="form1" method="post" onSubmit="return valid()" enctype="multipart/form-data">
   <fieldset class="form">
      <legend>Provide Menu Details</legend>
            
      <p><?php
        	 echo"<input name='vendorid' type='hidden' id='vendorid' value='$id' />";
		 ?>
         <input name="userlevel" type="hidden" id="userlevel" value="1">
      </p>
      <p>
		<label for="category"><span id="SContact" style="color:red;font-size:14px;">* </span>Itemname:</label>
		<select name="category" ><span id="category" style="color:red"></span>
			<option selected="selected" value="">Select Category</option>
				  <?php
					  $sql="SELECT id,name FROM menucategory where vid=$id";
					  //echo $sql;exit;
						$result=mysql_query($sql);
							if($result)
							{
							while($userInfo = mysql_fetch_array($result))
										{
											$menuid=$userInfo[0];
											
											$menuname=$userInfo[1];
											echo"<option value='$menuid'>$menuname</option>";
										}
							}
					?>
         </select><span id="Scategory" style="color:red"></span>
      </p>
      <p>
         <label for="menuitem"><span id="SContact" style="color:red;font-size:14px;">* </span>Menu Item:</label>
         <input name="menuitem" type="text" id="menuitem" value="" /><span id="Smenuitem" style="color:red"></span>
      </p>
	  <p>
         <label for="price"><span id="SContact" style="color:red;font-size:14px;">* </span>Price:</label>
         <input name="price" type="text" id="price" onkeypress="javascript:return OnlyValues(event);" /><span id="Sprice" style="color:red"></span>
      </p>    
       <p>
         <label for="description">Description:</label>
         <input name="description" type="text" id="price" /><span id="Sdescription" style="color:red"></span>
      </p>    
       <p>
         <label for="remark">Remark:</label>
         <input name="remark" type="text" id="remark" /><span id="Sremark" style="color:red"></span>
      </p>    
       <p>
         <label for="image">Image:</label>
		 <input name="menu_image" type="file" id="menu_image" class="image" /><span id="Simage" style="color:red"></span>
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
				$menuitem=$_POST["menuitem"];
				$price=$_POST["price"];
				$description=$_POST["description"];
				$remark=$_POST["remark"];
				/*$imgname=$_FILES['menu_image']['name'];
				$imgtmp=$_FILES['menu_image']['tmp_name'];
				move_uploaded_file($imgtmp,"Imgs/".$imgname) or die (mysql_error());
				$path="Imgs/".$imgname;
				*/
				//------Upload Image code
$rand_no =  date('Y-m-d H-i-s');
$rand_no = str_replace(' ', '', $rand_no);
$filename=$rand_no.'.jpg';
move_uploaded_file($_FILES["menu_image"]["tmp_name"],"upload/" . $filename);
$files="http://testgrubtracker.canopussystems.com/upload/". $filename;
//----	
				//$imgname=$_FILES['menu_image']['name'];
				//$imgtmp=$_FILES['menu_image']['tmp_name'];
				//move_uploaded_file('$imgname','upload/'.$imgname);
				
				 $sql1="SELECT * FROM `menu` where vid='$id'and itemname='$menuitem' and price='$price' and categoryid='$category'";		
						$result1=mysql_query($sql1);
						if($result1)
						{
							if(mysql_num_rows($result1)<=0)
							{
								$sql="INSERT INTO menu(vid,categoryid,itemname,price,description,remark,image)VALUES(trim('$id'),trim('$category'),trim('$menuitem'),trim('$price'),trim('$description'),trim('$remark'),trim('$files'))";
								
			/*						$sql="INSERT INTO menucategory(vid,name) values('$vendorid','$category')";*/
												$result=mysql_query($sql);
												if(($result) or die(mysql_error()))
												{
												echo"<script>alert('Menu Category Added Successful')</script>";
												}
							}
												else
												{
													echo"<script>alert('Item  Already Exists !')</script>";
												}
						}
				}
?>
   </body>
   </html>