<?php
	$this->load->view('includes/header_session');
?>
<script>
	function show()
        {
            document.getElementById("firstname").style.display = "block";
            document.getElementById("lastname").style.display = "block";
            document.getElementById("change").style.display = "block";
            document.getElementById("lbl_firstname").style.display = "none";
            document.getElementById("lbl_lastname").style.display = "none";
            document.getElementById("a_fname").style.display = "none";
            document.getElementById("a_lname").style.display = "none";
            return false;
        }
        function showpic()
        {
            document.getElementById("userfile").style.display = "block";
            document.getElementById("change").style.display = "block";
            document.getElementById("oldpic").style.display = "none";
            document.getElementById("a_upload").style.display = "none";
            //document.getElementById("lbl_firstname").style.display = "none";
            
            return false;
		}
		function valid_details()
		{
			var no_error=0;
			var firstname=document.getElementById("firstname").value;
			if(firstname=="")
			{
				document.getElementById("err_firstname").style.display = "block";
				document.getElementById("err_firstname").innerHTML = "Please Enter Firstname";
				//return false;
				no_error=1;
			}
			else
			{
				var letters = /^[A-Za-z]+$/;  
				if(!firstname.match(letters))  
				{
							//alert('Please Enter First Name in Alphabet Characters only Ex. A-Z or a-z');
					document.getElementById("err_firstname").style.display = "block";
					document.getElementById("err_firstname").innerHTML="Only A-Z or a-z Characters are allowed";  
					//return false; 
					no_error=1; 
				}
				else
				{
					if((firstname.length<=2)||(firstname.length>=14))
					{
						document.getElementById("err_firstname").style.display = "block";
						document.getElementById("err_firstname").innerHTML="Min. 3 & Max. 14 Characters are Allowed";  
						//return false; 
						no_error=1;
 					}
					else
					{
						document.getElementById("err_firstname").style.display = "none";
						document.getElementById("err_firstname").innerHTML = "";
					}
				}
			}
			
			
			var lastname=document.getElementById("lastname").value;
			if(lastname=="")
			{
				document.getElementById("err_lastname").style.display = "block";
				document.getElementById("err_lastname").innerHTML = "Please Enter Lastname";
				//return false;
				no_error=1;
			}
			else
			{
				var letters = /^[A-Za-z]+$/;  
				if(!lastname.match(letters))  
				{
							//alert('Please Enter First Name in Alphabet Characters only Ex. A-Z or a-z');
					document.getElementById("err_lastname").style.display = "block";
					document.getElementById("err_lastname").innerHTML="Only A-Z or a-z Characters are allowed";  
					//return false; 
					no_error=1; 
				}
				else
				{
					if((lastname.length<=2)||(lastname.length>=14))
					{
						document.getElementById("err_lastname").style.display = "block";
						document.getElementById("err_lastname").innerHTML="Min. 3 & Max. 14 Characters are Allowed";  
						//return false; 
						no_error=1;
 					}
					else
					{
						document.getElementById("err_lastname").style.display = "none";
						document.getElementById("err_lastname").innerHTML = "";
					}
				}
			}
			
			
			if(no_error==0)
			{
				return true;
			}
			else
			{
				return false;
			}
			
		}
	/*	function valid_file()
		{
			var res_field = document.profile_form.elements["userfile"].value;   
			var extension = res_field.substr(res_field.lastIndexOf('.') + 1).toLowerCase();
			var allowedExtensions = ['jpg', 'jpeg', 'png', 'bmp'];
			if(res_field=="")
			{
				document.getElementById("invalidfile").style.display = "block";
				document.getElementById("invalidfile").innerHTML = "Please Select a File to Upload";
				//alert('Invalid file Format. Only ' + allowedExtensions.join(', ') + ' are allowed.');
				return false;
			}
			if(res_field.length > 0)
			{
				if (allowedExtensions.indexOf(extension) === -1) 
				{
					document.getElementById("invalidfile").style.display = "block";
					document.getElementById("invalidfile").innerHTML = "The filetype you are attempting to upload is not allowed.";
					//alert('Invalid file Format. Only ' + allowedExtensions.join(', ') + ' are allowed.');
					return false;
				}
			}
		}*/
		
</script>
<?php
	$this->load->view('includes/admin_menu');
?>
<div class="container">
	<div class="content-data">
		<div class="message" style="margin:0px auto;"><?php  if($this->session->flashdata('Logmsg'))   echo  $this->session->flashdata('Logmsg'); ?></div>
		<form action="<?php echo site_url()?>/admin/profile" method="post" accept="image/*" id="profile_form" onsubmit="return valid_details()" enctype="multipart/form-data">
		<table align="center" cellspacing="5px" cellpadding="5px" style="background:#EEEEEE;margin-bottom:15px">
			<tr>
				<td class="tbl_add_cate">Firstname</td>
				<td class="tbl_add_cate">
					<input type="text" name="firstname" id="firstname" class="txt_popup" style="display:none;" value="<?php echo $getprofile[0]['firstname']; ?>"/>
					<span id="err_firstname" "display:none;" class="error" ></span>
					<label for="firstname" id="lbl_firstname"><?php echo $getprofile[0]['firstname']; ?></label>
					<a href="" onclick="return show()" id="a_fname">Edit</a></td>
			</tr>
			<tr>
				<td class="tbl_add_cate">Last Name</td>
				<td class="tbl_add_cate">
					<input type="text" name="lastname" id="lastname" class="txt_popup" style="display:none;"  value="<?php echo $getprofile[0]['lastname']; ?>"/>
					<span id="err_lastname" "display:none;" class="error" ></span>
					<label for="lastname" id="lbl_lastname"><?php echo $getprofile[0]['lastname']; ?></label>
					<a href="" onclick="return show()" id="a_lname">Edit</a></td>
			</tr>
		<!--	<tr>
				<td class="tbl_add_cate">Gender</td>
				<td class="tbl_add_cate">
					<input type="radio" name="gender" id="male" value="male" <?php if($getprofile[0]['gender']=="male"){echo "selected";} ?> /><label for="male" class="radio">Male</label>
					<input type="radio" name="gender" id="female" value="female" <?php if($getprofile[0]['gender']=="female"){echo "selected";} ?> /><label for="female" class="radio">Female</label></td>
			</tr>-->
			<tr>
				<td class="tbl_add_cate">Profile Pic</td>
				<td class="tbl_add_cate">
				<input type="hidden" value="<? echo $getprofile[0]['image'] ;?>" name="existingimage" id="existingimage" />
				
				<img src="<?php echo base_url().'/ast/images/uploads/userpic/'.$getprofile[0]['image'];?>" id="oldpic" class="" style="height:50px; width:50px; margin-left:10px; border:1px solid #FFFFFF;" />
				<input type="file" name="userfile" id="userfile" style="display:none;" >
				<a href="" id="a_upload" style="margin-right:50px;" onclick="return showpic()">Upload New</a>
				</td>
			</tr>
			<tr>
				<td class="tbl_add_cate" colspan="2" align="right"><input type="submit" name="change" id="change" style="display:none;" value="Change" class="bttn_popup" /></td>
			</tr>
		</table>
		</form>
	</div>
</div>
<?php
	$this->load->view('includes/footer_session');
?>
